<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLedgersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('ledgers', function (Blueprint $table) {
      $table->id();
      $table->string('code');
      $table->text('description');
      $table->string('debit')->default(0);
      $table->string('credit')->default(0);
      $table->integer('user')->default(1);
      $table->integer('ledger_type')->default(0);
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
    Schema::dropIfExists('ledgers');
  }
}
