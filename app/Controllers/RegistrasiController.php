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
        // Ambil data dari request
        $email = $this->request->getPost('email');
        $firstname = $this->request->getPost('first_name');
        $lastname = $this->request->getPost('last_name');
        $password = $this->request->getPost('password');

        // Lakukan validasi di sini
        $validationRules = [
            'email' => 'required|valid_email',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|min_length[8]' 
        ];

        $validation = \Config\Services::validation();
        
    if (!$validation->setRules($validationRules)->run($this->request->getPost())) {
        $errors = [
            'email' => $validation->getError('email'),
            'first_name' => $validation->getError('first_name'),
            'last_name' => $validation->getError('last_name'),
            'password' => $validation->getError('password'),
        ];

        return view('auth/registrasi', ['errors' => $errors]);
    }

        // Jika data valid, kirimkan ke endpoint registrasi
        $client = \Config\Services::curlrequest();
        $api_url = 'https://take-home-test-api.nutech-integrasi.app/registration'; // Ganti dengan URL API registrasi yang sebenarnya

        try {
            // Lakukan permintaan ke API
            $response = $client->request('POST', $api_url, [
                'form_params' => [
                    'email' => $email,
                    'first_name'=> $firstname,
                    'last_name'=> $lastname,
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
        // Tangani jika ada kesalahan dalam permintaan (misalnya, kode status bukan 200)
        return view('error_page');
    }
            } catch (\Exception $e) {
                // Tangkap kesalahan saat melakukan permintaan ke API
                return view('auth/registrasi', ['error' => 'Error: ' . $e->getMessage()]);
            }
    }
}