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
         * test create 新建数据
         * TODO::增加data方法
         */
        /*$user = new User();
        $data["name"] = "夏贺强";
        $data["sex"] = "1";
        $data["email"] = "xhq@11.com";
        if($user->create($data)){
            echo "create success";
        }*/

        /**
         * test save 保存数据
         * TODO::save方法可以优化操作可以使用$user->where($whereSter)->data($data)->save() 同样create方法也可以适用 之后优化
         */
        /*$user = new User();
        $whereStr = "id = 1";
        $data["name"] = "111222";
        if($user->where($whereStr)->save($data)){
            echo "save Success";
        }*/
        /*$user = new User();
        $whereStr["id"] = "1";
        $data["name"] = "6666";
        if($user->where($whereStr)->save($data)){
            echo "save Success";
        }*/

        /**
         * test delete 删除数据
         * TODO::增加order limit方法
         *
         */
        /*$user = new User();
        $whereStr = "id = 5";
        if($count = $user->where($whereStr)->delete()){
            echo "delete Success $count item";
        }*/
        /*$user = new User();
        $whereStr["id"] = "5";
        if($count = $user->where($whereStr)->delete()){
            echo "delete Success $count item";
        }*/

        /**
         * test findFirst 查询单条
         * TODO::增加order limit方法
         *
         */
        /*$user = new User();
        //$cloumnStr = "id,name,email";
        $cloumnArr = array("id","name","sex");
        $whereStr = "id = 4";
        //$userInfo = $user->cloumn($cloumnStr)->where($whereStr)->findFirst();
        $userInfo = $user->cloumn($cloumnArr)->where($whereStr)->findFirst();
        print_r($userInfo);exit;*/


        /**
         * test find 查询单条
         * TODO::增加order limit方法
         *
         */
        /*$user = new User();
        //$cloumnStr = "id,name,email";
        $cloumnArr = array("id","name","sex");
        $whereStr = "sex = 1";
        //$userInfo = $user->cloumn($cloumnStr)->where($whereStr)->findFirst();
        $userInfo = $user->cloumn($cloumnArr)->where($whereStr)->find();
        echo "<pre>";
        var_dump($userInfo);exit;*/




    }

}