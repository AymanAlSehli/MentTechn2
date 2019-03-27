<?php include 'models/dbconfig.php'; 

    $Setting = $DB_con->prepare("SELECT * FROM `mainsetting`");
    $Setting->execute(); 
    $Setrows = $Setting->fetch(PDO::FETCH_OBJ);


    if(isset($_GET['postby'])){
        $_SESSION['postby'] = $_GET['postby'];
    }

        $id = 0; //init
        if(isset($_GET['id']) && (int)$_GET['id'] > 0)
        {
        $today = date("Y-m-d");    
        $id = (int)$_GET['id'];
        $getL = $DB_con->prepare("SELECT * FROM `post` WHERE `id`=".$id."");
        $getL->execute(); 
        $getp = $getL->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $Setrows->site_name; ?></title>  
    <meta http-equiv="content-type" content="text/html"; charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $Setrows->desc_site; ?>">
    <meta name="keywords" content="<?php echo $Setrows->key_site; ?>">      
    <link rel="icon" type="image/png" href="favicon.ico" />
    <meta property="og:url"           content="post.php?id=<?php echo"".$getp->id.""; ?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?php echo"".$getp->title.""; ?>" />
    <meta property="og:description"   content="<?php echo"".$getp->title.""; ?>" />
    <meta property="og:image"         content="imgupload/<?php echo"".$getp->image.""; ?>" />       
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->  
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link href="css/bootstrap-arabic.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap-arabic.min.css" rel="stylesheet" type="text/css">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <link href="css/normalize.css" rel="stylesheet" type="text/css">
  </head>
  <?php 
    if($Setrows->open_close == 0){
    echo "
    <div style='width:1024px;margin:auto;'>
    <br/>
    <center>
    <div class='alert alert-block alert-info' style='width:500px;'>الموقع تحت الصيانة حاليا أعد المحاولة لاحقا </div>
    <div class='clr'></div>
    <img src='images/slogo.png' />
    </center>
    </div>
    ";
    exit;}    
    
  ?>    
  <body>
    <div id="HomePage">
    <header>
    <div class='rgt' style='margin:5px;margin-top:15px;'><a href='index.php'><img src='images/slogo.png' /></a></div>   
    <div class='lft' style='margin:5px;'>
     <table class="desktop-only table table-bordered" style='width:200px;background:white;font-size:13px;'>
        <tbody >
          <tr>
            <td style='padding:2px;'><center><img src='images/Fire_alarm-128.png' style='width:20px;'/> نشطة  </center></td>
          </tr>
            <?php 
            $stmtca = $DB_con->prepare("SELECT * FROM `category` ORDER BY veiws DESC LIMIT 6");
            $stmtca->execute();   

            foreach ($stmtca->fetchAll() as $row) {  
            echo'
            <tr class="rgt" style="border:0px;">
            <td style="padding:2px;width:98px;">
            <a href="cat.php?id='.$row['id'].'" style="margin-right:5px;">'.$row['catname'].'</a></td>
            </tr>  
            ';
            }
            ?>
            
        </tbody>
      </table>
    </div> 
            
    <div class='desktop-only lft' style='margin:5px;'><img src='images/728x90.png' /></div>    

    </header>    
    <div class='clr'></div>    
    <nav class="navbar navbar-default " style='background:#555A60;border-radius:0px;'>
    
    <div class="navbar-header nav-background dropdown">
		<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
        
		<a href="#" class="navbar-brand dropdown-toggle" id='nav-a' data-toggle="dropdown" style=''> 
            القائمة <span class="glyphicon glyphicon-list" aria-hidden="true"></span> </a>
        <ul class="dropdown-menu" style='border-radius:0px;font-size:20px;font-family:chakirhelve;width:190px;'>
                        <?php
            $LopP = $DB_con->prepare("SELECT * FROM `category` ORDER BY id DESC");
            $LopP->execute();    
            while($rowePl = $LopP->fetch(PDO::FETCH_ASSOC))
            {
            echo'<li><a href="cat.php?id='.$rowePl['id'].'">'.$rowePl['catname'].'</a></li>';
            }
            ?>
            

        </ul>
	</div>     
       
    <div class="navbar-header nav-backgroundsrch">
        <div class='navbar-brand' id="topnav">
          <ul>
            <li><a href="#" id="searchtoggl"><span class="glyphicon glyphicon-search" style='color:white;'></span></a></li>
          </ul>
        </div>
	</div> 
            <?php
            $LopP = $DB_con->prepare("SELECT * FROM `category` ORDER BY id DESC");
            $LopP->execute();    
            while($rowePl = $LopP->fetch(PDO::FETCH_ASSOC))
            {
            $stmtMega = $DB_con->prepare("SELECT id,image,title,type FROM `post` WHERE `catid`=".$rowePl['id']." ORDER BY id DESC LIMIT 4");
            $stmtMega->execute();
            $countMega  = $stmtMega->rowCount();
               
            echo'
              <div class="desktop-only navbar-header dropdown mega-dropdown nav-alink">
                <a href="cat.php?id='.$rowePl['id'].'" class="navbar-brand dropdown-toggle"  style="margin-top:-10px;margin-bottom:-15px;text-align:center;color:white;font-size:13px;height:75px;"> 
                    <center><img src="imagespost/'.$rowePl['image'].'" style="margin-top:-10px;"/></center>
                    <div class="clr"></div>
                    <div style="margin-top:-10px;color:white;font-family:chakirhelve;">'.$rowePl['catname'].'</div>  
                </a>';
                if($countMega > 0){
                echo'<ul class="dropdown-menu mega-dropdown-menu row">';    
                foreach ($stmtMega->fetchAll() as $roweMeg) {       
                 echo'
                     <li class="rgt col-sm-3">
                        <ul>                        
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                              <div class="carousel-inner">
                                <div class="item active">';
                                if($roweMeg['type'] == 1){
                                echo'
                                <a href="post.php?id='.$roweMeg['id'].'"><img src="imagespost/'.$roweMeg['image'].'" class="img-responsive" alt="product 1"></a>
                                ';    
                                }else{
                                echo'
                                <a href="review.php?id='.$roweMeg['id'].'"><img src="imagespost/'.$roweMeg['image'].'" class="img-responsive" alt="product 1"></a>
                                '; 
                                }
                                echo'
                                    <h4><small>
                                    <a href="" style="font-size:17px;text-decoration:none;font-family:chakirhelve;color:black;">'.$roweMeg['title'].'</a>
                                    </small></h4>                                    
                                </div><!-- End Item -->                    
                              </div><!-- End Carousel Inner -->                              
                            </div><!-- /.carousel -->
                        </ul>
                    </li>
                  
                 ';   
                }
                echo'</ul>';    
                }

               echo'</div> 
                  ';   
                }                
              
            ?>

     
        
    <div id="searchbar" class="clearfix">
    <form action="search.php" method="GET" role="search">
      <input type="text" name="query" id="s" placeholder="كلمة البحث ...">
    </form>  
  </div>
    <div class='desktop-only lft' style='padding:10px;width:100px;'>
        <a href='<?php echo $Setrows->fb; ?>'><img class='lft' src='images/social_55-128.png' style='width:17px;margin:1px;'/></a>
        <a href='<?php echo $Setrows->tw; ?>'><img class='lft' src='images/social_54-128.png' style='width:17px;margin:1px;'/></a>
        <a href='<?php echo $Setrows->go; ?>'><img class='lft' src='images/social_32-128.png' style='width:17px;margin:1px;'/></a>
        <div class='clr'></div>
        <a href='<?php echo $Setrows->insta; ?>'><img class='lft' src='images/social_50-128.png' style='width:17px;margin:2px;'/></a>
        <a href='<?php echo $Setrows->yt; ?>'><img class='lft' src='images/social_51-128.png' style='width:17px;margin:2px;'/></a>
       </div>   
</nav>
  
<script id="dsq-count-scr" src="//menttech.disqus.com/count.js" async></script>
<?php 

        $count  = $getL->rowCount();
        if($count <= 0){
            echo '<meta http-equiv="refresh" content="0; url=index.php"> ';    
        }   
        $getC = $DB_con->prepare("SELECT * FROM `category` WHERE `id`=".$getp->catid."");
        $getC->execute(); 
        $getCat = $getC->fetch(PDO::FETCH_OBJ); 
      
        $getN = $DB_con->prepare("SELECT id from post where catid = '".$getp->catid."' AND id > $id ORDER BY ID DESC LIMIT 1;");
        $getN->execute(); 
        $getNext = $getN->fetch(PDO::FETCH_OBJ);
        $countN  = $getN->rowCount();    
            
        $getP = $DB_con->prepare("SELECT id from post where catid = '".$getp->catid."' AND id < $id ORDER BY ID DESC LIMIT 1;");
        $getP->execute(); 
        $getprevious = $getP->fetch(PDO::FETCH_OBJ);
        $countP  = $getP->rowCount();    
            
         $getR = $DB_con->prepare("SELECT id from post where catid = '".$getp->catid."' ORDER BY rand() DESC LIMIT 1;");
         $getR->execute(); 
         $getrandom = $getR->fetch(PDO::FETCH_OBJ);
         $countR  = $getR->rowCount();          
            

            $current_views = $getp->veiws;    
            $vizualizari = $current_views+1;
            $sqlv = "UPDATE `post` SET `veiws` = :veiws WHERE id = {$id}";
            $qv = $DB_con->prepare($sqlv);
            $qv->bindParam(':veiws', $vizualizari, PDO::PARAM_STR); 
            $qv->execute();
            
            $stmtT = $DB_con->prepare("SELECT * FROM `admins` WHERE id=".$getp->users."");
            $stmtT->execute();
            $userRow = $stmtT->fetch(PDO::FETCH_ASSOC);
            
            // Like              
            $user_ip = $_SERVER['REMOTE_ADDR'];
            $pageID = (int)$_GET['id']; // The ID of the page, the article or the video ...

            //function to calculate the percent
            function percent($num_amount, $num_total) {
                @$count1 = $num_amount / $num_total;
                $count2 = $count1 * 100;
                $count = number_format($count2, 0);
                return $count;
            }

            // check if the user has already clicked on the unlike (rate = 2) or the like (rate = 1)
                $dislike_sql = $DB_con->prepare('SELECT COUNT(*) FROM  wcd_yt_rate WHERE ip = "'.$user_ip.'" and id_item = "'.$pageID.'" and rate = 2 ');
                $dislike_sql->execute();
                $dislike_count = array_shift($dislike_sql->fetch(PDO::FETCH_NUM));
                //$dislike_count = mysql_result($dislike_sql, 0); 

                $like_sql = $DB_con->prepare('SELECT COUNT(*) FROM  wcd_yt_rate WHERE ip = "'.$user_ip.'" and id_item = "'.$pageID.'" and rate = 1 ');
                $like_sql->execute(); 
                $like_count = array_shift($like_sql->fetch(PDO::FETCH_NUM));
                //$like_count = mysql_result($like_sql, 0);  

                // count all the rate 
                $rate_all_count = $DB_con->prepare('SELECT COUNT(*) FROM  wcd_yt_rate WHERE id_item='.$pageID.'');
                try {
                 $rate_all_count->execute();
                } catch (Exception $e) {
                    echo 'Exception : ',  $e->getMessage(), "\n";
                    
                }
                $rate_all_count_value = array_shift($rate_all_count->fetch(PDO::FETCH_NUM));
                                          
                $rate_like_count = $DB_con->prepare('SELECT COUNT(*) FROM  wcd_yt_rate WHERE id_item = "'.$pageID.'" and rate = 1');
                $rate_like_count->execute();
                $rate_like_count_value = array_shift($rate_like_count->fetch(PDO::FETCH_NUM));
                $rate_like_percent = percent($rate_like_count_value, $rate_all_count_value);

                $rate_dislike_count = $DB_con->prepare('SELECT COUNT(*) FROM  wcd_yt_rate WHERE id_item = "'.$pageID.'" and rate = 2');
                $rate_dislike_count->execute();
                $rate_dislike_count_value = array_shift($rate_dislike_count->fetch(PDO::FETCH_NUM));
                $rate_dislike_percent = percent($rate_dislike_count_value, $rate_all_count_value);
        ?>

        <script>
            $(function(){ 
                var pageID = <?php echo $pageID;  ?>; 

                $('.like-btn').click(function(){
                    $('.dislike-btn').removeClass('dislike-h');    
                    $(this).addClass('like-h');
                    $.ajax({
                        type:"POST",
                        url:"ajax.php",
                        data:'act=like&pageID='+pageID,
                        success: function(){
                        }
                    });
                });
                $('.dislike-btn').click(function(){
                    $('.like-btn').removeClass('like-h');
                    $(this).addClass('dislike-h');
                    $.ajax({
                        type:"POST",
                        url:"ajax.php",
                        data:'act=dislike&pageID='+pageID,
                        success: function(){
                        }
                    });
                });
                $('.share-btn').click(function(){
                    $('.share-cnt').toggle();
                });
            });
        </script>
<div class="row">
    <div class='clr'></div>
     <div id="sidebarWrap" class="desktop-only col-md-2">
        <div id="sidebar" class="panel panel-default" style='border-radius:0px;border-right:5px solid #d3d3d3;'>
          <div class="panel-heading" style='font-family:JF Flat regular;font-size:17px;font-weight:bold;'><span class="lft glyphicon glyphicon-th-large" style='color:#8E44AD;'></span>أخبار</div>
          <div style='background:url("images/purple.jpg") bottom fixed ;'>   
          <div class="panel-body" style='color:white;'>
              <p style="font-size:12px;">تقراء الان  </p>
              <p><?php echo $getp->title; ?></p>
              <?php 
               if($countP > 0){
               echo'
              <p id="nextp">
              <a href="post.php?id='.$getprevious->id.'" style="text-decoration:none;">      
              <span class="glyphicon glyphicon-chevron-right"></span>
               السابق </a>
              </p>
               ';    
               }else{
               echo'';       
               }
            
               if($countN > 0){
               echo'
              <p id="nextp">
              <a href="post.php?id='.$getNext->id.'" style="text-decoration:none;">      
               التالي      
              <span class="glyphicon glyphicon-chevron-left"></span>
              </a>   
              </p>               
               ';    
               }
            
              if($countR > 0){
               echo'
              <p id="nextp">
               <a href="post.php?id='.$getrandom->id.'" style="text-decoration:none;">     
              <span class="glyphicon glyphicon-random" style="padding:2px;"></span> 
              </a>
              </p>           
               ';    
               }              
              ?>


              


              
          </div>
          </div>   
        </div>        
      </div>
    
     <div class='rgt col-md-7'>
        <div class="row">
          <div class="col-sm-10 TopicWidth">
            <div style='font-size:16px;'>
                <div class="tab-cnt">
                <div class="tab-tr" id="t1">
                    <div class="like-btn <?php if($like_count == 1){ echo 'like-h';} ?>">Like</div>
                    <div class="dislike-btn <?php if($dislike_count == 1){ echo 'dislike-h';} ?>"></div>
                    <div class="stat-cnt">
                        <div class="rate-count"><?php echo $rate_all_count_value; ?></div>
                        <div class="stat-bar">
                            <div class="bg-green" style="width:<?php echo $rate_like_percent; ?>%;"></div>
                            <div class="bg-red" style="width:<?php echo $rate_dislike_percent; ?>%"></div>
                        </div><!-- stat-bar -->
                        <div class="dislike-count"><?php echo $rate_dislike_count_value; ?></div>
                        <div class="like-count"><?php echo $rate_like_count_value; ?></div>
                    </div><!-- /stat-cnt -->
                </div><!-- /tab-tr -->
                </div>
            </div>
            <div class='clr'></div>  
            <hr style='margin-top:0px;'/>
            <div class='clr'></div>  
            <h2 class='fonttopic'>
                <?php echo ''.$getp->title.''; ?></h2>  
            <img class='fade2 Topicimg' src="imagespost/<?php echo ''.$getp->image.''; ?>">
            <div style='background:white;height:auto;'>
            <div style="padding:10px;">
                <span class='rgt' style='font-weight:bold;font-size:17px;line-height:30px;'>بواسطة : <a href="" style='color:#9A12B3;'><?php echo ''.$userRow['username'].''; ?></a> </span>
                <div class='clr'></div>
                <span class='rgt' style='font-size:12px;'><?php echo ''.$getp->time.''; ?></span>
                <br/><br/>
                <div class='clr'></div>
                <div class='estoimg' style='line-height:30px;'><?php echo ''.$getp->content.''; ?></div>
            </div>                
            </div> 
            <div class='clr'></div>
            <hr/>  
            <div class='clr'></div>
            <style type="text/css">

            #share-buttons img {
            width: 45px;
            padding: 5px;
            border: 0;
            box-shadow: 0;
            display: inline;
            }

            </style>            
             <center><div id="share-buttons">
                 
                <!-- Facebook -->
                <a href="http://www.facebook.com/sharer.php?u=post.php?id=<?php echo"".$getp->id.""; ?>" target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
                </a>

                <!-- Google+ -->
                <a href="https://plus.google.com/share?url=post.php?id=<?php echo"".$getp->id.""; ?>" target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
                </a>

                <!-- LinkedIn -->
                 <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=post.php?id=<?php echo"".$getp->id.""; ?>" target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
                </a>

                <!-- Pinterest -->
                <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
                    <img src="https://simplesharebuttons.com/images/somacro/pinterest.png" alt="Pinterest" />
                </a>

                <!-- Tumblr-->
                <a href="http://www.tumblr.com/share/link?url=post.php?id=<?php echo"".$getp->id.""; ?>&amp;title=<?php echo"".$getp->title.""; ?>" target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/tumblr.png" alt="Tumblr" />
                </a>


                <!-- Twitter -->
                <a href="https://twitter.com/share?url=post.php?id=<?php echo"".$getp->id.""; ?>&amp;text=<?php echo"".$getp->title.""; ?>" target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
                </a>

                <!-- VK -->
                <a href="http://vkontakte.ru/share.php?url=post.php?id=<?php echo"".$getp->id.""; ?>" target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/vk.png" alt="VK" />
                </a>


</div></center>  
                         
            <div class='clr'></div>
            <hr/>  
            <div class='clr'></div>               
            <div class="col-sm-12 Topic2Wid">
             <table class="tableWid table table-bordered">
                <tbody>
                  <tr style='text-align:center;'>
                    <td >
                        <div id="vc-feelback-main" data-access-token="c47e959260b37905ea27145ad3e2c59e" data-display-type="4"></div> 
                    </td>
                  </tr>   
                </tbody>
              </table>
                <div class='clr'></div>
                <hr/>  
                <div class='clr'></div>              
                  <div class="col-md-12"><p style='color:black;font-weight:bold;'>عن المؤلف</p></div>
                  <div class="rgt col-md-2">
                    <?php 
                    if($userRow['image'] != ''){
                    echo"<img src='images/".$userRow['image']."' style='width:100px;height:100px;'/>";    
                    }else{
                    echo"<img src='images/user.png' style='width:100px;height:100px;'/>";    
                    }  
                     ?>  
                </div>
                  <div class="rgt col-md-9">
                      <p style='font-size:20px;'><?php echo $userRow['username']; ?></p>
                      <p style='font-size:15px;'><?php echo $userRow['desce']; ?></p>
                    <p>
                       <?php 
            
                        if($userRow['siteweb'] != ''){
                         echo "
                         <a class='rgt' href='".$userRow['siteweb']."' target='_blank'>
                         <img src='images/web.png' style='width:30px;height:30px;'/></a>";   
                        }if($userRow['fblink'] != ''){
                          echo "
                         <a class='rgt' href='".$userRow['fblink']."' target='_blank'>
                         <img src='images/facebook.png' style='width:30px;height:30px;'/></a>";                            
                        }if($userRow['twlink'] != ''){
                          echo "
                         <a class='rgt' href='".$userRow['twlink']."' target='_blank'>
                         <img src='images/twitter.png' style='width:30px;height:30px;'/></a>";                            
                        }if($userRow['golink'] != ''){
                          echo "
                         <a class='rgt' href='".$userRow['golink']."' target='_blank'>
                         <img src='images/google.png' style='width:30px;height:30px;'/></a>";                            
                        } 
            
                       ?>      
                      </p>                       
                  </div>
                  <div class='clr'></div>
                          <br/>
                <div class="panel panel-default" style='border-radius:0px;margin-right:10px;'>
                  <div class="panel-heading" style='font-family:JF Flat regular;font-size:17px;font-weight:bold;'><span class="lft glyphicon glyphicon-tags" style='color:#8E44AD;'></span> كلمات مفتاحية </div>
                  <div class="panel-body">
                    <?php 

                    $tags = $getp->keywords;  
                    $new = explode(',', $tags);
                    $count = count($new);
                    $count2 = $count - 1;

                    echo'
                    <div class="">
                        <div class="item-content-block tags">
                    ';
                    for ($x = 0; $x <= $count2; $x++) {
                    echo '
                            <a href="search.php?query='.@$new[$x].'">'.@$new[$x].'</a>
                    '; 

                    }
                    echo'
                        </div>
                    </div>
                    ';


                    ?>
                  </div>

                </div>                
                          <br/>
                          <div class='clr'></div>
                  <div class='likeWid'>
                    <p class='belike'> <span class="glyphicon glyphicon-thumbs-up"></span> قد تعجبك  </p>  
                  </div>
                    <div class='clr'></div>
                
                    <div style='margin-right:20px;'>
                    <?php 
                        $stmt = $DB_con->prepare("SELECT * FROM `post` ORDER BY id DESC LIMIT 6");
                        $stmt->execute();   

                        foreach ($stmt->fetchAll() as $row) {
                        $contente = mb_substr($row['title'], 0, 50, 'UTF-8'); 
                        if($row['type'] == 1){
                        echo'
                        <div class="rgt" style="width:210px;margin-left:10px;margin-bottom:10px;">
                        <div class="rgt itemsContainer" >
                        <a href="post.php?id='.$row['id'].'"><div class="image"><img src="imagespost/'.$row['image'].'" class="hoverp"/></div></a>
                        <a href="post.php?id='.$row['id'].'"><div class="play"><img src="images/r.png" /> </div></a>   
                        </div>
                        <a href="post.php?id='.$row['id'].'" class="rgt" style="margin-right:-10px;width:200px;">'.$contente.'...</a>   
                        </div>
                        ';   
                        }else{
                        echo'
                        <div class="rgt" style="width:210px;margin-left:10px;margin-bottom:10px;">
                        <div class="rgt itemsContainer" >
                        <a href="review.php?id='.$row['id'].'"><div class="image"><img src="imagespost/'.$row['image'].'" class="hoverp"/></div></a>
                        <a href="review.php?id='.$row['id'].'"><div class="play"><img src="images/r.png" /> </div></a>   
                        </div>
                        <a href="review.php?id='.$row['id'].'" class="rgt" style="margin-right:-10px;width:200px;">'.$contente.'...</a>   
                        </div>
                        '; 
                        }    
   
                        }
                      ?>    

                        
                        
                    </div>
              
                <div class='clr'></div>
                
                <div class='commentWid'>
                <p class='becomment'> <span class="glyphicon glyphicon-comment"></span> تعليقات   </p> 
                </div>  
                <div class='clr'></div>
                <!-- Commetn  !-->

                <div id="disqus_thread" style='margin-top:10px;margin-right:20px;'></div>
                <script>
                (function() { // DON'T EDIT BELOW THIS LINE
                var d = document, s = d.createElement('script');

                s.src = '//menttech.disqus.com/embed.js';

                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
                })();
                </script>
                <div class='clr'></div>                
                
            </div>
            <div class='clr'></div>
            <br/>   
            <br/>   
            <br/>   
            <br/>   
            <br/>   
            <br/>   
          </div>
    
        </div>
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
        
     <script> 
(function() { 
var v = document.createElement('script'); v.async = true; 
v.src = "http://assets-prod.vicomi.com/vicomi.js"; 
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(v, s); 
})(); 
</script>         
        
        
