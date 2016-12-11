<?php

use Illuminate\Database\Seeder;
use App\LapPPAT;
use Faker\Factory as Faker;

class TabelLapPPAT extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // clear databases
        DB::table('tabel_lapppat')->delete();

        // create data
        $faker = Faker::create();
        foreach (range(1,20) as $index) {
        LapPPAT::create(array(
        	'no_surat'	=> $faker->month($max = 'now').'/'.$faker->century.'/'.$faker->year($max = 'now'),
            'no_agenda' => $faker->month($max = 'now').'/'.$faker->century.'/'.$faker->year($max = 'now').'/713',
        	'bulan'		=> $faker->numberBetween($min = 1, $max = 12),
            'tahun'     => $faker->numberBetween($min = 2014, $max = 2016),
        	'ppat_npwp'	=> $faker->randomElement($array = array (67879353713000, 66766064713000, 98082571713000, 98084619713000, 141618934713000, 144258761713000, 144258845713000, 153561733713000, 166160960713000, 552755332542000, 546177742532000, 554523969015000, 672390952713001, 269832747657000, 340392752713000, 554127167517000)),
        	'tgl_surat'	=> $faker->dateTimeThisYear($max = 'now'),
        	'tgl_terima'=> $faker->dateTimeThisYear($max = 'now'),
            'jml_data'  => $faker->numberBetween($min = 0, $max = 200),
            'nilai_data'  => $faker->numberBetween($min = 500000000, $max = 2000000000),
            'jml_alket' => $faker->numberBetween($min = 0, $max = 100)
        	));
        }

        $this->command->info('Laporan PPAT berhasil ditambahkan.');
    }
}
