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
    $validationRules = [
        'profile_image' => [
            'label' => 'Profile Image',
            'rules' => 'uploaded[profile_image]|max_size[profile_image,100]|mime_in[profile_image,image/jpeg,image/png]',
            'errors' => [
                'uploaded' => 'Pilih sebuah gambar.',
                'max_size' => 'Ukuran gambar melebihi batas maksimum 100 KB.',
                'mime_in' => 'Format gambar tidak valid. Hanya file JPG atau PNG yang diperbolehkan.'
            ]
        ]
    ];

    if ($this->validate($validationRules)) {
        $url = "https://take-home-test-api.nutech-integrasi.app/profile/image";
        $token = session()->get('userToken');
        $uploadedImage = $this->request->getFile('profile_image');
        $filePath = $uploadedImage->getRealPath();

        $client = \Config\Services::curlrequest();

        try {
            $response = $client->request('PUT', $url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'multipart/form-data',
                ],
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => fopen($filePath, 'r'),
                        'filename' => $uploadedImage->getName(),
                    ],
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                return redirect()->to('/profile')->with('success', 'Gambar profil berhasil diunggah');
            } else {
                return redirect()->to('/profile')->with('error', 'Gagal mengunggah gambar profil');
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return redirect()->to('/profile')->with('error', $errorMessage);
        }
    } else {
        return redirect()->to('/profile')->with('error', $this->validator->getErrors());
    }
}



}

    

