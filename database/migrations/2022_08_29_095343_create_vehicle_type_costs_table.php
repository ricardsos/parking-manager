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
        Schema::create('vehicle_type_costs', function (Blueprint $table) {
            $table->id();
            $table->float('cost_per_measure_unit');
            $table->enum('measure_unit', ['second', 'minute', 'hour', 'day', 'week', 'month', 'year']);
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
        Schema::dropIfExists('vehicle_type_costs');
    }
};
