<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        !Schema::hasTable('ad_tag') &&
        Schema::create('ad_tag', function (Blueprint $table) {
            $table->primary(['ad_id', 'tag_id']);
            $table->unsignedInteger('ad_id');
            $table->foreign('ad_id')->references('id')->on('ads')->onDelete('cascade');
            $table->unsignedInteger('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
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
        Schema::dropIfExists('ad_tag');
    }
}
