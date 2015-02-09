<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>
<meta content="<?php echo ($config_keyword); ?>" name="keywords">
<meta content="<?php echo ($config_description); ?>" name="description">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/images/Kd_Common.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/images/<?php echo ($css_file); ?>">
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.SuperSlide.2.1.js"></script>
</head>
<body>
<div class="header">
	<div class="wrap clearfix">
		<h1 class="logo"><a href="<?php echo U('Index/index');?>"><img src="__PUBLIC__/images/logo.jpg" width="273" height="89" /></a></h1>
		<div class="nav">
			<ul class="navs clearfix">
				<?php if(is_array($navs)): foreach($navs as $key=>$v): ?><li class="<?php echo ($v["class"]); ?>">
					<a href="<?php echo ($v["url"]); ?>" <?php if($v['id'] == $id_configs['base_id']): ?>class="current"<?php endif; ?> ><?php echo ($v["name"]); ?></a>
				</li><?php endforeach; endif; ?>
			</ul>
		</div>
		<p class="topTel">客服电话：<em>0551-65151513</em></p>
	</div>
	<?php if($css_file == 'Kd_Default.css'): ?><div class="banner">
		<div class="bd">
			<ul>
                <?php if(is_array($banners)): foreach($banners as $key=>$v): ?><li style="background:url(<?php echo C('UPLOAD_PATH'); echo ($v["pic"]); ?>) no-repeat center top"><a href=""></a></li><?php endforeach; endif; ?>
			</ul>
		</div>
		<div class="hd"><ul></ul></div>
	</div><?php endif; ?>
</div>


<div class="container">
	<div class="wrap clearfix">
		<div class="sidebar">
	<h2 class="colPicTitle"><?php echo ($id_configs['base_name']); ?><em><?php echo ($id_configs['base_en_name']); ?></em></h2>
	<div class="menu">
		<dl>
			<?php if(is_array($seconds)): $i = 0; $__LIST__ = $seconds;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><dt><a href="<?php echo ($v["second"]["url"]); ?>" <?php if($v['second']['id'] == $id_configs['second_id']): ?>class="current"<?php endif; ?>><?php echo ($v["second"]["name"]); ?></a></dt><?php endforeach; endif; else: echo "" ;endif; ?>
		</dl>
	</div>
</div>
		
		<div class="main">
			<div class="article">
			<?php echo ($infos[0]["content"]); ?>
			</div>
		</div>
	</div>
	<p class="wrapBt"></p>
</div>
<div class="footer">
	<div class="wrap clearfix">
		<div class="copyright">
			<?php echo C("CONFIG_CONTACT");?>
		</div>
	</div>
</div>
<?php echo C('CONFIG_AD');?>
<?php echo C('CONFIG_JAVASCRIPT');?>
</body>
</html>