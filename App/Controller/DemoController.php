<?php

/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 17/1/19
 * Time: 下午6:25
 */
class DemoController extends Controller
{
    public function indexAction()
    {
        $user = new User();
        $list= $user->find();
        $this->assign("list", $list);
        $this->display();
    }

    public function createAction()
    {
        $this->display();
    }

    public function addAction()
    {
        $user = new User();
        unset($_POST["submit"]);
        $data = $_POST;
        if($user->data($data)->create()){
            echo "<script>alert('新建成功');window.location.href='../index';</script>";
        }
    }

    public function editAction($params)
    {
        $data = $params;
        $user = new User();
        $userInfo = $user->where($data)->findFirst();
        $this->assign("userInfo", $userInfo);
        $this->display();
    }

    public function updateAction()
    {
        $user = new User();
        $whereArr["id"] = $_POST["id"];
        unset($_POST["id"]);
        unset($_POST["submit"]);
        $data = $_POST;
        if($user->where($whereArr)->data($data)->save()){
            echo "<script>alert('编辑成功');window.location.href='../index';</script>";
        }
    }

    public function deleteAction($params)
    {
        $id = $params["id"];
        $user = new User();
        if($user->where("id = $id")->delete()){
            echo "<script>alert('删除成功');window.location.href='../../index';</script>";
        }
    }

    public function searchAction()
    {
        $whereArr = array_filter($_POST);
        unset($whereArr["submit"]);
        $user = new User();
        $list= $user->where($whereArr)->find();
        $this->assign("list", $list);
        $this->display();
    }

}