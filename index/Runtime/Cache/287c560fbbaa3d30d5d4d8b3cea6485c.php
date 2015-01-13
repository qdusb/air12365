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
			<div class="bg-join clearfix">
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
					<div class="ja clearfix">
						<p class="fl"><img src="__PUBLIC__/images/p313x215.jpg" width="313" height="215"></p>
						<div class="fr">
							<h4>如果你有项目需要加盟,欢迎您随时联系我们!</h4>
							<p>我们将提供：</p>
							<p>·专业人员支持,24小时提供专业系统的产品介绍及处理相关问题,</p> 
							<p>·丰富多样的产品, 每季度至少发布一个系列的新品，</p>
							<p>如果您想成为我们在当地的加盟商,请您现在就联系我们,我们将会给您提供的合作价格。</p>
							<p>我们相信双方本着互相合作、双赢发展的共同目标而努力，就一定能够一起做大做强。</p>
						</div>
					</div>
					<p class="jb">欢迎您查阅巴黎咖啡服务平台，您可以在本栏目在线咨询各式关于巴黎咖啡的各式疑问，提交问题后请持续关注本栏目，以便及时获得我们的答复！感谢您的支持！</p>
					<form action="" name="join_form" method="post" class="jf">
						<div class="jfu clearfix">
							<ul>
								<li class="jfun">姓名</li>
								<li><input type="text" name="name" class="text" /></li>
								<li class="jfun">电话</li>
								<li><input type="text" name="phone" class="text" /></li>
							</ul>
						</div>
						<div class="jfu clearfix">
							<ul>
								<li class="jfun">内容</li>
								<li><textarea class="textarea" name="content"></textarea></li>
							</ul>
						</div>
						<div class="jfus clearfix">
							<ul>
								<li><input type="button" class="submit" value="确认" /><input type="reset" class="reset" value="重置" /></li>
							</ul>
						</div>
					</form>
					<script type="text/javascript">
					var url="<?php echo U('Advanced/submitJoin');?>";
					$(function(){
						$(".submit").click(function(){
							var name=$("input[name='name']").val();
							var phone=$("input[name='phone']").val();
							var content=$("textarea[name='content']").val();

							if(name==""||content==""){
								alert("留言人和留言内容不能为空");
								return;
							}
							else{
								var data={"name":name,"phone":phone,"content":content};
								$.ajax({type:'POST',url:url,data:data,success:function (data,textStatus){
										var obj=eval("("+data+")");
										if(obj.returnInfo=="ok"){
											alert("留言成功，我们将尽快予以查看,谢谢！");
											document.join_form.reset();
										}else{
											alert(obj.returnInfo);
										}

										this;}});
							}
						});
					});
					</script>
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