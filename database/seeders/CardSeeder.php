<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cards')->insert([
            'name'=>'Novembro Azul',
            'src_img'=>'images/cards/novembroazul.png',
            'date_exp'=>'2022-12-31 23:59:59',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('cards')->insert([
            'name'=>'Natal 2019',
            'src_img'=>'images/cards/natal2019.png',
            'src_img_onclick'=>'images/cards/natal2019_onclick.png',
            'date_exp'=>'2022-12-31 23:59:59',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
