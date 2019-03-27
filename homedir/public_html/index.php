<?php include 'header.php'; ?>
<div class="row">
     <div id="sidebarWrap" class="desktop-only rgt col-md-2">
         
        <div id="sidebar" class="panel panel-default" style='border-radius:0px;'>
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
            <div class="lft dropdown" style='margin-top:-5px;'>
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="border-radius:0px;">
                الترتيب 
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" style='padding-right:10px;'>
                <a class='rgt' href='index.php?postby=veiws' style='color:#9A12B3;font-size:50px;padding:10px;'><span class="glyphicon glyphicon-fire" aria-hidden="true"></span></a>    
                <a class='rgt' href='index.php?postby=title' style='color:#9A12B3;font-size:50px;padding:10px;'><span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span></a> 
                <a class='rgt' href='index.php?postby=id' style='color:#9A12B3;font-size:50px;padding:10px;'><span class="glyphicon glyphicon-time" aria-hidden="true"></span></a>   
                <a class='rgt' href='index.php?postby=veiws' style='color:#9A12B3;font-size:50px;padding:10px;'><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>                     
              </ul>
            </div>              
 
          </div> 
         </div>           
    <div class="row">
  <?php 
        
        if(isset($_SESSION['postby'])){
            $stmt = $DB_con->prepare("SELECT * FROM `post` ORDER BY ".$_SESSION['postby']." DESC");
            $stmt->execute();     
        }else{
            $stmt = $DB_con->prepare("SELECT * FROM `post` ORDER BY id DESC");
            $stmt->execute();               
        }

          
            foreach ($stmt->fetchAll() as $row) {
            $main = $DB_con->prepare("SELECT * FROM `category` WHERE `id`=".$row['catid']."");
            $main->execute(); 
            $infos = $main->fetch(PDO::FETCH_OBJ);             
                
            $title = trim(strip_tags(htmlspecialchars($row['title'])));
            $cont  = htmlspecialchars(strip_tags($row['content']));    
            $contente = mb_substr($cont, 0, 200, 'UTF-8');
                
             echo'
              <div class="col-sm-10">
                <img class="fade2" src="imagespost/'.$row['image'].'">
                <div class="div11">
                <div class="div12">
                    <span class="rgt">'.$row['time'].'</span>
                    <div class="clr"></div>';
                    if($row['type'] == 1){
                    echo'<h2 class="mobilefont"><a href="post.php?id='.$row['id'].'" style="text-decoration:none;">'.$title.'</a></h2>';    
                    }else{
                    echo'<h2 class="mobilefont"><a href="review.php?id='.$row['id'].'" style="text-decoration:none;">'.$title.'</a></h2>';
                    }
                    echo'<p>'.$contente.' ..</p>
                    <div class="clr"></div> 
                    <div style="margin-top:30px;">
                    <p class="rgt"><img src="images/book.png"/></p>     
                    <p class="rgt" style="margin-right:10px;"><img src="images/share.png"/></p>     
                    <p class="lft" style="font-size:16px;font-weight:bold;"> <img src="images/Fire_alarm-128.png" width="30"/> '.$row['veiws'].'</p>     
                    </div>
                </div>    
                </div> 
              </div>
              <div class="clr"></div>           
             ';
            }
            
            
?>          
            

        </div>
     </div>
    
    <?php include 'leftsidebar.php'; ?>

     <div class='clr'></div>  
    <div id="footer"></div>
    <div class='clr'></div>
    <hr/>
    <div class='clr'></div>
     <div class='col-md-12'>
      <center>  
          <?php 
            $stmt = $DB_con->prepare("SELECT * FROM `category` ORDER BY id DESC");
            $stmt->execute();   
          
            foreach ($stmt->fetchAll() as $row) {
            echo'
               <div class="sectionS">
               <a href="cat.php?id='.$row['id'].'" style="color:white;text-decoration:none;">   
               <p style="margin-top:30px;"><img src="imagespost/'.$row['image'].'" /></p>   
               <p>'.$row['catname'].'</p> 
               </a>   
               </div>
            ';    
            }
          ?>

      </center> 
         
     </div>
     <div class='clr'></div>  
     <hr/> 
     <div class='clr'></div>  
    
</div>


<?php include 'footer.php'; ?>
        
        
        
        
