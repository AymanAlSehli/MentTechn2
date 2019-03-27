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
          $main = $DB_con->prepare("SELECT * FROM `code` WHERE `id`=".$id."");
          $main->execute(); 
          $infos = $main->fetch(PDO::FETCH_OBJ);
          $count = $main->rowCount();
            
            if($count == 0){
            echo "<div class='alert alert-danger'>صفحة المطلوبة غير موجودة </div>"; 
            echo '<meta http-equiv="refresh" content="1; url=addcode.php"> '; 
            exit;}else{
      if(isset($_POST['Edit'])){

        $newPage['codenumber']   = htmlspecialchars(strip_tags($_POST['codenumber']));
        $newPage['codelink']   = htmlspecialchars(strip_tags($_POST['codelink']));
 

        $tablename = "code";
          
        if($newPage['codelink'] == '' OR $newPage['codenumber'] == ''){
        echo '<div class="alert alert-danger">المرجو ملء جميع البيانات </div>';
        }else{
            $sql = "UPDATE `code` SET  
            codenumber = :codenumber,
            codelink = :codelink
            WHERE `id`=".$id."
            ";
            $UPD = $DB_con->prepare($sql);                                  
            $UPD->bindParam(':codenumber', $newPage['codenumber'], PDO::PARAM_STR);              
            $UPD->bindParam(':codelink', $newPage['codelink'], PDO::PARAM_STR);              
            $UPD->execute(); 

           echo"<div class='alert alert-block alert-success'>ثم تعديل البيانات بنجاح </div>";
           echo'<meta http-equiv="refresh" content="3; url=addcode.php" />';
      exit;}
      }
     }
        
?>
<div class='TitleTag'>إعدادات الموقع </div>

      <form class='rgt' action='' method='post' style='margin:10px;padding:10px;text-align:right;font-size:14px;'>
        <div class='rgt form-group' >
            <label for='inputEmail' >رقم الشرح  </label>
            <input type='text' name='codenumber' class='form-control' value='<?php echo"".$infos->codenumber.""; ?>' style='width:450px;height:40px;border-radius:0px;text-align:right;'>
        </div>
          
        <div class='rgt form-group' style='margin-right:5px;'>
            <label for='inputEmail' >رابط الشرح  </label>
            <input type='text' name='codelink' class='form-control' value='<?php echo"".$infos->codelink.""; ?>' style='width:450px;height:40px;border-radius:0px;text-align:right;'>
        </div>          
          <div class='clr'></div>          

        <input name='Edit' type='submit' class='rgt btn btn-primary' value='أضف الشرح  '>
    </form>


<?php
                
        }else{
    echo "<div class='alert alert-danger'>صفحة المطلوبة غير موجودة </div>";    
    } 
?>
