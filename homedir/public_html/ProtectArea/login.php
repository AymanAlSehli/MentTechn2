<!DOCTYPE html>
<html lang="en"> 
<head>
<meta http-equiv="content-type" content='text/html; charset=utf-8' />
<title>Panel</title>
    <link rel="stylesheet" href="styles/admincp.css" type='text/css'/>
    <link rel="stylesheet" href="../css/bootstrap-arabic.css" />
	<link rel="stylesheet" href="../css/bootstrap-arabic.min.css" />
	<link rel="stylesheet" href="../css/custom.css" />
	<link rel="stylesheet" href="../css/styles.css" />
 

</head>

<body style='background:#FAFAFA;'>

   <table align='center' cellpadding='5' cellspacing='5' style='width:500px;margin:auto;'>
   <tr>
     <td class='cpanel'>
     <div class='TitleTag'>إدارة الموقع </div>
	 
<?php

      // animepanel 
      include '../models/dbconfig.php'; 

      if(isset($_POST['login'])){
      $username = addslashes(strip_tags($_POST['username']));
      $password = md5($_POST['password']);

      if($username == '' or $password == ''){
			echo"<div class='alert alert-block alert-danger'>الإسم أو كلمة السر خاطئة </div>";
      }else{
        $stmt = $DB_con->prepare("SELECT * FROM `admins` WHERE `email`=:username AND `password`=:password");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);       
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);      
        $stmt->execute();
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);  
          
        $count = $stmt->rowCount();
		 
        if($count == 1){
            
         $_SESSION['user_session'] = $userRow['id'];
         @setcookie("user_session",$userRow['id'],time()+50000);

			echo"<div class='alert alert-block alert-success'>مرحبا ثم تسجيل الدخول بنجاح </div>";
			echo'<meta http-equiv="refresh" content="2; url=index.php" />';
			exit;


        }else{

			echo"<div class='alert alert-block alert-danger'>الإسم أو كلمة السر خاطئة </div>";
			echo'<meta http-equiv="refresh" content="2; url=login.php" />';
			exit;
        }
      }

    }

         ?>	
         
         
      <form class='rgt' action='login.php' method='post' dir='ltr' style='margin:10px;width:500px;'>
  
      <div class='rgt form-group' style='margin-right:5px;'>
            <label for='inputEmail' >إسم المستخدم أو الإيميل </label>
            <input type='text' name='username' class='form-control' id='inputEmail' style='width:450px;height:40px;border-radius:0px;'>
        </div>
         <div class='clr'></div>
        <div class='rgt form-group' style='margin-right:5px;'>
            <label for='inputEmail' >كلمة السر </label>
            <input type='password' name='password' class='form-control' id='inputEmail' style='width:450px;height:40px;border-radius:0px;'>
        </div>

        <div class='clr'></div>
        <input name='login' type='submit' class='lft btn btn-success' value='أدخل '>
    </form>





          </td>
   </tr>
   </table>
</body>
</html>