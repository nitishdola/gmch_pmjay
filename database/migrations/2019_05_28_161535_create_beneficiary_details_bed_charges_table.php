<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiaryDetailsBedChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiary_details_bed_charges', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('beneficiary_detail_id', false, true);
            $table->string('name',255);
            $table->decimal('amount', 20,2 );
            $table->date('date');
            
            $table->timestamps();
        });

        Schema::table('beneficiary_details_bed_charges', function($table) {
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
        Schema::dropIfExists('beneficiary_details_bed_charges');
    }
}
