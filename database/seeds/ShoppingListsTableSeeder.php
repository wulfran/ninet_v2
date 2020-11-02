<?php

use App\Models\ShoppingList;
use Illuminate\Database\Seeder;

class ShoppingListsTableSeeder extends Seeder
{
    private $faker;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * name
         * desc
         * unit
         * quantity
         * bought
         * optional
         * notes
         */

        $shoppingLists = factory(ShoppingList::class, 40)->create();
        foreach ($shoppingLists as $list){
            for($i=0;$i<(rand(8,11)); $i++) {
                $list->items()->create([
                    'name' => $this->faker->word,
                    'description' => $this->faker->sentence,
                ], $this->createItemsCollection());
            }
        }
    }

    private function createItemsCollection()
    {
        return [
            'unit' => 'item',
            'quantity' => rand(1, 40),
            'bought' => false,
            'optional' => (boolean) rand(0,1),
            'notes' => null
        ];
    }
}
