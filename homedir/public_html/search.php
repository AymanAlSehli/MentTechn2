<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<?php include 'header.php'; 


    ?>
<div class="row">
     <?php include 'leftsidebar.php'; ?>
     <div class='rgt col-md-7'>        
        <div class="row">
             <?php 
            $query = $_GET['query']; 
            $min_length = 3;

            if(strlen($query) > $min_length){ 

                $query = htmlspecialchars($query); 

                $raw_results = $DB_con->prepare("SELECT * FROM `post` WHERE (`title` LIKE :search) OR (`content` LIKE :search)");
                $raw_results->bindValue(':search', '%' . $query . '%', PDO::PARAM_INT);
                $raw_results->execute();
                
    
                if($raw_results->rowCount() > 0){ 
                    $results = $raw_results->fetchAll();
                    foreach($results as $row ) {        
                    $title = trim(strip_tags(htmlspecialchars($row['title'])));
                    $cont  = htmlspecialchars(strip_tags($row['content']));    
                    $contente = mb_substr($cont, 0, 200, 'UTF-8');
                            ?>
                    <div class='Post row<?php echo($i++ & 1 );?>'>
                    <?php
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

                }
                else{ 
                    echo "<div class='alert alert-block alert-danger' style='margin-right:40px;'>لا توجد أي نتائج </div>";
                }

            }
            else{ 
                echo "<div class='alert alert-block alert-danger' style='margin-right:40px;'>لا توجد أي نتائج </div>";
            }

          ?>  

            
            
       
      
        </div>
     </div>
     


    
</div>


    <?php 
    include'footer.php';
    ?>
        
        
        
