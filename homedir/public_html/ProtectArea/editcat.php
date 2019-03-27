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
          $main = $DB_con->prepare("SELECT * FROM `category` WHERE `id`=".$id."");
          $main->execute(); 
          $infos = $main->fetch(PDO::FETCH_OBJ);
          $count = $main->rowCount();
            
            if($count == 0){
            echo "<div class='alert alert-danger'>صفحة المطلوبة غير موجودة </div>"; 
            echo '<meta http-equiv="refresh" content="1; url=addcat.php"> '; 
            exit;}else{

      if(isset($_POST['Edit'])){

        $newPage['catname']   = htmlspecialchars(strip_tags($_POST['catname']));
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
                $newPage['image'] = '';
                } 

              }else{
              $newPage['image'] = ''.$infos->image.'';      
              } 
          
        $tablename = "category";
          
        if($newPage['catname'] == ''){
        echo '<div class="alert alert-danger">المرجو ملء جميع البيانات </div>';
        }else{
            $sql = "UPDATE `category` SET  
            catname = :catname,
            image = :image
            WHERE `id`=".$id."
            ";
            $UPD = $DB_con->prepare($sql);                                  
            $UPD->bindParam(':catname', $newPage['catname'], PDO::PARAM_STR);              
            $UPD->bindParam(':image', $newPage['image'], PDO::PARAM_STR);              
            $UPD->execute(); 

           echo"<div class='alert alert-block alert-success'>ثم تعديل البيانات بنجاح </div>";
           echo'<meta http-equiv="refresh" content="3; url=addcat.php" />';
      exit;}
            }
            }
        
?>
<div class='TitleTag'>إعدادات الموقع </div>

      <form class='rgt' action='' method='post' style='margin:10px;padding:10px;text-align:right;font-size:14px;' enctype="multipart/form-data">
        <div class='rgt form-group' >
            <label for='inputEmail' >إسم القسم </label>
            <input type='text' name='catname' class='form-control' id='inputEmail' value='<?php echo"".$infos->catname.""; ?>' style='width:450px;height:40px;border-radius:0px;text-align:right;'>
        </div>          
        <div class='clr'></div>
               <div class="panel panel-default" style='width:450px;border-radius:0px;text-align:right;'>
              <div class="panel-heading">أيقونة القسم  </div>
              <div class="panel-body">                
                  
              <div class="form-group">
                <input type="file" name='image[]' id="exampleInputFile" multiple>
                <p class="help-block"> من نوع (png - jpg - gif - jpeg)</p>
              </div>
               
              </div>            
              </div>           
        <div class='clr'></div>
        <input name='Edit' type='submit' class='rgt btn btn-primary' value='أضف القسم  '>
    </form>
    <div class='clr'></div>

<?php
                
        }else{
    echo "<div class='alert alert-danger'>صفحة المطلوبة غير موجودة </div>";    
    } 
?>