<?php include "header.php"; include "session.php";
        if($userRow['type'] == 1 OR $userRow['type'] == 2){
            echo "<div class='alert alert-danger'>صفحة المطلوبة غير موجودة </div>"; 
            echo '<meta http-equiv="refresh" content="1; url=index.php"> '; 
            exit;
            }
      if(isset($_POST['Add'])){

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
              $newPage['image'] = '';      
              }    

        $tablename = "category";
          
        if($newPage['catname'] == ''){
        echo '<div class="alert alert-danger">المرجو ملء جميع البيانات </div>';
        }else{
            try{
            include '../models/Add.php';
            $admins = new Add($DB_con);
            $addNewUser = $admins->AddData($newPage,$tablename);

            if($addNewUser){
             echo '<div class="alert alert-success">ثم إضافة القسم  بنجاح </div>';
            }

            }catch (Exception $exc){
              echo $exc->getMessage();
            }
      }
      }
        
?>
<div class='TitleTag'>إعدادات الموقع </div>

      <form class='rgt' action='addcat.php' method='post' style='margin:10px;padding:10px;text-align:right;font-size:14px;' enctype="multipart/form-data">
        <div class='rgt form-group' >
            <label for='inputEmail' >إسم القسم </label>
            <input type='text' name='catname' class='form-control' id='inputEmail' style='width:450px;height:40px;border-radius:0px;text-align:right;'>
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
        <input name='Add' type='submit' class='rgt btn btn-primary' value='أضف القسم  '>
    </form>
    <div class='clr'></div>

<table class="rgt table table-striped table-bordered" style='text-align:right;'>
    <thead>
      <tr>
            <th style='text-align:right;'>#</th>
            <th style='text-align:right;width:400px;'>إسم القسم </th>
            <th style='text-align:right;width:250px;'>صورة القسم  </th>
            <th style='text-align:right;'>تعديل القسم </th>
            <th style='text-align:right;'>حذف القسم  </th>


      </tr>
    </thead>
    <tbody>
        <?php
        if($_REQUEST['du'] == 'remov'){
          $gid = intval($_GET['id']);
          $DEL = $DB_con->prepare("DELETE FROM `category` WHERE id=:id");
          $DEL->bindParam(':id', $gid, PDO::PARAM_INT); 
          $DEL->execute();   
            
         echo"<br/><div class='alert alert-block alert-success'>ثم حذف القسم </div>";
         echo'<meta http-equiv="refresh" content="1; url=addcat.php" />';
         exit;}

          $stmt = $DB_con->prepare("SELECT * FROM `category` ORDER BY `id` DESC");
          $stmt->execute();   
          foreach ($stmt->fetchAll() as $row) {   
          echo"
            <tr style='background:#e5e5e5;'>
             <td>".$row['id']." </td>
             <td style='font-size:17px;color:#1F2833;'>".$row['catname']."</td>
             <td style='font-size:15px;color:#1F2833;text-align:center;'>
             <img src='../imagespost/".$row['image']."' style='width:30px;'/></td>
             <td>
             <a href='editcat.php?id=".$row['id']."' class='btn btn-xs btn-success' style='width:100px;border-radius:0px;padding:5px;'>تعديل القسم  </a>
             </td>
             <td>
             <a href='?du=remov&id=".$row['id']."' class='btn btn-xs btn-danger' style='width:100px;border-radius:0px;padding:5px;'>حذف  </a></tdالقسم 
            </tr>
            ";
              
            }
        
        ?>
            

    </tbody>
  </table>

