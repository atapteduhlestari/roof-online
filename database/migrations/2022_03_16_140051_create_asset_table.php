<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_group_id');
            $table->foreignId('user_id');
            $table->foreignId('sdb_id')->nullable();
            $table->foreignId('sbu_id')->nullable();
            $table->foreignId('emp_id')->nullable();
            $table->string('asset_code');
            $table->string('asset_no')->nullable();
            $table->string('asset_name');
            $table->date('pcs_date');
            $table->double('pcs_value', 2);
            $table->string('location')->nullable();
            $table->string('condition', 1);
            $table->string('aktiva');
            $table->text('desc')->nullable();
            $table->text('image')->nullable();
            $table->boolean('asset_is_exist')->default(1);
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
        Schema::dropIfExists('asset');
    }
}
