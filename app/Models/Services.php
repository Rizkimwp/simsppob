<?php

namespace App\Models;

use CodeIgniter\Model;

class Services extends Model
{
     
 

    // Fungsi untuk memanggil data service
    public function getServicesData(){
         // Lakukan panggilan API menggunakan HTTP client untuk get /Profile
         $client = \Config\Services::curlrequest();
        
         // Ambil Token dari Sesi Logins
         $token = session()->get('userToken');
 
         $url = "https://take-home-test-api.nutech-integrasi.app/services";
         $headers = [
             'Authorization' => 'Bearer ' . $token
         ];
         $response = $client->request('GET', $url, ['headers' => $headers]);
 
         // Mengembalikan hasil JSON
         return json_decode($response->getBody(), true);
    }

    // Fungsi untuk mendapatkan semua layanan dari Database 
    public function getAllServices()
    {
        return $this->findAll();
    }

    // Fungsi untuk mendapatkan detail layanan berdasarkan ID
    public function getServiceByID($id)
    {
        return $this->find($id);
    }
}
