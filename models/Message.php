<?php 

include "MessageHelper.php";


class Message{

	private  $db = "";
	private  $user = "";

	public function __construct(){
	
		$this->db=Db::getConnection();
		
		$this->user = 0;
		if(isset($_SESSION['user'])) 
			$this->user = $_SESSION['user'];
		
	}
	
	
	public  function getMessageTree(){
	
		$out='<ul>';
		
		
		$q2='SELECT T1.*, T2.username FROM smp_messages AS T1 INNER JOIN smp_users AS T2 ON T1.author_id=T2.userid order by `last_edited` desc';
		
		$result = $this->db->query($q2);
		
		if($result)while($messages = $result->fetch(PDO::FETCH_ASSOC)) {
					$mId = $messages['id'];
					$has_parent = self::has_parent($mId);
					$text = htmlspecialchars($messages['message_text']);
					
					if($has_parent){
							$img = '<img class=img_arrow  onclick=showCommentWrapper('.$mId.') src="/smp/template/images/arrow_right.png" id=message_img'.$mId.'>&nbsp;';}
							else 
							{$img = '<img class=img_arrow src="/smp/template/images/arrow_right.png" id=message_img'.$mId.'>&nbsp;';	}
							
							
					$reply_link ='<a href=# id="showForm'.$mId.'" class="showForm" 
						onclick="showCommentInput('.$mId.')" style="border:0;">Ответить </a> ';		
							
					$edit_link ='<a href=# id="showEditForm'.$mId.'" class="showEditForm" 
						onclick="showEditMessage('.$mId.')" style="border:0;">Редактировать </a> 
						<form action=/smp/server/deletemessage style="display:inline;">
							<input type=hidden name=message_id value='.$mId.'>
							<input type=submit value=Удалить class=delete_button>
						</form>';			
					
							
					$date = MessageHelper::humanDate($messages['last_edited']);		
							
					$out .= '<li>';
					$out .= '<div class=message_wrapper >';
					$out .= '<div class=message_header>';
					$out .= $img; 	
						
	                $out .= '<span>'.$messages['username'].'</span>  <span>  ('.$date.')</span></div> ';
	                $out .= '<div class=message_main><span>'.$text.'</span></div>';
	                
	                $out .= MessageHelper::getCommentForm($mId, 0, $this->user);
	                $out .= MessageHelper::getEditMessageForm($mId, 0, $this->user, $text);
	                $out .= '<div class=comments_header>';
	                
	                
	                
						
					if($this->user != 0)
						$out .= $reply_link;
					
					if($this->user == 	$messages['author_id'])
						$out .= $edit_link;
						
						
						
	                if($has_parent){
						
						$out .= ' <a href=# id="showComments'.$mId.'" class="showComments" 
								onclick="showCommentWrapper('.$mId.')"> Показать ответы</a></div>';
								
								
						$out .= '<div class=comments_wrapper id=comments_wrapper'.$mId.'>';
						$out .=  self::getComments($mId, 0, 0);
						$out .= '</div>';
						
						$out .= '<div class=comments_footer>
									<a href=# id="hideComments'.$mId.'" class="hideComments" 
								onclick="hideCommentWrapper('.$mId.')">Скрыть ответы</a>';
					}
	                $out .= '</div>';
	                
					
	                $out .= "\n</div><!--message_wrapper--></li>\n";
			
		}
		$out.="</ul>\n";
	
		return $out;
		
		return "";
	}


	private  function getComments($message_id, $parent_id, $lvl) { 
		
		$tree="<ul>\n";
		global $link; 
		global $lvl; 
		$lvl++; 
		
		
		$q_message="SELECT T1.*, T2.username FROM smp_comments AS T1 
					INNER JOIN smp_users AS T2 
					ON T1.author_id=T2.userid 
					WHERE `parent_id` = ".$parent_id. " AND `message_id` = ".$message_id."
					order by `last_edited` asc";
					
		
		$result=$this->db->query($q_message);
		
			if($result) while( $comment = $result->fetch(PDO::FETCH_ASSOC) ) {
				
				$commentId = $comment['id'];
				$date = MessageHelper::humanDate($comment['last_edited']);
				
				$text = htmlspecialchars($comment['text']);
				
				$reply_link ='<a href=# id="showCommentForm'.$commentId.'" class="showCommentForm" 
						onclick="show`('.$commentId.')" style="border:0;">Ответить </a> ';		
				
				$edit_link ='<a href=# id="showEditCommentForm'.$commentId.'" class="showEditCommentForm" 
						onclick="showEditComment('.$commentId.')" style="border:0;">Редактировать </a> 
						<form action=/smp/server/deletecomment style="display:inline;">
							<input type=hidden name=comment_id value='.$commentId.'>
							<input type=submit value=Удалить class=delete_button>
						</form>';			
				
				
				$tree .= '<li>
							<div class=comment_wrapper id="'.$commentId.'">
								<img class=comment_image src="/smp/template/images/page.png">
								<div class=comment_header>
									<span class=comments_author>'.$comment['username'].'</span>  
									<span class=comments_date>('.$date.') </span>
								</div>
								<div class=comment_text>
									<span>'.$text.'</span>
								</div>';
				$tree .= MessageHelper::getComment2CommentForm($message_id, $commentId, $commentId, $this->user);
				$tree .= MessageHelper::getEditCommentForm($commentId, $text);
				
				if($this->user != 0)
						$tree .= $reply_link;
						
				if($this->user == 	$comment['author_id'])
						$tree .= $edit_link;		
						
				$tree .='</div>
						  </li>';
								
				$tree .= self::getComments($message_id, $commentId, $lvl); 
				$lvl--;
			}
		$tree .= "</ul>\n";
			
		return $tree;
	}
	
	
	
	private  function has_parent($id){
		
			$id=intval($id);
			
			if($id){			
				$result = $this->db->query('SELECT count(`id`) FROM smp_comments WHERE `message_id` = ' . $id);
				$parents=$result->fetch(PDO::FETCH_ASSOC);
				return intval($parents["count(`id`)"]);
				
			}else 
				return false;
			
	}
	
}
?>
