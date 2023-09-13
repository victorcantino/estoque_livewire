<?php

namespace App\Http\Traits;

use Exception;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

trait HttpTrait
{
    public function sendGetRequest($url)
    {
        return $this->sendHttpRequest('get', $url);
    }

    public function sendPostRequest($url, $data = [])
    {
        return $this->sendHttpRequest('post', $url, $data);
    }

    public function sendPutRequest($url, $data = [])
    {
        return $this->sendHttpRequest('put', $url, $data);
    }

    public function sendDeleteRequest($url)
    {
        return $this->sendHttpRequest('delete', $url);
    }

    private function sendHttpRequest($method, $url, $data = [])
    {
        try {
            // Acesse a constante global SERVER_URL
            $serverUrl = config('app.SERVER_URL');

            // Agora você pode usá-la no URL do seu método HTTP
            $fullUrl = $serverUrl . $url;
            // Envie a solicitação HTTP
            $response = Http::$method($fullUrl, $data);

            if ($response->successful()) {
                return $response->json();
            } else {
                // Você pode lançar uma exceção personalizada aqui ou tratar o erro de outra forma
                return ['error' => 'Erro ao fazer a solicitação HTTP: ' . $response->status()];
            }
        } catch (RequestException $e) {
            // Captura exceções relacionadas à solicitação HTTP (por exemplo, falha na rede)
            // Você pode lançar uma exceção personalizada aqui ou tratar o erro de outra forma
            return ['error' => 'Erro ao fazer a solicitação HTTP: ' . $e->getMessage()];
        } catch (Exception $e) {
            // Captura exceções gerais
            // Você pode lançar uma exceção personalizada aqui ou tratar o erro de outra forma
            return ['error' => 'Erro desconhecido: ' . $e->getMessage()];
        }
    }
}
