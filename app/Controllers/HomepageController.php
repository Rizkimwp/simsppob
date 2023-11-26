<?php

namespace App\Controllers;

use App\Models\Balance;
use App\Models\Banner;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProfileModel;
use App\Models\Services;

class HomepageController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        
        $bannerModel = new Banner();
        $servicesModel = new Services();
        $balanceModel = new Balance();
        $profileModel = new ProfileModel();
        $profileData = $profileModel->getProfileData();
        $balanceData = $balanceModel->getBalanceData();
        $servicesData = $servicesModel->getServicesData();
        $bannerdata = $bannerModel->getBannerData();
        // Tampilkan view homepage dan kirim data profil
        return view('homepage/home', [
            'profileData' => $profileData,
            'balanceData' => $balanceData,
            'servicesData' => $servicesData,
            'bannerData' => $bannerdata
    ]);
    }
}