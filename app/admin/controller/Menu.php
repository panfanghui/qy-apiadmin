<?php
namespace app\admin\controller;
use app\admin\logic\MenuForm;
class Menu
{
    public function index()
    {
        $form=new MenuForm();
        return $form->index();
    }
    public function find()
    {
        $form=new MenuForm();
        return $form->find();
    }
    public function edit()
    {
        $form=new MenuForm();
        return $form->edit();
    }
    public function delete()
    {
        $form=new MenuForm();
        return $form->delete();
    }
}
