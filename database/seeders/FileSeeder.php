<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('files')->insert([
            'name' => 'arquivo 1',
            'path' => 'null',
            'year' => 2021,
            'ext' => 'pdf',
            'number' => '0001',
            'desc' => 'Descrição do arquivo',
            'file_category_id' => '3',
            'file_sub_category_id' => '8',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('files')->insert([
            'name' => 'arquivo 2',
            'path' => 'null',
            'year' => 2021,
            'ext' => 'pdf',
            'number' => '0002',
            'desc' => 'Descrição do arquivo 2',
            'file_category_id' => '3',
            'file_sub_category_id' => '9',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('files')->insert([
            'name' => 'arquivo 3',
            'path' => 'null',
            'year' => 2022,
            'ext' => 'pdf',
            'number' => '0003',
            'desc' => 'Descrição do arquivo 3',
            'file_category_id' => '1',
            'file_sub_category_id' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
