<?php 


class Message{

private  $db = "";

public function __construct(){

$this->db=Db::getConnection();
}

public  function getMessageTree(){
	
		$out='<ul>';
		
		$result = $this->db->query('SELECT * FROM `smp_messages` order by `last_edited` desc ');
		if($result)while($messages = $result->fetch(PDO::FETCH_ASSOC)) {
					
					$out .= '<li>';
					$date=explode(" ", $messages['last_edited']);
						
						if(self::has_parent($messages['id'])){
							$out .= '<img src="/template/images/arrow_down.png">&nbsp;';}
							else {$out .= '<img src="/template/images/arrow_right.png">&nbsp;';	}
						
	                $out.='('.$date[1].') '.$messages['message_text'];
	                $out .=  self::show_tree($messages['id'], 0, 0);
	                $out .= "</li>\n";
			
		}
		$out.="</ul>\n";
	
		return $out;
}


private  function show_tree($message_id, $parent_id, $lvl) { 
	
	$tree="<UL>\n";
		global $link; 
		global $lvl; 
		$lvl++; 
	
	$sSQL="SELECT * FROM smp_comments WHERE `parent_id` = ".$parent_id. " AND `message_id` = ".$message_id." ORDER BY `timestamp` asc";
	$result=$this->db->query($sSQL);
	
	

		if($result)while ( $comment = $result->fetch(PDO::FETCH_ASSOC) ) {
			
			$ID1 = $comment['id'];
			$date=explode(" ", $comment['timestamp']);
			$tree.=("<li>");
			$tree .= '<p ?ID="'.$ID1.'"><img src="/template/images/page.png">&nbsp;';
			$tree.=('('.$date[1].') '.$comment['text'].'</p>'.'  </li>');
			$tree.=self::show_tree($message_id, $ID1, $lvl); 
			$lvl--;
		}
	$tree.=("</UL>\n");
		
	return $tree;
}

private  function has_parent($id){
	
		$id=intval($id);
		if($id){
			
			$result = $this->db->query('SELECT count(`id`) FROM smp_comments WHERE `message_id` = ' . $id);
			$parents=$result->fetch(PDO::FETCH_ASSOC);
	
			return intval($parents["count(`id`)"]);
			
		}else return false;
		
	}

}


?> 
