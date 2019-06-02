<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiaryReimbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiary_reimbursements', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name', 255);
            $table->bigInteger('beneficiary_detail_id', false, true);
            $table->decimal('amount', 20, 2);
            $table->date('date');
            $table->boolean('status')->default(1);
            
            $table->timestamps();
        });

        Schema::table('beneficiary_reimbursements', function($table) {
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
        Schema::dropIfExists('beneficiary_reimbursements');
    }
}
