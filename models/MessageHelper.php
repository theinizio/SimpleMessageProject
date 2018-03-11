<?php

class MessageHelper{
	
	public static function getCommentForm($message_id, $parent_id, $author_id){
		return "<form method=GET action=\"/smp/server/savecomment\" id=form_comment$message_id class=form_comment>
					<input type=hidden name=message_id value=$message_id>
					<input type=hidden name=parent_id value=$parent_id>
					<input type=hidden name=author_id value=$author_id>
					<textarea name=comment_text placeholder='Добавьте ответ' class=comment_textarea rows=1></textarea>
					<input type=submit value=\"Отправить\">
					<input type=reset value=\"Отмена\" onclick=\"hideCommentInput($message_id)\">							
				</form>";
	}
	
	public static function getComment2CommentForm($message_id, $comment_id, $parent_id, $author_id){
		return "<form method=GET action=\"/smp/server/savecomment\" id=form_comment_2_comment$comment_id class=form_comment>
					<input type=hidden name=message_id value=$message_id>
					<input type=hidden name=parent_id value=$parent_id>
					<input type=hidden name=author_id value=$author_id>
					<textarea name=comment_text placeholder='Добавьте ответ' class=comment_textarea rows=1></textarea>
					<input type=submit value=\"Отправить\">
					<input type=reset value=\"Отмена\" onclick=\"hideComment2CommentInput($comment_id)\">							
				</form>";
	}
	
	
	
	public static function getEditMessageForm($message_id, $parent_id, $author_id, $text){
		return "<form method=GET action=\"/smp/server/editmessage\" id=form_edit_message$message_id class=form_edit_message>
					<input type=hidden name=message_id value=$message_id>
					
					<textarea name=message_text  class=comment_textarea rows=1>$text</textarea>
					<input type=submit value=\"Отправить\">
					<input type=reset value=\"Отмена\" onclick=\"hideEditMeaage($message_id)\">							
				</form>";
	}
	
	
	public static function getEditCommentForm($comment_id, $text){
		return "<form method=GET action=\"/smp/server/editcomment\" id=form_edit_comment$comment_id class=form_edit_comment>
					<input type=hidden name=comment_id value=$comment_id>
					<textarea name=comment_text  class=comment_textarea rows=1>$text</textarea>
					<input type=submit value=\"Отправить\">
					<input type=reset value=\"Отмена\" onclick=\"hideEditComment($comment_id)\">							
				</form>";
	}
	
	
	
	
	public static function humanDate($date){
	$years   = date_create()->diff(date_create($date))->y;	
	$months  = date_create()->diff(date_create($date))->m;	
	$weeks   = intval(date_create()->diff(date_create($date))->d / 7);	
	$days    = date_create()->diff(date_create($date))->d;	
	$hours   = date_create()->diff(date_create($date))->h;	
	$minutes = date_create()->diff(date_create($date))->i;
	$result = '';
	
	if($years > 0) switch ($years){
		case 1:  $result = 'год назад'; break;
		case 2:
		case 3:
		case 4:  $result = $years.' года назад'; break;
		default: $result = $years.' лет назад'; break;
	}else
	if($months > 0) switch ($months){
		case 1:  $result = 'месяц назад'; break;
		case 2:
		case 3:
		case 4:  $result = $months.' месяца назад'; break;
		default: $result = $months.' месяцев назад'; break;
	}else
	if($weeks > 0) switch ($weeks){
		case 1:  $result = 'неделю назад'; break;
		case 2:
		case 3:
		case 4:  $result = $weeks.' недели назад'; break;
		default: $result = $weeks.' недель назад'; break;
	}else
	if($days > 0) switch ($days){
		case 1:  $result = 'день назад'; break;
		case 2:
		case 3:
		case 4:  $result = $days.' дня назад'; break;
		default: $result = $days.' дней назад'; break;
	}else
	if($hours > 0) switch ($hours){
		case 1:  $result = 'час назад'; break;
		case 2:
		case 3:
		case 4:  $result = $hours.' часа назад'; break;
		default: $result = $hours.' часов назад'; break;
	}else
	if($minutes > 0) switch ($minutes){
		case 1:  $result = 'минуту назад'; break;
		case 2:
		case 3:
		case 4:  $result = $minutes.' минуты назад'; break;
		default: $result = $minutes.' минут назад'; break;
	}else
		$result = 'менее минуты назад';
	
	return $result;
	
}
	
}
