<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /*Schema::table('blood_transfusions', function (Blueprint $table) {
            $table->boolean('status')->after('added_by')->default(1);
        });*/

        Schema::table('beneficiary_details_o_t_charges', function (Blueprint $table) {
            $table->boolean('status')->after('added_by')->default(1);
        });

        Schema::table('beneficiary_details_icu_charges', function (Blueprint $table) {
            $table->boolean('status')->after('added_by')->default(1);
        });

        Schema::table('beneficiary_details_bed_charges', function (Blueprint $table) {
            $table->boolean('status')->after('added_by')->default(1);
        });

        Schema::table('beneficiary_detail_dialysis_charges', function (Blueprint $table) {
            $table->boolean('status')->after('added_by')->default(1);
        });

        Schema::table('beneficiary_detail_pet_cts', function (Blueprint $table) {
            $table->boolean('status')->after('added_by')->default(1);
        });
    }

    // /*/**
    //  * Reverse the migrations.
    //  *
    //  * @return void
    //  */
    // public function down()
    // {
    //     Schema::table('beneficiary_details_sub_tables', function (Blueprint $table) {
    //         //
    //     });
    // }*/
}
