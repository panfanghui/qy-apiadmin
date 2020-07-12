<?php
namespace app\admin\controller;
use app\admin\logic\IndexForm;
class Index
{
    //权限
    public function auth_list()
    {
        $form=new IndexForm();
        return $form->authList();
    }
    //权限
    public function auth_list2()
    {
        $form=new IndexForm();
        return $form->authList2();
    }
}
