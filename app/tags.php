<?php

// 应用行为扩展定义文件
return [
    // 应用初始化
    'app_init'    => [
        'cmf\\behavior\\InitHookBehavior',
    ],
    // 应用开始
    'app_begin'   => [
        'cmf\\behavior\\LangBehavior',
    ],
    // 模块初始化
    'module_init' => [
        'cmf\\behavior\\InitAppHookBehavior',
    ],
    // 后台初始化
    'admin_init'  => [
        'cmf\\behavior\\AdminLangBehavior',
    ],
    // 前台初始化
    'home_init'   => [
        'cmf\\behavior\\HomeLangBehavior',
    ]
];
