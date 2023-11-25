<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ServicesSeeder extends Seeder
{
    public function run()
    {

        $data = [
            [
            "service_code" => "PAJAK",
            "service_name" => "PBB",
            "service_icon" => "images/pbb.png",
            "service_tarif" => 40000,
            ], 
          [
            "service_code" => "PLN",
            "service_name" => "Listrik",
            "service_icon" => "images/listrik.png",
            "service_tarif" => 10000
          ],
          [
            "service_code" => "PDAM",
            "service_name" => "PDAM",
            "service_icon" => "images/pdam.png",
            "service_tarif" => 40000
          ],
          [
            "service_code" => "PULSA",
            "service_name" => "Pulsa",
            "service_icon" => "images/pulsa.png",
            "service_tarif" => 40000
          ],
          [
            "service_code" => "PGN",
            "service_name" => "PGN",
            "service_icon" => "images/pgn.png",
            "service_tarif" => 50000
          ],
          [
            "service_code" => "MUSIK",
            "service_name" => "Musik",
            "service_icon" => "images/musik.png",
            "service_tarif" => 50000
          ],
          [
            "service_code" => "TV",
            "service_name" => "TV",
            "service_icon" => "images/televisi.png",
            "service_tarif" => 50000
          ],
          [
            "service_code" => "PAKET_DATA",
            "service_name" => "Paket data",
            "service_icon" => "images/paket_data.png",
            "service_tarif" => 50000
          ],
          [
            "service_code" => "VOUCHER_GAME",
            "service_name" => "Voucher Game",
            "service_icon" => "images/game.png",
            "service_tarif" => 100000,
          ],
          [
            "service_code" => "VOUCHER_MAKANAN",
            "service_name" => "Voucher Makanan",
            "service_icon" => "images/voucher.png",
            "service_tarif" => 100000
          ],
          [
            "service_code" => "QURBAN",
            "service_name" => "Qurban",
            "service_icon" => "images/kurban.png",
            "service_tarif" => 200000
          ],
          [
            "service_code" => "ZAKAT",
            "service_name" => "Zakat",
            "service_icon" => "images/zakat.png",
            "service_tarif" => 300000
          ],
        ];
    
    $this->db->table('services')->insertBatch($data);
    }
}
