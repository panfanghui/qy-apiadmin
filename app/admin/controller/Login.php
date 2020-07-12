<?php
namespace app\admin\controller;
use app\admin\logic\LoginForm;
class Login
{
    public function login()
    {
        $form=new LoginForm();
        return $form->login();
    }
}
