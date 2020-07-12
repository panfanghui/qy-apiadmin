<?php
namespace app\admin\controller;
use app\admin\logic\UserForm;
class User
{
    //获取用户信息
    public function user_info(){
         $form=new UserForm();
        return $form->getUserInfo();
    }
    public function index()
    {
        $form=new UserForm();
        return $form->index();
    }
    public function find()
    {
        $form=new UserForm();
        return $form->find();
    }
    public function edit()
    {
        $form=new UserForm();
        return $form->edit();
    }
    public function delete()
    {
        $form=new UserForm();
        return $form->delete();
    }
}
