<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenewalCycle extends Migration
{
    public function up()
    {
        Schema::create('renewal_cycle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trn_renewal_id');
            $table->string('name');
            $table->boolean('type');
            $table->date('renewal_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('renewal_cycle');
    }
}
