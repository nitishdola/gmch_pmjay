<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusAddedByBllodTransfusion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficiary_details_blood_transfusions', function (Blueprint $table) {
            $table->bigInteger('added_by')->nullable()->after('test_date');
            $table->boolean('status')->default(1)->after('added_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beneficiary_details_blood_transfusions', function (Blueprint $table) {
            //
        });
    }
}
