<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //プロフィール用画像をコピー
        copy('public/img/hoge.png', 'storage/app/public/user/hoge.png');
        User::factory()->create(['name'=>'hoge1','email' => 'hoge1@hoge.jp','image' => 'public/user/hoge.png']);
        User::factory()->create(['name'=>'hoge2','email' => 'hoge2@hoge.jp','image' => 'public/user/hoge.png']);
        User::factory()->create(['name'=>'hoge3','email' => 'hoge3@hoge.jp','image' => 'public/user/hoge.png']);
    }
}
