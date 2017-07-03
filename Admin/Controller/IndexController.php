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
        $this->display();
    }

    public function submitAction()
    {
        $oriContent = file_get_contents('php://input');
        $elements = split('&', $oriContent);
        $valueMap = array();
        foreach ($elements as $element)
        {
            $single = split('=', $element);
            $valueMap[$single[0]] = $single[1];
        }
        print_r($valueMap);
    }

}