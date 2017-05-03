<?php

/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 17/1/14
 * Time: 下午5:30
 */
class IndexController extends Controller
{

    public function indexAction($param = "")
    {
        /**
         * test create 方法
         * 新增data()方法  类生成sql统一处理
         */
        /*$user = new User();
        $data["name"] = "vega_xia";
        $data["sex"] = "1";
        $data["email"] = "vega.xia@vegagame.com";
        if($user->data($data)->create()){
            echo "create success";
        }*/

        /**
         * test save 方法
         * 新增data()方法 类生成sql统一处理
         */
        /*$user = new User();
        $whereStr = " id = 1";
        $data["name"] = "vega_xia";
        $data["sex"] = "1";
        $data["email"] = "vega.xia@vegagame.com";
        if($user->where($whereStr)->data($data)->save()){
            echo "save success";
        }*/

        /**
         * test findFirst 方法
         * 类生成sql统一处理
         */
        /*$user = new User();
        $whereStr = " id = 1";
        $userInfo = $user->where($whereStr)->findFirst();
        print_r($userInfo);
        exit;*/

        /**
         * test find 方法
         * 类生成sql统一处理
         */
        /*$user = new User();
        $whereStr = " sex = 1";
        $userInfo = $user->where($whereStr)->find();
        print_r($userInfo);
        exit;*/

        /**
         * test delete 方法
         * 类生成sql统一处理
         */
        /*$user = new User();
        $whereStr = " id = 5";
        if($user->where($whereStr)->delete()){
            echo "delete success";
        }*/

        /**
         * test 原生sql 方法
         * 修改execute 方法
         */
        /*$user = new User();
        $sql = "select * from user where name='zhangsan' ";
        $userHandle = $user->execute($sql);
        print_r($userHandle->fetchAll());*/


    }

}