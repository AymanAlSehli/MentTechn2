<?php include 'header.php'; 
?>
<div class="row">
    <div class='rgt col-md-2'>
    <div class="list-group" style='border-radius:0px;'>
      <a href="#" class="rwabet list-group-item active" style='border-color:#2C3E50;border-radius:0px;background:#2C3E50;'>
        روابط مهمة 
      </a>
      <a href="aboutus.php" class="list-group-item">عن الموقع </a>
      <a href="terms.php" class="list-group-item">سياسة الخصوصية </a>
      <a href="privacy.php" class="list-group-item">قوانين الموقع </a>
      <a href="contact.php" class="list-group-item">إتصل بنا </a>
    </div>
    </div> 
    <div class='rgt col-md-7'>
        <div class="row">
            <div class="panel panel-default" style='margin-right:10px;border-radius:0px;'>
              <div class="panel-heading" style='font-size:17px;background:#2c3e50;border-radius:0px;color:white;border-color:#2c3e50;'><span class="lft glyphicon glyphicon-question-sign"></span>  تطبيقات  </div>
              <div class="panel-body" style='line-height:25px;font-size:16px;margin:10px;'>
                <div class='clr'></div>
                <?php 
                      if(isset($_POST['Add'])){

                        $newPage['code']  = htmlspecialchars(strip_tags($_POST['code']));

                        if($newPage['code'] == ''){
                        echo '<div class="alert alert-danger">المرجو إدخال رقم معين </div>';
                        }elseif($newPage['code'] != strval(intval($newPage['code']))){
                         echo '<div class="alert alert-danger">اكتب الرقم بالانجليزي فقط </div>';           
                        }else{
                        
                          $main = $DB_con->prepare("SELECT * FROM `code` WHERE `codenumber`=".$_POST['code']."");
                          $main->execute();
                          $count = $main->rowCount();
                          
    
                          if($count > 0){
                            $infos = $main->fetch(PDO::FETCH_OBJ);
                            echo '<meta http-equiv="refresh" content="0; url='.$infos->codelink.'"> ';                              
                          }else{
                            echo '<meta http-equiv="refresh" content="0; url=code.php"> ';                                
                          }
                            
                          $infos ->closeCursor();
                      }
                      }

                ?>                  
                <div class="panel panel-primary">
                  <div class="panel-heading">رقم الشرح</div>
                  <div class="panel-body">
                    <form action="" method="post">
                      <div class="form-group">
                        <input type="text" name='code' class="form-control input-lg" placeholder="رقم الشرح">
                      </div>                 
                      <input type="submit" name='Add' class="lft btn btn-primary" value='أرسل ' style='width:300px;'/>
                    </form> 
                  </div>
                </div>
                <div class="alert alert-info" style='border-radius:0px;'>
                    اكتب الرقم بالانجليزي فقط
                </div>
                <div class="clr"></div>
                <center><img src='images/aymn.jpg' style='width:250px;height:220px;'/></center>   
              </div>
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


    <?php include 'footer.php'; ?>
        
        
        
        
