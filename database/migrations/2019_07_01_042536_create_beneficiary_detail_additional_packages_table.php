<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiaryDetailAdditionalPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiary_detail_additional_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('package_id', false, true);
            $table->bigInteger('beneficiary_detail_id', false, true);
            $table->decimal('package_amount', 30, 2);
            $table->date('date');
            $table->bigInteger('added_by', false, true);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::table('beneficiary_detail_additional_packages', function($table) {
           $table->foreign('package_id', 'addiPkgPckgfrgnid')->references('id')->on('pmjay_packages');
        });

        Schema::table('beneficiary_detail_additional_packages', function($table) {
           $table->foreign('beneficiary_detail_id', 'addiPkgBendetfrgnid')->references('id')->on('beneficiary_details');
        });

        Schema::table('beneficiary_detail_additional_packages', function($table) {
           $table->foreign('added_by','addiPkgAddbyfrgnid')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficiary_detail_additional_packages');
    }
}
