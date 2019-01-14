<?php

use App\Models\Item;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (!Category::where(['name' => 'Канцелярия'])->first()) {
            $categoryParent = Category::create(['name' => 'Канцелярия']);
        }
        if (!Category::where(['name' => 'Тетради'])->first()) {
            $categoryChildren = Category::create(['name' => 'Тетради'], $categoryParent);
        }

        if (!Category::where(['name' => 'В клетку'])->first()) {

            $categorySubChildren1 = Category::create(['name' => 'В клетку'], $categoryChildren);
        }
        if (!Category::where(['name' => 'В линейку'])->first()) {
            $categorySubChildren2 = Category::create(['name' => 'В линейку'], $categoryChildren);
        }
        if (!Item::where(['name' => '48 листов в клетку'])->first()) {
            $item1 = Item::create(['name' => '48 листов в клетку'])->categories()->attach([$categorySubChildren1->id]);

        }

        if (!Item::where(['name' => '48 листов в линейку'])->first()) {
            $item2 = Item::create(['name' => '48 листов в линейку'])->categories()->attach([$categorySubChildren2->id]);

        }
        if (!Item::where(['name' => 'блокнот универстальный'])->first()) {
            $item3 = Item::create(['name' => 'блокнот универстальный'])->categories()->attach([$categorySubChildren1->id, $categorySubChildren2->id]);

        }

    }
}
