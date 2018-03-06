<?php

include_once ROOT. '/models/Message.php';


class MessageController
{

		
		public function actionIndex()
		{
			
			$mesageList = array();
			$mes=new Message();
			$messageList = $mes->getMessageTree();
			
			require_once(ROOT . '/views/message/index.php');
	
			return true;
		}

		public function actionView($id)
		{
			if ($id) {
				$messageItem = Message::getMessageItemByID($id);
	
				require_once(ROOT . '/views/message/view.php');
	
			}
	
			return true;
	
		}
	
		


}
