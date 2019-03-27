<?php include "header.php"; include "session.php";
            if($userRow['type'] == 1 OR $userRow['type'] == 2){
            echo "<div class='alert alert-danger'>صفحة المطلوبة غير موجودة </div>"; 
            echo '<meta http-equiv="refresh" content="1; url=index.php"> '; 
            exit;
            }
?>

<div class='TitleTag'> قراءة الرسالة </div>

<table class="rgt table table-striped table-bordered" style='text-align:right;'>
    <thead>
        <?php
        if($_REQUEST['du'] == 'remov'){
          $gid = intval($_GET['id']);
          $DEL = $DB_con->prepare("DELETE FROM `message` WHERE id=:id");
          $DEL->bindParam(':id', $gid, PDO::PARAM_INT); 
          $DEL->execute();   
            
         echo"<br/><div class='alert alert-block alert-success'>ثم حذف الرسالة بنجاح </div>";
         echo'<meta http-equiv="refresh" content="3; url=message.php" />';
         exit;}
        
        $id = 0; //init
      if(isset($_GET['id']) && (int)$_GET['id'] > 0)
        {
        $id = (int)$_GET['id'];
          
          $main = $DB_con->prepare("SELECT * FROM `message` WHERE `id`=".$id."");
          $main->execute(); 
          $infos = $main->fetch(PDO::FETCH_OBJ);
          
            if(isset($_POST['send'])){
              
            $newPage['user_send']     = $_POST['user_send'];
            $newPage['user_receiver'] = $infos->username;
            $newPage['postid'] = $_POST['postid'];
            $newPage['msgtext']       = htmlspecialchars(strip_tags($_POST['msg']));

            $tablename = "usermessage";

            if($newPage['msgtext'] == ''){
            echo '<div class="alert alert-danger">رسالة فارغة </div>';
            }else{
                try{
                include '../models/Add.php';
                $message = new Add($DB_con);
                $addNewMessage = $message->AddData($newPage,$tablename);

                if($addNewMessage){
                 echo '<div class="alert alert-success">ثم إرسال الرسالة  بنجاح </div>';
                 echo'<meta http-equiv="refresh" content="5; url=usermessage.php">';

                exit;}

                }catch (Exception $exc){
                  echo $exc->getMessage();
                }
          }
          }
          
            if($infos <= ''){
                 echo"<div class='alert alert-block alert-danger'>لا توجد أي رسالة </div>";
                 echo'<meta http-equiv="refresh" content="3; url=message.php" />';
            exit;}

            echo"
      <tr>
            <th style='text-align:right;color:#01A3EE;'>رقم الرسالة </th>
            <th style='text-align:right;color:#01A3EE;'>صاحب الرسالة </th>
            <th style='text-align:right;color:#01A3EE;'>موضوع الرسالة </th>
            <th style='text-align:right;color:#01A3EE;'>البريد الإلكتروني </th>
            <th style='text-align:right;color:#01A3EE;'>تاريخ الرسالة </th>



      </tr>
            <tr>
            <th style='text-align:right;'>".$infos->id."</th>
            <th style='text-align:right;'>".$infos->fullname."</th>
            <th style='text-align:right;'>".$infos->subject." </th>
            <th style='text-align:right;'>".$infos->email." </th>
            <th style='text-align:right;'>".$infos->datemsg."</th>



      </tr>
    </thead>
  </table>
    <div class='clr'></div>
    <div style='padding:5px;text-align:center;width:700px;margin:auto;'>".$infos->msg."</div>
    <div class='clr'></div>
    <hr/>
    <a class='lft btn btn-danger' href='?du=remov&id=".$infos->id."'>حذف الرسالة </a>
    ";
          } 
 ?>