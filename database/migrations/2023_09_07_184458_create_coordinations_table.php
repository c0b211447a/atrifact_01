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
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->longText('coordinations_img');
            $table->text('tops_id')->nullable();
            $table->text('tops_color_id')->nullable();
            $table->text('tops_size_width')->nullable();
            $table->text('tops_size_height')->nullable();
            $table->text('tops_locate_x')->nullable();
            $table->text('tops_locate_y')->nullable();
            $table->text('botoms_id')->nullable();
            $table->text('botoms_color_id')->nullable();
            $table->text('botoms_size_width')->nullable();
            $table->text('botoms_size_height')->nullable();
            $table->text('botoms_locate_x')->nullable();
            $table->text('botoms_locate_y')->nullable();
            $table->text('shoes_id')->nullable();
            $table->text('shoes_color_id')->nullable();
            $table->text('shoes_size_width')->nullable();
            $table->text('shoes_size_height')->nullable();
            $table->text('shoes_locate_x')->nullable();
            $table->text('shoes_locate_y')->nullable();
            $table->text('others1_id')->nullable();
            $table->text('others1_color_id')->nullable();
            $table->text('others1_size_width')->nullable();
            $table->text('others1_size_height')->nullable();
            $table->text('others1_locate_x')->nullable();
            $table->text('others1_locate_y')->nullable();
            $table->text('others2_id')->nullable();
            $table->text('others2_color_id')->nullable();
            $table->text('others2_size_width')->nullable();
            $table->text('others2_size_height')->nullable();
            $table->text('others2_locate_x')->nullable();
            $table->text('others2_locate_y')->nullable();
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
