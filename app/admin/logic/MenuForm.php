<?php
namespace app\admin\logic;
use app\admin\model\User;
use app\admin\model\Role;
use app\admin\model\Menu;
use think\exception\ValidateException;
use app\BaseController;
class MenuForm extends  Base
{
    //获取数据
    public  function index(){
        $list=Menu::field('id,pid,title label,icon,module,sort,path,name,component,url_value')->order('sort ASC')->select()->toArray();
        return fetchJson([
            'list'=>generateTree($list),
            'count'=>0
        ]);
    }
    //查询
    public  function  find(){
        $id=input('id');
        $form=Menu::where(['id'=>$id])->find();
        return fetchJson($form);
    }
    public function  edit(){
        $id=input('id');
        $form=Menu::where(['id'=>$id])->find();
        try {
            $data=request()->post();
            $rule = [
                'title|名称'   => 'require',
                'path|链接'=>'require',
                'name|路由别名'=>'require',
                'component|组件路径'=>'require'
            ];
            $this->validate($data,$rule);
        } catch (ValidateException $e){
            return fetchJson([],$e->getError(),1);
        }
        if(!$form){
            $form=new Menu();
        }
        $form->save($data);
        return fetchJson([],'保存成功');
    }
    public  function  delete(){
        $id=input('id');
        if(Menu::where(['id'=>$id,'system_menu'=>1])->count()){
             return fetchJson([],'系统菜单不可删除',1);
        }else{
            Menu::where(['id'=>$id])->delete();
            return fetchJson([],'删除成功');
        }
    }

}