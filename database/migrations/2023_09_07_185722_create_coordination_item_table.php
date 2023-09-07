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
        Schema::create('coordination_item', function (Blueprint $table) {
            $table->foreignId('item_id')->constrained('items');
            $table->foreignId('coordination_id')->constrained('coordinations');
            $table->primary(['item_id', 'coordination_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coordination_item');
    }
};
