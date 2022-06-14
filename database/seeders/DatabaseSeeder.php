<?php

namespace Database\Seeders;

use App\Models\Buyer;
use App\Models\Customer;
use App\Models\CustomerLocation;
use App\Models\Item;
use App\Models\Uom;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // \App\Models\User::factory(10)->create();

        $this->createUoms();

        $this->createItems();

        $this->createCustomers($faker);

        $this->createBuyers($faker);

    }

    public function createCustomers(Faker $faker)
    {
        for ($i = 0; $i < 5; $i++) {
            $customer = Customer::create([
                'name' => $faker->name,
                'email' => preg_replace('/@example\..*/', '@domain.com', $faker->unique()->safeEmail),
            ]);

            $location = rand(1, 3);

            for ($x = 1; $x <= $location; $x++) {

                CustomerLocation::create([
                    'customer_id' => $customer->id,
                    'address' => $faker->address(),
                ]);
            }

        }
    }

    public function createBuyers(Faker $faker)
    {
        for ($i = 0; $i < 3; $i++) {
            Buyer::create([
                'name' => $faker->name,
                'address' => $faker->address(),
            ]);
        }
    }

    public function createItems()
    {
        $prices = [20, 50, 100, 500, 1050, 700, 840, 420];
        for ($i = 1; $i <= 7; $i++) {
            $item = Item::create([
                'name' => 'Product ' . $i,
                'sku' => 'ITEM' . $i,
                'price' => $prices[array_rand($prices)],
                'stock' => rand(0, 10),
            ]);

            DB::table('item_uoms')->insert([
                'item_id' => $item->id,
                'uom_id' => rand(1, 4),
            ]);

            $cats = rand(1, 4);
            for ($x = 1; $x <= $cats; $x++) {
                DB::table('item_categories')->insert([
                    'item_id' => $item->id,
                    'name' => "Category $x",
                ]);
            }

            $types = rand(1, 3);
            for ($x = 1; $x <= $types; $x++) {
                DB::table('item_types')->insert([
                    'item_id' => $item->id,
                    'name' => "Type $x",
                ]);
            }
        }
    }

    private function createUoms()
    {
        $uoms = Uom::insert([
            [
                'id' => 1,
                'name' => 'piece',
                'short' => 'pc',
            ],
            [
                'id' => 2,
                'name' => 'kilogram',
                'short' => 'kg',
            ],
            [
                'id' => 3,
                'name' => 'litres',
                'short' => 'ltr',
            ],
            [
                'id' => 4,
                'name' => 'metre',
                'short' => 'mtr',
            ]
        ]);

        return;
    }
}
