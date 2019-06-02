<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiaryDetailOldDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiary_detail_old_data', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('beneficiary_detail_id')->unsigned();
            $table->decimal('investigation_cost')->decimal();
            $table->decimal('pet_cet_cost_cost')->decimal();
            $table->decimal('srl_cost')->decimal();
            $table->decimal('miscellaneous_cost', 30,2)->nullable();
            $table->decimal('amrit_pharmacy_cost')->decimal();
            $table->decimal('dialysis_cost')->decimal();
            $table->decimal('endorscopy_cost')->decimal();
            $table->decimal('ot_cost')->decimal();
            $table->decimal('bed_cost')->decimal();
            $table->decimal('icu_cost')->decimal();
            $table->decimal('blood_transfusion_cost')->decimal();
            $table->decimal('implant_cost')->decimal();
            $table->decimal('vendor_reimbursement_cost')->decimal();
            $table->decimal('beneficiary_reimbursement_cost')->decimal();
            $table->decimal('vvi_cost')->decimal();
            $table->decimal('medicine_return_cost')->decimal();

            $table->timestamps();
        });


        Schema::table('beneficiary_detail_old_data', function($table) {
           $table->foreign('beneficiary_detail_id')->references('id')->on('beneficiary_details');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficiary_detail_old_data');
    }
}
