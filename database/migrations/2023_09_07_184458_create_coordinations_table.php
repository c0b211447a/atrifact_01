<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->longtext('coordinations_img');
            $table->integer('tops_id')->nullable();
            $table->integer('tops_color_id')->nullable();
            $table->integer('tops_size_width')->nullable();
            $table->integer('tops_size_height')->nullable();
            $table->integer('tops_locate_x')->nullable();
            $table->integer('tops_locate_y')->nullable();
            $table->integer('botoms_id')->nullable();
            $table->integer('botoms_color_id')->nullable();
            $table->integer('botoms_size_width')->nullable();
            $table->integer('botoms_size_height')->nullable();
            $table->integer('botoms_locate_x')->nullable();
            $table->integer('botoms_locate_y')->nullable();
            $table->integer('shoes_id')->nullable();
            $table->integer('shoes_color_id')->nullable();
            $table->integer('shoes_size_width')->nullable();
            $table->integer('shoes_size_height')->nullable();
            $table->integer('shoes_locate_x')->nullable();
            $table->integer('shoes_locate_y')->nullable();
            $table->integer('others1_id')->nullable();
            $table->integer('others1_size_width')->nullable();
            $table->integer('others1_size_height')->nullable();
            $table->integer('others1_locate_x')->nullable();
            $table->integer('others1_locate_y')->nullable();
            $table->integer('others2_id')->nullable();
            $table->integer('others2_size_width')->nullable();
            $table->integer('others2_size_height')->nullable();
            $table->integer('others2_locate_x')->nullable();
            $table->integer('others2_locate_y')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coordinations');
    }
};
