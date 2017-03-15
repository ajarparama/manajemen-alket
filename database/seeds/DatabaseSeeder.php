<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(TabelLapPPAT::class);
        // $this->call(PPATSeeder::class);
        $this->call(TabelArTableSeeder::class);
        $this->call(TabelPpatTableSeeder::class);
        $this->call(TabelLapppatTableSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call('BulanTableSeeder');
        $this->call('TabelArTableSeeder');
        $this->call('TabelPpatTableSeeder');
        $this->call('TabelSeksiTableSeeder');
        $this->call('SettingTableSeeder');
    }
}
