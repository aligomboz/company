<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_clients', function (Blueprint $table) {
            $table->id();
            $table->enum('payments',['Full_payment','partial_payment']);
            $table->string('batch_price');
            $table->decimal('rest_of_batch');
            $table->bigInteger('client_id')->unsigned();
            $table->bigInteger('project_id')->unsigned();
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_clients');
    }
}
