<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiaryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiary_details', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('register_sl_no')->nullable();
            $table->string('name_of_patient');
            $table->string('urn');
            $table->date('date_of_admission');
            $table->string('inward_number')->unique();
            $table->string('hospital_number')->nullable();
            $table->string('mrd_number')->nullable();
            $table->date('discharge_date')->nullable();
            $table->integer('package_id', false, true)->nullable();
            $table->string('name_of_package', 1000)->nullable();
            $table->decimal('package_amount', 30, 2)->default(0);
            $table->decimal('total_expenditure', 30, 2)->default(0);
            $table->decimal('remaining_amount', 30, 2)->default(0);
            $table->decimal('cliams_received', 30, 2)->default(0);
            $table->decimal('deducted_by_sha', 30, 2)->default(0);
            $table->boolean('is_cancelled')->default(0);
            $table->date('cancellation_date')->nullable(0);
            $table->text('remarks')->nullable();
            $table->boolean('status' )->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficiary_details');
    }
}
