<?php
namespace app\admin\logic;
use app\admin\model\User;
use app\admin\model\Role;
use app\admin\model\Menu;
use think\exception\ValidateException;
use app\BaseController;
class LoginForm extends  BaseController
{
    public function __construct()
    {
        $this->initialize();
    }
    public  function  login(){
        try {
            $data=request()->post();
            $rule = [
                'username|账号'   => 'require',
                'password|密码'=>'require',
            ];
            $this->validate($data,$rule);
        } catch (ValidateException $e){
            return fetchJson([],$e->getError(),1);
        }
        $user=User::where([
            'username'=>$data['username'],
            'password'=>md5($data['password'])
        ])->withoutField('password')->find();
        if($user){
            if($user->role==1){
                $menu=Menu::field('id,pid,title,url_value,icon')->select()->toArray();
            }else{
                $role=Role::where(['id'=>$user->role])->field('name,menu_auth')->find();
                if($role){
                    $menu=Menu::where('id','in',json_decode($role->menu_auth))->field('id,pid,title,url_value,icon')->select()->toArray();
                }else{
                    return fetchJson([],'暂无任何权限',1);
                }
            }
            $ip=request()->ip();
            if($user->last_login_ip!=$ip){
                $user->access_token=self::accessToken();
                $user->last_login_time=time();
            }
            $user->last_login_ip=$ip;
            $user->save();
            if($user->avatar){
                 $user->avatar=request()->domain().substr(request()->baseUrl(),0,stripos(request()->baseUrl(),'index.php')).'static/logo.png';
            }else{
               $user->avatar=request()->domain().substr(request()->baseUrl(),0,stripos(request()->baseUrl(),'index.php')).'static/logo.png';
            }

            $user['menu_list']=generateTree($menu);
            return fetchJson($user,'登录成功',0);
        }else{
            return fetchJson([],'账号密码错误',1);
        }
    }
    public function accessToken(){
        $accessToken=sha1(time().rand(1000,9999));
        while (User::where('access_token',$accessToken)->count()){
            self::accessToken();
        }
        return $accessToken;
    }
}
