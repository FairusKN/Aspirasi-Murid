<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class LLMService
{
    //protected $groq_base_url;
    //protected $groq_model;
    protected $n8n_base_url;
    protected $chat_endpoint;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //$this->groq_base_url = config('services.groq.base_url');
        //$this->groq_model = config('services.groq.model');

        $this->n8n_base_url = config('services.n8n.base_url');
        $this->chat_endpoint = $this->n8n_base_url . "/aspirasi-chat";
    }

    public function chat(string $prompt): string
    {
        $response = Http::post(
            $this->chat_endpoint,
            [
                "question" => $prompt
            ]
        );

        return $response->json('output');
    }
}
