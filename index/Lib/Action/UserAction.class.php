<?php
class UserAction extends BasicAction
{
	public function index(){
		$user=session('user');
		$info_type=I("info_type","","htmlspecialchars");
		if(empty($user)){
			U("Index/index","","",true);
		}else{
			$db=M("member");
			$user=$db->where("user='{$user}'")->find();
			if(empty($user)){
				U("Index/index","","",true);
			}else{
				$this->assign("user",$user);
			}
		}
		$this->assign("title","会员页面"."-".C("CONFIG_TITLE"));
		if($info_type=="info"){
			$this->display("info");
		}else{
			$this->display("index");
		}
	}
	public function login(){
		if($this->isPost()){
			$type=I("type",0,"htmlspecialchars");
			$pass=I("pas","","htmlspecialchars");
			$user=I("name","","htmlspecialchars");
			if(empty($pass)||empty($user)){
				U("Index/index",array("retval"=>1),"",true);
			}
			$db=M("member");
			$pass=md5($pass);
			$retval=$db->where("user='{$user}' and pass='{$pass}'")->find();
			if($retval){
				session('user',$user); 
				$data=array(
					"login_time"=>date("Y-m-d H:i:s"),
					"login_num"=>$retval['login_num']+1
					);
				$db->where("user='{$user}'")->save($data);
				U("User/index","","",true);
			}else{
				U("Index/index",array("retval"=>2),"",true);
			}
		}
	}
	public function regist(){
		$type	=I("type","0","htmlspecialchars");
		$db=M("member");
		$this->assign("title","会员注册-".C("CONFIG_TITLE"));
		$this->assign("type",$type);
		$this->display("regist");
	}
	public function doRegist(){
		if($this->isAjax()){
			$db=M("member");

			$type=I("type","0","htmlspecialchars");
			$pass=I("pwd","","htmlspecialchars");
			$user=I("username","","htmlspecialchars");
			if(empty($pass)||empty($user)){
				echo json_encode(array('returnInfo'=>"抱歉，参数不能为空！"));
				exit;
			}
			$retval=$db->where("user='{$user}'")->find();
			if(!empty($retval)){
				echo json_encode(array('returnInfo'=>"抱歉，此用户名已被使用！"));
				exit;
			}
			
			$data=array(
				"sortnum"=>$db->where("user_type={$type}")->max("sortnum")+10,
				"user"=>$user,
				"user_type"=>0,
				"level"=>0,
				"admin_id"=>0,
				"pass"=>md5($pass),
				"user_no"=>getMemberNo($type),
				"login_time"=>date("Y-m-d H:i:s"),
				"login_num"=>1
				);
			$rst=$db->data($data)->add();
			if($rst){
				session('user',$user); 
				echo json_encode(array('returnInfo'=>"success"));
			}else{
				echo json_encode(array('returnInfo'=>"抱歉，注册失败！"));
			}
		}else{
			$this->error("抱歉，此页面不存在,马上跳回首页",U("Index/index"));
		}
	}
	
}