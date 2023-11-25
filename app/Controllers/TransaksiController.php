<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Transaksi;
use App\Models\ProfileModel;
use App\Models\Balance;
class TransaksiController extends BaseController
{
   

    public function index()
    {
        // Mendapatkan data Profile 
        $profileModel = new ProfileModel();
        $profileData = $profileModel->getProfileData();
        // Mendapatkan Saldo 
        $balanceModel = new Balance(); 
        $balance = $balanceModel->getBalanceData();

        // Merubah Format Saldo ke Rupiah 
        $formatBalance = $balance['data']['balance'];
        $balanceData = number_format($formatBalance, 0, ',', '.');

        // Mendapatkan token dari session 
        $token = session()->get('userToken'); 

        // Membuat instance model TransactionModel
        $transactionModel = new Transaksi();

        // Mengambil data transaksi dengan atau tanpa limit (opsional)
        $limit = $this->request->getGet('limit');
        $data = $transactionModel->getTransaksiData($token, $limit);
        
        // Menampilkan data atau melakukan operasi lain sesuai kebutuhan
        // Contoh: Tampilkan data dalam bentuk view
        return view('homepage/transaksi', [
            'transaksi' => $data,
            'profileData' => $profileData,
            'balanceData' => $balanceData
        ]);
    }
}
