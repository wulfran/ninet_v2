<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingListItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_list_items', function (Blueprint $table) {
            $table->id();
            $table->string('unit')->nullable();
            $table->string('quantity')->nullable();
            $table->boolean('bought')->default(false);
            $table->boolean('optional')->default(false);
            $table->string('notes')->nullable();
            $table->bigInteger('list_id')->unsigned()->index();
            $table->foreign('list_id')
                ->references('id')
                ->on('shopping_lists')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->bigInteger('item_id')->unsigned()->index();
            $table->foreign('item_id')
                ->references('id')
                ->on('items')
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
        Schema::dropIfExists('shopping_list_items');
    }
}
