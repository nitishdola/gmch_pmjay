<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddedByHonorariums extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('honorariums', function (Blueprint $table) {
            $table->bigInteger('added_by', false, true)->after('remarks');
        });

        Schema::table('honorariums', function($table) {
           $table->foreign('added_by', 'habf')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('honorariums', function (Blueprint $table) {
            //
        });
    }
}
