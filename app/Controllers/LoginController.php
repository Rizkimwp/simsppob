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
        // Load helper untuk validasi
        helper('form');
        // Menyiapkan aturan validasi untuk email dan password
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];
        // Pesan kesalahan yang ingin ditampilkan
        $errors = [
            'email' => [
                'valid_email' => 'Email tidak valid'
            ]
        ];
        // Jalankan validasi dengan aturan yang ditentukan
        if ($this->validate($rules, $errors)) {
            // Ambil data dari input
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
    


            // Lakukan panggilan API menggunakan HTTP client untuk login
            $client = \Config\Services::curlrequest();
            $api_url = 'https://take-home-test-api.nutech-integrasi.app/login';
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
    
                    return redirect()->to('/homepage');
                } else {
                    // Tangani kondisi lain dari respons API
                    // ...
                }
            } catch (\Exception $e) {
                // Tangani kesalahan saat melakukan permintaan ke API
                return view('auth/login', ['error' => 'password yang anda masukan salah']);
            }
        } else {
            // Jika validasi gagal, tampilkan halaman login dengan pesan kesalahan
            return view('auth/login', [
                'validation' => $this->validator, // Mengirim pesan kesalahan validasi ke halaman
                'error' => 'masukan email dan password'
            ]);
        }
    }
    
    



  public function logout()
  {
    session()->remove('isLoggedIn'); // Hapus session isLoggedIn
    // Lakukan hal-hal lain yang perlu dilakukan saat logout
    return redirect()->to('/'); // Redirect ke halaman login setelah logout
  }

}