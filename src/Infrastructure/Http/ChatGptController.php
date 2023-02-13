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
        $question = $parameters['question'] ?? '';

        $answer = $this->chatGptManager->getAnswer($question);
        if (!$answer) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($answer);
    }
}
