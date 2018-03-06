
<!DOCTYPE html>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


<title>List Example</title>

<!-- CSS -->
<link href="/template/css/main.css" type="text/css" rel="stylesheet">


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

</head>
<body>
<div id="page" style="padding-top:40px;">
	<div id="compose_form" style="vertical-align:middle;">
		<form id="form" method="GET" action="/server/compose">
			<textarea name="message_text" id="sms"placeholder="Ваше сообщение..." style="width:50%;"></textarea>
			<input type="submit" value="Отправить">
		</form>
	</div>
	<div class="post">
		<?php echo $messageList; ?>
	</div>
    
    <div id="footer_guarantor"></div>
</div>
<div id="footer" class="text-align-c">
</div>

</body></html>
