<?php

use Illuminate\Database\Seeder;

class TabelSeksiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tabel_seksi')->delete();
        
        \DB::table('tabel_seksi')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Seksi Eksten',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'Seksi Waskon 2',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'Seksi Waskon 3',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'Seksi Waskon 4',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nama' => 'KPP Lain',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
