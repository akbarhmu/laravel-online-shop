<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class ProvincesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = RajaOngkir::provinsi()->all();
        foreach($provinces as $province){
            Province::create([
                'province_id' => $province['province_id'],
                'province' => $province['province'],
            ]);
        }
    }
}
