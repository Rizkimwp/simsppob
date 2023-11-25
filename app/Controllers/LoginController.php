<?php

namespace App\Controllers;
use \Firebase\JWT\JWT;

class LoginController extends BaseController
{



  public function index(): string
  {
    // Load HTTP client

    return view('auth/login');
  }
 

  public function store()
{
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    // ... (validasi dan pengecekan email & password)

    if ($email && $password) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
            // Lakukan panggilan API menggunakan HTTP client untuk login
            $client = \Config\Services::curlrequest();
            $api_url = 'https://take-home-test-api.nutech-integrasi.app/login'; // Sesuaikan dengan URL API yang sesuai

            try {
                $response = $client->request('POST', $api_url, [
                    'form_params' => [
                        'email' => $email,
                        'password' => $password
                    ]
                ]);

                // Proses respons dari API
                $statusCode = $response->getStatusCode();
                $responseData = json_decode($response->getBody(), true);

                if ($statusCode === 200) {
                    // Login berhasil
                    session()->set('isLoggedIn', true);

                    // Memuat payload JWT dengan email dan waktu kedaluwarsa 12 jam
                    $expirationTime = time() + (12 * 60 * 60); // Waktu kedaluwarsa 12 jam
                    $payload = [
                        'email' => $email,
                        'exp' => $expirationTime
                    ];

                  
                    $token = $responseData['data']['token'];

            // Simpan token ke dalam session
                   session()->set('userToken', $token);
                    // Menyimpan token ke dalam sesi
                  
                    return redirect()->to('/homepage');
                } else {    
                    // Tangani kondisi lain dari respons API
                    // ...
                }
            } catch (\Exception $e) {
                // Tangani kesalahan saat melakukan permintaan ke API
                return view('auth/login', ['error' => 'email atau password salah.']);
            }
        }
    }
}


  public function logout()
  {
    session()->remove('isLoggedIn'); // Hapus session isLoggedIn
    // Lakukan hal-hal lain yang perlu dilakukan saat logout
    return redirect()->to('/'); // Redirect ke halaman login setelah logout
  }
}
