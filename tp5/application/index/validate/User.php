<?php 
namespace app\index\validate;
use think\Validate;
/**
* 
*/
class User extends Validate
{
	
	protected $rule=[
		'username' => 'require|length:2,100|unique:user',
		'password' => 'require|min:6',
		'repassword'=>'require|confirm:password',
		'email'	=> 'email',
		// 'captcha' => 'require|captcha',
		'phone'	=>  ['regex' => '/^1(3\d|4[579]|5[0-35-9]|7[0135-8]|8\d)\d{8}$/'],
	];

	protected $message=[
	'username.require' => '用户名不能为空',
	'username.length'  => '用户名长度非法(2-100位)',
	'username.unique'  => '用户名已被占用,请换一个',
	'password.require' => '密码不能为空',
	'password.min'	   => '密码最短是6位',
	'repassword.require'=>'确认密码不能为空',
	'repassword.confirm'=>'两次输入的密码不一致,请重新输入',
	'email.email'		=>'邮箱格式非法',	
	'phone.regex'		=>'手机号格式不对',

	// 'captcha.captcha'	=>''
	];
}