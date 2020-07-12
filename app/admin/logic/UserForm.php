<?php
namespace app\admin\logic;
use app\admin\model\User;
use app\admin\model\Role;
use app\admin\model\Menu;
use think\exception\ValidateException;
use app\BaseController;
class UserForm extends  Base
{
    //获取数据
    public  function index(){
        $list=User::where(['is_delete'=>0])->page($this->page)->limit($this->limit)->select()->toArray();
        $count=User::count();
        return fetchJson([
            'list'=>$list,
            'count'=>$count
        ]);
    }
    //查询
    public  function  find(){
        $id=input('id');
        $form=User::where(['id'=>$id])->find();
        return fetchJson($form);
    }
    //编辑
    public function  edit(){
        $id=input('id');
        $form=User::where(['id'=>$id])->find();
        try {
            $data=request()->post();
            $rule = [
                'nickname|名称'=>'require',
                'username|账号'   => 'require',
            ];
            $this->validate($data,$rule);
        } catch (ValidateException $e){
            return fetchJson([],$e->getError(),1);
        }
        if(!$form){
            $form=new User();
        }
        if($data['password']){
            $data['password']=md5($data['password']);
        }
        $form->save($data);
        return fetchJson([],'保存成功');
    }
    public  function  delete(){
        $id=input('id');
        if($id==1){
            return fetchJson([],'该账号不可删除',1);
        }
        User::where(['id'=>$id])->update(['is_delete'=>1]);
        return fetchJson([],'删除成功');
    }

}