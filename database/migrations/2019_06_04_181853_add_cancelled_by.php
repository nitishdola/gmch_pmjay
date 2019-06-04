<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCancelledBy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficiary_details', function (Blueprint $table) {
            $table->bigInteger('cancelled_by', false, true)->after('cancellation_date')->nullable();
        });

        Schema::table('beneficiary_details', function($table) {
           $table->foreign('cancelled_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beneficiary_details', function (Blueprint $table) {
            //
        });
    }
}
