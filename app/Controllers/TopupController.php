<?php

namespace App\Controllers;
use App\Models\ProfileModel;
use App\Controllers\BaseController;
use App\Models\Balance;

class TopupController extends BaseController
{
    public function index()
    {
        $profileModel = new ProfileModel();
        $profileData = $profileModel->getProfileData();
        $balanceModel = new Balance(); 
        $balance = $balanceModel->getBalanceData();
        $formatBalance = $balance['data']['balance'];
        $balanceData = number_format($formatBalance, 0, ',', '.');
        
        // Tampilkan view homepage dan kirim data profil
        return view('homepage/topup', [
            'profileData' => $profileData,
            'balanceData' => $balanceData
    ]);
    }

    public function topup () {
        
        $amount = $this->request->getVar('top_up_amount'); 

        $validation =  \Config\Services::validation();

        $validation = [ 'top_up_amount' => 'required|int'];

         // Validasi data sebelum top up
    if ($amount < 10000 || $amount> 1000000) {
        // Jika tidak memenuhi kriteria, lakukan sesuai penanganan yang kamu inginkan
        // Contoh: Tampilkan pesan kesalahan atau ambil tindakan yang sesuai
        return redirect()->to('/topup')->with('error', 'Jumlah top up harus antara 10,000 sampai 1,000,000');
    }


    
        $token = session()->get('userToken');
        $client = \Config\Services::curlrequest();
        $headers = [
            'Authorization' => 'Bearer ' . $token
        ];

try {
    $response = $client->request('POST', "https://take-home-test-api.nutech-integrasi.app/topup", [
        'headers' => $headers,
        'json' => [ 
            'top_up_amount' => $amount
        ]
    ]);
    

    $body = $response->getBody();
    $statusCode = $response->getStatusCode();

    // Penanganan berdasarkan status code
    switch ($statusCode) {
        case 200:
            $responseData = json_decode($body, true);

            // Validasi status 0 (Request Successfully)
            if ($responseData['status'] === 0) {
                $balance = $responseData['data']['balance'];
                $message = 'Top up berhasil. Saldo sekarang: ' . $balance;
                $response = [
                    'status' => 'success',
                    'message' => $message
                ];
                return $this->response->setStatusCode(200)->setJSON($response);
            } else {
                $errorMessage = $responseData['message'];
                return $this->response->setStatusCode(400)->setJSON(['error' => $errorMessage]);
            }
            break;
        case 400:
            $errorData = json_decode($body, true);

            // Validasi status 102 (Bad Request)
            if ($errorData['status'] === 102) {
                $errorMessage = $errorData['message'];
                return $this->response->setStatusCode(400)->setJSON(['error' => $errorMessage]);
            }
            break;
        case 401:
            $errorData = json_decode($body, true);

            // Validasi status 108 (Unauthorized)
            if ($errorData['status'] === 108) {
                $errorMessage = $errorData['message'];
                return $this->response->setStatusCode(401)->setJSON(['error' => $errorMessage]);
            }
            break;
        default:
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Terjadi kesalahan']);
            break;
    }
} catch (\Exception $e) {
    $errorMessage = 'Terjadi kesalahan: ' . $e->getMessage();
    return $this->response->setStatusCode(500)->setJSON(['error' => $errorMessage]);
}

    }
}
