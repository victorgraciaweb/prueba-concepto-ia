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

        $response->id; // 'cmpl-uqkvlQyYK7bGYrRHQ0eXlWi7'
        $response->object; // 'text_completion'
        $response->created; // 1589478378
        $response->model; // 'text-davinci-003'

        foreach ($response->choices as $result) {
            $result->text; // '\n\nThis is a test'
            $result->index; // 0
            $result->logprobs; // null
            $result->finishReason; // 'length'
        }

        $response->usage->promptTokens; // 5,
        $response->usage->completionTokens; // 6,
        $response->usage->totalTokens; // 11


        return $response->toArray(); // ['id' => 'cmpl-uqkvlQyYK7bGYrRHQ0eXlWi7', ...]
    }
}
