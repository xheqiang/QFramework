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
//        $user = new User();
//        $data["name"] = "zhangsan";
//        $data["sex"] = "1";
//        $data["email"] = "admin@qq.com";
//        if($user->add($data)){
//            echo "add成功";
//        }

//        $user = new User();
//        $id = 1;
//        $data["name"] = "李四";
//        $data["sex"] = 1;
//        $data["email"] = "admin@admin.php";
//        if($user->update($id, $data)){
//            echo "update成功";
//        }

//        $user = new User();
//        $id = 1;
//        $userInfo = $user->select($id);
//        print_r($userInfo);exit;

        $user = new User();
        $id = 4;
        if($user->delete($id)){
            echo "delete Success!";
        }
    }

}