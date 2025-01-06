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
        $param = [
            'name' => 'hoge',
            'email' => 'hoge@hoge.com',
            'password' => Hash::make('password'),
            'image' => 'public/user/hoge.png',
            'post_code' => '000-0000',
            'address' => 'hogehoge',
            'building' => 'hoge',
            'email_verified_at' => '2025-01-01 00:00:00',

        ];
        User::create($param);
    }
}
