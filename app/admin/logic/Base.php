<?php
namespace app\admin\logic;

use app\BaseController;
use app\admin\model\User;
use app\admin\model\Role;
use app\admin\model\Menu;
class Base extends BaseController
{
    public $admin;
    public $user_id;
    public $page;
    public $limit;
    public function __construct()
    {
        $this->initialize();
        $access_token=request()->post('access_token');
        if(!$access_token){
             $access_token=request()->get('access_token')?request()->get('access_token'):404;
        }
        $this->admin=User::where('access_token',$access_token)->cache(10)->find();
        if(!$this->admin){
            die(json_encode(['code'=>-1,'data'=>[],'msg'=>'会话失效请重新登录']));
        }
        $this->user_id=$this->admin->id;
        $this->page=request()->post('page')?request()->post('page'):1;
        $this->limit=request()->post('limit')?request()->post('limit'):20;
        if($this->admin->role!=1){
            $menu_auth=Role::where('id',$this->admin->role)->cache(10)->value('menu_auth');
            $menu_auth=json_decode($menu_auth,1);
            $authlist=Menu::where('id','in',$menu_auth)->cache(10)->column('url_value');
            $auth=request()->root().'/'.request()->controller(true).'/'.request()->action();
            $auth=substr($auth,1);
            if(!$authlist){
                die(json_encode(['code'=>1,'data'=>[],'msg'=>'暂无权限']));
            }
            if(!in_array($auth,$authlist)){
                 die(json_encode(['code'=>1,'data'=>[],'msg'=>'暂无权限']));
            }
        }
    }
}
