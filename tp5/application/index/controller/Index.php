<?php
namespace app\index\controller;
use think\Controller;
use think\Session;

class Index extends Controller
{
    public function index()
    {
        // $user=Session::get('user["username"]');
        // echo " <h1>首页</h1><a href='#'>$user</a>";
        return $this->fetch();

    }

    public function tpl()
    {
    	$user = db('user')->find(1);
    	// print_r($user);

    	$obj=json_decode(json_encode($user));

    	$hi = "hello,World";
    	
    	//将php的变量绑定到模板
    	$this->assign('hello',$hi);
    	$this->assign('user',$user);
    	$this->assign('obj',$obj);
    	//调用模板
    	return $this->fetch();
    }
}
