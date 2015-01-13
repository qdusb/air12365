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
			<div class="<?php echo ($bbg); ?> clearfix">
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
					<?php if($info_state == 'list'): ?><div class="news">
	<?php if(is_array($infos)): foreach($infos as $key=>$v): ?><div class="item">
		<h2><span></span><a href="javascript:"><?php echo (msubstr($v["title"],0,60)); ?></a> <em><?php echo (date("m-d",strtotime($v["create_time"]))); ?></em></h2>
		<div class="hotNews clearfix">
			<div class="pic"><a href="<?php echo ($v["url"]); ?>"><img src="<?php echo ($v["pic"]); ?>" width="146" height="100" /></a></div>
			<dl>
				<dd class="info"><?php echo (msubstr(strip_tags($v["content"]),0,60)); ?></dd>
				<dd class="more"><a href="<?php echo ($v["url"]); ?>">阅读全文&gt;&gt;</a></dd>
			</dl>
		</div>
	</div><?php endforeach; endif; ?>
</div>
<script type="text/javascript">
$(function(){
	$(".news .item").eq(0).addClass("on");
	$(".news .item h2").click(function(){
		$(".news .item").removeClass("on");
		var $parent=$(this).parent(".item").addClass("on");
	});
})
</script>
						<div class="page">
	<a href="<?php echo ($page_config["prev"]); ?>"><img src="__PUBLIC__/images/ico_07.gif" width="29" height="27"></a>
	<?php if(is_array($page_config['page'])): $i = 0; $__LIST__ = $page_config['page'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo ($v["url"]); ?>" <?php if($v['label'] == $page_config['page_id']): ?>class="current"<?php endif; ?>><?php echo ($v["label"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
	<a href="<?php echo ($page_config["next"]); ?>"><img src="__PUBLIC__/images/ico_08.gif" width="29" height="27"></a>
</div>
					<?php elseif($info_state == 'pic'): ?>
						<div class="products clearfix">
	<?php if(is_array($infos)): $i = 0; $__LIST__ = $infos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="item">
		<div class="txt"><a href="<?php echo ($v["url"]); ?>"><?php echo ($v["title"]); ?></a></div>
		<div class="pic"><a href="<?php echo ($v["url"]); ?>"><img src="<?php echo ($v["pic"]); ?>" width="164" height="240"></a></div>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
						<div class="page">
	<a href="<?php echo ($page_config["prev"]); ?>"><img src="__PUBLIC__/images/ico_07.gif" width="29" height="27"></a>
	<?php if(is_array($page_config['page'])): $i = 0; $__LIST__ = $page_config['page'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo ($v["url"]); ?>" <?php if($v['label'] == $page_config['page_id']): ?>class="current"<?php endif; ?>><?php echo ($v["label"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
	<a href="<?php echo ($page_config["next"]); ?>"><img src="__PUBLIC__/images/ico_08.gif" width="29" height="27"></a>
</div>
					<?php elseif($info_state == 'content'): ?>
						<div class="article">
	<div class="bd">
		<?php echo ($infos[0]["content"]); ?>
	</div>
</div><?php endif; ?>
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