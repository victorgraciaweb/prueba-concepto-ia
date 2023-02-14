<?php

namespace App\Infrastructure\Http;

use App\Application\Service\ChatGptManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChatGptController
{
    private ChatGptManager $chatGptManager;

    /**
     * @param ChatGptManager $chatGptManager
     */
    public function __construct(ChatGptManager $chatGptManager)
    {
        $this->chatGptManager = $chatGptManager;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function sendRequest(Request $request): JsonResponse
    {
        $parameters = json_decode($request->getContent(), true);
        $model = $parameters['model'] ?? '';
        $prompt = $parameters['prompt'] ?? '';
        $max_tokens = $parameters['max_tokens'] ?? '';
        $temperature = $parameters['temperature'] ?? '';

        $answer = $this->chatGptManager->getAnswer($model, $prompt, $max_tokens, $temperature);
        if (!$answer) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($answer);
    }
}
