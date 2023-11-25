<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{ 
    
    public function getProfileData()
    {
         // Lakukan panggilan API menggunakan HTTP client untuk get /Profile
         $client = \Config\Services::curlrequest();
        
         // Ambil Token dari Sesi Logins
         $token = session()->get('userToken');
 
         $url = "https://take-home-test-api.nutech-integrasi.app/profile";
         $headers = [
             'Authorization' => 'Bearer ' . $token
         ];
         $response = $client->request('GET', $url, ['headers' => $headers]);
 
         // Mengembalikan hasil JSON
         return json_decode($response->getBody(), true);
    }
}

