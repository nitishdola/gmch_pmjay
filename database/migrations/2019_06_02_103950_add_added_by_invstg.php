<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddedByInvstg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficiary_investigations', function (Blueprint $table) {
            $table->bigInteger('added_by', false, true)->after('test_date');
        });

        Schema::table('beneficiary_investigations', function($table) {
           $table->foreign('added_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beneficiary_investigations', function (Blueprint $table) {
            //
        });
    }
}
