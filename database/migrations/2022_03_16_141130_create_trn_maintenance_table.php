<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnMaintenanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_maintenance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->nullable();
            $table->foreignId('asset_child_id')->nullable();
            $table->foreignId('maintenance_id');
            $table->foreignId('user_id');
            $table->string('pemohon')->nullable();
            $table->string('penyetuju')->nullable();
            $table->string('trn_no');
            $table->date('trn_date');
            $table->longText('trn_desc');
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
        Schema::dropIfExists('trn_maintenance');
    }
}
