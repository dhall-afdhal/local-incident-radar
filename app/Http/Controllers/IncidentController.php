<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Services\AIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IncidentController extends Controller
{
    protected $aiService;

    public function __construct(AIService $aiService)
    {
        $this->aiService = $aiService;
    }

    public function index(Request $request)
    {
        $query = Incident::with('user')->latest();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by urgency
        if ($request->filled('urgency')) {
            $query->where('urgency_level', $request->urgency);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $incidents = $query->paginate(15);

        return view('incidents.index', compact('incidents'));
    }

    public function create()
    {
        return view('incidents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('incidents', 'public');
        }

        $incident = Incident::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'image_path' => $imagePath,
            'status' => 'pending',
        ]);

        // Process AI automatically after creation
        try {
            $description = $incident->description;
            $incident->update([
                'summary' => $this->aiService->generateSummary($description),
                'category' => $this->aiService->generateCategory($description),
                'urgency_level' => $this->aiService->generateUrgency($description),
                'status' => 'reviewed',
            ]);
        } catch (\Exception $e) {
            // If AI processing fails, keep incident as pending
            Log::error('AI Processing Error: ' . $e->getMessage());
        }

        return redirect()->route('incidents.show', $incident)
            ->with('success', 'Laporan berhasil dibuat dan diproses dengan AI.');
    }

    public function show(Incident $incident)
    {
        $incident->load('user');
        return view('incidents.show', compact('incident'));
    }

    public function processAI(Incident $incident)
    {
        if ($incident->summary && $incident->category) {
            return redirect()->route('incidents.show', $incident)
                ->with('info', 'Laporan sudah diproses sebelumnya.');
        }

        try {
            $description = $incident->description;

            $incident->update([
                'summary' => $this->aiService->generateSummary($description),
                'category' => $this->aiService->generateCategory($description),
                'urgency_level' => $this->aiService->generateUrgency($description),
                'status' => 'reviewed',
            ]);

            return redirect()->route('incidents.show', $incident)
                ->with('success', 'Laporan berhasil diproses dengan AI.');
        } catch (\Exception $e) {
            return redirect()->route('incidents.show', $incident)
                ->with('error', 'Terjadi kesalahan saat memproses laporan: ' . $e->getMessage());
        }
    }

    public function map()
    {
        return view('incidents.map');
    }

    public function apiMap()
    {
        $incidents = Incident::select('id', 'title', 'latitude', 'longitude', 'urgency_level', 'category')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return response()->json($incidents);
    }
}

