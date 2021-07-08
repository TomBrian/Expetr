<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->text('month');
            $table->text('year');
            $table->text('total_expenses');
            $table->text('total_rental');
            $table->text('total_salaries');
            $table->text('total_medical');
            $table->text('total_utilities');
            $table->text('total_insurance');
            $table->text('total_marketing');
            $table->text('total_delivery');
            $table->text('total_food');
            $table->text('total_gifts');
            $table->text('total_other');
            $table->text('organisation_code');
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
        Schema::dropIfExists('histories');
    }
}
