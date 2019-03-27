<?php include '../models/dbconfig.php'; include "session.php";

    $user_id = $_SESSION['user_session'];
    $stmt = $DB_con->prepare("SELECT * FROM admins WHERE id=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en"> <!--<![endif]-->
<head>
<meta http-equiv="content-type" content='text/html; charset=utf-8' />
<title>Panel</title>
    <link rel="stylesheet" href="styles/admincp.css" type='text/css'/>
    <link rel="stylesheet" href="css/bootstrap.css" />
	<link rel="stylesheet" href="../css/bootstrap-responsive.css" />
	<link rel="stylesheet" href="../css/custom.css" />
	<link rel="stylesheet" href="../css/styles.css" />
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="tinymce/tinymce.min.js"></script>


</head>
    


<body style='background:#F1F2F7;'>
   <table align='center' cellpadding='5' cellspacing='5'>
   <tr>       
     <td class='rgt rpanel'>
    <div class='rgt info' style='background:#01A3EE;width:240px;height:80px;text-align:right;'>
       <div class='rgt' style='width:90px;padding:5px;'><img src='../images/Microsoft_Alt.png' style='width:70px;'/></div>  
       <div class='rgt' style='width:120px;margin-top:10px;'>
        <p style='font-family:JF Flat Regular;font-size:18px;color:white;'><?php echo $userRow['username']; ?></p>
        <p class='rgt' style='font-family:JF Flat Regular;font-size:13px;color:white;'>مدير الموقع</p>
           <div class='clr'></div>
        <div class='lft' style='font-size:25px;color:#00638E;margin-top:-30px;margin-left:-20px;'><a href='logout.php'><span class="glyphicon glyphicon-off"></span></a></div>
       </div>
     </div>
         <div class='clr'></div>
   <?php if($userRow['type'] == 3){ ?>
   <div class="list-group" style="text-align:right;border-color:#1f2833;">
    <a class="list-group-item" id="itemMenu" style="background:#1f2833;color:white;">إعدادات الرئيسية</a>
    <a href="index.php" class="list-group-item" id="itemMenu"><span class="glyphicon glyphicon-home"></span> رئيسية الموقع </a>
    <a href="addusers.php" class="list-group-item" id="itemMenu"><span class="glyphicon glyphicon-user"></span> إضافة مشرفين  </a>
    <a href="mainsetting.php" class="list-group-item" id="itemMenu"><span class="glyphicon glyphicon-cog"></span> إعدادات الموقع </a>
    <a href="privacy.php" class="list-group-item" id="itemMenu"><span class="glyphicon glyphicon-bookmark"></span> سياسة الخصوصية </a>
    <a href="termspost.php" class="list-group-item" id="itemMenu"><span class="glyphicon glyphicon-bookmark"></span> سياسة النقل  </a>
    <a href="terms.php" class="list-group-item" id="itemMenu"><span class="glyphicon glyphicon-bookmark"></span> شروط الإستخدام </a>
    <a href="aboutus.php" class="list-group-item" id="itemMenu"><span class="glyphicon glyphicon-question-sign"></span> من نحن ؟ </a>
    <a href="adspanel.php" class="list-group-item" id="itemMenu"><span class="glyphicon glyphicon-bullhorn"></span> إدارة الإعلانات  </a>
    <a href="message.php" class="list-group-item" id="itemMenu" style="color:#f1c40f;"><span class="glyphicon glyphicon-envelope"></span> رسائل الزوار (0)</a>
   </div>
    
    <div class="list-group" style='text-align:right;border-color:#1f2833;'>
    <a class="list-group-item" id='itemMenu' style='background:#1f2833;color:white;'>الأقسام و تصنيفات </a>
    <a href="addcat.php" class="list-group-item" id='itemMenu'><span class="glyphicon glyphicon-th-list"></span> إضافة قسم جديد </a>
   </div>  
         
    <div class="list-group" style='text-align:right;border-color:#1f2833;'>
    <a class="list-group-item" id='itemMenu' style='background:#1f2833;color:white;'>إضافة كود جديد  </a>
    <a href="addcode.php" class="list-group-item" id='itemMenu'><span class="glyphicon glyphicon-th-list"></span> أضف كود جديد </a>
   </div>      
    <?php } ?>       
    <div class="list-group" style='text-align:right;border-color:#1f2833;'>
    <a class="list-group-item" id='itemMenu' style='background:#1f2833;color:white;'>إضافة المواضيع</a>
    <a href="newpost.php" class="list-group-item" id='itemMenu'><span class="glyphicon glyphicon-th-list"></span> إضافة موضوع جديد  </a>
    <a href="newreview.php" class="list-group-item" id='itemMenu'><span class="glyphicon glyphicon-th-list"></span> إضافة مراجعة أو تغطية </a>
    <a href="allpost.php" class="list-group-item" id='itemMenu'><span class="glyphicon glyphicon-th-list"></span> تعديل المواضيع  </a>
   </div>           

    <div class="list-group" style='text-align:right;border-color:#1f2833;'>
    <a class="list-group-item" id='itemMenu' style='background:#1f2833;color:white;'>الدعم الفني  </a>
    <a href="#" class="list-group-item" id='itemMenu' style="color:#f1c40f;"><span class="glyphicon glyphicon-warning-sign"></span> مراسلة المبرمج </a>
   </div>  

     </td>

     <td valign='top' class='rgt cpanel' style='width:1000px;background:#FDFDFD;'>