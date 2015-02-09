<?php
/*
author reevesc cui
update 2014.6.10
常规页面，列表，图片，内容，图文列表，自定义
*/
class InfoAction extends BasicAction{
	public function home(){
		$this->error("抱歉，此页面不存在,马上跳回首页",U("Index/index"));
	}

	public function index(){

		$page_id=I("page_id","1","htmlspecialchars");

		if(empty($this->class_id)){
			$this->error("页面不存在");
		}
		$class_id=$this->configs["class_id"];
		$info_state=$this->configs["info_state"];
		$this->setIDConfig($class_id);
		
		/*分页设置*/
		switch($info_state)
		{
			case "pic":
			$page_size=4;
			break;
			case "list":
			$page_size=8;
			break;
			case "pictxt":
			$page_size=8;
			break;
			default:
			$page_size=8;
			break;
		}
		if($info_state=="pic"){
			$bbg="bg-product";
		}elseif($info_state=="list"){
			$bbg="bg-news";
		}else{
			$bbg="bg-about";
		}
		$this->assign("bbg",$bbg);
		$db=M("info");
		if($info_state!="content"){
			/*分页*/
			$recordCnt=$db->where("class_id=$class_id and state>0")->count("id");
			$page_num=ceil($recordCnt/$page_size);
			$page_config=page($page_id,$page_num,"Info/index",array("class_id"=>$class_id));
			$this->assign("page_config",$page_config);
			$page_start=($page_id-1)*$page_size;
			$infos=$db->where("class_id=$class_id and state>0")->order("state desc,sortnum desc")->limit($page_start,$page_size)->select();
			foreach($infos as $key=>$info){
				$infos[$key]['url']=U("Display/index",array("id"=>$info['id'],"type"=>$info_state));
				$infos[$key]['pic']=C("UPLOAD_PATH").$info["pic"];
			}
		}else{
			$infos=$db->where("class_id=$class_id and state>0")->order("state desc,sortnum desc")->limit(1)->select();
		}
		$this->assign("infos",$infos);
		$this->assign("title",$this->configs['class_name'] ."-".C("CONFIG_TITLE"));
		$this->display("index");
	}
	public function menu(){
		$class_id="103";
		$this->setIDConfig($class_id);
		$this->configs['second_id']=$class_id;
		$this->configs['second_name']=$this->configs['base_name'];
		$this->assign("id_configs",$this->configs);
		$db=M("info");
		/*$db=M("info_class");
		$infos=$db->where("id like '{$class_id}___' ")->order("sortnum asc")->select();
		foreach($infos as $key=>$info){
				$infos[$key]['url']=U("Info/index",array("class_id"=>$info['id']));
				$infos[$key]['pic']=C("UPLOAD_PATH").$info["pic"];
			}*/
		$infos=$db->where("class_id like '103___' and state>0")->order("class_id asc")->select();
		foreach($infos as $key=>$info){
			$infos[$key]['url']=U("Display/index",array("id"=>$info['id'],"type"=>"pic"));
			$infos[$key]['pic']=C("UPLOAD_PATH").$info["pic"];
		}
		$this->assign("infos",$infos);
		$this->assign("title",$this->configs['base_name'] ."-".C("CONFIG_TITLE"));
		$this->display("menu");
	}
}
?>