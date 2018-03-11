<?php




class LoginController
{

		
		public function actionLogin(){
			require_once(ROOT . '/views/login.php');
	
			return true;
		}
		
		public function actionLogout(){
	
			$GLOBALS['logout']=true;
			require_once(ROOT . '/components/User.php');
			User::logout();
			header("Location: /smp");
			exit;
			return true;
		}
		
		
		public function actionGoogle(){
			include "login_with_google.php";
	
	
			if($success){
				//print_r($user);
				
				$db=Db::getConnection();
				$result = $db->query('SELECT `userid` FROM smp_users WHERE `key` = ' .$user->id);
				$user_id=$result->fetch(PDO::FETCH_ASSOC);
					
				$sql="REPLACE INTO `smp_users`(`userid`, `username`, `display_name`, `email`, `key`) VALUES (?, ?, ?, ?, ?);";
				$prepared = $db->prepare($sql);
				$prepared->execute(array($user_id['userid'],
										 $user->name, 
										 $user->given_name.' '.$user->family_name,
										 $user->email,
										 $user->id
										)
								   );
				$lastId = $db->lastInsertId();				   
					//var_dump($lastId);
			
				
				setcookie("user", $user->name, time() + 3600 * 24 * 30); 
				setcookie("key",  $user->id,   time() + 3600 * 24 * 30);
				
				
				$_SESSION['user'] = $lastId;
				$GLOBALS['user']=new User(Db::getConnection());
				header("Location: /smp");
				exit;
				
			}else{
				echo HtmlSpecialChars($client->error);
				header("Location: /smp/login");
				exit;
			}
			
	
			return true;
		}
		
		
		
		public function actionFacebook(){
			include "login_with_facebook.php";
		
			if($success){
		
				
				$db=Db::getConnection();
				$result = $db->query('SELECT `userid` FROM smp_users WHERE `key` = ' .$user->id);
				$user_id=$result->fetch(PDO::FETCH_ASSOC);
				
				$sql="REPLACE INTO `smp_users`(`userid`, `username`, `display_name`, `email`, `key`) VALUES (?, ?, ?, ?, ?);";
				$prepared = $db->prepare($sql);
				$prepared->execute(array($user_id['userid'],
										 $user->name, 
										 $user->first_name.' '.$user->last_name,
										 $user->email,
										 $user->id
										)
								   );
				$lastId = $db->lastInsertId();				   
					//var_dump($lastId);
			
				
				setcookie("user", $user->name, time() + 3600 * 24 * 30); 
				setcookie("key",  $user->id,   time() + 3600 * 24 * 30);
				
				
				$_SESSION['user'] = $lastId;
				$GLOBALS['user']=new User(Db::getConnection());
				header("Location: /smp");
				exit;
				
			}else{
				echo HtmlSpecialChars($client->error);
				header("Location: /smp/login");
				exit;
				
			}
	
			return true;
		}
		
		
		public function actionVk(){
			require_once("login_with_vk.php");
			if($success){
		
				print_r($user);/*
				$db=Db::getConnection();
				$sql="REPLACE INTO `smp_users`( `username`, `display_name`, `email`, `key`) VALUES (?, ?, ?, ?);";
				$prepared = $db->prepare($sql);
				$prepared->execute(array($user->name, 
										 $user->first_name.' '.$user->last_name,
										 $user->email,
										 $user->id
										)
								   );
				$lastId = $db->lastInsertId();				   
					//var_dump($lastId);
			
				
				setcookie("user", $user->name, time() + 3600 * 24 * 30); 
				setcookie("key",  $user->id,   time() + 3600 * 24 * 30);
				
				
				$_SESSION['user'] = $lastId;
				$GLOBALS['user']=new User(Db::getConnection());
				header("Location: /smp");
				exit;
				*/
			}else{
				echo HtmlSpecialChars($client->error);
				header("Location: /smp/login");
				exit;
				
			}
			return true;
		}
}
