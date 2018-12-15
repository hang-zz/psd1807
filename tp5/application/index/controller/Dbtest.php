<?php 
namespace app\index\controller;

use think\Db;

/**
* 数据库测试类
*/
class Dbtest
{
	
	public function index()
	{
		//获取数据库对象
		//$db=Db::table('tedu_user');
		$db=Db::name('user');
		print_r($db);
		return "<h1>这里是数据库测试</h1>";
	}
	//验证数据库插入
	//访问路径:
	//index.php/index/dbtest/add
	public function add()
	{
		//1.获取数据库对象
		$db=Db::table('tedu_user');

		//2.准备插入数据
		$user=[
			'username'=>mt_rand(10000,99999),
			'password'=>md5('abc123'),
			'created' =>time(),
		];

		$users=[
		[
				'username'=>mt_rand(10000,99999),
				'password'=>md5('abc123'),
				'created' =>time(),
			],[
				'username'=>mt_rand(10000,99999),
				'password'=>md5('abc123'),
				'created' =>time(),
			],[
				'username'=>mt_rand(10000,99999),
				'password'=>md5('abc123'),
				'created' =>time(),
			],
		];
		//3.执行操作
		//$res = $db->insert($user);
		$res=$db->insertAll($users);
		echo $res;

	}

	//验证数据删除操作
	//访问路径:index.php/index/dbtest/remove
	public function remove()
	{
		//1.获取数据库对象
		$db = Db::name('user');
		//2.执行删除 id=7 删除单条
		//$res=$db->delete(7);
		//删除多条
		$res=$db->delete([4,5]);
		echo $res;
	}

	//验证数据更新操作
	//访问路径: index.php/index/dbtest/update
	public function update()
	{
		//1.获取数据库对象
		$db = Db::name('user');
		//2.执行更新
		// $res=$db->where('id=1')->update(['balance'=>100000000]);
		 // $res=$db->where('id=1')->setField('balance',200000000);
		// $res=$db->where('id=1')->setField('email','xiaoxin@qq.com');
		
		// 递减字段
		// $res=$db->where('id=1')->setDec('balance',5000000);
		//递增字段
		$res=$db->where('id','<=',2)->setInc('balance',5000000);
		echo $res;
	}
	//验证数据查询操作
	//访问路径:index.php/index/dbtest/query
	public function query()
	{
		$db= Db::name('user');
		 $user=$db->find(1);

		// $user=$db->where('id=1')->find();
		//$users=$db->select();
		//$users=$db->field("username,password")->select();
		// $users=$db->field(["username","password"])->select();
		
		 // $users=$db->where("username","eq","xiaoxin")->where("password","eq",md5("123456a"))->find();
		 $users = $db->field("username,password,created")->order("created DESC")->limit(2)->select();
		 
		print_r($users);

	}

		public function adda()
	{
		//1.获取数据库对象
		$db=Db::table('tedu_user');

		//2.准备插入数据
		$user=[
			'username'=>mt_rand(10000,99999),
			'password'=>md5('abc123'),
			'created' =>time(),
		];

		$users=[
		[
				'username'=>mt_rand(10000,99999),
				'password'=>md5('abc123'),
				'created' =>time(),
			],[
				'username'=>mt_rand(10000,99999),
				'password'=>md5('abc123'),
				'created' =>time(),
			],[
				'username'=>mt_rand(10000,99999),
				'password'=>md5('abc123'),
				'created' =>time(),
			],
		];
		//3.执行操作
		//$res = $db->insert($user);
		$res=$db->insertAll($users);
		echo $res;

	}


}