<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiaryInvestigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiary_investigations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('lab_test_id', false, true);
            $table->bigInteger('beneficiary_detail_id', false, true);
            $table->decimal('amount', 20, 2);
            $table->date('test_date');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::table('beneficiary_investigations', function($table) {
           $table->foreign('beneficiary_detail_id')->references('id')->on('beneficiary_details');
           $table->foreign('lab_test_id')->references('id')->on('lab_tests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficiary_investigations');
    }
}
