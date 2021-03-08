<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FilesSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /** Legislação id = 1 */
        DB::table('files_sub_categories')->insert([
            'name' => 'Decretos',
            'href' => 'decretos',
            'files_category_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('files_sub_categories')->insert([
            'name' => 'Leis',
            'href' => 'leis',
            'files_category_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('files_sub_categories')->insert([
            'name' => 'Resoluções',
            'href' => 'resolucoes',
            'files_category_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        /** Licitação id = 2 */
        DB::table('files_sub_categories')->insert([
            'name' => 'Atas',
            'href' => 'atas',
            'files_category_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('files_sub_categories')->insert([
            'name' => 'Contratos',
            'href' => 'contratos',
            'files_category_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('files_sub_categories')->insert([
            'name' => 'Editais',
            'href' => 'editais',
            'files_category_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('files_sub_categories')->insert([
            'name' => 'Resultados',
            'href' => 'resultados',
            'files_category_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

          /** Concursos Públicos id = 3 */


        DB::table('files_sub_categories')->insert([
            'name' => 'Editais',
            'href' => 'editais',
            'files_category_id' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('files_sub_categories')->insert([
            'name' => 'Resultados',
            'href' => 'resultados',
            'files_category_id' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
