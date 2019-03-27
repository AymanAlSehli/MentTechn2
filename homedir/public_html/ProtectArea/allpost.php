<?php include "header.php"; include "session.php";

?>

<div class='TitleTag'>جميع الإعلانات </div>
</br>
<div class="input-group" style='width:800px;'> 
    <input id="filter" type="text" class="form-control" placeholder="البحث ...">
</div>
</br>
<table class="rgt table table-striped table-bordered" style='text-align:right;'>
    <thead>
      <tr>
            <th style='text-align:right;color:#01A3EE;width:70px;'>#</th>
            <th style='text-align:right;width:450px;color:#01A3EE;'>عنوان الموضوع  </th>
            <th style='text-align:right;color:#01A3EE;width:110px;'>كاتب   </th>
            <th style='text-align:right;color:#01A3EE;width:110px;'>تصنيف  </th>
            <th style='text-align:right;color:#01A3EE;width:150px;'>تاريخ الإضافة  </th>
            <th style='text-align:right;color:#01A3EE;width:120px;'>تعديل   </th>
            <th style='text-align:right;color:#01A3EE;width:120px;'>تعديل   </th>
      </tr>
    </thead>
    
    <tbody class='searchable'>
    <?php
        if($_REQUEST['du'] == 'remov'){
          $gid = intval($_GET['id']);
          $DEL = $DB_con->prepare("DELETE FROM `post` WHERE id=:id");
          $DEL->bindParam(':id', $gid, PDO::PARAM_INT); 
          $DEL->execute();   
            
         echo"<br/><div class='alert alert-block alert-success'>ثم حذف الموضوع </div>";
         echo'<meta http-equiv="refresh" content="1; url=allpost.php" />';
         exit;}
           if($userRow['type'] == 1){
            $ADS = $DB_con->prepare("SELECT * FROM `post` WHERE `users`=".$userRow['id']." ORDER BY id DESC");
            $ADS->execute();    
           }else{
            $ADS = $DB_con->prepare("SELECT * FROM `post` ORDER BY id DESC");
            $ADS->execute();               
           }

        
            foreach ($ADS->fetchAll() as $row) {
             $mainCat = $DB_con->prepare("SELECT * FROM `category` WHERE `id`=".$row['catid']."");
             $mainCat->execute(); 
             $infosCat = $mainCat->fetch(PDO::FETCH_OBJ);
                
             $infosU = $DB_con->prepare("SELECT * FROM `admins` WHERE `id`=".$row['users']."");
             $infosU->execute(); 
             $infosUU = $infosU->fetch(PDO::FETCH_OBJ);                  
            echo"
          <tr>
            <td style='font-size:13px;'>".$row['id']." </td>
            <td style='font-size:13px;'>".$row['title']."</td>
            <td style='font-size:13px;'>".$infosUU->username." </td>
            <td style='font-size:13px;'>".$infosCat->catname." </td>
            <td style='font-size:13px;'>".$row['time']." </td>
            <td><a href='editpost.php?id=".$row['id']."' class='btn btn-xs btn-primary' style='width:80px;border-radius:0px;padding:5px;'>تعديل </a></td>
            <td><a href='?du=remov&id=".$row['id']."' class='btn btn-xs btn-danger' style='width:80px;border-radius:0px;padding:5px;'>حذف  </a></td>
          </tr>

            ";
            }
            ?>
      </tr>
    </tbody>
  </table>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function () {

        (function ($) {

            $('#filter').keyup(function () {

                var rex = new RegExp($(this).val(), 'i');
                $('.searchable tr').hide();
                $('.searchable tr').filter(function () {
                    return rex.test($(this).text());
                }).show();

            })

        }(jQuery));

    });
    </script>    