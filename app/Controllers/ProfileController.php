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
            return redirect()->to('/profile')->with('error', 'Gagal memperbarui profil. Coba lagi nanti.');
        }
    } catch (\Exception $e) {
        // Tangani kesalahan yang terjadi saat panggilan API
        return redirect()->to('/profile')->with('error', 'Gagal memperbarui profil. Table tidak boleh kosong');
    }
}




    
    public function updateImage() {
        // Ambil file gambar dari form
        $file = $this->request->getFile('file');

        // Validasi file yang diunggah
        if ($file->isValid() && !$file->hasMoved()) {
            // Validasi tipe file
            if ($file->getClientMimeType() === 'image/jpeg' || $file->getClientMimeType() === 'image/png') {
                // Validasi ukuran file
                if ($file->getSize() < 100 * 1024) { // Ukuran dalam bytes, 100 KB
                    // Ambil binary dari file gambar
                    $binary = file_get_contents($file->getTempName());

                    // Lakukan request ke API menggunakan cURL
                    $ch = curl_init();
                    $apiUrl = 'https://take-home-test-api.nutech-integrasi.app/profile/image'; // Ganti dengan URL API yang sesuai

                    // Setup cURL untuk mengirimkan file dan string biner
                    $postData = [
                        'file' => curl_file_create($file->getTempName(), $file->getClientMimeType(), $file->getName()),
                        'binary' => $binary
                    ];

                    curl_setopt($ch, CURLOPT_URL, $apiUrl);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    // Eksekusi permintaan cURL
                    $response = curl_exec($ch);

                    // Periksa respons dari API
                    if ($response === false) {
                        // Gagal melakukan permintaan cURL
                        $error = curl_error($ch);
                        curl_close($ch);
                        return redirect()->back()->with('error', 'Gagal melakukan permintaan cURL: ' . $error);
                    } else {
                        // Berhasil mendapatkan respons dari API
                        curl_close($ch);

                        // Lakukan sesuatu dengan respons dari API jika diperlukan
                        return redirect()->to('/profile')->with('success', 'Gambar berhasil diunggah');
                    }
                } else {
                    // Ukuran file terlalu besar
                    return redirect()->back()->withInput()->with('error', 'Ukuran gambar terlalu besar (maksimum 100 KB)');
                }
            } else {
                // Tipe file tidak didukung
                return redirect()->back()->withInput()->with('error', 'Format gambar tidak didukung. Hanya JPEG dan PNG yang diizinkan.');
            }
        } else {
            // Tidak ada file yang diunggah
            return redirect()->back()->withInput()->with('error', 'Tidak ada gambar yang diunggah');
        }
    
    }
}








    

