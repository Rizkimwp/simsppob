<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class RegistrasiController extends BaseController

{
    use ResponseTrait;

    
    public function index(): string
    {

        return view('auth/registrasi');
    }



    public function store()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $firstname = $this->request->getVar('first_name');
        $lastname = $this->request->getVar('last_name');
helper('form');

// Menyiapkan aturan validasi untuk email dan password
$rules = [
    'email' => 'required|valid_email',
    'password' => 'required|min_length[8]',
    'first_name' => 'required',
    'last_name' => 'required',
    'password_confirmation' => 'matches[password]'
];

// Pesan kesalahan yang ingin ditampilkan
$errors = [
    'email' => [
        'valid_email' => 'Email tidak valid'
    ],
    'password' => [
        'required' => 'Password harus diisi',
        'min_length' => 'Password minimal harus terdiri dari {param} karakter'
    ],
    'first_name' => [
        'required' => 'Nama depan harus diisi'
    ],
    'last_name' => [
        'required' => 'Nama belakang harus diisi'
    ],
    'password_confirmation' => [
        'matches' => ' password tidak sama'
    ]
];

// Jalankan validasi dengan aturan yang ditentukan
if ($this->validate($rules, $errors)) {
    // Ambil data dari input
    


        // Jika data valid, kirimkan ke endpoint registrasi
        $client = \Config\Services::curlrequest();
        $api_url = 'https://take-home-test-api.nutech-integrasi.app/registration'; // Ganti dengan URL API registrasi yang sebenarnya

        try {
            // Lakukan permintaan ke API
            $response = $client->request('POST', $api_url, [
                'form_params' => [
                    'email' => $email,
                    'first_name' => $firstname,
                    'last_name' => $lastname,
                    'password' => $password
                ]
            ]);

            // Ubah respons JSON menjadi array
            $apiResponse = json_decode($response->getBody(), true);
            // Periksa jika respons berhasil
            if ($response->getStatusCode() === 200) {
                $apiResponse = json_decode($response->getBody(), true);

                // Periksa status dan pesan dari respons
                if ($apiResponse['status'] === 0) {
                    // Registrasi berhasil
                    $successMessage = $apiResponse['message']; // Pesan "Registrasi berhasil silahkan login"

                    // Kirim pesan ke view atau lakukan tindakan sesuai kebutuhan aplikasi Anda
                    return view('auth/login', ['successMessage' => $successMessage]);
                } else {
                    // Registrasi gagal, lakukan tindakan sesuai kebutuhan aplikasi Anda
                    // Contoh: Tampilkan pesan gagal
                    return view('auth/registrasi', ['errorMessage' => $apiResponse['message']]);
                }
            } else {
                // Tangani jika ada kesalahan dalam permintaan  kode status bukan 200)
                return view('auth/registrasi');
            }
        } catch (\Exception $e) {
            // Tangkap kesalahan saat melakukan permintaan ke API
            return view('auth/registrasi', ['error' => 'email sudah terdaftar']);
        }
    } else {
    // Jika validasi gagal, tampilkan pesan kesalahan di halaman registrasi
    return view('auth/registrasi', [
        'validation' => $this->validator, // Mengirim pesan kesalahan validasi ke halaman
        'error' => 'Pastikan semua isian diisi dengan benar'
    ]);
} 
    }}