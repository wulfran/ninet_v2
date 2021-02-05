<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_positions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('quantity');
            $table->string('unit');
            $table->float('unit_price');
            $table->integer('tax');

            $table->bigInteger('invoice_id')->unsigned()->index();
            $table->foreign('invoice_id')
                ->references('id')
                ->on('invoices')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_positions');
    }
}
