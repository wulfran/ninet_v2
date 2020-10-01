<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallingCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calling_codes', function (Blueprint $table) {
            $table->id();
            $table->string('calling_code');
            $table->bigInteger('country_id')->unsigned()->index();
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
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
        Schema::dropIfExists('calling_codes');
    }
}
