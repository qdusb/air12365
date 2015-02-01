<?php
/*
author reevesc cui
update 2014.6.10
首页
*/
class IndexAction extends BasicAction {
    public function index(){
       
        $banners=M("link")->where("class_id=1")->select();
        $this->assign("banner",$banners);

        $links=M("link")->where("class_id=1")->select();
        $this->assign("links",$links);
		$this->assign("title","网站首页-".C("CONFIG_TITLE"));
		$this->display("default");
    }
}