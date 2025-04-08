<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        #商品用画像をコピー
        $files = glob('public/img/items/*');
        foreach ($files as $file) {
            copy($file, 'storage/app/public/item/' . basename($file));
        }
        $params = [
            [
                'image' => 'public/item/Armani+Mens+Clock.jpg',
                'name' => '腕時計',
                'brand' => 'Armani',
                'price' => 15000,
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'condition' => '良好',
                'category_id' => [1, 5],
                'user_id' => 1
            ],
            [
                'image' => 'public/item/HDD+Hard+Disk.jpg',
                'name' => 'HDD',
                'brand' => 'WESTERN DIGITAL',
                'price' => 5000,
                'description' => '高速で信頼性の高いハードディスク',
                'condition' => '目立った傷や汚れなし',
                'category_id' => [2],
                'user_id' => 1

            ],
            [
                'image' => 'public/item/iLoveIMG+d.jpg',
                'name' => '玉ねぎ3束',
                'price' => 300,
                'description' => '新鮮な玉ねぎ3束のセット',
                'condition' => 'やや傷や汚れあり',
                'category_id' => [],
                'user_id' => 1
            ],
            [
                'image' => 'public/item/Leather+Shoes+Product+Photo.jpg',
                'name' => '革靴',
                'brand' => 'Allen Edmonds',
                'price' => 4000,
                'description' => 'クラシックなデザインの革靴',
                'condition' => '状態が悪い',
                'category_id' => [1, 5],
                'user_id' => 1
            ],
            [
                'image' => 'public/item/Living+Room+Laptop.jpg',
                'name' => 'ノートPC',
                'brand' => 'Apple',
                'price' => 45000,
                'description' => '高性能なノートパソコン',
                'condition' => '良好',
                'category_id' => [2],
                'user_id' => 1
            ],
            [
                'image' => 'public/item/Music+Mic+4632231.jpg',
                'name' => 'マイク',
                'brand' => 'Maxim',
                'price' => 8000,
                'description' => '高音質のレコーディング用マイク',
                'condition' => '目立った傷や汚れなし',
                'category_id' => [2],
                'user_id' => 2
            ],
            [
                'image' => 'public/item/Purse+fashion+pocket.jpg',
                'name' => 'ショルダーバッグ',
                'brand' => 'Nine West',
                'price' => 3500,
                'description' => 'おしゃれなショルダーバッグ',
                'condition' => 'やや傷や汚れあり',
                'category_id' => [1, 4],
                'user_id' => 2
            ],
            [
                'image' => 'public/item/Tumbler+souvenir.jpg',
                'name' => 'タンブラー',
                'price' => 500,
                'description' => '使いやすいタンブラー',
                'condition' => '状態が悪い',
                'category_id' => [10],
                'user_id' => 2
            ],
            [
                'image' => 'public/item/Waitress+with+Coffee+Grinder.jpg',
                'name' => 'コーヒーミル',
                'price' => 4000,
                'description' => '手動のコーヒーミル',
                'condition' => '良好',
                'category_id' => [3, 10],
                'user_id' => 2
            ],
            [
                'image' => 'public/item/外出メイクアップセット.jpg',
                'name' => 'メイクセット',
                'price' => 2500,
                'description' => '便利なメイクアップセット',
                'condition' => '目立った傷や汚れなし',
                'category_id' => [4, 6],
                'user_id' => 2
            ],
        ];
        foreach ($params as $param) {
            $category_id_list = $param['category_id'];
            unset($param['category_id']);
            $item = Item::create($param);
            $item->categories()->attach($category_id_list);
        }
    }
}
