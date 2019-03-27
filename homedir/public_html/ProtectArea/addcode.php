<?php include "header.php"; include "session.php";
        if($userRow['type'] == 1 OR $userRow['type'] == 2){
            echo "<div class='alert alert-danger'>صفحة المطلوبة غير موجودة </div>"; 
            echo '<meta http-equiv="refresh" content="1; url=index.php"> '; 
            exit;
            }
      if(isset($_POST['Add'])){

        $newPage['codenumber']   = htmlspecialchars(strip_tags($_POST['codenumber']));
        $newPage['codelink']   = htmlspecialchars(strip_tags($_POST['codelink']));
 

        $tablename = "code";
          
        if($newPage['codelink'] == '' OR $newPage['codenumber'] == ''){
        echo '<div class="alert alert-danger">المرجو ملء جميع البيانات </div>';
        }else{
            try{
            include '../models/Add.php';
            $admins = new Add($DB_con);
            $addNewUser = $admins->AddData($newPage,$tablename);

            if($addNewUser){
             echo '<div class="alert alert-success">ثم إضافة الشرح  بنجاح </div>';
            }

            }catch (Exception $exc){
              echo $exc->getMessage();
            }
      }
      }
        
?>
<div class='TitleTag'>إعدادات الموقع </div>

      <form class='rgt' action='addcode.php' method='post' style='margin:10px;padding:10px;text-align:right;font-size:14px;'>
        <div class='rgt form-group' >
            <label for='inputEmail' >رقم الشرح  </label>
            <input type='text' name='codenumber' class='form-control' id='inputEmail' style='width:450px;height:40px;border-radius:0px;text-align:right;'>
        </div>
          
        <div class='rgt form-group' style='margin-right:5px;'>
            <label for='inputEmail' >رابط الشرح  </label>
            <input type='text' name='codelink' class='form-control' id='inputEmail' style='width:450px;height:40px;border-radius:0px;text-align:right;'>
        </div>          
          <div class='clr'></div>          

        <input name='Add' type='submit' class='rgt btn btn-primary' value='أضف الشرح  '>
    </form>
    <div class='clr'></div>

<table class="rgt table table-striped table-bordered" style='text-align:right;'>
    <thead>
      <tr>
            <th style='text-align:right;'>#</th>
            <th style='text-align:right;width:200px;'>رقم الشرح  </th>
            <th style='text-align:right;width:500px;'>رابط الشرح   </th>
            <th style='text-align:right;'>تعديل  </th>
            <th style='text-align:right;'>حذف   </th>


      </tr>
    </thead>
    <tbody>
        <?php
        if($_REQUEST['du'] == 'remov'){
          $gid = intval($_GET['id']);
          $DEL = $DB_con->prepare("DELETE FROM `code` WHERE id=:id");
          $DEL->bindParam(':id', $gid, PDO::PARAM_INT); 
          $DEL->execute();   
            
         echo"<br/><div class='alert alert-block alert-success'>ثم حذف الشرح </div>";
         echo'<meta http-equiv="refresh" content="1; url=addcode.php" />';
         exit;}

          $stmt = $DB_con->prepare("SELECT * FROM `code` ORDER BY `id` DESC");
          $stmt->execute();   
          foreach ($stmt->fetchAll() as $row) {   
          echo"
            <tr style='background:#e5e5e5;'>
             <td>".$row['id']." </td>
             <td style='font-size:17px;color:#1F2833;'>".$row['codenumber']."</td>
             <td style='font-size:17px;color:#1F2833;'>".$row['codelink']."</td>
             <td style='font-size:17px;color:#1F2833;'><a href='editcode.php?id=".$row['id']."' class='btn btn-xs btn-success' style='width:100px;border-radius:0px;padding:5px;'>تعديل القسم  </a>
             </td>
             <td>
             <a href='?du=remov&id=".$row['id']."' class='btn btn-xs btn-danger' style='width:100px;border-radius:0px;padding:5px;'>حذف  </a></tdالقسم 
            </tr>
            ";
              
            }
        
        ?>
            

    </tbody>
  </table>

