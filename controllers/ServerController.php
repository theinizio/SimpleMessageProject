<?php




class ServerController
{

		
		public function actionSaveMessage()
		{
			if (isset($_GET['message_text'])&&$_GET['message_text']!='') {
				$_GET['message_text']=trim($_GET['message_text']);
				$_GET['message_text']=htmlspecialchars($_GET['message_text']);
				
				
				$db=Db::getConnection();
				$author_id=intval($_GET['author_id']);
				$date=new DateTime();
				$date=$date->format('Y-m-d H:i:s');
						$query="INSERT INTO `smp_messages`(`author_id`, `message_text`, `last_edited`) VALUES (? ,? ,?)";
						$prepared = $db->prepare($query);
						$prepared->execute(array($author_id, $_GET['message_text'], $date));
						header('Location: /smp');
						die();
			}
			else die("error");
			
		}
		
		
		
		public function actionEditMessage()
		{
			if (isset($_GET['message_text'])) {
				$_GET['message_text']=trim($_GET['message_text']);
				$_GET['message_text']=htmlspecialchars($_GET['message_text']);
				
				
				$db=Db::getConnection();
				
				$date=new DateTime();
				$date=$date->format('Y-m-d H:i:s');
						$query="UPDATE `smp_messages` SET `message_text`=?,`last_edited`=? WHERE `id`=?";
						$prepared = $db->prepare($query);
						$prepared->execute(array($_GET['message_text'], $date, $_GET['message_id'] ));
						header('Location: /smp');
						die();
			}
			else die("error ");
			
		}
		
		
		
		public function actionDeleteMessage()
		{
			if (isset($_GET['message_id'])) {
				
				$db=Db::getConnection();
				$mId = intval($_GET['message_id']);
				$query="DELETE FROM `smp_messages` WHERE `id`=?";
						$prepared = $db->prepare($query);
						$prepared->execute(array($mId ));
						header('Location: /smp');
						die();
			}
			else die("error");
			
		}
		
		
		
		public function actionDeleteComment()
		{
			if (isset($_GET['comment_id'])) {
				
				$db=Db::getConnection();
				$mId = intval($_GET['comment_id']);
				$query="DELETE FROM `smp_comments` WHERE `id`=?";
						$prepared = $db->prepare($query);
						$prepared->execute(array($mId ));
						header('Location: /smp');
						die();
			}
			else die("error");
			
		}
		
		
		public function actionSaveComment()
		{
			if (isset($_GET['comment_text'])&&$_GET['comment_text']!='') {
				$_GET['comment_text']=trim($_GET['comment_text']);
				$_GET['comment_text']=htmlspecialchars($_GET['comment_text']);
				
				
				$db=Db::getConnection();
				$author_id=1;
				$date=new DateTime();
				$date=$date->format('Y-m-d H:i:s');
						$query="INSERT INTO `smp_comments`(`message_id`, `parent_id`, `author_id`, `text`, `last_edited`) VALUES (?, ?, ? ,? ,?)";
						$prepared = $db->prepare($query);
						$prepared->execute(array($_GET['message_id'], $_GET['parent_id'], $_GET['author_id'], $_GET['comment_text'], $date));
						header('Location: /smp');
						die();
			}
			else die("error");
			
		}
		
		
		
		public function actionEditComment()
		{
			if (isset($_GET['comment_text'])) {
				$_GET['comment_text']=trim($_GET['comment_text']);
				$_GET['comment_text']=htmlspecialchars($_GET['comment_text']);
				
				
				$db=Db::getConnection();
				
				$date=new DateTime();
				$date=$date->format('Y-m-d H:i:s');
						$query="UPDATE `smp_comments` SET `text`=?,`last_edited`=? WHERE `id`=?";
						//var_dump($query);
						$prepared = $db->prepare($query);
						$prepared->execute(array($_GET['comment_text'], $date, $_GET['comment_id'] ));
						header('Location: /smp');
						die();
			}
			else die("error");
			
		}
		
		

}
