<?php 
namespace app\index\controller;
// use app\index\model\User as UserModel;
use think\Controller;
use think\Request;
use think\Session;
use think\Validate;


class User extends Controller
{
	// 用户列表
	public function index()
    {
        $list = db('user')->field("id,username,balance,created")->order("created DESC")->select();
        $this->assign("list",$list);
        
        // index/view/user/index.html
        return $this->fetch();
       
    }
    //展示注册页面
    //访问路径:index.php/index/user/register
    public function register()
    {
    	return $this->fetch();
    }

    public function doRegister(Request $request)
    {

        $data=input('param.');
        print_r($data);
        if (!captcha_check($data['captcha'])) {
            $this->error("验证码非法!");
            }

		//1.获取验证对象
		// $rule = [
		// 	// 字段名 => '规则1|规则2|.....'
		// 	'username' => 'require|length:2,100|unique:user',
		// 	'password' => 'require|min:6',
		// 	'repassword'=>'require|confirm:password',
		// ];
		// $message = [
		// 	'username.require' => '用户名不能为空',
		// 	'username.length'  => '用户名长度非法(2-100位)',
		// 	'username.unique'  => '用户名已被占用,请换一个',
		// 	'password.require' => '密码不能为空',
		// 	'password.min'	   => '密码最短是6位',
		// 	'repassword.require'=>'确认密码不能为空',
		// 	'repassword.confirm'=>'两次输入的密码不一致,请重新输入',
		// ];

		//$v = new Validate($rule,$message);  
		
		// if (!$m->check($data))
		// {
		//    	$this->error($m->getError());
		// 	}          
        $m = model('user');
        $res=$m
        ->allowField(true)
        ->validate(true)
        ->save($data);
 		if ($res) {
 			$this->success("用户注册成功!",url('index/User/login'));
 		}else{
 			$this->error($m->getError());
 		}
    }

    public function login()
    {
    	// view/user/login.html
    	return $this->fetch();
    }

    public function Dologin()
    {
    	$data=$_POST;
    	print_r($data);
        if (!captcha_check($data['captcha'])) {
            $this->error("验证码非法!");
        }
        
    	$user = db('user')->field("id,username")->where("username","=",$data['username'])->where("password","=",md5($data['password']))->find();		 
    	 if ($user) {
    	 	Session::set('user',$user);
            Session::set('id',$user);
    	 	$this->success("用户登录成功!",url('index/index/index'));
    	 }else{
    	 	$this->error("用户登录失败!");
    	 }
    	
   
    }

    public function logout()
    {
        Session::delete('user');
       $this->redirect(url('index/index/index'));
    }

    public function center()
    {
        if (session('?user')) {
            $uid = session('user.id');
            $user = model('user')->find($uid);

            // $list = model('blog')->getList(); 
            $this->assign('list',$user->blogs());
            return $this->fetch();
        }else{
            return $this->error("未登录");
        }


    }




}