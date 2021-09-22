<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FileSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /** Legislação id = 1 */
        DB::table('file_sub_categories')->insert([
            'name' => 'Decretos',
            'href' => 'decretos',
            'single_name' => 'Decreto',
            'file_category_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('file_sub_categories')->insert([
            'name' => 'Leis',
            'href' => 'leis',
            'single_name' => 'Lei',
            'file_category_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('file_sub_categories')->insert([
            'name' => 'Leis Complementares',
            'href' => 'leis_complementares',
            'single_name' => 'Lei Complementar',
            'file_category_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        /** Licitação id = 2 */
        DB::table('file_sub_categories')->insert([
            'name' => 'Atas',
            'href' => 'atas',
            'single_name' => 'Ata',
            'file_category_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('file_sub_categories')->insert([
            'name' => 'Contratos',
            'href' => 'contratos',
            'single_name' => 'Contrato',
            'file_category_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('file_sub_categories')->insert([
            'name' => 'Editais',
            'href' => 'editais',
            'single_name' => 'Edital',
            'file_category_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('file_sub_categories')->insert([
            'name' => 'Resultados',
            'href' => 'resultados',
            'single_name' => 'Resultado',
            'file_category_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

          /** Concursos Públicos id = 3 */


        DB::table('file_sub_categories')->insert([
            'name' => 'Editais',
            'href' => 'editais',
            'single_name' => 'Edital',
            'file_category_id' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('file_sub_categories')->insert([
            'name' => 'Resultados',
            'href' => 'resultados',
            'single_name' => 'Resultado',
            'file_category_id' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
