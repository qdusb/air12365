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
			<h2 class="logo"><a href="default.html">信望餐饮</a></h2>
			<div class="nav">
				<ul class="navs clearfix">
					<?php if(is_array($navs)): foreach($navs as $key=>$v): ?><li class="<?php echo ($v["class"]); ?>">
						<a href="<?php echo ($v["url"]); ?>" <?php if($v['id'] == $id_configs['base_id']): ?>class="current"<?php endif; ?> ><?php echo ($v["name"]); ?></a>
					</li><?php endforeach; endif; ?>
				</ul>
			</div>
		</div>
	</div>

<script src="__PUBLIC__/js/jquery.SuperSlide.2.1.1.js"></script>
	<div class="container">
		<div class="wrap">
			<div class="sm">
				<div class="smt">
					<p>
						<a href="javascript:history.back(-1)" class="o">返回</a>
						<?php if(is_array($third_nav)): foreach($third_nav as $key=>$v): ?><a href="<?php echo U('Info/show',array('class_id'=>$v['id']));?>" <?php if($id_configs['class_id'] == $v['id']): ?>class="current"<?php endif; ?>><?php echo ($v["name"]); ?></a><?php endforeach; endif; ?>
					</p>
				</div>
				<div class="smb">
					<h2><?php echo ($id_configs["second_name"]); ?></h2>
					<div class="preview clearfix">
						<div class="bigImg">
							<ul>
								<?php if(is_array($infos)): foreach($infos as $key=>$v): ?><li><img src="<?php echo ($v["pic"]); ?>" width="710" height="483" /><span><?php echo ($v["title"]); ?></span></li><?php endforeach; endif; ?>
							</ul>
						</div>
						<div class="smallScroll">
							<div class="smallImg">
								<ul>
									<?php if(is_array($infos)): foreach($infos as $key=>$v): ?><li class="on"><img src="<?php echo ($v["pic"]); ?>" width="184" height="123" /><i></i></li><?php endforeach; endif; ?>
								</ul>
							</div><a class="sPrev" href="javascript:void(0)">←</a><a class="sNext" href="javascript:void(0)">→</a>
						</div>
					</div>
					<script>
						jQuery(".preview").slide({ titCell:".smallImg li", mainCell:".bigImg ul", effect:"fold",delayTime:200});
						jQuery(".preview .smallScroll").slide({ mainCell:"ul",delayTime:100,vis:3,effect:"top",prevCell:".sPrev",nextCell:".sNext",pnLoop:false });
					</script>
				</div>
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