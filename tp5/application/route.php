<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//方式三:注册的路由
use think\Route;
Route::rule('/','index/index/index','get');
//用户登录
//路由表达式  地址表达式
Route::rule('login','index/user/login','get');
//注册
Route::get('register','index/user/register');
Route::get('center','index/user/center');
Route::get('logout','index/user/logout');
//博客系列
Route::get('index','index/blog/index');
Route::get(':id','index/blog/detail');
Route::get('add','index/blog/add');
Route::post('doadd','index/blog/doadd');
Route::get('admin','admin/index/index');
return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    //方式一:直接声明
    //路由表达式   地址表达式
    //blog 		  index/blog/index
    //blog/数字   index/blog/detail/id/数字
    
    // 'blog/:id'    => [
    // 	'index/blog/detail',
    // 	['method' => 'get'],
    // 	['id'     => '\d+'],
    // ],

    // 'blog/add'		  => [
    // 	'index/blog/add',
    // 	['method' => 'get'],    	
    // ],
    // 'blog/doadd'		  => [
    // 	'index/blog/doadd',
    // 	['method' => 'post'],    	
    // ],

    // 'blog' 		  => [
    // 	'index/blog/index',
    // 	['method' => 'get'],

    // ],
   

    //方式二:路由分组
    // '[blog]'	=> [
    // 	':id'	=>	['index/blog/detail',['method'=>'get'],['id'=>'\d+']],
    // 	'add'	=>	['index/blog/add',['method'=>'get']],
    // 	'doAdd'	=>	['index/blog/doAdd',['method'=>'post']],

    // 	'/'		=>	['index/blog/index',['method'=>'get']],
    // ],

    // '[user]'	=>	[
    // 	'login'	=>['index/user/login',['method'=>'get']],
    // 	'register'=>['index/user/register',['method'=>'get']],
    // 	'center'  =>['index/user/center',['method'=>'get']],
    // ],
    // '[index]'	=>	[
    // 	'/'	=>['index/index/index',['method'=>'get']],
    // ],
    // 
    
    
];
