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

	<div class="container">
		<div class="wrap">
			<div class="bg-join clearfix">
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
					<<div class="message">
					<?php if(is_array($infos)): foreach($infos as $key=>$v): ?><dl class="message-list">
						<dt class="m-title">留言者:<?php echo ($v["name"]); ?></dt>
						<dd class="m-info"><?php echo ($v["content"]); ?></dd>
						<dt class="r-title">回复：</dt>
						<dd class="r-info">
							<p><?php echo ($v["reply"]); ?></p>
						</dd>
					</dl><?php endforeach; endif; ?>
				</div>
				<div class="page">
	<a href="<?php echo ($page_config["prev"]); ?>"><img src="__PUBLIC__/images/ico_07.gif" width="29" height="27"></a>
	<?php if(is_array($page_config['page'])): $i = 0; $__LIST__ = $page_config['page'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo ($v["url"]); ?>" <?php if($v['label'] == $page_config['page_id']): ?>class="current"<?php endif; ?>><?php echo ($v["label"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
	<a href="<?php echo ($page_config["next"]); ?>"><img src="__PUBLIC__/images/ico_08.gif" width="29" height="27"></a>
</div>
				<div class="form-panel">
					<h4>发送留言</h4>
					<h6>请注意：带有 <span>*</span> 的项目必须填写！</h6>
					<div class="tips">留言成功，我们稍后将处理您的留言！</div>
					<form action="" name="form_message" method="post" id="form_message">
						<ul>
							<li class="field">
								<div class="input">
									<label>姓名：</label>
									<input name="name" type="text" size="20" maxlength="50" class="text" /> <span class="red">*</span>
								</div>
							</li>
							<li class="field">
								<div class="input">
									<label>电话：</label>
									<input name="phone" type="text" size="20" maxlength="50" class="text" />
								</div>
							</li>
							<li class="field">
								<div class="input">
									<label>邮箱：</label>
									<input name="email" type="text" size="40" maxlength="50" class="text" />
								</div>
							</li>
							<li class="field">
								<div class="input">
									<label>留言：</label>
									<textarea name="content" cols="60" rows="6" class="textarea"></textarea> <span class="red">*</span>
								</div>
							</li>
							<li class="submit-field">
								<div class="input clearfix">
									<input type="button" value="提交" id="btn-submit" class="btn-submit" />
									<input type="reset" value="重置" class="btn-reset" /></div>
							</li>
						</ul>
					</form>
					<script type="text/javascript">
					var url="<?php echo U('Advanced/submitMessage');?>";
					$(function(){
						$(".btn-submit").click(function(){
							var name=$("input[name='name']").val();
							var phone=$("input[name='phone']").val();
							var email=$("input[name='email']").val();
							var content=$("textarea[name='content']").val();

							if(name==""||content==""){
								alert("留言人和留言内容不能为空");
								return;
							}
							else{
								var data={"name":name,"phone":phone,"email":email,"content":content};
								$.ajax({type:'POST',url:url,data:data,success:function (data,textStatus){
										var obj=eval("("+data+")");
										if(obj.returnInfo=="ok"){
											alert("留言成功，我们将尽快予以查看,谢谢！");
											document.form_message.reset();
										}else{
											alert(obj.returnInfo);
										}

										this;}});
							}
						});
					});
					</script>
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