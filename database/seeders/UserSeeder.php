<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->insert([
      'name' => "Admin",
      'email' => 'admin@bwa.com',
      'phone_number' => '082312345655',
      'password' => Hash::make('passworadmin'),
      'avatar' => '',
      'role' => 'admin',
      'created_at' => now(),
      'updated_at' => now()
    ]);
  }
}
