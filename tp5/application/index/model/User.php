<?php

namespace app\index\model;

use think\Model;

/**
 * 前台用户模型; 对应tedu_user数据表
 */
class User extends Model
{
	// 开启时间字段自动完成
	protected $autoWriteTimestamp = true;
	protected $updateTime		  = false;
	protected $createTime			="created";
	//添加场景下自动完成的字段
	protected $insert =[
		'balance'=>200,
	];

	//查看某个用户下的博客(一对多)
	//当前模型是 User
	public function blogs()
	{
		return $this->hasMany('Blog','uid')
		->field("id,uid,title,created")
		->order('created DESC')
		->paginate(5);
	}
	//修改器-将明文的密码装成密文
	public function setPasswordAttr($value)
	{
		return md5($value);
	}


}
