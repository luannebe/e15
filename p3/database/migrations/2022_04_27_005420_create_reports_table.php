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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('street_number');
            $table->string('street_name');
            $table->date('date_observed');
            $table->time('time_observed')->nullable();
            $table->boolean('heritage_tree')->nullable();
            $table->text('comments')->nullable();
            $table->string('observer_first_name');
            $table->string('observer_last_name');
            $table->text('observer_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
};