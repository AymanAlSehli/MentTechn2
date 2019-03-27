	<script src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/samples/js/sample.js"></script>
	<link rel="stylesheet" href="ckeditor/samples/css/samples.css">
<?php include "header.php"; include "session.php";

        if(isset($_POST['Add'])){
    
           $newPage['title']      = addslashes(strip_tags($_POST['title']));
           $newPage['catid']      = addslashes(strip_tags($_POST['catid']));
           $newPage['keywords']   = addslashes(strip_tags($_POST['keywords']));
           $newPage['users']      = (int)$userRow['id'];
           $newPage['content']    = $_POST['content'];
           $newPage['type']       = 1;
            
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

           $tablename = "post";
            

          if($newPage['title'] == ''){
           echo"<div class='alert alert-block alert-danger'>Title not found</div>";
		   
            }else{
            try{
            include '../models/Add.php';
            $anime = new Add($DB_con);
            $addNew = $anime->AddData($newPage,$tablename);

            if($addNew){
             echo '<div class="alert alert-success">POST Addeded</div>';
            echo'<meta http-equiv="refresh" content="3; url=newpost.php" />';	
            }
            }catch (Exception $exc){
              echo $exc->getMessage();
            }
        }
        }
        
        
?>
<div class='TitleTag'>إضافة موضوع جديد </div>

      <form class='rgt' action='' method='post' style='margin:10px;padding:10px;font-size:14px;' enctype="multipart/form-data">
        <div class='rgt form-group' >
            <label for='inputEmail' >عنوان الموضوع </label>
            <input type='text' name='title' class='form-control' id='inputEmail' style='width:400px;height:40px;border-radius:0px;'>
        </div>
        <fieldset disabled>  
        <div class='rgt form-group' style='margin-right:5px;'>
            
            <div class='rgt form-group'>
                <label for='inputEmail' >كاتب الموضوع </label>                
                <input type='text' id="disabledTextInput" class='form-control' value='<?php echo $userRow['username']; ?>' style='width:400px;height:40px;border-radius:0px;'>
            </div>  
            
              
        </div>
        </fieldset>    
          <div class='clr'></div>
            <div class='rgt form-group' >
                <label for='inputPassword'>قسم الموضوع  </label>
                <select class='form-control' name='catid' style='width:400px;height:40px;border-radius:0px;text-align:right;color:black;'>
                <?php
                  $cat = $DB_con->prepare("SELECT * FROM `category` ORDER BY id DESC");
                  $cat->execute();   
                  foreach ($cat->fetchAll() as $rowcat) {
                  echo"<option value='".$rowcat['id']."' style='color:#1f2833;font-family:JF Flat Medium;'> ".$rowcat['catname']."</option>";       
                  }
                ?>
                </select>
              </div>
            <div class='rgt form-group' style='margin-right:5px;'>
                    <label for='inputEmail' >كلمات المفتاحية </label>
                    <input type='text' name='keywords' class='form-control' style='width:400px;height:40px;border-radius:0px;'>
                </div>           
          <div class='clr'></div>          
               <div class="panel panel-default" style='width:400px;border-radius:0px;text-align:right;'>
              <div class="panel-heading">رفع الصور </div>
              <div class="panel-body">                
                  
              <div class="form-group">
                <input type="file" name='image[]' id="exampleInputFile" multiple>
                <p class="help-block"> من نوع (png - jpg - gif - jpeg)</p>
              </div>
               
              </div>            
              </div>         
           <div class='clr'></div>
            <label for='inputPassword'>محتوى الموضوع </label>
            <textarea name='content' id="editor" class='rgt form-control' style='width:950px;text-align:right;border-radius:0px;'></textarea>
          <script>
            initSample();
        </script>
        <div class='clr'></div>
          </br>
        <input name='Add' type='submit' class='btn btn-primary' value='أدخل الموضوع '>
    </form>


