<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    public function login($username, $password)
    {
        $client = \Config\Services::curlrequest();

        $data = [
            'username' => $username,
            'password' => $password
        ];

        $response = $client->request('POST', 'https://take-home-test-api.nutech-integrasi.app/login', [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $data
        ]);

        if ($response->getStatusCode() === 200) {
            $result = json_decode($response->getBody());
            return $result->session_token; // Mengembalikan session/token untuk disimpan
        } else {
            return false; // Login gagal
        }
    }

    // Metode lain untuk melakukan permintaan ke endpoint lain yang memerlukan otentikasi
    public function authenticatedRequest($sessionToken)
    {
        $client = \Config\Services::curlrequest();

        $response = $client->request('GET', 'https://take-home-test-api.nutech-integrasi.app/other_endpoint', [
            'headers' => [
                'Authorization' => 'Bearer ' . $sessionToken
            ]
        ]);

        if ($response->getStatusCode() === 200) {
            return json_decode($response->getBody());
        } else {
            return false; // Permintaan gagal karena otentikasi
        }
    }
}
