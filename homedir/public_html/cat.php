<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<?php include 'header.php'; 

 $id = 0; //init
        if(isset($_GET['id']) && (int)$_GET['id'] > 0)
        {
        $id = (int)$_GET['id'];
           
        $getC = $DB_con->prepare("SELECT * FROM `category` WHERE `id`=".$id."");
        $getC->execute(); 
        $getCat = $getC->fetch(PDO::FETCH_OBJ);
            
        $count  = $getC->rowCount();
        if($count == 0){
            echo '<meta http-equiv="refresh" content="0; url=index.php"> ';    
        }
            $current_views = $getCat->veiws;    
            $vizualizari = $current_views+1;
            $sqlv = "UPDATE `category` SET `veiws` = :veiws WHERE id = {$id}";
            $qv = $DB_con->prepare($sqlv);
            $qv->bindParam(':veiws', $vizualizari, PDO::PARAM_STR); 
            $qv->execute();       
        //     
    ?>
<div class="row">
    <div id="sidebar"></div>        
    <div id="footer"></div>
     <div class="desktop-only rgt col-md-2">
        <div class="panel panel-default" style='border-radius:0px;'>
          <div class="panel-heading" style='font-family:JF Flat regular;font-size:17px;font-weight:bold;'><span class="lft glyphicon glyphicon-th-large" style='color:#8E44AD;'></span> آخر المراجعات</div>
            <?php 
            $stmt = $DB_con->prepare("SELECT * FROM `post` ORDER BY id DESC LIMIT 5");
            $stmt->execute();   

            foreach ($stmt->fetchAll() as $row) {
            $title = mb_substr($row['title'], 0, 60, 'UTF-8'); 
            if($row['type'] == 1){
            echo'
              <div class="panel-body">
                <a href="post.php?id='.$row['id'].'"><img class="fade" src="imagespost/'.$row['image'].'" style="width:150px;height:130px;"/></a>
                <p style="line-height:20px;margin-top:5px;"><a href="post.php?id='.$row['id'].'">'.$title.'</a></p>   
              </div>
            ';   
            }else{
            echo'
              <div class="panel-body">
                <a href="review.php?id='.$row['id'].'"><img class="fade" src="imagespost/'.$row['image'].'" style="width:150px;height:130px;"/></a>
                <p style="line-height:20px;margin-top:5px;"><a href="review.php?id='.$row['id'].'">'.$title.'</a></p>   
              </div>
            '; 
         }                  
            }
          ?> 
        </div>        
      </div>
     <div class='rgt col-md-7'>
          <div class="paneltartib panel panel-default">
          <div class="panel-heading" style='height:45px;'>
              
            <div class='rgt'>
            <span class="glyphicon glyphicon-fire" style='font-size:20px;'>
            <span style='font-weight:bold;font-size:20px;font-family:chakirhelve;'><?php echo $getCat->catname; ?></span></div> 
                
            <div class="lft dropdown" style='margin-top:-5px;'>
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="border-radius:0px;">
                الترتيب 
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" style='padding-right:10px;'>
                <a class='rgt' href='cat.php?id=<?php echo $id; ?>&postby=veiws' style='color:#9A12B3;font-size:50px;padding:10px;'><span class="glyphicon glyphicon-fire" aria-hidden="true"></span></a>    
                <a class='rgt' href='cat.php?id=<?php echo $id; ?>&postby=title' style='color:#9A12B3;font-size:50px;padding:10px;'><span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span></a> 
                <a class='rgt' href='cat.php?id=<?php echo $id; ?>&postby=id' style='color:#9A12B3;font-size:50px;padding:10px;'><span class="glyphicon glyphicon-time" aria-hidden="true"></span></a>   
                <a class='rgt' href='cat.php?id=<?php echo $id; ?>&postby=veiws' style='color:#9A12B3;font-size:50px;padding:10px;'><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>                     
              </ul>
            </div>              
 
          </div> 
         </div>         
        <div class="row">
        <?php

            
        if(isset($_SESSION['postby'])){
           $stmt = $DB_con->prepare("SELECT * FROM `post` WHERE `catid`=".$id." ORDER BY ".$_SESSION['postby']." DESC");
           $stmt->execute(); 
        }else{
           $stmt = $DB_con->prepare("SELECT * FROM `post` WHERE `catid`=".$id." ORDER BY `id` DESC");
           $stmt->execute();             
        }    
            
         $count2  = $stmt->rowCount(); 
         if($count2 <= 0){
         echo '<div class="rgt alert alert-info" style="border-radius:0px;width:700px;">لا يوجد أي موضوع حاليا في هذا القسم </div>';    
         }else{
             
         while($rownews = $stmt->fetch(PDO::FETCH_ASSOC)){
                $result[] = $rownews;
            } 
                         
            include 'models/Add.php';
            $pagination = new Pagination();
            $numbers = @$pagination->Paginate($result,10);
            $data    = $pagination->fetchResult();
            
	    foreach ($data as $d){
            $title = trim(strip_tags(htmlspecialchars($d['title'])));
            $cont  = htmlspecialchars(strip_tags($d['content']));    
            $contente = mb_substr($cont, 0, 200, 'UTF-8');
		echo '
                <div class="col-sm-10">
                <img class="fade2" src="imagespost/'.$d['image'].'">
                <div class="div11">
                <div class="div12">
                    <span class="rgt">'.$d['time'].'</span>
                    <div class="clr"></div>';
                    if($d['type'] == 1){
                    echo'<h2 class="mobilefont"><a href="post.php?id='.$d['id'].'" style="text-decoration:none;">'.$title.'</a></h2>';    
                    }else{
                    echo'<h2 class="mobilefont"><a href="review.php?id='.$d['id'].'" style="text-decoration:none;">'.$title.'</a></h2>';
                    }
                    echo'<p>'.$contente.' ..</p>
                    <div class="clr"></div> 
                    <div style="margin-top:30px;">
                    <p class="rgt"><img src="images/book.png"/></p>     
                    <p class="rgt" style="margin-right:10px;"><img src="images/share.png"/></p>     
                    <p class="lft" style="font-size:16px;font-weight:bold;"> <img src="images/Fire_alarm-128.png" width="30"/> '.$d['veiws'].'</p>     
                    </div>
                </div>    
                </div> 
              </div>
              <div class="clr"></div>          
        ';

	} 
      
            

        ?> 
        <div class='clr'></div>
         <?php
        foreach($numbers as $n){
                echo'
                  <div class="lft pagination pagination-small">
                   <ul class="lft" style="margin:1px;">
                    <li><a class="lft btn btn-primary" id="paginactionP" href="cat.php?id='.$id.'&page=' .$n. '" style="border-radius:0px;">'.$n.'</a></li>
                  </ul>
                  </div>

                  ';
                   }
                   }
         ?>
        <div class='clr'></div>      
        </div>
   
        <div class='clr'></div>  
     </div>
     
     <?php include 'leftsidebar.php'; ?>

     <div class='clr'></div>  
     <div id="footer" class='col-md-12'></div>
     <div class='clr'></div>  
     <hr/> 
     <div class='clr'></div>  
    
</div>


    <?php 
    }else{
    echo '<meta http-equiv="refresh" content="0; url=index.php"> ';    
    exit;} 
    include'footer.php';
    ?>
        
        
        
