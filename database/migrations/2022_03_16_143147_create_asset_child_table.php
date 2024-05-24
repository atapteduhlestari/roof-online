<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetChildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_child', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->nullable();
            $table->foreignId('sdb_id')->nullable();
            $table->foreignId('sbu_id')->nullable();
            $table->string('doc_name');
            $table->string('doc_code');
            $table->string('doc_no')->nullable();
            $table->text('file')->nullable();
            $table->text('desc')->nullable();
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
        Schema::dropIfExists('asset_child');
    }
}
