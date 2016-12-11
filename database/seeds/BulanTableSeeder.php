<?php

use Illuminate\Database\Seeder;

class BulanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bulan')->delete();
        
        \DB::table('bulan')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Januari',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'Februari',
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'Maret',
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'April',
            ),
            4 => 
            array (
                'id' => 5,
                'nama' => 'Mei',
            ),
            5 => 
            array (
                'id' => 6,
                'nama' => 'Juni',
            ),
            6 => 
            array (
                'id' => 7,
                'nama' => 'Juli',
            ),
            7 => 
            array (
                'id' => 8,
                'nama' => 'Agustus',
            ),
            8 => 
            array (
                'id' => 9,
                'nama' => 'September',
            ),
            9 => 
            array (
                'id' => 10,
                'nama' => 'Oktober',
            ),
            10 => 
            array (
                'id' => 11,
                'nama' => 'November',
            ),
            11 => 
            array (
                'id' => 12,
                'nama' => 'Desember',
            ),
        ));
        
        
    }
}
