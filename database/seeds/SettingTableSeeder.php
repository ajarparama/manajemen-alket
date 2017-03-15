<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('setting')->delete();
        
        \DB::table('setting')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Nama Kantor',
                'value' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Lokasi Kantor',
                'value' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Nama Kepala Kantor',
                'value' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'NIP Kepala Kantor',
                'value' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Nama Kanwil',
                'value' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Lokasi Kanwil',
                'value' => NULL,
            ),
        ));    }
}
