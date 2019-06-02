<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiaryMedicineReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiary_medicine_returns', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('invoice_number', 255)->nullable();
            $table->bigInteger('beneficiary_detail_id', false, true);
            $table->decimal('amount', 20, 2);
            $table->date('bill_date');
            $table->boolean('status')->default(1);

            $table->timestamps();
        });

        Schema::table('beneficiary_medicine_returns', function($table) {
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
        Schema::dropIfExists('beneficiary_medicine_returns');
    }
}
