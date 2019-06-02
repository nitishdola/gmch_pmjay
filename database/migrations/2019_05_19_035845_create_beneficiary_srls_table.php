<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiarySrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiary_srls', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('test_name', 255);
            $table->bigInteger('beneficiary_detail_id', false, true);
            $table->decimal('amount', 20, 2);
            $table->date('test_date');
            $table->boolean('status')->default(1);

            $table->timestamps();
        });


        Schema::table('beneficiary_srls', function($table) {
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
        Schema::dropIfExists('beneficiary_srls');
    }
}
