<?php include 'models/dbconfig.php'; 

    $Setting = $DB_con->prepare("SELECT * FROM `mainsetting`");
    $Setting->execute(); 
    $Setrows = $Setting->fetch(PDO::FETCH_OBJ);
    $Setting->closeCursor();
     
    if(isset($_GET['postby'])){
        $_SESSION['postby'] = $_GET['postby'];
    }
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
  
        







          