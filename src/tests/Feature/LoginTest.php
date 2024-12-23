<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginTest extends TestCase
{

    public function test_login(): void
    {
        $tests = [
            [
                'param' => ['password' => 'password'],
                'valid' => ['email' => 'メールアドレスを入力してください']
            ],
            [
                'param' => ['email' => 'test@hoge.com'],
                'valid' => ['password' => 'パスワードを入力してください']
            ],
            [
                'param' => ['email' => 'none@hoge.com', 'password' => 'password'],
                'valid' => ['email' => 'ログイン情報が登録されていません']
            ],
        ];

        foreach ($tests as $test) {
            $response = $this->post(
                '/login',
                $test['param']
            );
            $response->assertInvalid($test['valid']);
        }
        #ログインテスト
        $response = $this->post(
            '/login',
            ['email' => 'hoge@hoge.com', 'password' => 'password']
        );
        $this->assertAuthenticated();
        $response->assertRedirect('/');
        #ログアウトテスト
        $response = $this->post(
            '/logout'
        );
        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
