<?php 
namespace app\index\controller;
use app\index\model\Blog as BlogModel;
use think\Controller;
use think\Session;

/**
* 
*/
class Blog extends Controller
{
	//初始化方法
	
	public function _initialize()
	{
		//查询点击量排前的博客
		$vie = model('blog')->getRanking();
		//查询最新发布博客(按创建时间排名)
		$creat =model('blog')->getNew();

		// 结果绑定
		$this->assign('vie',$vie);
		$this->assign('creat',$creat);
		
	}

	public function index()
	{
		// 轮播图
		$slide=model('blog')->getSlide();

		// 分页
		$list = model('blog')->getpaginate();
			
		// 结果绑定		
		$this->assign('list',$list);
		$this->assign('slide',$slide);
		return $this->fetch();	
	}

	public function add()
	{
		if (session("?user")) {
			return $this->fetch();
		}else{
			$this->error("用户登录后才能添加博客",url("index/user/login"));
		}
		 
	}

    public function doAdd()
    {
        // $data = $_POST;
        $data = input('post.');

        // 上传图片
        $file  = request()->file('image');
        if ($file) {
        	//上传的目标目录  public/static/upload
        	$path = ROOT_PATH."public/static/upload";
        	$info = $file->move($path);
        	if ($info) {
        		$data['image'] = $info->getSaveName();
        	}
        }
        $res = model('blog')->save($data);
        // 用模型方式添加数据
        if ($res) {
            $this->success("添加成功", url("index/blog/index"));
        } else {
            $this->error("添加失败");
        }
    }

    //博客详情
	public function detail()
	{
		 $id=input('param.id');
		 // print_r($id);
		// $con = model('blog')->find($id);
		$con = BlogModel::get($id);
		db('blog')->where('id',$id)->setInc('view');
		$this->assign('con',$con);
		// $data = BlogModel::get($id);
		// $this->assign('data',$data);
		return $this->fetch();

	}




}