<?php

namespace App\Application\Service;

use OpenAI;

class ChatGptManager
{
    /**
     * @param string $question
     * @return array
     */
    public function getAnswer(string $question): array
    {
        $client = OpenAI::client($_ENV['API_KEY_OPENAI']);

        $response = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $question,
            'max_tokens' => 4000,
            'temperature' => 0
        ]);

        /*$response->id;
        $response->object;
        $response->created;
        $response->model;

        foreach ($response->choices as $result) {
            $result->text;
            $result->index;
            $result->logprobs;
            $result->finishReason;
        }

        $response->usage->promptTokens;
        $response->usage->completionTokens;
        $response->usage->totalTokens;*/

        return $response->toArray();
    }
}
