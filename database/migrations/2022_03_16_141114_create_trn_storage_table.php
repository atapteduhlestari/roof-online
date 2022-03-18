<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnStorageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_storage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->nullable();
            $table->foreignId('asset_child_id')->nullable();
            $table->foreignId('storage_id');
            $table->foreignId('employee_id');
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
        Schema::dropIfExists('trn_storage');
    }
}
