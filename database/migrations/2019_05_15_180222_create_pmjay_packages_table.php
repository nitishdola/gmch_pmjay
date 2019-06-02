<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmjayPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmjay_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('speciality_code', 127);
            $table->string('procedure_name', 500);
            $table->string('procedure_code', 127);
            $table->decimal('non_nabh_package_amount', 30,2)->default(0);
            $table->decimal('nabh_package_amount', 30,2)->default(0);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('pmjay_packages');
    }
}
