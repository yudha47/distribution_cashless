<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::truncate();
      User::create([
          'username' => 'sa',
          'full_name' => 'Super Admin',
          'email' => 'it.sysdev@accrossasiaassist.co.id',
          'password' => bcrypt('P@ssw0rd'),
          'level' => '0'
      ]);
      User::create([
          'username' => 'esti.kuswardani',
          'full_name' => 'Esti Kuswardani',
          'password' => bcrypt('P@ssw0rd16'),
          'level' => '1'
      ]);
      User::create([
          'username' => 'presetya.agung',
          'full_name' => 'Presetya Agung',
          'password' => bcrypt('Superman1234#'),
          'level' => '1'
      ]);
      User::create([
          'username' => 'delima_aai',
          'full_name' => 'Delima',
          'password' => bcrypt('P@ssw0rd01'),
          'level' => '1'
      ]);
      User::create([
          'username' => 'Amalia.D',
          'full_name' => 'Amalia D',
          'password' => bcrypt('Amalia.DDD@98'),
          'level' => '1'
      ]);
      User::create([
          'username' => 'ike.prissilia',
          'full_name' => 'Ike Prissilia',
          'password' => bcrypt('P@ssw0rd0'),
          'level' => '2'
      ]);
      User::create([
          'username' => 'meti.briendha.checker',
          'full_name' => 'Meti Briendha Juhazty',
          'password' => bcrypt('P@ssw0rd1'),
          'level' => '2'
      ]);
      User::create([
          'username' => 'isti.dwi',
          'full_name' => 'Isti Dwi Hapsari',
          'password' => bcrypt('P@ssw0rd1234'),
          'level' => '2'
      ]);
      User::create([
          'username' => 'gregorius.checker',
          'full_name' => 'Gregorius Gede Ama',
          'password' => bcrypt('Jesse@4321'),
          'level' => '2'
      ]);
      User::create([
          'username' => 'yosef',
          'full_name' => 'Yosef',
          'password' => bcrypt('P@ssw0rd'),
          'level' => '2'
      ]);
      User::create([
          'username' => 'pujita.checker',
          'full_name' => 'Pujita',
          'password' => bcrypt('P@ssw0rd1616'),
          'level' => '2'
      ]);
      User::create([
          'username' => 'anita.anggraini',
          'full_name' => 'Anita Anggaini',
          'password' => bcrypt('anitaanggraini13'),
          'level' => '2'
      ]);
      User::create([
          'username' => 'elsa.kristin',
          'full_name' => 'Elsa Kristin S',
          'password' => bcrypt('Els@y0309'),
          'level' => '2'
      ]);
      User::create([
          'username' => 'aprilia.agarta',
          'full_name' => 'Aprilia Agarta',
          'password' => bcrypt('apriliaagarta121220'),
          'level' => '2'
      ]);
      User::create([
          'username' => 'desta.checker',
          'full_name' => 'Desta Larosa',
          'password' => bcrypt('P@ssw0rd001'),
          'level' => '2'
      ]);
      User::create([
          'username' => 'enno',
          'full_name' => 'Enno',
          'password' => bcrypt('P@ssw0rd'),
          'level' => '2'
      ]);
      User::create([
          'username' => 'azis.muslim',
          'full_name' => 'Azis Muslim',
          'password' => bcrypt('Azmus@070691'),
          'level' => '2'
      ]);
      User::create([
          'username' => 'irvan.prambudi',
          'full_name' => 'Irvan Prambudi',
          'password' => bcrypt('P@ssw0rd'),
          'level' => '2'
      ]);
      User::create([
          'username' => 'nesa.ginting',
          'full_name' => 'dr. Nesa Ginting',
          'password' => bcrypt('NT6cj834e6yoZLMd'),
          'level' => '3'
      ]);
      User::create([
          'username' => 'melchisedek',
          'full_name' => 'dr. Melchi',
          'password' => bcrypt('Loveisagrace1985'),
          'level' => '3'
      ]);
      User::create([
          'username' => 'leonardus.ca',
          'full_name' => 'dr. Leo',
          'password' => bcrypt('P@ssw0rd'),
          'level' => '3'
      ]);
      User::create([
          'username' => 'jessy',
          'full_name' => 'dr. Jessy',
          'password' => bcrypt('P@ssw0rd7'),
          'level' => '3'
      ]);
      User::create([
          'username' => 'maria.fera',
          'full_name' => 'dr. Fera',
          'password' => bcrypt('P@ssw0rd'),
          'level' => '3'
      ]);
    }
}
