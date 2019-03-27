<?php
	include 'models/dbconfig.php';
	
	extract($_POST);
	$user_ip = $_SERVER['REMOTE_ADDR'];

	// check if the user has already clicked on the unlike (rate = 2) or the like (rate = 1)

        $dislike_sql = $DB_con->prepare('SELECT COUNT(*) FROM wcd_yt_rate WHERE ip = "'.$user_ip.'" and id_item = "'.$pageID.'" and rate = 2 ');
        $dislike_sql->execute();
        $dislike_count = array_shift($dislike_sql->fetch(PDO::FETCH_NUM));

        $like_sql = $DB_con->prepare('SELECT COUNT(*) FROM wcd_yt_rate WHERE ip = "'.$user_ip.'" and id_item = "'.$pageID.'" and rate = 1 ');
        $like_sql->execute();
        $like_count = array_shift($like_sql->fetch(PDO::FETCH_NUM));

	if($act == 'like'): //if the user click on "like"
		if(($like_count == 0) && ($dislike_count == 0)){
            $likee = $DB_con->prepare('INSERT INTO wcd_yt_rate (id_item, ip, rate )VALUES("'.$pageID.'", "'.$user_ip.'", "1")');
            $likee->execute();  
            
		}
		if($dislike_count == 1){
            $likee = $DB_con->prepare('UPDATE wcd_yt_rate SET rate = 1 WHERE id_item = '.$pageID.' and ip ="'.$user_ip.'"');
            $likee->execute();              
		}

	endif;
	if($act == 'dislike'): //if the user click on "like"
		if(($like_count == 0) && ($dislike_count == 0)){
            $dlikee = $DB_con->prepare('INSERT INTO wcd_yt_rate (id_item, ip, rate )VALUES("'.$pageID.'", "'.$user_ip.'", "2")');
            $dlikee->execute();              
		}
		if($like_count == 1){
            $dlikee = $DB_con->prepare('UPDATE wcd_yt_rate SET rate = 2 WHERE id_item = '.$pageID.' and ip ="'.$user_ip.'"');
            $dlikee->execute();              
		}

	endif;
?>