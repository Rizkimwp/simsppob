<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\History;
use App\Models\ProfileModel;
use App\Models\Balance;
use App\Models\Transaksi;

class HistoryController extends BaseController
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
        $transactionModel = new History();

        // Mengambil data transaksi dengan atau tanpa limit (opsional)
        $limit = $this->request->getGet('limit');
        $data = $transactionModel->getTransaksiHistory($token, $limit);
        
        // Menampilkan data atau melakukan operasi lain sesuai kebutuhan
        // Contoh: Tampilkan data dalam bentuk view
        return view('homepage/history', [
            'transaksi' => $data,
            'profileData' => $profileData,
            'balanceData' => $balanceData
        ]);

    }

    public function loadMore()
    {
        // Mendapatkan offset dari permintaan AJAX
        $offset = $this->request->getVar('offset');

        // Membuat instance model TransactionModel
        $transactionModel = new Transaksi();

        // Mengambil data transaksi lebih lanjut dengan offset
        $limit = 5;
        $data = $transactionModel->getTransaksiHistory($limit, $offset);

        // Kirim data sebagai respons JSON
        return $this->response->setJSON($data);
    }
}
