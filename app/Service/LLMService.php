<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class LLMService
{
    protected $groq_base_url;
    protected $groq_model;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->groq_base_url = config('services.groq.base_url');
        $this->groq_model = config('services.groq.model');
    }

    public function chat(string $prompt)
    {
        $response = Http::withToken(config('services.groq.key'))
            ->post($this->groq_base_url . '/chat/completions', [
                'model' => $this->groq_model,
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                    ['role' => 'user', 'content' => $prompt],
                ]
            ]);

        return $response->json('choices.0.message.content');
    }
}
