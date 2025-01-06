<?php

return [
    'required' => ':attributeを入力してください',
    'min' => ['string' => ':attributeは:min文字以上で入力してください'],
    'max' => ['string' => ':attributeは:max文字以内で入力してください'],
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
        'item_name' => '商品名',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'comment' => 'コメント',
        'post_code' => '郵便番号',
        'address' => '住所',
        'building' => '建物名',
        'image' => '画像',
        'categories' => 'カテゴリー',
        'description' => '商品説明',
        'price' => '販売価格',
        'payment' => '支払い方法'
    ],
];
