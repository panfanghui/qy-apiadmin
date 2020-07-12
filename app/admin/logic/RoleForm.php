<?php
namespace app\admin\logic;
use app\admin\model\User;
use app\admin\model\Role;
use app\admin\model\Menu;
use think\exception\ValidateException;
use app\BaseController;
class RoleForm extends  Base
{
    //获取数据
    public  function index(){
        $list=Role::page($this->page)->limit($this->limit)->field('id,name,description')->select()->toArray();
        $count=Role::count();
        return fetchJson([
            'list'=>$list,
            'count'=>$count
        ]);
    }
    //查询
    public  function  find(){
        $id=input('id');
        $form=Role::where(['id'=>$id])->find();
        $form->menu_auth=json_decode($form->menu_auth,1);
        $menu_list=Menu::field('id,pid,title label')->order('sort ASC')->select()->toArray();
        $form->menu_list=generateTree($menu_list);
        return fetchJson($form);
    }
    public function  edit(){
        $id=input('id');
        $form=Role::where(['id'=>$id])->find();
        try {
            $data=request()->post();
            $rule = [
                'name|名称'   => 'require',
                'description|描述'=>'require',
                'menu_auth|权限'=>'require'
            ];
            $this->validate($data,$rule);
        } catch (ValidateException $e){
            return fetchJson([],$e->getError(),1);
        }
        if(!$form){
            $form=new Role();
        }
        $data['menu_auth']=json_encode($data['menu_auth']);
        $form->save($data);
        return fetchJson([],'保存成功');
    }
    public  function  delete(){
        $id=input('id');
        if($id==1){
            return fetchJson([],'不可删除',1);
        }
        Role::where(['id'=>$id])->delete();
        return fetchJson([],'删除成功');
    }

}