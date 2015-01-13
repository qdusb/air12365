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
			<div class="bg-about clearfix">
				<div class="location clearfix">
	<h2><?php echo ($id_configs["class_name"]); ?></h2>
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
					<div class="article">
						<div class="hd">
							<h1><?php echo ($data["title"]); ?></h1>
							<p class="titBar">发布时间：<?php echo (date("Y-m-ddH:i:s",strtotime($data["create_time"]))); ?> 来源：<?php echo ($data["source"]); ?>  分享：</p>
						</div>
						<div class="bd">
							<?php echo ($data["content"]); ?>
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