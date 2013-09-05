<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>留言板</title>
<link rel="stylesheet" type="text/css" href="static/images/main.css">
</head>

<body>
	<div class="wrap">

		<div class="comment">
			<div class="user">
				<center style="color:white;font-size:28px;">神级留言板</center>
			</div>			
			<form class="com-form" name="commentForm">
				<textarea name="comment" id="msg_con"></textarea>
				<input class="com-sub" type="submit" id="msg_sub" value="添加评论" />
				<p class="com-f"></p>
			</form>
			<div class="com-list">
				<div id="placeholder"></div> 
<?php foreach($list as $one):?>			
<div class="com-li">
<a class="com-li-l" href="javascript:void(0)">
<img src="static/images/user_pic.jpg" width="51" height="51" alt="头像">
</a>
<div class="com-li-r">
<div class="com-li-top">
<span class="c-t-l">
<a data-id="<?=$one['id']?>" class="msg_del"><em>删除</em></a></span>
<span class="c-t-r"><span><?=$one['ut']?></span> 发表</span></div>
<div class="com-text"><p class="toEdit"><?=$one['content']?></p>
<textarea data-id="<?=$one['id']?>" class="editable" style="display:none;margin: 0px; height: 75px; width: 885px;"></textarea>
</div></div></div>				
<?php endforeach; ?>		
			</div>


		</div>
	</div>
	<div class="footer">

	</div>
<script src="./static/sea-modules/seajs/seajs/2.1.1/sea.js"></script>
<script>

  // Set configuration
  seajs.config({
    base: "./static/sea-modules/",
    alias: {
      "jquery": "jquery/jquery/1.10.1/jquery.js"
    }
  });


  // For production
    seajs.use("msg/main");

</script>
<!--<MsgList_widget>mylist</MsgList_Widget>-->
</body>
</html>
