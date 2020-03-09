<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->integer('role')->default(1);
      $table->string('name');
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->string('bank');
      $table->string('pin_bank');
      $table->string('phone')->unique();
      $table->string('id_identity_card')->unique();
      $table->text('identity_card_image')->nullable();
      $table->text('identity_card_image_salve')->nullable();
      $table->text('image')->nullable();
      $table->text('province');
      $table->text('district');
      $table->text('sub_district');
      $table->text('village');
      $table->integer('number_address');
      $table->text('description_address');
      $table->integer('status')->default(1);
      $table->rememberToken();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('users');
  }
}
