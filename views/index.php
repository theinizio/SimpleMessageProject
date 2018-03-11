<?php

include "header.php";
$mes=new Message();
$messageList = $mes->getMessageTree();

?>

<div id="page" style="padding-top:40px;">
	
<?php
//echo $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']);
//var_dump($_SERVER['DOCUMENT_ROOT'],$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
if($user->islg()) { 
	//var_dump($user->data['userid']);
	
?>
<div class=before_post>
	<div class="compose_form" style="vertical-align:middle;">
			<form id="form_compose" method="GET" action="/smp/server/savemessage">
				<input type=hidden name=author_id value=<?php echo $user->data['userid'];?>>
				<textarea name="message_text" id="sms"placeholder="Ваше сообщение..." style="width:50%;"></textarea>
				<input type="submit" value="Отправить">
			</form>
		</div>
	<div class="logout_form" >
			<form id="form_logout" method="GET" action="/smp/login/logout">
				<input type=hidden name=user_id value=<?php echo $user->data['userid'];?>>
				<input type="submit" value="Выйти из системы">
			</form>
	</div>
</div>
<?php

}else{?>
<div class=before_post>
	<div class=login>
		<h2>Для добавления и комментирования сообщений выполните 
		
	         <a href='/smp/login/'>вход</a> 
	    </h2>
	     
	</div>
</div>
<?php   
   }
?>
	
	
	
	<div class="post">
		<?php echo $messageList; ?>
	</div>
    
   
</div><!--page-->
<?php include "footer.php"?>
