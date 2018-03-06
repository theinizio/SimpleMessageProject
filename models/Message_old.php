<?php


class Message
{
	private static function has_parent($id){
		$start = microtime(true);
		$id=intval($id);
		if($id){
			$db = Db::getConnection();
			$result = $db->query('SELECT count(`id`) FROM smp_messages WHERE parent_id=' . $id);
			$parents=$result->fetch(PDO::FETCH_ASSOC);
			return intval($parents["count(`id`)"]);
		}else return false;
		
		echo 'has_parent '.(microtime(true)-$start);
	}

	private static function build_tree($cats,$parent_id,$only_parent = false){
		
		
	    if(is_array($cats) and isset($cats[$parent_id])){
	        $tree = '<ul>';
	        if($only_parent==false){
	            foreach($cats[$parent_id] as $cat){
					$date=explode(" ", $cat['last_edited']);
					$tree .= '<li>';
					if(intval($cat['parent_id']) <>0){
						$tree .= '<img src="/template/images/page.png">&nbsp;';
					}else{
						
						if(self::has_parent($cat['id'])){
							$tree .= '<img src="/template/images/arrow_down.png">&nbsp;';}
							else {$tree .= '<img src="/template/images/arrow_right.png">&nbsp;';	}
						}
	                $tree.='('.$date[1].') '.$cat['message_text'];
	                $tree .=  self::build_tree($cats,$cat['id']);
	                $tree .= "</li>\n";
	            }
	        }elseif(is_numeric($only_parent)){
	            $cat = $cats[$parent_id][$only_parent];
	            $date=explode(" ", $cat['last_edited']);
	            $tree .= '<li>('.$date[1].') '.$cat['message_text'];
	            $tree .=  self::build_tree($cats,$cat['id']);
	            $tree .= "</li>\n";
	        }
	        $tree .= '</ul>';
	    }
	    else return null;
	    return $tree;
	}






	/** Returns single news items with specified id
	* @rapam integer &id
	*/
	public static function getMessageItemByID($id){
		
		$id = intval($id);

		if ($id) {
/*			$host = 'localhost';
			$dbname = 'php_base';
			$user = 'root';
			$password = '';
			$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);*/
			$db = Db::getConnection();
			$result = $db->query('SELECT * FROM smp_messages WHERE id=' . $id);

			/*$result->setFetchMode(PDO::FETCH_NUM);*/
			$result->setFetchMode(PDO::FETCH_ASSOC);

			$newsItem = $result->fetch();
			$author_result=$db->query('SELECT `display_name` FROM bkc_mls_users WHERE `userid`='.$newsItem['author_id']);
			if($author_result)$author_name = $author_result->fetch(PDO::FETCH_ASSOC); else $author_name['display_name'] = 'unknown';
			$newsItem['author_name'] = $author_name['display_name'];
				
				
			return $newsItem;
		}

	}
	
	private static function find_parent($tmp, $cur_id){
	    if($tmp[$cur_id][0]['parent_id']!=0){
	        return find_parent($tmp,$tmp[$cur_id][0]['parent_id']);
	    }
	    return (int)$tmp[$cur_id][0]['id'];
	}
	
	

	/**
	* Returns an array of news items
	*/
	public static function getMessageList() {
/*		$host = 'localhost';
		$dbname = 'php_base';
		$user = 'root';
		$password = '';
		$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);*/

		$db = Db::getConnection();
		$messageList = array();

		$result = $db->query('SELECT * FROM `smp_messages` ;');
		
			
		$i = 0;
		//var_dump($result);
			
			if($result)while($row = $result->fetch(PDO::FETCH_ASSOC)) {
				$messageList[$i]['id'] = $row['id'];
				$messageList[$i]['parent_id'] = $row['parent_id'];
				$messageList[$i]['date'] = $row['timestamp'];
				$author_result=$db->query('SELECT `display_name` FROM bkc_mls_users WHERE `userid`='.$row['author_id']);
				if($author_result)$author_name = $author_result->fetch(PDO::FETCH_ASSOC); else $author_name['display_name'] = 'unknown';
				$messageList[$i]['author_name'] = $author_name['display_name'];
				$messageList[$i]['message'] = $row['message_text'];
				$i++;
			}
		//var_dump($messageList);

		return $messageList;
	
	}
	
	public static function getMessageTree(){
		//Выбираем данные из БД
		$db = Db::getConnection();
		$messageList = array();

		$result = $db->query('SELECT * FROM `smp_messages` order by `last_edited` desc ');
		
		
		//В цикле формируем массив, ключом будет id родительского комментария, а также массив разделов, ключом будет id комментария
		if($result)while($messages = $result->fetch(PDO::FETCH_ASSOC)) {
			$result2 = $db->query('SELECT * FROM `smp_comments` order by `last_edited` asc; ');
			if($result2)while($messages = $result->fetch(PDO::FETCH_ASSOC)) {
			}
	        //$cats_ID[$cat['id']][] = $cat;
	        $cats[$cat['parent_id']][$cat['id']] =  $cat;
	        
	        
	    }
	    
	    
	    
		
		return self::build_tree($cats,0);
	}
	
	

}
