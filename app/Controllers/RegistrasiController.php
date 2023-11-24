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
            'password' => 'required|min_length[8]' // Atur panjang minimal password
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
    
            if ($response->getStatusCode() === 201) {
                // Registrasi berhasil, kirimkan respons dengan redirect ke route tertentu
                return redirect()->to('/registration')->with('success', 'Registrasi berhasil');
            } else {
                // Registrasi gagal, kirimkan pesan error terperinci kepada pengguna
                if (isset($apiResponse['messages'])) {
                    // Pesan error terperinci dari API
                    $errorMessages = $apiResponse['messages'];
    
                    // Kirimkan pesan-pesan kesalahan ke view
                    return view('auth/registrasi', ['errors' => $errorMessages]);
                } else {
                    // Pesan error umum
                    return $this->fail($apiResponse['message']);
                }
            }
        } catch (\Exception $e) {
            // Tangkap kesalahan saat melakukan permintaan ke API
            return view('auth/registrasi', ['error' => 'Error: ' . $e->getMessage()]);
        }
    }
}
