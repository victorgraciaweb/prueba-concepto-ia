<?php

namespace App\Application\Service;

use OpenAI;

class ChatGptManager
{
    /**
     * @param string $question
     * @return array
     */
    public function getAnswer(string $model, string $prompt, int $max_tokens, int $temperature): array
    {
        // Criterios de búsqueda
        // (1) Deportista: Rafa Nadal
        // (2) Lugar-Organización: Uefa
        // (3) Equipo: Argentina

        /*
         * Temperatura, entre 0 y 1. A mas cerca del 0 mas real y la búsqueda mas cercana. Mas cerca del
         * 1 será una búsqueda mas diversa.
         * Por lo general, es mejor configurar una temperatura baja para tareas en las que el resultado
         * deseado está bien definido. Una temperatura más alta puede ser útil para tareas en
         * las que se desea variedad o creatividad, o si desea generar algunas variaciones para que
         * elijan sus usuarios finales o expertos humanos.
         * Para su generador de nombres de mascotas, probablemente desee poder generar muchas ideas
         * de nombres. Una temperatura moderada de 0,6 debería funcionar bien.
        */

        $client = OpenAI::client($_ENV['API_KEY_OPENAI']);

        $response = $client->completions()->create([
            'model' => $model,
            'prompt' => $prompt,
            'max_tokens' => $max_tokens,
            'temperature' => $temperature
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
