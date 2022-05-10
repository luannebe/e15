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
        Schema::table('photos', function (Blueprint $table) {

            # Remove the field associated with the old way we were storing authors
            # Can do this here, or update the original migration that creates the `books` table
            # $table->dropColumn('author');
    
            # Add a new bigint field called `report_id`
            # has to be unsigned (i.e. positive)
            # nullable so it's possible to have a book without an author
            $table->bigInteger('report_id')->unsigned()->nullable();
    
            # This field `report_id` is a foreign key that connects to the `id` field in the `reports` table
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
        Schema::table('photos', function (Blueprint $table) {
            $table->dropForeign('photos_report_id_foreign');
            $table->dropColumn('report_id');
        });
    }
};