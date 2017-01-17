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
        $data["id"] = array(123,456);
        $this->assign("list", $data);
        $this->display();
    }

}