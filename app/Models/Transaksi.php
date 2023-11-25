<?php

namespace App\Models;

use CodeIgniter\Model;

class Transaksi extends Model
{
    protected $table = 'transaction_history'; 
        // Fungsi untuk memanggil data service
        public function getTransaksiData($token, $limit = null){
            // Lakukan panggilan API menggunakan HTTP client untuk get /Profile
            $client = \Config\Services::curlrequest();
           
            // Ambil Token dari Sesi Logins
            $token = session()->get('userToken');
    
            $url = "https://take-home-test-api.nutech-integrasi.app/transaction/history";
            $headers = [
                'Authorization' => 'Bearer ' . $token
            ];

            // Jika ada limit, tambahkan ke dalam URL
        if ($limit !== null) {
            $url .= '?limit=' . $limit;
        }
            $response = $client->request('GET', $url, ['headers' => $headers]);
    
            // Mengembalikan hasil JSON
            return json_decode($response->getBody(), true);
       }
   
}
