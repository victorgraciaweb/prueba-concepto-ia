<?php

namespace App\Application\Service;

use OpenAI;

class ChatGptManager
{
    public function getAnswer(string $question): string
    {
        $client = OpenAI::client($_ENV['API_KEY_OPENAI']);

        $result = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $question,
        ]);

        echo $result['choices'][0]['text']; // an open-source, widely-used, server-side scripting language.
        return "Hola";
    }
}
