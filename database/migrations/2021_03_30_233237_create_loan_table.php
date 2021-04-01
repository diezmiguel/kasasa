<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 45);
            $table->integer('ssn');
            $table->date('dob');
            $table->float('loan_amount');
            $table->float('rate');
            $table->string('type', 45);
            $table->integer('term');
            $table->float('apr');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan');
    }
}
