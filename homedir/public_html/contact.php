<?php include 'header.php'; ?>
<div class="row">
    <div class='rgt col-md-2'>
    <div class="list-group" style='border-radius:0px;'>
      <a href="#" class="rwabet list-group-item active" style='border-color:#2C3E50;border-radius:0px;background:#2C3E50;'>
        روابط مهمة 
      </a>
      <a href="aboutus.php" class="list-group-item">عن الموقع </a>
      <a href="terms.php" class="list-group-item">سياسة الخصوصية </a>
      <a href="termscopy.php" class="list-group-item">سياسة النقل  </a>        
      <a href="privacy.php" class="list-group-item">قوانين الموقع </a>
      <a href="contact.php" class="list-group-item">إتصل بنا </a>
    </div>
    </div>    
    <div class='rgt col-md-7'>
    <?php 


      if(isset($_POST['Add'])){
          
        $newPage['fullname']  = htmlspecialchars(strip_tags($_POST['fullname']));
        $newPage['email']     = htmlspecialchars(strip_tags($_POST['email']));
        $newPage['subject']   = htmlspecialchars(strip_tags($_POST['subject']));
        $newPage['msg']       = htmlspecialchars(strip_tags($_POST['msg']));

        $tablename = "message";
          
        if($newPage['fullname'] == '' or $newPage['email']  == '' or $newPage['msg'] == ''){
        echo '<div class="alert alert-danger">المرجو ملء جميع البيانات </div>';
        }elseif(!preg_match("/^[_a-zA-Z0-9-]+(.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+.)+[a-zA-Z]{2,4}$/", $newPage['email'])){
			echo"<div class='alert alert-block alert-danger'>البريد الإلكتروني غير صحيح </div>";

      }else{
            try{
            include 'models/Add.php';
            $message = new Add($DB_con);
            $addNewMessage = $message->AddData($newPage,$tablename);

            if($addNewMessage){
             echo '<div class="alert alert-success">ثم إرسال الرسالة بنجاح </div>';
            }

            }catch (Exception $exc){
              echo $exc->getMessage();
            }
      }
      }
              
        ?> 
        <div class="row">
            <div class="panel panel-default" style='margin-right:10px;border-radius:0px;'>
              <div class="panel-heading" style='font-size:17px;background:#2c3e50;border-radius:0px;color:white;border-color:#2c3e50;'><span class="lft glyphicon glyphicon-envelope"></span>  إتصل بنا  </div>
              <div class="panel-body">
                <div class="alert alert-info" style='border-radius:0px;'>
                    لديك إستفسار أو إقتراح للإدارة الموقع المرجو ملئ بيانات أسفله 
                </div>
                <div class='clr'></div>
                <form action="" method="post">
                  <div class="form-group">
                    <label for="exampleInputEmail1">الإسم الكريم </label>
                    <input type="text" name='fullname' class="form-control input-lg" placeholder="الإسم الكريم ">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">الإيميل الإلكتروني </label>
                    <input type="text" name='email' class="form-control input-lg" placeholder="الإيميل الإلكتروني ">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">موضوع الرسالة </label>
                    <input type="text" name='subject' class="form-control input-lg" placeholder="موضوع الرسالة ">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">الرسالة </label>
                    <textarea name='msg' class="form-control" rows='5' placeholder="الرسالة "></textarea>
                  </div>                    
                  <input type="submit" name='Add' class="lft btn btn-primary" value='أرسل الرسالة '/>
                </form>                  
              </div>
            </div>
        </div>
     </div>
    <?php include 'leftsidebar.php'; ?>

     <div class='clr'></div>
     <div id="footer" class='col-md-12'></div>
     <div class='clr'></div>  
     <hr/> 
     <div class='clr'></div>  
    
</div>


<?php include 'footer.php'; ?>
        
        
        
        
