<?php include "header.php"; include "session.php";
            if($userRow['type'] == 1 OR $userRow['type'] == 2){
            echo "<div class='alert alert-danger'>صفحة المطلوبة غير موجودة </div>"; 
            echo '<meta http-equiv="refresh" content="1; url=index.php"> '; 
            exit;
            }
          $main = $DB_con->prepare("SELECT * FROM `mainsetting`");
          $main->execute(); 
          $infos = $main->fetch(PDO::FETCH_OBJ);


        if(isset($_POST['UpdateSetting'])){
    
           $sn  = addslashes(strip_tags($_POST['site_name']));
           $fb  = addslashes(strip_tags($_POST['fb']));
           $tw  = addslashes(strip_tags($_POST['tw']));
           $yt  = addslashes(strip_tags($_POST['yt']));
           $go  = addslashes(strip_tags($_POST['go']));
           $ds  = addslashes(strip_tags($_POST['desc_site']));
           $ks  = addslashes(strip_tags($_POST['key_site']));
           $em  = addslashes(strip_tags($_POST['email']));
           $ins  = addslashes(strip_tags($_POST['insta']));
           $open_close  = addslashes(strip_tags($_POST['open_close']));

          if($sn == ''){
           echo"<div class='alert alert-block alert-danger'>يجب إدخال إسم الموقع </div>";
           echo'<meta http-equiv="refresh" content="3; url=mainsetting.php" />';
		   
            }else{
            $sql = "UPDATE `mainsetting` SET 
            site_name = :site_name, 
            fb = :fb, 
            tw = :tw,  
            yt = :yt,  
            go = :go,  
            desc_site = :desc_site,  
            key_site = :key_site,  
            email = :email,
            insta = :insta,
            open_close = :open_close
            ";
            $UPD = $DB_con->prepare($sql);                                  
            $UPD->bindParam(':site_name', $sn, PDO::PARAM_STR);       
            $UPD->bindParam(':fb', $fb, PDO::PARAM_STR);    
            $UPD->bindParam(':tw', $tw, PDO::PARAM_STR); 
            $UPD->bindParam(':yt', $yt, PDO::PARAM_STR); 
            $UPD->bindParam(':go', $go, PDO::PARAM_STR); 
            $UPD->bindParam(':desc_site', $ds, PDO::PARAM_STR); 
            $UPD->bindParam(':key_site', $ks, PDO::PARAM_STR); 
            $UPD->bindParam(':email', $em, PDO::PARAM_STR); 
            $UPD->bindParam(':insta', $ins, PDO::PARAM_STR); 
            $UPD->bindParam(':open_close', $open_close, PDO::PARAM_STR); 
            $UPD->execute(); 

           echo"<div class='alert alert-block alert-success'>ثم تعديل البيانات بنجاح </div>";
           echo'<meta http-equiv="refresh" content="3; url=mainsetting.php" />';	   
            }
			
			
        }
        
?>
<div class='TitleTag'>إعدادات الموقع </div>

      <form class='rgt' action='' method='post' style='margin:10px;padding:10px;text-align:right;font-size:14px;'>
        <div class='rgt form-group' >
            <label for='inputEmail' >إسم الموقع </label>
            <input type='text' name='site_name' class='form-control' id='inputEmail' value='<?php echo"".$infos->site_name."";?>' style='width:450px;height:40px;border-radius:0px;text-align:right;'>
        </div>
        <div class='rgt form-group' style='margin-right:5px;'>
            <label for='inputPassword'>ايميل </label>
            <input type='email' name='email' class='form-control' id='inputPassword' value='<?php echo"".$infos->email."";?>' style='width:450px;height:40px;border-radius:0px;text-align:right;'>
        </div>

          <div class='rgt form-group'>
            <label for='inputEmail' >صفحة فيسبوك </label>
            <input type='text' name='fb' class='form-control' id='inputEmail' value='<?php echo"".$infos->fb."";?>' style='width:450px;height:40px;border-radius:0px;text-align:right;'>
        </div>

        <div class='rgt form-group' style='margin-right:5px;'>
            <label for='inputEmail' >صفحة تويتر </label>
            <input type='text' name='tw' class='form-control' id='inputEmail' value='<?php echo"".$infos->tw."";?>' style='width:450px;height:40px;border-radius:0px;text-align:right;'>
        </div>
          
        <div class='rgt form-group'>
            <label for='inputEmail' >Google+ صفحة </label>
            <input type='text' name='go' class='form-control' id='inputEmail' value='<?php echo"".$infos->go."";?>' style='width:450px;height:40px;border-radius:0px;text-align:right;'>
        </div>
          
        <div class='rgt form-group' style='margin-right:5px;'>
            <label for='inputEmail' >صفحة يوتيوب  </label>
            <input type='text' name='yt' class='form-control' id='inputEmail' value='<?php echo"".$infos->yt."";?>' style='width:450px;height:40px;border-radius:0px;text-align:right;'>
        </div>          
       <div class='clr'></div>
        <div class='rgt form-group'>
            <label for='inputEmail' >انستقرام</label>
            <input type='text' name='insta' class='form-control' id='inputEmail' value='<?php echo"".$infos->insta."";?>' style='width:450px;height:40px;border-radius:0px;text-align:right;'>
        </div>
        <div class='rgt form-group'  style='margin-right:5px;'>
            <label for='inputEmail' >حالة الموقع </label>
            <select name='open_close' class='form-control' style='width:450px;height:40px;border-radius:0px;text-align:right;'>
              <?php 
              if($infos->open_close == 1){
              echo'<option value="1">الموقع مفتوح </option>'; 
               echo'<option value="0">إغلاق الموقع  </option>';                      
              }else{
              echo'<option value="0">الموقع مغلق </option>';                  
              echo'<option value="1"> فتح الموقع</option>';                     
              }  
              ?>    
            </select>
        </div>             
       <div class='clr'></div>
        <div class='rgt form-group'>
            <label for='inputPassword'>وصف الموقع </label>
            <textarea name='desc_site' class='form-control' style='width:450px;height:160px;border-radius:0px;text-align:right;'><?php echo"".$infos->desc_site."";?></textarea>
        </div>

        <div class='rgt form-group' style='margin-right:5px;'>
            <label for='inputPassword'>كلمات المفتاحية</label>
            <textarea name='key_site' class='form-control' style='width:450px;height:160px;border-radius:0px;text-align:right;'><?php echo"".$infos->key_site."";?></textarea>
        </div>
        

        <div class='clr'></div>
        <input name='UpdateSetting' type='submit' class='rgt btn btn-primary' value='تعديل البيانات '>
    </form>


