<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\LLMService;

class ChatBotController extends Controller
{

    public function __construct(protected LLMService $llmservice) {}

    public function chatBot(string $prompt)
    {
        $response = $this->llmservice->chat($prompt);

        dd($response);
    }
}
