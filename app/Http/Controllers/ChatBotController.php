<?php

namespace App\Http\Controllers;

use App\Service\LLMService;
use App\Http\Requests\ChatBot\ChatRequest;
use Illuminate\Support\Facades\Log;

class ChatBotController extends Controller
{

    public function __construct(protected LLMService $llmservice) {}

    public function chatBot(ChatRequest $request)
    {
        $fields = $request->validated();
        $response = $this->llmservice->chat($fields['question']);


        return [
            "answer" => $response
        ];
    }
}
