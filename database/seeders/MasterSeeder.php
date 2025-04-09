<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('days')->insert([
            [
            'name' => 'Senin',
            'slug' => 'Monday'
            ],
            [
            'name' => 'Selasa',
            'slug' => 'Tuesday'
            ],
            [
            'name' => 'Rabu',
            'slug' => 'Wednesday'
            ],
            [
            'name' => 'Kamis',
            'slug' => 'Thursday'
            ],
            [
            'name' => 'Jumat',
            'slug' => 'Friday'
            ],
            [
            'name' => 'Sabtu',
            'slug' => 'Saturday'
            ],
            [
            'name' => 'Minggu',
            'slug' => 'Sunday'
            ]
        ]);
        DB::table('hours')->insert([
            [
            'hour' => '00.00',
            ],
            [
            'hour' => '00.30'
            ],
            [
            'hour' => '01.00'
            ],
            [
            'hour' => '01.30'
            ],
            [
            'hour' => '02.00'
            ],
            [
            'hour' => '02.30'
            ],
            [
            'hour' => '03.00'
            ],
            [
            'hour' => '03.30'
            ],
            [
            'hour' => '04.00'
            ],
            [
            'hour' => '04.30'
            ],
            [
            'hour' => '05.00'
            ],
            [
            'hour' => '05.30'
            ],
            [
            'hour' => '06.00'
            ],
            [
            'hour' => '06.30'
            ],
            [
            'hour' => '07.00'
            ],
            [
            'hour' => '07.30'
            ],
            [
            'hour' => '08.00'
            ],
            [
            'hour' => '08.30'
            ],
            [
            'hour' => '09.00'
            ],
            [
            'hour' => '09.30'
            ],
            [
            'hour' => '10.00'
            ],
            [
            'hour' => '10.30'
            ],
            [
            'hour' => '11.00'
            ],
            [
            'hour' => '11.30'
            ],
            [
            'hour' => '12.00'
            ],
            [
            'hour' => '12.30'
            ],
            [
            'hour' => '13.00'
            ],
            [
            'hour' => '13.30'
            ],
            [
            'hour' => '14.00'
            ],
            [
            'hour' => '14.30'
            ],
            [
            'hour' => '15.00'
            ],
            [
            'hour' => '15.30'
            ],
            [
            'hour' => '16.00'
            ],
            [
            'hour' => '16.30'
            ],
            [
            'hour' => '17.00'
            ],
            [
            'hour' => '17.30'
            ],
            [
            'hour' => '18.00'
            ],
            [
            'hour' => '18.30'
            ],
            [
            'hour' => '19.00'
            ],
            [
            'hour' => '19.30'
            ],
            [
            'hour' => '20.00'
            ],
            [
            'hour' => '20.30'
            ],
            [
            'hour' => '21.00'
            ],
            [
            'hour' => '21.30'
            ],
            [
            'hour' => '22.00'
            ],
            [
            'hour' => '22.30'
            ],
            [
            'hour' => '23.00'
            ],
            [
            'hour' => '23.30'
            ]
        ]);
        DB::table('facilities')->insert([
            [
            'name' => 'Wifi',
            'icon' => 'fas fa-wifi'
            ],
            [
            'name' => 'Toilet',
            'icon' => 'fas fa-restroom'
            ],
            [
            'name' => 'AC',
            'icon' => 'far fa-snowflake'
            ],
            [
            'name' => 'TV',
            'icon' => 'fas fa-tv'
            ],
            [
            'name' => 'Buku Bacaan',
            'icon' => 'fa fa-book'
            ],
            [
            'name' => 'Mushalla',
            'icon' => 'fas fa-pray'
            ],
            [
            'name' => 'Parkir Mobil',
            'icon' => 'fa fa-car'
            ],
            [
            'name' => 'Parkir Motor',
            'icon' => 'fa fa-motorcycle'
            ],
            [
            'name' => 'Minimarket',
            'icon' => 'fa fa-shopping-cart'
            ],
            [
            'name' => 'Kantin',
            'icon' => 'fas fa-utensils'
            ],
            [
            'name' => 'Locker',
            'icon' => 'fa fa-th-large'
            ],
            [
            'name' => 'Changing Room',
            'icon' => ''
            ],
            [
            'name' => 'Waiting Room',
            'icon' => ''  
            ],
            [
            'name' => 'Charge Station',
            'icon' => 'fas fa-charging-station'
            ],
            [
            'name' => 'Sport Apparel',
            'icon' => ''
            ]
        ]);
        DB::table('payment_methods')->insert([
            [
            'name' => 'Bank BNI',
            'icon' => 'bni.png',
            ],
            [
            'name' => 'Bank Mandiri',
            'icon' => 'mandiri.png',
            ],
            [
            'name' => 'Bank BRI',
            'icon' => 'bri.png',
            ],
            [
            'name' => 'Bank BCA',
            'icon' => 'bca.png',
            ],
            [
            'name' => 'Bank Bukopin',
            'icon' => 'bukopin.png',
            ],
            [
            'name' => 'Bank Permata',
            'icon' => 'permata.png',
            ],
            [
            'name' => 'Bank BTN',
            'icon' => 'btn.png',
            ],
            [
            'name' => 'Bank BJB',
            'icon' => 'bjb.png',
            ],
            [
            'name' => 'Bank CIMB',
            'icon' => 'cimb.png',
            ],
        ]);
        DB::table('field_types')->insert([
            [
            'name' => 'Lapangan Futsal Vinyl'
            ],
            [
            'name' => 'Lapangan Futsal Rumput Sintetis'
            ],
            [
            'name' => 'Lapangan Futsal Semen'
            ],
            [
            'name' => 'Lapangan Futsal Parquette'
            ],
            [
            'name' => 'Lapangan Futsal Taraflex'    
            ],
            [
            'name' => 'Lapangan Futsal Karpet Plastik'    
            ]
        ]);
    }
}
