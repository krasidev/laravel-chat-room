<?php

return [
    'login' => [
        'title' => 'Login',
        'labels' => [
            'email' => 'Email Address',
            'password' => 'Password',
            'remember' => 'Remember Me'
        ],
        'buttons' => [
            'login' => 'Login',
            'register' => 'Register'
        ]
    ],
    'register' => [
        'title' => 'Register',
        'labels' => [
            'name' => 'Name',
            'email' => 'Email Address',
            'password' => 'Password',
            'password_confirmation' => 'Confirm Password'
        ],
        'buttons' => [
            'register' => 'Register'
        ]
    ],
    'home' => [
        'content' => 'You are logged in!'
    ],
    'users' => [
        'table' => [
            'headers' => [
                'id' => 'ID',
                'name' => 'Name',
                'email' => 'E-Mail Address',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At'
            ]
        ]
    ],
];
