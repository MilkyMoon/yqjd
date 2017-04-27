<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

    // 定义资源路由
    '__rest__'=>[
        'admin/rules'		   =>'admin/rules',
        'admin/groups'		   =>'admin/groups',
        'admin/users'		   =>'admin/users',
        'admin/menus'		   =>'admin/menus',
        'admin/structures'	   =>'admin/structures',
        'admin/posts'          =>'admin/posts',
    ],


    // 【文章】批量删除
    'admin/article/deletes' => ['admin/article/deletes', ['method' => 'POST']],
    // 【文章】启用/禁用
    'admin/article/enables' => ['admin/article/enables', ['method' => 'POST']],
    // 【文章】添加
    'admin/article/save' => ['admin/article/save', ['method' => 'POST']],

    // MISS路由
//    '__miss__'  => 'admin/base/miss',
];
