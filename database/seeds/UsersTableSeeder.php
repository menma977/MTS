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
      'name' => 'koperasi serba usaha bumi rahayu',
      'username' => 'adminmts', //adminmts
      'email' => 'admin@mts.com',
      'password' => bcrypt('adminmts'), //adminmts
      'role' => '1',
      'bank' => 'BRI',
      'pin_bank' => '6434-0101-345-3530',
      'phone' => '085259598097',
      'id_identity_card' => '0',
      'identity_card_image' => null,
      'identity_card_image_salve' => null,
      'image' => null,
      'address' => '',
      'status' => 2,
    ]);
  }
}
