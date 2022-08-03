<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnRenewalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_renewal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_child_id');
            $table->foreignId('renewal_id');
            $table->foreignId('sbu_id');
            $table->foreignId('user_id');
            $table->string('pemohon')->nullable();
            $table->string('penyetuju')->nullable();
            $table->string('trn_no');
            $table->date('trn_start_date');
            $table->date('trn_date');
            $table->double('trn_value_plan', 2)->nullable();
            $table->double('trn_value', 2);
            $table->longText('trn_desc')->nullable();
            $table->text('file')->nullable();
            $table->boolean('trn_status')->default(2);
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
        Schema::dropIfExists('trn_renewal');
    }
}
