<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiaryDetailsBloodTransfusionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiary_details_blood_transfusions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('blood_transfusion_id', false, true);
            $table->bigInteger('beneficiary_detail_id', false, true);
            $table->decimal('amount', 20,2);
            $table->date('test_date');

            $table->timestamps();
        });

        Schema::table('beneficiary_details_blood_transfusions', function($table) {
           $table->foreign('blood_transfusion_id', 'lqa_id_foreign')->references('id')->on('blood_transfusions');
           $table->foreign('beneficiary_detail_id', 'bti_id_foreign')->references('id')->on('beneficiary_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficiary_details_blood_transfusions');
    }
}
