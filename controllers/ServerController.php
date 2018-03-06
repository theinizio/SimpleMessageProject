<?php




class ServerController
{

		
		public function actionCompose()
		{
			if (isset($_GET['message_text'])) {
				$_GET['message_text']=trim($_GET['message_text']);
				$_GET['message_text']=htmlspecialchars($_GET['message_text']);
				
				
				$db=Db::getConnection();
				$author_id=1;
				$date=new DateTime();
				$date=$date->format('Y-m-d H:i:s');
						$query="INSERT INTO `smp_messages`(`author_id`, `message_text`, `last_edited`) VALUES (? ,? ,?)";
						$prepared = $db->prepare($query);
						$prepared->execute(array($author_id, $_GET['message_text'], $date));
						header('Location: /message');
						die();
			}
			else die("error");
			
		}
		

}
