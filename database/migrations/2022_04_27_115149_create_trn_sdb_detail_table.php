<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnSDBDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_sdb_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sdb_id');
            $table->foreignId('asset_id')->nullable();
            $table->foreignId('asset_child_id')->nullable();
            $table->string('status', 1)->default(1);
            $table->date('take_out');
            $table->date('back_in')->nullable();
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
        Schema::dropIfExists('trn_sdb_detail');
    }
}
