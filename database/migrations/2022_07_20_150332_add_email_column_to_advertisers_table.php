<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailColumnToAdvertisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        !Schema::hasColumn('advertisers', 'email') &&
        Schema::table('advertisers', function (Blueprint $table) {
            $table->string('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::hasColumn('advertisers', 'email') &&
        Schema::table('advertisers', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
}
