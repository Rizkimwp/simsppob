<?php

namespace App\Models;

use CodeIgniter\Model;

class Balance extends Model

{  public function getBalanceData()
    {
         // Lakukan panggilan API menggunakan HTTP client untuk get /Profile
         $client = \Config\Services::curlrequest();
        
         // Ambil Token dari Sesi Logins
         $token = session()->get('userToken');
 
         $url = "https://take-home-test-api.nutech-integrasi.app/balance";
         $headers = [
             'Authorization' => 'Bearer ' . $token
         ];
         $response = $client->request('GET', $url, ['headers' => $headers]);
 
         // Mengembalikan hasil JSON
         return json_decode($response->getBody(), true);
    }
}
