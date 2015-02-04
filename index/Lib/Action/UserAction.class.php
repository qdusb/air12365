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
				$docu_types=array("身份证","军官证","护照","港澳通行证","入台证");
				$user['docu_name']=$docu_types[$user['docu_type']];
				$user['integral']=intval(M("air_record")->where("user_id={$user['id']}")->sum("ticket_price"));
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
	public function recordList(){
		$user=session('user');
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
		$db=M("air_record");
		$records=$db->where("user_id={$user['id']}")->order("sortnum desc")->select();
		$this->assign("records",$records);
		$this->assign("title","会员页面"."-".C("CONFIG_TITLE"));
		$this->display("record_list");
	}
	public function update(){
		if($this->isPost()){
			$user=session('user');
			$user_type=I("user_type",0);
			if($user_type==0){
				$data=array(
					"name"=>I("name","","htmlspecialchars"),
					"company"=>I("company","","htmlspecialchars"),
					"phone"=>I("phone","","htmlspecialchars"),
					"email"=>I("email","","htmlspecialchars"),
					"update_time"=>date("Y-m-d H:i:s")
				);
			}else{
				$data=array(
					"address"=>I("address","","htmlspecialchars"),
					"tel"=>I("tel","","htmlspecialchars"),
					"contact"=>I("contact","","htmlspecialchars"),
					"phone"=>I("phone","","htmlspecialchars"),
					"update_time"=>date("Y-m-d H:i:s")
				);
			}
			M("member")->where("user='{$user}'")->save($data);
			U("index",array("info_type"=>"info"),"",true);
		}
	}
	public function updateInfo(){
		if($this->isPost()){
			$intro=I("intro","","htmlspecialchars");
			$user=session('user');
			$data=array("intro"=>$intro,"update_time"=>date("Y-m-d H:i:s"));
			M("member")->where("user='{$user}'")->save($data);
			U("index","","",true);
		}
	}
	public function regist(){
		$type	=I("type","0","htmlspecialchars");
		$db=M("member");
		$this->assign("title","会员注册-".C("CONFIG_TITLE"));
		$this->assign("type",$type);
		$this->display("regist");
	}
	public function loginout(){
		session('user',null);
		U("Index/index","","",true);
	}
	public function doRegist(){
	//	if($this->isAjax()){
			$db=M("member");
			$type=I("type","0","htmlspecialchars");
			$pass=I("pwd","","htmlspecialchars");
			$user=I("username","","htmlspecialchars");
			$phone=I("phone","","htmlspecialchars");
			$docu_type=I("docu_type","","htmlspecialchars");
			$docu_no=I("docu_no","","htmlspecialchars");
			$email=I("email","","htmlspecialchars");
			$name=I("name","","htmlspecialchars");
			$company=I("company","","htmlspecialchars");
			$address=I("address","","htmlspecialchars");
			$intro=I("intro","","htmlspecialchars");

			if(empty($pass)||empty($user)){
				echo json_encode(array('returnInfo'=>"抱歉，参数不能为空！"));
				exit;
			}
			$retval=$db->where("user='{$user}'")->find();
			if(!empty($retval)){
				echo json_encode(array('returnInfo'=>"抱歉，此用户名已被使用！"));
				exit;
			}
			if($type==0){
				$data=array(
					"sortnum"=>$db->where("user_type={$type}")->max("sortnum")+10,
					"user"=>$user,
					"user_type"=>0,
					"intro"=>$intro,
					"name"=>$name,
					"docu_type"=>$docu_type,
					"docu_no"=>$docu_no,
					"level"=>0,
					"admin_id"=>0,
					"phone"=>$phone,
					"email"=>$email,
					"pass"=>md5($pass),
					"user_no"=>getMemberNo($type),
					"login_time"=>date("Y-m-d H:i:s"),
					"login_num"=>1
				);
			}else{
				$data=array(
					"sortnum"=>$db->where("user_type={$type}")->max("sortnum")+10,
					"user"=>$user,
					"user_type"=>1,
					"admin_id"=>0,
					"phone"=>$phone,
					"intro"=>$intro,
					"company"=>$company,
					"address"=>$address,
					"email"=>$email,
					"pass"=>md5($pass),
					"user_no"=>getMemberNo($type),
					"login_time"=>date("Y-m-d H:i:s"),
					"login_num"=>1
				);
			}
			
			$rst=$db->data($data)->add();
			if($rst){
				session('user',$user);
				sendMessageAdapter($phone,"恭喜你注册成功，你的用户名是: {$user},密码是: {$pass},请妥善保存");
				echo json_encode(array('returnInfo'=>"success"));
			}else{
				echo json_encode(array('returnInfo'=>"抱歉，注册失败！"));
			}
		/*}else{
			$this->error("抱歉，此页面不存在,马上跳回首页",U("Index/index"));
		}*/
	}
	
}