<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ItemType;

class add_item_types extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $itemsType = ["BeltBag","Blanket","Filipiniana","Handbag","Headband","Scarf","Tumbler Case","Wallets"];
        foreach($itemsType as $type){
            ItemType::create(['type_name' => $type]);
        }

    }

    public function rollback(): void
    {
        $itemsType = ["BeltBag","Blanket","Filipiniana","Handbag","Headband","Scarf","Tumbler Case","Wallets"];
        foreach($itemsType as $type){
            ItemType::where('type_name', $type)->delete();
        }
    }
}
