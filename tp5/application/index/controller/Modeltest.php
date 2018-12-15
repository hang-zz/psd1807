<?php

namespace app\index\controller;

// 引入模型类
use app\index\model\User;

/**
 * 模型演示控制器
 */
class Modeltest
{
    // 获取模型对象
    // 访问路径:
    // index.php/index/modeltest/index
    public function index()
    {
        $u = new User;

        $model = model('user');
        // print_r($u);
        print_r($model);
    }

    /**
     * 演示模型添加数据
     */
    public function add()
    {
        $data = [
            'username' => mt_rand(10000, 99999),
            'password' => md5('abc123'),
            'created'  => time(),
        ];
        // $res = User::create($data);
        // print_r($res);
        // echo $res->id;

        // $res = model('user')->save($data);

        $users = [
            [
                'username' => mt_rand(10000, 99999),
                'password' => md5('abc123'),
                'created'  => time(),
            ],
            [
                'username' => mt_rand(10000, 99999),
                'password' => md5('abc123'),
                'created'  => time(),
            ],
        ];

        $res = model('user')->saveAll($users);

        print_r($res);
    }

    public function remove()
    {
        // $u = User::get(11);
        // $res=$u->delete();
        // print_r($res);
        $u =User:: destroy("34,36,37,38,39,40,41");
        print_r($u);
    }

    public function update($value='')
    {
        // $data=[
        //     'id' =>3,
        //     'balance' =>10000
        // ];
        // $u = User::get(3);
        // $u->balance='266';
        // $res = $u->save();
        //修改多条记录
        $u = new User;
        $data = [
            ['id' => 2,'balance'=>3000],
            ['id' => 3,'username'=>'苏小镇','balance'=>88888],
        ];
        $res = $u->saveAll($data);
        print_r($res);
    }

    //验证数据查询操作
    public function query()
    {
        //$u = User::get(1);
        $user = User::all(['6,9,12']);
        //将结果转成数组
       // print_r($u->toArray());
        //将结果转成json
        //print_r($u->toJson());
        //查看某个字段的值
        // echo $u->balance;
        print_r($user);
    }
}
