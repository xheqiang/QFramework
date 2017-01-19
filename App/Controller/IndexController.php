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
         * save 增加order limit方法
         */
        /*$user = new User();
        $whereArr["sex"] = 2;
        $orderArr["id"] = "desc";
        $limitArr["end"] = 5;
        $data["sex"] = 1;
        $data["email"] = "adminaaa@vega.com";
        if($user->where($whereArr)->order($orderArr)->limit($limitArr)->save($data)){
            echo "save success";
        }*/

        /**
         * find 增加order limit方法
         */
        /*$user = new User();
        $cloumnArr = array("name","email");
        $whereArr["sex"] = 1;
        $orderArr["id"] = "desc";
        $limitArr["end"] = 2;
        $userInfo = $user->cloumn($cloumnArr)->where($whereArr)->order($orderArr)->limit($limitArr)->find();
        print_r($userInfo);*/
    }

}