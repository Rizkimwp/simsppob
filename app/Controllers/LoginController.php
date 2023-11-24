<?php

namespace App\Controllers;

use Config\Services;

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

    // Lakukan validasi email dan password di sini

    if ($email && $password) {
      // Contoh validasi sederhana
      // Anda bisa menggunakan validasi lebih lanjut sesuai kebutuhan Anda
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Panggil API menggunakan HTTP client untuk login
        $client = \Config\Services::curlrequest();
        $api_url = 'https://take-home-test-api.nutech-integrasi.app/login'; // Ganti dengan URL API yang sebenarnya

        try {
          $response = $client->request('POST', $api_url, [
            'form_params' => [
              'email' => $email,
              'password' => $password
            ]
          ]);


          $statusCode = $response->getStatusCode();
          $responseData = $response->getBody();
          $responseDataArray = json_decode($responseData, true);
          if ($statusCode === 200) {
            // Login berhasil
            session()->set('isLoggedIn', true);
            // Simpan token ke dalam sesi
            $token = isset($responseDataArray['token']) ? $responseDataArray['token'] : null;
            session()->set('userToken', $token);

            return redirect()->to('/homepage');
          } elseif ($statusCode === 400) {
            // Jika respons dari API menunjukkan error karena password salah
            $errorMessage = isset($responseDataArray['error']) ? $responseDataArray['error'] : 'Invalid credentials. Please try again.';
            return view('auth/login', ['error' => $errorMessage]);
          } else {
            // Respons lain yang tidak diharapkan dari API
            return view('auth/login', ['error' => 'Unexpected error. Please try again later.']);
          }
        } catch (\Exception $e) {
          // Tangkap kesalahan saat melakukan permintaan ke API
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
