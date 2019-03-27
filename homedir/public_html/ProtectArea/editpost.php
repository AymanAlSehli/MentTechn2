	<script src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/samples/js/sample.js"></script>
	<link rel="stylesheet" href="ckeditor/samples/css/samples.css">
<?php include "header.php"; include "session.php";
        
        $id = 0;
        if(isset($_GET['id']) && (int)$_GET['id'] > 0)
        {
          $id = (int)$_GET['id'];
          $main = $DB_con->prepare("SELECT * FROM `post` WHERE `id`=".$id."");
          $main->execute(); 
          $infos = $main->fetch(PDO::FETCH_OBJ);          
            
          $userIn = $DB_con->prepare("SELECT * FROM `admins` WHERE `id`=".$infos->users."");
          $userIn->execute(); 
          $infosY = $userIn->fetch(PDO::FETCH_OBJ);
            
          $count = $main->rowCount();
            
            
            if($count == 0){
            echo "<div class='alert alert-danger'>صفحة المطلوبة غير موجودة </div>"; 
            echo '<meta http-equiv="refresh" content="1; url=allpost.php"> '; 
            exit;
            }elseif($userRow['type'] == 1 AND $infos->users != $userRow['id']){
            echo "<div class='alert alert-danger'>صفحة المطلوبة غير موجودة </div>"; 
            echo '<meta http-equiv="refresh" content="1; url=allpost.php"> '; 
            exit;
            }
            
            else{

      if(isset($_POST['Update'])){

           $newPage['title']      = addslashes(strip_tags($_POST['title']));
           $newPage['catid']      = addslashes(strip_tags($_POST['catid']));
           $newPage['keywords']   = addslashes(strip_tags($_POST['keywords']));
           $newPage['users']      = $infos->users;
           $newPage['content']    = $_POST['content'];
           
            if(isset($_FILES)){
              try{
                include '../models/Upload.php';
                $file = $_FILES['image'];
                $allowedExts = array('jpg','png','gif','jpeg');
                $uploadsDirectory = "../imagespost/";
                $maxSize = 4000000;
                $upload = new Upload($file, $allowedExts, $uploadsDirectory, $maxSize);
                $upload->uploadFiles();
                $newPage['image'] = $upload->getFileUrl();
                }
                catch(Exception $exc){
                $newPage['image'] = ''.$infos->image.'';
                } 

              }else{
              $newPage['image'] = ''.$infos->image.'';      
              }
          
           if(isset($_POST['videolink'])){
            $newPage['videolink']  = addslashes(strip_tags($_POST['videolink']));
            $newPage['type']       = 2;   
           }else{
            $newPage['type']       = 1;   
           }


        if($newPage['title'] == ''){
        echo '<div class="alert alert-danger">المرجو ملء جميع البيانات </div>';
        }else{
            
            $sql = "UPDATE `post` SET  
            title = :title,
            catid = :catid,
            keywords = :keywords,
            users = :users,
            videolink = :videolink,
            content = :content,
            type = :type
            WHERE `id`=".$id."
            ";
            $UPD = $DB_con->prepare($sql);                                  
            $UPD->bindParam(':title', $newPage['title'], PDO::PARAM_STR);           
            $UPD->bindParam(':catid', $newPage['catid'], PDO::PARAM_STR);           
            $UPD->bindParam(':keywords', $newPage['keywords'], PDO::PARAM_STR);           
            $UPD->bindParam(':users', $newPage['users'], PDO::PARAM_STR);  
            $UPD->bindParam(':videolink', $newPage['videolink'], PDO::PARAM_STR);                                 
            $UPD->bindParam(':content', $newPage['content'], PDO::PARAM_STR);                     
            $UPD->bindParam(':type', $newPage['type'], PDO::PARAM_STR);                     
            $UPD->execute(); 

           echo"<div class='alert alert-block alert-success'>ثم تعديل البيانات بنجاح </div>";
           echo'<meta http-equiv="refresh" content="3; url=allpost.php" />';
            }
      
            }
            }
        
?>
<div class='TitleTag'>إعدادات الموقع </div>

      <form class='rgt' action='' method='post' style='margin:10px;padding:10px;font-size:14px;' enctype="multipart/form-data">
        <div class='rgt form-group' >
            <label for='inputEmail' >عنوان الموضوع </label>
            <input type='text' name='title' class='form-control' value='<?php echo "".$infos->title.""; ?>' style='width:400px;height:40px;border-radius:0px;'>
        </div>
        <fieldset disabled>  
        <div class='rgt form-group' style='margin-right:5px;'>
            
            <div class='rgt form-group'>
                <label for='inputEmail' >كاتب الموضوع </label>                
                <input type='text' id="disabledTextInput" value='<?php echo $infosY->username; ?>' class='form-control' style='width:400px;height:40px;border-radius:0px;'>
            </div>  
            
              
        </div>
        </fieldset>    
          <div class='clr'></div>
            <div class='rgt form-group' >
                <label for='inputPassword'>قسم الموضوع  </label>
                <select class='form-control' name='catid' style='width:400px;height:40px;border-radius:0px;text-align:right;color:black;'>
                <?php
                  $cat = $DB_con->prepare("SELECT * FROM `category` ORDER BY id DESC");
                  $cat->execute();   
                  foreach ($cat->fetchAll() as $rowcat) {
                  echo"<option value='".$rowcat['id']."' style='color:#1f2833;font-family:JF Flat Medium;'> ".$rowcat['catname']."</option>";       
                  }
                ?>
                </select>
              </div>
            <div class='rgt form-group' style='margin-right:5px;'>
                    <label for='inputEmail' >كلمات المفتاحية </label>
                    <input type='text' name='keywords' class='form-control' value='<?php echo "".$infos->keywords.""; ?>' style='width:400px;height:40px;border-radius:0px;'>
                </div>           
          <div class='clr'></div>          
               <div class="panel panel-default" style='width:400px;border-radius:0px;text-align:right;'>
              <div class="panel-heading">رفع الصور </div>
              <div class="panel-body">                
                  
              <div class="form-group">
                <input type="file" name='image[]' id="exampleInputFile" multiple>
                <p class="help-block"> من نوع (png - jpg - gif - jpeg)</p>
              </div>
              </div>            
              </div> 
               <?php 
                if($infos->type == 2){
                 echo"
                 <div class='clr'></div>
                    <div class='rgt form-group' style='margin-right:5px;'>
                        <label for='inputEmail' >رابط الفيديو </label>
                        <input type='text' name='videolink' class='form-control' value='".$infos->videolink."' style='width:400px;height:40px;border-radius:0px;'>
                    </div> 
                 ";   
                }else{
                echo"";    
                }  
                  
                ?>          
           <div class='clr'></div>
            <label for='inputPassword'>محتوى الموضوع </label>
            <textarea name='content' id="editor" class='rgt form-control' style='width:950px;text-align:right;border-radius:0px;'><?php echo "".$infos->content.""; ?></textarea>
          <script>
            initSample();
        </script>
        <div class='clr'></div>
          </br>
        <input name='Update' type='submit' class='btn btn-primary' value='أدخل الموضوع '>
    </form>

<?php 
    } 
?>  