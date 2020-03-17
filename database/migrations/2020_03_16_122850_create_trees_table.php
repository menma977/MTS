<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('trees', function (Blueprint $table) {
      $table->id();
      $table->string('user')->nullable();
      $table->string('qr')->unique();
      $table->string('code');
      $table->string('start')->nullable();
      $table->string('end')->nullable();
      $table->string('yield')->nullable();
      $table->text('x_fild')->nullable();
      $table->text('y_fild')->nullable();
      $table->string('status')->default(1);
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
    Schema::dropIfExists('trees');
  }
}
