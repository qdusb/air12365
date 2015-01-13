<?php
/*
author reevesc cui
update 2014.6.10
高级页面非常规页面
比如留言，联系我们,搜索页面
*/
class AdvancedAction extends BasicAction
{
	function index(){
		$this->error("非法请求");
	}
	/*招商加盟*/
	function join(){
		$class_id="104101";
		$this->setIDConfig($class_id);
		$this->assign("title",$this->configs['class_name'] ."-".C("CONFIG_TITLE"));
		$this->display("join");
	}
	function submitJoin(){
		if($this->isAjax())
		{
			$db=D("Message");
			if (!$db->create()){
				$error=$db->getError();
				$returnInfo=$error;
				//$this->error($error);
			}else{
				$name	=I("name","","htmlspecialchars");
				$content=I("content","","htmlspecialchars");
				$phone=I("phone","","htmlspecialchars");
				$data=array(
					"id"=>$db->max("id")+1,
					"sortnum"=>$db->max("sortnum")+10,
					"name"=>$name,
					"phone"=>$phone,
					"content"=>$content,
					"create_time"=>date("Y-m-d H:i:s")
					);
				$rst=$db->data($data)->add();
				if($rst){
					$returnInfo="ok";
				}else{
					$returnInfo="error";
				}
			}
		}
		else
		{
			
			$this->error("非法请求");
			exit;
		}
		$arr=array('returnInfo'=>$returnInfo);
		echo json_encode($arr);
	}

	function message(){
		$this->error("抱歉，此页面不存在,马上跳回首页",U("Index/index"));
		exit;
		$class_id="106102";
		$page_id=I("page_id","1","htmlspecialchars");
		$this->setIDConfig($class_id);

		$page_size=2;
		$start=($page_id-1)*$page_size;
		$db=M("message");
		$records=$db->where("state=2")->order("sortnum desc")->limit($start,$page_size)->select();

		$recordCnt=$db->where("state=2")->count("id");
		$page_num=ceil($recordCnt/$page_size);
		$page_config=page($page_id,$page_num,"Advanced/message",array());
		$this->assign("page_config",$page_config);

		$this->assign("infos",$records);
		$this->assign("title","在线留言-".C("CONFIG_TITLE"));
		$this->display("message");
	}
	function submitMessage(){
		$this->error("抱歉，此页面不存在,马上跳回首页",U("Index/index"));
		exit;
		if($this->isAjax())
		{
			$db=D("Message");
			if (!$db->create()){
				$error=$db->getError();
				$returnInfo=$error;
				//$this->error($error);
			}else{
				$name	=I("name","","htmlspecialchars");
				$content=I("content","","htmlspecialchars");
				$phone=I("phone","","htmlspecialchars");
				$email=I("email","","htmlspecialchars");
				$data=array(
					"id"=>$db->max("id")+1,
					"sortnum"=>$db->max("sortnum")+10,
					"name"=>$name,
					"phone"=>$phone,
					"email"=>$email,
					"content"=>$content,
					"create_time"=>date("Y-m-d H:i:s")
					);
				$rst=$db->data($data)->add();
				if($rst){
					$returnInfo="ok";
					//$this->success("提交成功");
				}else{
					$returnInfo="error";
				}
			}
		}
		else
		{
			
			$this->error("非法请求");
			exit;
		}
		$arr=array('returnInfo'=>$returnInfo);
		echo json_encode($arr);
	}
	/*联系我们页面*/
	function contact(){
		$class_id="106101";
		$this->setIDConfig($class_id);
		/*百度地图*/
		$map=array(
			"long"=>121.500708,
			"lati"=>31.21649,
			"zoom"=>13
			);
		$this->assign("map",$map);

		$db=M("info");
		$infos=$db->where("class_id=$class_id and state>0")->limit(1)->select();
		$this->assign("infos",$infos);
		$this->assign("title","联系我们-".C("CONFIG_TITLE"));
		$this->display("contact");
	}
	/*搜索页面*/
	function search(){
		$this->error("抱歉，此页面不存在,马上跳回首页",U("Index/index"));
		exit;
		$keyword=I("keyword","","htmlspecialchars");
		$page_id=I("page_id","0","htmlspecialchars");
		if($page_id==0){
			$page_id=1;
		}else{
			$keyword=base64_decode($keyword);
		}
		if(empty($keyword)||$keyword=="请输入关键词"){
			alert("关键词不能为空",true);
			exit;
		}
		
		$page_size=15;
		$start=($page_id-1)*$page_size;
		$sql="(title like '%{$keyword}%' or content like '%{$keyword}%') and state>0";
		$db=M("Info");
		$records=$db->where($sql)->limit($start,$page_size)->select();

		$recordCnt=$db->where($sql)->count("id");
		$page_num=ceil($recordCnt/$page_size);
		$page_config=page($page_id,$page_num,"Advanced/search",array("keyword"=>base64_encode($keyword)));
		$this->assign("page_config",$page_config);

		$this->assign("infos",$records);
		$this->assign("keyword",$keyword);
		$this->assign("title","在线搜索-".C("CONFIG_TITLE"));
		$this->display("search");
	}
}
?>