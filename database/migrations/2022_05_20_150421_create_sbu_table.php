<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSBUTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sbu', function (Blueprint $table) {
            $table->id();
            $table->string('sbu_name');
            $table->string('sbu_address')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('sbu');
    }
}
