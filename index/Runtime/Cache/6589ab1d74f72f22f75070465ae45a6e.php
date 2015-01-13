<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo ($title); ?></title>
<meta content="<?php echo ($config_keyword); ?>" name="keywords"/>
<meta content="<?php echo ($config_description); ?>" name="description"/>
<link rel="stylesheet" href="__PUBLIC__/images/base.css" />
<link rel="stylesheet" href="__PUBLIC__/images/<?php echo ($css_file); ?>" />
<script src="__PUBLIC__/js/jquery-1.7.2.min.js"></script>
<script src="__PUBLIC__/js/jquery.SuperSlide.js"></script>
<script src="__PUBLIC__/js/adver.js"></script>
</head>
<body>
<div class="wrapper">
	<div class="header">
		<div class="topArea">
			<h2 class="logo"><a href="<?php echo U('Index/index');?>">信望餐饮</a></h2>
			<div class="nav">
				<ul class="navs clearfix">
					<?php if(is_array($navs)): foreach($navs as $key=>$v): ?><li class="<?php echo ($v["class"]); ?>">
						<a href="<?php echo ($v["url"]); ?>" <?php if($v['id'] == $id_configs['base_id']): ?>class="current"<?php endif; ?> ><?php echo ($v["name"]); ?></a>
					</li><?php endforeach; endif; ?>
				</ul>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="wrap">
			<div class="bg-contact clearfix">
				<div class="location clearfix">
	<h2><?php echo ($id_configs["base_name"]); ?></h2>
	<div class="breadcrumbs">
		<a href="<?php echo U(Index/index);?>">首页</a> 
		&gt; <a href="<?php echo U('Info/index',array('class_id'=>$id_configs['second_id']));?>"><?php echo ($id_configs["second_name"]); ?></a>
		<?php if($id_configs["third_id"] != ''): ?>&gt; <a href="<?php echo U('Info/index',array('class_id'=>$id_configs['third_id']));?>"><?php echo ($id_configs["third_name"]); ?></a><?php endif; ?>
	</div>
</div>
<script>
$(".breadcrumbs a:last").addClass("current");
</script>
				<div class="sidebar">
	<div class="menu">
		<dl>
			<?php if(is_array($seconds)): $i = 0; $__LIST__ = $seconds;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><dt><a href="<?php echo ($v["second"]["url"]); ?>" <?php if($v['second']['id'] == $id_configs['second_id']): ?>class="current"<?php endif; ?>><?php echo ($v["second"]["name"]); ?></a></dt><?php endforeach; endif; else: echo "" ;endif; ?>
		</dl>
	</div>
</div>
				<div class="main">
					<div class="cmod cmod-1">
						<div class="hd">
							<h3>上海巴黎咖啡店</h3>
						</div>
						<div class="bd">
							<?php echo ($infos[0]["content"]); ?>
						</div>
					</div>
					<div class="cmod cmod-2">
						<div class="hd">
							<h3>导航地图</h3>
						</div>
						<div class="bd">
							<!--引用百度地图API-->
<style type="text/css">
	html,body{margin:0;padding:0;}
	.iw_poi_title {color:#CC5522;font-size:14px;font-weight:bold;overflow:hidden;padding-right:13px;white-space:nowrap}
	.iw_poi_content {font:12px arial,sans-serif;overflow:visible;padding-top:4px;white-space:-moz-pre-wrap;word-wrap:break-word}
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
 <!--百度地图容器-->
 <div style="width:578px;height:240px;border:#ccc solid 1px;" id="dituContent"></div>
<script type="text/javascript">
	//创建和初始化地图函数：
	function initMap(){
		createMap();//创建地图
		setMapEvent();//设置地图事件
		addMapControl();//向地图添加控件
		addMarker();//向地图中添加marker
	}
	
	//创建地图函数：
	function createMap(){
		var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
		

		var point = new BMap.Point(<?php echo ($map["long"]); ?>,<?php echo ($map["lati"]); ?>);//定义一个中心点坐标标
		map.centerAndZoom(point,<?php echo ($map["zoom"]); ?>);//设定地图的中心点和坐标并将地图显示在地图容器中
		window.map = map;//将map变量存储在全局
	}
	
	//地图事件设置函数：
	function setMapEvent(){
		map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
		map.enableScrollWheelZoom();//启用地图滚轮放大缩小
		map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
		map.enableKeyboard();//启用键盘上下左右键移动地图
	}
	
	//地图控件添加函数：
	function addMapControl(){
		//向地图中添加缩放控件
	var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
	map.addControl(ctrl_nav);
		//向地图中添加缩略图控件
	var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:1});
	map.addControl(ctrl_ove);
		//向地图中添加比例尺控件
	var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
	map.addControl(ctrl_sca);
	}
	
	//标注点数组
	var markerArr = [{title:"信望餐饮",content:"地址：上海市黄浦区普育西路105号 <br>电话：15000899559<br>邮箱：Larry@pariscafe.com",point:"121.500708|31.21649",isOpen:0,icon:{w:23,h:25,l:46,t:21,x:9,lb:12}}];
	//创建marker
	function addMarker(){

		for(var i=0;i<markerArr.length;i++){
			var json = markerArr[i];
			var p0 = json.point.split("|")[0];
			var p1 = json.point.split("|")[1];
			json.isOpen=1;
			var point = new BMap.Point(p0,p1);
			var iconImg = createIcon(json.icon);
			var marker = new BMap.Marker(point,{icon:iconImg});
			var iw = createInfoWindow(i);
			var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
			marker.setLabel(label);
			map.addOverlay(marker);
			label.setStyle({
						borderColor:"#808080",
						color:"#333",
						cursor:"pointer"
			});
			
			(function(){
				var index = i;
				var _iw = createInfoWindow(i);
				var _marker = marker;
				_marker.addEventListener("click",function(){
					this.openInfoWindow(_iw);
				});
				_iw.addEventListener("open",function(){
					_marker.getLabel().hide();
				})
				_iw.addEventListener("close",function(){
					_marker.getLabel().show();
				})
				label.addEventListener("click",function(){
					_marker.openInfoWindow(_iw);
				})
				if(!!json.isOpen){
					label.hide();
					_marker.openInfoWindow(_iw);
				}
			})()
		}
	}
	//创建InfoWindow
	function createInfoWindow(i){
		var json = markerArr[i];
		var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
		return iw;
	}
	//创建一个Icon
	function createIcon(json){
		var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
		return icon;
	}
	initMap();//创建和初始化地图
</script>
						</div>
					</div>
				</div>
	<p class="footer"><?php echo C("CONFIG_CONTACT");?></p>
				</div>
				<p class="coffee"></p>
			</div>
			<div class="wrapBt"></div>
		</div>
	<p class="ftl"></p>
</div>
<!--[if lte IE 6]><script src="js/iepng.js"></script><![endif]-->
<?php echo C('CONFIG_AD');?>
<?php echo C('CONFIG_JAVASCRIPT');?>
</body>
</html>