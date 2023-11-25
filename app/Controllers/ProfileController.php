<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfileModel;
class ProfileController extends BaseController
{
    public function index()
    {
        $profileModel = new ProfileModel();
        $profileData = $profileModel->getProfileData();
        return view('homepage/profile', [
            'profileData' => $profileData,]);
        }

        public function update()
{
    // Ambil data yang akan diupdate dari form atau sumber lain
    $updatedData = [
        'email' => $this->request->getPost('email'),
        'first_name' => $this->request->getPost('first_name'),
        'last_name' => $this->request->getPost('last_name'),
        // Tambahkan data lain yang perlu diupdate
    ];

    // Ambil token dari sesi login
    $token = session()->get('userToken');

    // Buat instance HTTP client
    $client = \Config\Services::curlrequest();

    // Endpoint API untuk update profile
    $url = "https://take-home-test-api.nutech-integrasi.app/profile/update";

    // Header dengan token JWT
    $headers = [
        'Authorization' => 'Bearer ' . $token,
        'Content-Type' => 'application/json',
    ];

    try {
        // Kirim permintaan PUT ke API
        $response = $client->request('PUT', $url, [
            'headers' => $headers,
            'json' => $updatedData,
        ]);

        // Cek respons dari API
        if ($response->getStatusCode() === 200) {
            // Jika respons berhasil
            return redirect()->to('/profile')->with('success', 'Profil berhasil diperbarui');
        } else {
            // Jika respons gagal
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui profil. Coba lagi nanti.');
        }
    } catch (\Exception $e) {
        // Tangani kesalahan yang terjadi saat panggilan API
        return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan. Coba lagi nanti atau periksa koneksi internet Anda.');
    }
}


// Fungsi Update Image
public function updateImage()
{
   
    

    // Ambil file gambar dari request
    $image = $this->request->getFile('profile_image');

    if ($image->isValid() && ($image->getClientMimeType() === 'image/jpeg' || $image->getClientMimeType() === 'image/png')) {
        // Ambil konten file sebagai string binary
        $fileContent = file_get_contents($image->getPathname());

        // Endpoint API untuk update gambar profil
        $url = "https://take-home-test-api.nutech-integrasi.app/profile/image";

        // Ambil token dari sesi login
        $token = session()->get('userToken');

        // Buat instance HTTP client
        $client = \Config\Services::curlrequest();

        try {
            // Kirim gambar sebagai string binary ke endpoint API menggunakan metode PUT
            $response = $client->request('PUT', $url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/octet-stream', // Sesuaikan dengan tipe konten yang diperlukan
                ],
                'body' => $fileContent // Kirim file content sebagai body permintaan
            ]);

            if ($response->getStatusCode() === 200) {
                // Jika respons berhasil
                $responseData = json_decode($response->getBody(), true);
                // Lakukan penanganan respons sesuai dengan dokumen respons
                // Misalnya, Anda dapat menggunakan $responseData untuk menampilkan URL gambar baru
                return redirect()->to('/profile')->with('success', 'Gambar profil berhasil diunggah');
            } else {
                // Jika respons gagal
                return redirect()->to('/profile')->with('error', 'Gagal mengunggah gambar profil');
            }
        } catch (\Exception $e) {
            // Tangani kesalahan yang terjadi saat panggilan API
            return redirect()->to('/profile')->with('error', 'Terjadi kesalahan. Coba lagi nanti atau periksa koneksi internet Anda.');
        }
    } else {
        // Jika file tidak valid
        return redirect()->to('/profile')->with('error', 'Format gambar tidak valid. Hanya file JPG atau PNG yang diperbolehkan.');
    }
}

    }

