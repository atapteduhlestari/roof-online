<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLoginFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->datetime('last_login_at')->nullable();
            $table->datetime('last_logout_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->boolean('active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_login_at');
            $table->dropColumn('last_logout_at');
            $table->dropColumn('last_login_ip');
            $table->dropColumn('active');
        });
    }
}
