<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->integer('income')->default(0);
            $table->integer('save_money')->default(0);
            $table->integer('tax_money')->default(0);
            $table->integer('general_expenses')->default(0);
            $table->integer('extra_money')->default(0);
            $table->integer('total_extra_money')->default(0);
            $table->string('month');
            $table->integer('user_id');
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
        Schema::dropIfExists('incomes');
    }
}
