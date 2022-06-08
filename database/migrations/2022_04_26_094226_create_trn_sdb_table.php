<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnSDBTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_sdb', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('sdb_id');
            $table->string('trn_no');
            $table->string('ren_date');
            $table->double('ren_value_plan', 2);
            $table->double('ren_value', 2);
            $table->date('due_date', 2);
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
        Schema::dropIfExists('trn_sdb');
    }
}
