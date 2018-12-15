<?php 
namespace app\index\model;
use think\Model;
use think\Controller;
class Blog extends Model
{
	protected $autoWriteTimestamp 	= true;
	protected $updateTime			= "updated";
	protected $createTime			= "created";

	protected $insert = [
        'uid',
    ];

    // 修改器
    public function setUidAttr()
    {
        return session('user.id');
    }

    // 查询带图片的,最新的,5篇博客
    public function getSlide($num = 5)
    {
        return $this
            ->field("id,title,image")
            ->where("image", 'neq', "")
            ->order("created DESC")
            ->limit($num)
            ->select();
    }

    public function getList()
    {
        $uid = session('user.id');
        return $this
        ->field("*")
        ->where('uid','=',$uid)
        ->order('created DESC')
        ->paginate(5);  
    }

    // 查看博客的作者信息
    // 当前模型是 Blog
    public function author()
    {
        return $this->belongsTo('User','uid');
    }

    //博客点击量排名查询方法getRanking()
    public function getRanking()
    {
        return $this->field("id,title,view")->order("view DESC")->limit(5)->select();
    }
    //博客最新创建排名查询方法
    public function getNew()
    {
       return $this->field("id,title,created")->order("created DESC")->limit(5)->select();
    }

    //博客列表分页查询方法getpaginate()
    public function getpaginate()
    {
       return $this->field("*")->order('created DESC')->paginate(5);
    }

}