<?php
namespace app\admin\logic;
use app\admin\model\User;
use app\admin\model\Role;
use app\admin\model\Menu;
use think\exception\ValidateException;
use app\BaseController;
class IndexForm extends  Base
{
    //获取数据
    public function authList(){
    	if($this->admin->role==1){
    		$list=Menu::select()->toArray();
    	}else{
    		$menu_auth=Role::where('id',$this->admin->role)->value('menu_auth');
    		$menu_auth=json_decode($menu_auth,1);
    		$list=Menu::where('id','in',$menu_auth)->select()->toArray();
    	}
    	$list=generateTree($list);
    	$auth_json=[];
    	foreach ($list as $key => $value) {
    		if(isset($value['children'])){
    			$children=[];
    			foreach ($value['children'] as $k => $v) {
    				$children[]=[
			          "path"=>$v['path'],
			          "name"=>$v['name'],
			          "component"=>$v['component'],
			          "meta"=>[
			            "title"=>$v['title'],
			            "icon"=>$v['icon']
			          ]
			        ];
    			}
    			$auth_json[]=[
	    			"path"=>$value['path'],
			        "component"=>"Layout",
			        "redirect"=>'noRedirect',
			        "name"=>$value['name'],
				    "meta"=>[
				    	"title"=>$value['title'],
				    	"icon"=>$value['icon'],
				    ],
				    "alwaysShow"=>true,
				    "children"=>$children
	    		];
    		}else{
    			$auth_json[]=[
	    			"path"=>$value['path']=='/'?'/':$value['path'],
			        "component"=>"Layout",
			        "name"=>$value['name'],
			        "redirect"=>$value['path']=='/'?'/index':$value['path'],
				    "children"=>[
				       [
				          "path"=>$value['path']=='/'?'/index':$value['path'],
				          "name"=>$value['name'],
				          "component"=>$value['component'],
				          "meta"=>[
				            "title"=>$value['title'],
				            "icon"=>$value['icon'],
				            "affix"=>true,
				            "noKeepAlive"=>true
				          ]
				       ]
				     ]
	    		];
    		}
    	}
    	return fetchJson($auth_json);

    }
}
/*
public  function authList2(){
        $list=Menu::select()->toArray();
        $json='[
	    {
	      "path": "/",
	      "component": "Layout",
	      "redirect": "noRedirect",
	      "children": [
	        {
	          "path": "index",
	          "name": "Index",
	          "component": "index/index",
	          "meta": {
	            "title": "首页",
	            "icon": "home",
	            "affix": true,
	            "noKeepAlive": true
	          }
	        }
	      ]
	    },
	      {
	      "path": "/admin",
	      "component": "Layout",
	      "redirect": "noRedirect",
	      "name": "AdminAuth",
	      "meta": { "title": "权限管理", "icon": "bug" },
	      "alwaysShow": true,
	      "children": [
	        {
	          "path": "AdminAuthMenu",
	          "name": "AdminAuthMenu",
	          "component": "admin/auth/menu",
	          "meta": { "title": "菜单管理" }
	        },
	        {
	          "path": "AdminAuthRole",
	          "name": "AdminAuthRole",
	          "component": "admin/auth/role",
	          "meta": { "title": "角色管理" }
	        },
	        {
	          "path": "AdminAuthUser",
	          "name": "AdminAuthUser",
	          "component": "admin/auth/user",
	          "meta": { "title": "用户管理" }
	        }
	      ]
	    }
	  ]';
        return fetchJson(json_decode($json,1));
    }