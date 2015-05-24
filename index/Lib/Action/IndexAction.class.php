<?php
/*
author reevesc cui
update 2014.6.10
首页
*/
class IndexAction extends BasicAction {
    public function index(){
        $retval=I("retval",0);
        $this->assign("retval",$retval);
        $banners=M("banner")->where("class_id=1 and state=1")->select();
        $this->assign("banners",$banners);

        $links=M("link")->where("class_id=1 and state=1")->select();
        $this->assign("links",$links);
        $this->assign("css_file","Kd_Default.css");
		$this->assign("title","网站首页-".C("CONFIG_TITLE"));
		$this->display("default");
		
    }
}
