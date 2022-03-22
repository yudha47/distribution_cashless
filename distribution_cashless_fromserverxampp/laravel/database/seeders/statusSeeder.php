<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class statusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Status::truncate();
      Status::create([
        'status_name' => 'Send To Analyst',
        'status_type' => 'Status Admission'
      ]);

      Status::create([
        'status_name' => 'RCV By Analyst',
        'status_type' => 'Status Admission'
      ]);

      Status::create([
        'status_name' => 'Pending Jaminan Awal',
        'status_type' => 'Action Analyst'
      ]);

      Status::create([
        'status_name' => 'Issued LOG',
        'status_type' => 'Action Analyst'
      ]);

      Status::create([
        'status_name' => 'Issued non LOG',
        'status_type' => 'Action Analyst'
      ]);

      Status::create([
        'status_name' => 'Send to MA',
        'status_type' => 'Action Analyst'
      ]);

      Status::create([
        'status_name' => 'Send to MA',
        'status_type' => 'Action Analyst - monitoring'
      ]);

      Status::create([
        'status_name' => 'Approve SPT',
        'status_type' => 'Action Analyst - monitoring'
      ]);

      Status::create([
        'status_name' => 'Pending SPT',
        'status_type' => 'Action Analyst - monitoring'
      ]);

      Status::create([
        'status_name' => 'Issued LOG',
        'status_type' => 'Action Analyst - monitoring'
      ]);
    }
}
