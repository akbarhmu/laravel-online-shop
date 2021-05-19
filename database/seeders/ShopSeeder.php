<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            'id' => 1,
            'name' => 'ElectroParadizo',
            'phone' => "085155377448",
            'address' => 'Jl. Raya Selopuro No.22 Mronjo',
            'province_id' => 11,
            'city_id' => 74,
            'subdistrict' => 'Selopuro',
            'postal_code' => 66185,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
