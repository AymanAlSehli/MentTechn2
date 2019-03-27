     <div class="sectionleft lft col-md-3">
        <div class="panel panel-default" style='border-radius:0px;'>
          <div class="panel-heading" style='font-family:JF Flat regular;font-size:17px;font-weight:bold;'><span class="lft glyphicon glyphicon-heart" style='color:#8E44AD;'></span> قد تعجبك </div>
          <?php 
            $stmt = $DB_con->prepare("SELECT * FROM `post` ORDER BY veiws DESC LIMIT 15");
            $stmt->execute();   

            foreach ($stmt->fetchAll() as $row) {
            $title = mb_substr($row['title'], 0, 60, 'UTF-8');    
            echo'
              <div class="panel-body">
                <div class="media">
                  <div class="media-left media-middle">

                    ';
                    if($row['type'] == 1){
                    echo'
                    <a href="post.php?id='.$row['id'].'">
                      <img class="fade media-object" src="imagespost/'.$row['image'].'" style="width:64px;height:64px;">
                    </a>
                    ';    
                    }else{
                    echo'
                    <a href="review.php?id='.$row['id'].'">
                      <img class="fade media-object" src="imagespost/'.$row['image'].'" style="width:64px;height:64px;">
                    </a>
                    '; 
                    }
                    echo'
                  </div>
                  <div class="media-body">
                    <h5 class="media-heading">
                    ';
                    if($row['type'] == 1){
                    echo'<a href="post.php?id='.$row['id'].'">'.$title.'</a>';    
                    }else{
                    echo'<a href="review.php?id='.$row['id'].'">'.$title.'</a>'; 
                    }
                    echo'                    
                    </h5>
                    <span class="rgt" style="margin-top:8px;">
                        <img src="images/Fire_alarm-128.png" style="width:20px;"/> '.$row['veiws'].'</span>
                    <span class="lft" style="margin-top:8px;">
                        <img src="images/21-20.png" style="width:20px;"/></span>
                  </div>
                </div>  
              </div>
            ';    
            }
          ?>     


        </div>
         
      </div>
    