<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class ViaCepService
{
    protected const API_BASE_URL = "https://viacep.com.br/ws/";

    /**
     * Consulta informações do CEP
     * @param string $cep
     * @return object|null
     */
    public static function consultaCEP(string $cep): object | null
    {
        $endPoint = self::API_BASE_URL . "$cep/json";

        $response = Http::get($endPoint);

        if ($response->status() !== 200) {
            return null;
        }

        return $response
            ->object();
    }
}
