<?php include "header.php"; include "session.php";
            if($userRow['type'] == 1 OR $userRow['type'] == 2){
            echo "<div class='alert alert-danger'>صفحة المطلوبة غير موجودة </div>"; 
            echo '<meta http-equiv="refresh" content="1; url=index.php"> '; 
            exit;
            }
          $main = $DB_con->prepare("SELECT * FROM `adspanel`");
          $main->execute(); 
          $infos = $main->fetch(PDO::FETCH_OBJ);


        if(isset($_POST['UpdateSetting'])){
    
           $ads1  = $_POST['bigads'];
           $ads2  = $_POST['smallads'];
           $ban1  = $_POST['banner1'];
           $ban2  = $_POST['banner2'];

            $sql = "UPDATE `adspanel` SET 
            bigads = :bigads, 
            smallads = :smallads,  
            banner1 = :banner1,  
            banner2 = :banner2";
            $UPD = $DB_con->prepare($sql);                                  
            $UPD->bindParam(':bigads', $ads1, PDO::PARAM_STR);       
            $UPD->bindParam(':smallads', $ads2, PDO::PARAM_STR);       
            $UPD->bindParam(':banner1', $ban1, PDO::PARAM_STR);       
            $UPD->bindParam(':banner2', $ban2, PDO::PARAM_STR);       
            $UPD->execute(); 

           echo"<div class='alert alert-block alert-success'>ثم تعديل البيانات بنجاح </div>";
           echo'<meta http-equiv="refresh" content="3; url=adspanel.php" />';	   
            
			
			
        }
        
?>

<div class='TitleTag'>إعلانات الموقع </div>

      <form class='rgt' action='' method='post' style='margin:10px;padding:10px;text-align:right;font-size:14px;'>
        <div class='rgt form-group'>
            <label for='inputPassword'>728x90 إعلانات أدسنس </label>
            <textarea name='bigads' class='form-control' style='width:450px;height:160px;border-radius:0px;'><?php echo"".$infos->bigads.""; ?></textarea>
        </div>

        <div class='rgt form-group' style='margin-right:5px;'>
            <label for='inputPassword'>468x60 إعلانات أدسنس </label>
            <textarea name='smallads' class='form-control' style='width:450px;height:160px;border-radius:0px;'><?php echo"".$infos->smallads.""; ?></textarea>
        </div>
          
        <div class='rgt form-group' style='margin-right:5px;'>
            <label for='inputPassword'> تبادل الإعلاني 1</label>
            <textarea name='banner1' class='form-control' style='width:450px;height:80px;border-radius:0px;'><?php echo"".$infos->banner1.""; ?></textarea>
        </div>
          
        <div class='rgt form-group' style='margin-right:5px;'>
            <label for='inputPassword'> تبادل الإعلاني  2</label>
            <textarea name='banner2' class='form-control' style='width:450px;height:80px;border-radius:0px;'><?php echo"".$infos->banner2.""; ?></textarea>
        </div>
        

        <div class='clr'></div>
        <input name='UpdateSetting' type='submit' class='rgt btn btn-primary' value='تعديل البيانات '>
    </form>

