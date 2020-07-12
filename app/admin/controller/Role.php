<?php
namespace app\admin\controller;
use app\admin\logic\RoleForm;
class Role
{
    public function index()
    {
        $form=new RoleForm();
        return $form->index();
    }
    public function find()
    {
        $form=new RoleForm();
        return $form->find();
    }
    public function edit()
    {
        $form=new RoleForm();
        return $form->edit();
    }
    public function delete()
    {
        $form=new RoleForm();
        return $form->delete();
    }
}
