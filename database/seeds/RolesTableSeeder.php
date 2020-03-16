<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('roles')->insert([
      'description' => 'admin',
    ]);

    DB::table('roles')->insert([
      'description' => 'Mitra Mandiri',
    ]);

    DB::table('roles')->insert([
      'description' => 'Mitra luar biasa',
    ]);

    DB::table('roles')->insert([
      'description' => 'Mitra agen',
    ]);
  }
}
