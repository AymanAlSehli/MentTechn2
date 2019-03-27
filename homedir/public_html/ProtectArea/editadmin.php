<?php include "header.php"; include "session.php";
        if($userRow['type'] == 1 OR $userRow['type'] == 2){
        echo "<div class='alert alert-danger'>صفحة المطلوبة غير موجودة </div>"; 
        echo '<meta http-equiv="refresh" content="1; url=index.php"> '; 
        exit;
        }
        $id = 0; //init
        if(isset($_GET['id']) && (int)$_GET['id'] > 0)
        {
          $id = (int)$_GET['id'];
          $main = $DB_con->prepare("SELECT * FROM `admins` WHERE `id`=".$id."");
          $main->execute(); 
          $infos = $main->fetch(PDO::FETCH_OBJ);
          $count = $main->rowCount();
            
            if($count == 0){
            echo "<div class='alert alert-danger'>صفحة المطلوبة غير موجودة </div>"; 
            echo '<meta http-equiv="refresh" content="1; url=addusers.php"> '; 
            exit;}else{
                
                
      if(isset($_POST['Edit'])){
          


        $newPage['username']   = htmlspecialchars(strip_tags($_POST['username']));
        if($_POST['password'] != ''){
        $newPage['password']   = strip_tags(md5(trim($_POST['password'])));    
        }else{
        $newPage['password']   = $infos->password;    
        }
        $newPage['email']      = htmlspecialchars(strip_tags($_POST['email']));
        $newPage['type']       = (int)$_POST['type'];        
        $newPage['desce']      = htmlspecialchars(strip_tags($_POST['desce']));
        $newPage['siteweb']      = htmlspecialchars(strip_tags($_POST['siteweb']));
        $newPage['fblink']      = htmlspecialchars(strip_tags($_POST['fblink']));
        $newPage['twlink']      = htmlspecialchars(strip_tags($_POST['twlink']));
        $newPage['golink']      = htmlspecialchars(strip_tags($_POST['golink']));
          if(isset($_FILES)){
          try{
            include '../models/Upload.php';
            $file = $_FILES['image'];
            $allowedExts = array('jpg','png','gif','jpeg');
            $uploadsDirectory = "../images/";
            $maxSize = 4000000;
            $upload = new Upload($file, $allowedExts, $uploadsDirectory, $maxSize);
            $upload->uploadFiles();
            $newPage['image'] = $upload->getFileUrl();
            }
            catch(Exception $exc){
            $newPage['image'] = $infos->image;
            } 
                        
          }else{
          $newPage['image'] = $infos->image;      
          }  
                 
          
        if($newPage['username'] == '' OR $newPage['email'] == ''){
        echo '<div class="alert alert-danger">المرجو ملء جميع البيانات </div>';
        }else{
            $sql = "UPDATE `admins` SET  
            username = :username,
            password = :password,
            email = :email,
            type = :type,
            image = :image,
            desce = :desce,
            siteweb = :siteweb,
            fblink = :fblink,
            twlink = :twlink,
            golink = :golink
            WHERE `id`=".$id."
            ";
            $UPD = $DB_con->prepare($sql);                                  
            $UPD->bindParam(':username', $newPage['username'], PDO::PARAM_STR);       
            $UPD->bindParam(':password', $newPage['password'], PDO::PARAM_STR);                
            $UPD->bindParam(':email', $newPage['email'], PDO::PARAM_STR);                
            $UPD->bindParam(':type', $newPage['type'], PDO::PARAM_STR);                
            $UPD->bindParam(':image', $newPage['image'], PDO::PARAM_STR);                
            $UPD->bindParam(':desce', $newPage['desce'], PDO::PARAM_STR);                
            $UPD->bindParam(':siteweb', $newPage['siteweb'], PDO::PARAM_STR);                
            $UPD->bindParam(':fblink', $newPage['fblink'], PDO::PARAM_STR);                
            $UPD->bindParam(':twlink', $newPage['twlink'], PDO::PARAM_STR);                
            $UPD->bindParam(':golink', $newPage['golink'], PDO::PARAM_STR);                
            $UPD->execute(); 

           echo"<div class='alert alert-block alert-success'>ثم تعديل البيانات بنجاح </div>";
           echo'<meta http-equiv="refresh" content="3; url=addusers.php" />';
      exit;}
            }
            }
        
?>
	<script src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/samples/js/sample.js"></script>
	<link rel="stylesheet" href="ckeditor/samples/css/samples.css"> 
<div class='TitleTag'>تعديل مدير  </div>


      <form class='rgt' action='' method='post' style='margin:10px;padding:10px;text-align:right;font-size:14px;' enctype="multipart/form-data">
        <div class='rgt form-group' >
            <label for='inputEmail' >إسم العضوية</label>
            <input type='text' name='username' class='form-control' value='<?php echo $infos->username; ?>' style='width:400px;height:40px;border-radius:0px;text-align:right;'>
        </div>
        <div class='rgt form-group' style='margin-right:5px;'>
            <label for='inputPassword'>كلمة السر  </label>
            <input type='password' name='password' class='form-control' placeholder='إذا تريد إبقاء على كلمة السر القديمة خلي المكان فارغ ' style='width:400px;height:40px;border-radius:0px;text-align:right;'>
        </div>
        <div class='clr'></div>
        <div class='rgt form-group' >
            <label for='inputEmail' >الإيميل</label>
            <input type='email' name='email' class='form-control' value='<?php echo $infos->email; ?>' style='width:400px;height:40px;border-radius:0px;text-align:right;'>
        </div>          
        <div class='rgt form-group' style='margin-right:5px;'>
            <label for='inputPassword'>حدد صلاحيات  </label>
            <select class='form-control' name='type' style='width:400px;height:40px;border-radius:0px;text-align:right;color:black;'>
            <option value='1'>محرر </option>            
            <option value='2'>مشرف عام  </option>            
            <option value='3'>مدير عام  </option>            
            </select>
          </div>
        <div class='clr'></div>
        <div class='rgt form-group' >
            <label for='inputEmail' >موقع الإلكتروني </label>
            <input type='text' name='siteweb' class='form-control' value='<?php echo $infos->siteweb; ?>' style='width:400px;height:40px;border-radius:0px;text-align:right;'>
        </div>
        <div class='rgt form-group' style='margin-right:5px;'>
            <label for='inputPassword'>صفحة الفيسبوك  </label>
            <input type='text' name='fblink' class='form-control' value='<?php echo $infos->fblink; ?>' style='width:400px;height:40px;border-radius:0px;text-align:right;'>
        </div>
        <div class='clr'></div> 
        <div class='rgt form-group' >
            <label for='inputEmail' >صفحة التويتر </label>
            <input type='text' name='twlink' class='form-control' value='<?php echo $infos->twlink; ?>' style='width:400px;height:40px;border-radius:0px;text-align:right;'>
        </div>
        <div class='rgt form-group' style='margin-right:5px;'>
            <label for='inputPassword'>صفحة جوجل  </label>
            <input type='text' name='golink' class='form-control' value='<?php echo $infos->golink; ?>' style='width:400px;height:40px;border-radius:0px;text-align:right;'>
        </div>
        <div class='clr'></div>          
               <div class="rgt panel panel-default" style='width:400px;border-radius:0px;text-align:right;'>
              <div class="panel-heading">صورة العضو  </div>
              <div class="panel-body">                
                  
              <div class="form-group">
                <input type="file" name='image[]' id="exampleInputFile" multiple>
                <p class="help-block"> من نوع (png - jpg - gif - jpeg)</p>
              </div>
               
              </div>            
              </div>
          
              <div class="rgt panel panel-default" style='width:400px;margin-right:5px;border-radius:0px;text-align:right;'>
              <div class="panel-heading">نبذة عن العضو  </div>
              <div class="panel-body">                
            
              <div class="form-group">
                <textarea name='desce' class='form-control' rows="5" style='border-radius:0px;text-align:right;'><?php echo $infos->desce; ?></textarea>
              </div>
               
              </div>            
              </div>                   
        <div class='clr'></div>
        <input name='Edit' type='submit' class='rgt btn btn-primary' value='تعديل العضو  '>
    </form>
    <div class='clr'></div>

<?php
                
        }else{
    echo "<div class='alert alert-danger'>صفحة المطلوبة غير موجودة </div>";    
    } 


?>