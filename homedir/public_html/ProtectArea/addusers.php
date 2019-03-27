<?php include "header.php"; include "session.php";
            if($userRow['type'] == 1 OR $userRow['type'] == 2){
            echo "<div class='alert alert-danger'>صفحة المطلوبة غير موجودة </div>"; 
            echo '<meta http-equiv="refresh" content="1; url=index.php"> '; 
            exit;
            }
      if(isset($_POST['Add'])){

        $newPage['username']   = htmlspecialchars(strip_tags($_POST['username']));
        $newPage['password']   = md5(htmlspecialchars(strip_tags($_POST['password'])));
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
            $newPage['image'] = '';
            } 
                        
          }else{
          $newPage['image'] = '';      
          }  

        $tablename = "admins";
          
        if($newPage['username'] == '' or $newPage['password'] == ''){
        echo '<div class="alert alert-danger">المرجو ملء جميع البيانات </div>';
        }else{
            try{
            include '../models/Add.php';
            $admins = new Add($DB_con);
            $addNewUser = $admins->AddData($newPage,$tablename);

            if($addNewUser){
             echo '<div class="alert alert-success">ثم إضافة المدير بنجاح </div>';
            }

            }catch (Exception $exc){
              echo $exc->getMessage();
            }
      }
      }
        
?>
<div class='TitleTag'>إعدادات الموقع </div>

      <form class='rgt' action='addusers.php' method='post' style='margin:10px;padding:10px;text-align:right;font-size:14px;' enctype="multipart/form-data">
        <div class='rgt form-group' >
            <label for='inputEmail' >إسم العضوية</label>
            <input type='text' name='username' class='form-control' id='inputEmail' style='width:400px;height:40px;border-radius:0px;text-align:right;'>
        </div>
        <div class='rgt form-group' style='margin-right:5px;'>
            <label for='inputPassword'>كلمة السر  </label>
            <input type='password' name='password' class='form-control' id='inputPassword' style='width:400px;height:40px;border-radius:0px;text-align:right;'>
        </div>
        <div class='clr'></div>
        <div class='rgt form-group' >
            <label for='inputEmail' >الإيميل</label>
            <input type='email' name='email' class='form-control' id='inputEmail' style='width:400px;height:40px;border-radius:0px;text-align:right;'>
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
            <input type='text' name='siteweb' class='form-control' style='width:400px;height:40px;border-radius:0px;text-align:right;'>
        </div>
        <div class='rgt form-group' style='margin-right:5px;'>
            <label for='inputPassword'>صفحة الفيسبوك  </label>
            <input type='text' name='fblink' class='form-control' style='width:400px;height:40px;border-radius:0px;text-align:right;'>
        </div>
        <div class='clr'></div> 
        <div class='rgt form-group' >
            <label for='inputEmail' >صفحة التويتر </label>
            <input type='text' name='twlink' class='form-control' style='width:400px;height:40px;border-radius:0px;text-align:right;'>
        </div>
        <div class='rgt form-group' style='margin-right:5px;'>
            <label for='inputPassword'>صفحة جوجل  </label>
            <input type='text' name='golink' class='form-control' style='width:400px;height:40px;border-radius:0px;text-align:right;'>
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
                <textarea name='desce' class='form-control' rows="5" style='border-radius:0px;text-align:right;'></textarea>
              </div>
               
              </div>            
              </div>                   
        <div class='clr'></div>
        <input name='Add' type='submit' class='rgt btn btn-primary' value='أضف العضو  '>
    </form>
    <div class='clr'></div>

<table class="rgt table table-striped table-bordered" style='text-align:center;'>
    <thead>
      <tr style='background:#1f69a5;color:white;'>
            <th style='text-align:center;'>#</th>
            <th style='text-align:center;'>إسم العضو</th>
            <th style='text-align:center;'>البريد الإلكتروني</th>
            <th style='text-align:center;'>نوع العضوية</th>
            <th style='text-align:center;'>حذف العضو </th>
      </tr>
    </thead>
    <tbody>
        <?php
        if($_REQUEST['du'] == 'remov'){
          $gid = intval($_GET['id']);
          $DEL = $DB_con->prepare("DELETE FROM `admins` WHERE id=:id");
          $DEL->bindParam(':id', $gid, PDO::PARAM_INT); 
          $DEL->execute();   
            
         echo"<br/><div class='alert alert-block alert-success'>ثم حذف العضو</div>";
         echo'<meta http-equiv="refresh" content="3; url=addusers.php" />';
         exit;}

          $stmt = $DB_con->prepare("SELECT * FROM `admins` ORDER BY id");
          $stmt->execute();   
          foreach ($stmt->fetchAll() as $row) {
            echo"
              <tr>
                <td>".$row['id']." </td>
                <td>".$row['username']."</td>
                <td>".$row['email']."</td>
                <td>";
                if($row['type'] == 1){
                echo '<span class="label label-success" style="font-size:12px;padding:5px;">محرر مواضيع </span>';    
                }elseif($row['type'] == 2){
                echo '<span class="label label-danger" style="font-size:12px;padding:5px;">مشرف عام </span>';   
                }else{
                echo '<span class="label label-primary" style="font-size:12px;padding:5px;"> مدير عام </span>';   
                }
                echo"</td>
                <td>
                
                <a href='editadmin.php?id=".$row['id']."' class='btn btn-xs btn-success' style='width:100px;border-radius:0px;padding:5px;'>تعديل العضو </a>                
                <a href='?du=remov&id=".$row['id']."' class='btn btn-xs btn-danger' style='width:100px;border-radius:0px;padding:5px;'>حذف العضو </a>
                
                </td>


              </tr>
        ";
            }
        
        ?>
            

    </tbody>
  </table>

