<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfileModel;
use App\Models\Services;
use App\Models\Balance;

class TransaksiController extends BaseController
{
    public function index($serviceCode)
    {
        // Ambil Profile Data
        $profileModel = new ProfileModel();
        $profileData = $profileModel->getProfileData();
        // Ambil Services Data
        $transaksiModel = new Services();
        $transaksiData = $transaksiModel->getServicesData();
        // Ambil Balance Data
        $balanceModel = new Balance();
        $balance = $balanceModel->getBalanceData();

        // Merubah Format Saldo ke Rupiah 
        $formatBalance = $balance['data']['balance'];
        $balanceData = number_format($formatBalance, 0, ',', '.');

        $selectedService = null;

        // Temukan layanan dengan serviceCode yang sesuai
        foreach ($transaksiData['data'] as $transaksi) {
            if ($transaksi['service_code'] === $serviceCode) {
                $selectedService = $transaksi;
                break;
            }
        }
        // Tampilkan view transaksi dengan data yang sesuai
        return view('homepage/transaction', [
            'transaksiData' => $selectedService,
            'profileData' => $profileData,
            'balanceData' => $balanceData
        ]);
    }


    // Fungsi Transaksi 
    public function store()
    {
        // Ambim Nilai Service Code 
        $service = $this->request->getVar('service_code');
        $servicetarif = $this->request->getVar('service_tarif');

        $balance = new Balance();
        $balanceData = $balance->getBalanceData();
        $balanceResponse = $balanceData['data']['balance'];
        $amountToTransact = $servicetarif;

        if ($balanceResponse < $amountToTransact) {
            return redirect()->to('transaksi/'.$service)->with('errorMessage', 'Saldo tidak mencukupi untuk melakukan transaksi');
        }
        
        $client =  \Config\Services::curlrequest();
        $token  = session()->get('userToken');
        $headers = [
            'Authorization' => 'Bearer ' . $token
        ];
        $url = 'https://take-home-test-api.nutech-integrasi.app/transaction';
        $response = $client->request('POST', $url, [
            'headers' => $headers,
            'json' => ['service_code' => $service]
        ]);

        $responseData = json_decode($response->getBody(), true);

        $statusCode = $response->getStatusCode();
       

        switch ($statusCode) {
            case 200:
                if ($responseData['status'] === 0) {
                    // Transaksi berhasil

                    return redirect()->to('transaksi/' . $service)->with('success', 'Transaksi Berhasil');
                } else {
                 
                    // Transaksi gagal
                    return redirect()->to('transaksi/' . $service)->with('errorMessage', 'Transaksi Gagal');
                }
                break;
            case 400:
                // Handle 400 Bad Request
                return redirect()->to('transaksi/' . $service)->with('errorMessage', $responseData['message']);
                break;
            case 401:
                return redirect()->to('transaksi/' . $service)->with('errorMessage', 'Unauthorized Access');

                break;
            default:
                // Handle other status codes
                return redirect()->to('transaksi/' . $service)->with('errorMessage', 'Terjadi Kesalahan');
                break;
        }
    }
}
