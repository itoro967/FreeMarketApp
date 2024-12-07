<?php

return [
    'required' => ':attributeを入力してください',
    'min' => ':attributeは:min文字以上で入力してください',
    'max' => ':attributeは:max文字以内で入力してください',
    'email' => ':attributeはメールアドレス形式で入力してください',
    'unique' => 'この::attributeは既に使用されています',
    'mimes' => '有効な拡張子は:valuesです',

    'custom' => [
        'password' =>
        [
            'confirmed' => 'パスワードと一致しません'
        ],
        'post_code' => [
            'regex' => 'ハイフンありの8文字で入力してください'
        ]
    ],

    'attributes' => [
        'name' => 'お名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'comment' => 'コメント',
        'post_code' => '郵便番号',
        'address' => '住所',
        'building' => '建物名'
    ],
];
