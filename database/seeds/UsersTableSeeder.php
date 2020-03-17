<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->insert([
      'name' => 'admin',
      'username' => 'admin',
      'email' => 'admin@gmail.com',
      'password' => bcrypt('admin'),
      'role' => '1',
      'bank' => '0',
      'pin_bank' => '0',
      'phone' => '0',
      'id_identity_card' => '0',
      'identity_card_image' => null,
      'identity_card_image_salve' => null,
      'image' => null,
      'address' => '',
      'status' => 2,
    ]);
  }
}
