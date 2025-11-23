<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIService
{
    protected $openaiApiKey;
    protected $geminiApiKey;

    public function __construct()
    {
        $this->openaiApiKey = env('OPENAI_API_KEY');
        $this->geminiApiKey = env('GEMINI_API_KEY');
    }

    public function generateSummary(string $description): string
    {
        if ($this->openaiApiKey) {
            return $this->generateSummaryWithOpenAI($description);
        }

        if ($this->geminiApiKey) {
            return $this->generateSummaryWithGemini($description);
        }

        // Fallback: return first 200 characters
        return substr($description, 0, 200) . (strlen($description) > 200 ? '...' : '');
    }

    public function generateCategory(string $description): string
    {
        if ($this->openaiApiKey) {
            return $this->generateCategoryWithOpenAI($description);
        }

        if ($this->geminiApiKey) {
            return $this->generateCategoryWithGemini($description);
        }

        // Fallback
        return 'general';
    }

    public function generateUrgency(string $description): string
    {
        if ($this->openaiApiKey) {
            return $this->generateUrgencyWithOpenAI($description);
        }

        if ($this->geminiApiKey) {
            return $this->generateUrgencyWithGemini($description);
        }

        // Fallback
        return 'low';
    }

    protected function generateSummaryWithOpenAI(string $description): string
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->openaiApiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a helpful assistant that creates concise summaries of incident reports in Indonesian language.'
                    ],
                    [
                        'role' => 'user',
                        'content' => "Buatkan ringkasan singkat dari laporan kejadian berikut (maksimal 150 kata):\n\n" . $description
                    ]
                ],
                'max_tokens' => 200,
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                $result = $response->json();
                return $result['choices'][0]['message']['content'] ?? substr($description, 0, 200);
            }
        } catch (\Exception $e) {
            Log::error('OpenAI API Error: ' . $e->getMessage());
        }

        return substr($description, 0, 200);
    }

    protected function generateCategoryWithOpenAI(string $description): string
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->openaiApiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a helpful assistant that categorizes incident reports. Return only one word category in Indonesian: infrastruktur, keamanan, kesehatan, lingkungan, lalu-lintas, atau umum.'
                    ],
                    [
                        'role' => 'user',
                        'content' => "Kategorikan laporan kejadian berikut:\n\n" . $description
                    ]
                ],
                'max_tokens' => 50,
                'temperature' => 0.3,
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $category = trim($result['choices'][0]['message']['content'] ?? 'umum');
                return strtolower($category);
            }
        } catch (\Exception $e) {
            Log::error('OpenAI API Error: ' . $e->getMessage());
        }

        return 'umum';
    }

    protected function generateUrgencyWithOpenAI(string $description): string
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->openaiApiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a helpful assistant that determines urgency level. Return only one word: low, medium, or high.'
                    ],
                    [
                        'role' => 'user',
                        'content' => "Tentukan level urgensi dari laporan kejadian berikut (low, medium, atau high):\n\n" . $description
                    ]
                ],
                'max_tokens' => 10,
                'temperature' => 0.2,
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $urgency = strtolower(trim($result['choices'][0]['message']['content'] ?? 'low'));
                return in_array($urgency, ['low', 'medium', 'high']) ? $urgency : 'low';
            }
        } catch (\Exception $e) {
            Log::error('OpenAI API Error: ' . $e->getMessage());
        }

        return 'low';
    }

    protected function generateSummaryWithGemini(string $description): string
    {
        try {
            $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$this->geminiApiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => "Buatkan ringkasan singkat dari laporan kejadian berikut (maksimal 150 kata):\n\n" . $description
                            ]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'maxOutputTokens' => 200,
                    'temperature' => 0.7,
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                return $result['candidates'][0]['content']['parts'][0]['text'] ?? substr($description, 0, 200);
            }
        } catch (\Exception $e) {
            Log::error('Gemini API Error: ' . $e->getMessage());
        }

        return substr($description, 0, 200);
    }

    protected function generateCategoryWithGemini(string $description): string
    {
        try {
            $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$this->geminiApiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => "Kategorikan laporan kejadian berikut. Jawab hanya satu kata: infrastruktur, keamanan, kesehatan, lingkungan, lalu-lintas, atau umum.\n\n" . $description
                            ]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'maxOutputTokens' => 50,
                    'temperature' => 0.3,
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $category = trim(strtolower($result['candidates'][0]['content']['parts'][0]['text'] ?? 'umum'));
                return $category;
            }
        } catch (\Exception $e) {
            Log::error('Gemini API Error: ' . $e->getMessage());
        }

        return 'umum';
    }

    protected function generateUrgencyWithGemini(string $description): string
    {
        try {
            $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$this->geminiApiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => "Tentukan level urgensi dari laporan kejadian berikut. Jawab hanya satu kata: low, medium, atau high.\n\n" . $description
                            ]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'maxOutputTokens' => 10,
                    'temperature' => 0.2,
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $urgency = strtolower(trim($result['candidates'][0]['content']['parts'][0]['text'] ?? 'low'));
                return in_array($urgency, ['low', 'medium', 'high']) ? $urgency : 'low';
            }
        } catch (\Exception $e) {
            Log::error('Gemini API Error: ' . $e->getMessage());
        }

        return 'low';
    }
}


