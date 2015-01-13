<?php
/*
author reevesc cui
update 2014.6.10
基本控制器
*/
class BasicAction extends Action{
	public $categorys=array();
	public $configs;
	public $class_id;
	/*
	自动化函数，自动调用
	*/
	public function _initialize(){
		$this->class_id=I("class_id","","htmlspecialchars");
		if(!empty($this->class_id)){
			$this->setIDConfig($this->class_id);
		}
		

		setBaseWebConfig();
		/*一级导航*/
		$navs=getBaseClass(6);
		$this->assign("navs",$navs);
		/*所有的二级导航*/
		$this->categorys=getAllCategorys();
		$this->assign("categorys",$this->categorys);
		/*默认为内页样式*/
		$this->assign("css_file","inside.css");
	}
	protected function setIDConfig($class_id){
		
		$configs=getClassValue($class_id);
		$this->assign("info_state",$configs['info_state']);
		$seconds=getSecondClasses($configs['base_id']);
		$this->assign("seconds",$seconds);
		$this->assign("id_configs",$configs);
		$this->configs=$configs;
	}
}
?>