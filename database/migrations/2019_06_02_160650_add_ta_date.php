<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficiary_details', function (Blueprint $table) {
            $table->date('beneficiary_ta_date')->after('beneficiary_ta_cost')->nullable();
            $table->string('is_process_completed', 20)->after('added_by')->default('No');
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
