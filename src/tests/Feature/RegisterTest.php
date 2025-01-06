<?php

namespace Tests\Feature;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function test_valid(): void
    {
        $tests = [
            [
                'param' => ['email' => 'test@hoge.com', 'password' => 'password', 'password_confirmation' => 'password'],
                'valid' => ['name' => 'お名前を入力してください']
            ],
            [
                'param' => ['name' => 'test', 'password' => 'password', 'password_confirmation' => 'password'],
                'valid' => ['email' => 'メールアドレスを入力してください']
            ],
            [
                'param' => ['name' => 'test', 'email' => 'test@hoge.com'],
                'valid' => ['password' => 'パスワードを入力してください']
            ],
            [
                'param' => ['name' => 'test', 'email' => 'test@hoge.com', 'password' => '1234567', 'password_confirmation' => '1234567'],
                'valid' => ['password' => '8文字以上で入力してください']
            ],
            [
                'param' => ['name' => 'test', 'email' => 'test@hoge.com', 'password' => 'password', 'password_confirmation' => 'hogehoge'],
                'valid' => ['password' => 'パスワードと一致しません']
            ],
        ];

        foreach ($tests as $test) {
            $response = $this->post(
                '/register',
                $test['param']
            );
            $response->assertInvalid($test['valid']);
        }
    }
}
