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
       
        // Membuat instance model TransactionModel
        $transactionModel = new History();

        // Mengambil data transaksi dengan atau tanpa limit (opsional)
        $limit = $this->request->getGet('limit');
        $offset = 0;
        $data = $transactionModel->getTransaksiHistory($limit, $offset);
        
        // Menampilkan data atau melakukan operasi lain sesuai kebutuhan
        // Contoh: Tampilkan data dalam bentuk view
        return view('homepage/history', [
            'transaksi' => $data,
            'profileData' => $profileData,
            'balanceData' => $balanceData
        ]);

    }

    public function showMore()
    {
        $limit = 5; // Jumlah data yang ingin ditampilkan setiap kali tombol "show more" ditekan
        $offset = $this->request->getPost('offset');
        $transactionModel = new History();
        // Panggil fungsi getTransaksiHistory dengan limit dan offset yang baru
        $transactions = $transactionModel->getTransaksiHistory($limit, $offset);
    
        // Kembalikan hasil dalam bentuk JSON
        return $this->response->setJSON($transactions);
    }
}
