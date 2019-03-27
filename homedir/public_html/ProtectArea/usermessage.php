<?php include "header.php"; include "session.php";
            if($userRow['type'] == 1 OR $userRow['type'] == 2){
            echo "<div class='alert alert-danger'>صفحة المطلوبة غير موجودة </div>"; 
            echo '<meta http-equiv="refresh" content="1; url=index.php"> '; 
            exit;
            }
?>

<div class='TitleTag'>رسائل الأعضاء   </div>

<table class="rgt table table-striped table-bordered" style='text-align:right;'>
    <thead>
      <tr>
            <th style='text-align:right;'>#</th>
            <th style='text-align:right;'>صاحب الرسالة </th>
            <th style='text-align:right;width:300px;'>موضوع الرسالة </th>
            <th style='text-align:right;'>تاريخ الرسالة </th>
            <th style='text-align:right;'>فتح الرسالة </th>




      </tr>
    </thead>
    <tbody>
        <?php

            $MSG = $DB_con->prepare("SELECT * FROM `message` WHERE `status`=1 ORDER BY id");
            $MSG->execute();   
            foreach ($MSG->fetchAll() as $row) {
             echo"  
      <tr>
        <td>".$row['id']." </td>
        <td>".$row['fullname']."</td>
        <td>".$row['subject']." </td>
        <td>".$row['datemsg']." </td>
        <td><a href='readmsg.php?id=".$row['id']."' class='btn btn-xs btn-primary' style='width:100px;border-radius:0px;padding:5px;'>قراءة الرسالة </a></td>

      </tr>
        ";
        }
            ?>
            

    </tbody>
  </table>
