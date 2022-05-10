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
        Schema::create('category_report', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('report_id')->unsigned();
    
            # Make foreign keys
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('report_id')->references('id')->on('reports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_report');
    }
};