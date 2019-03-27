<?php include "header.php"; include "session.php";
            if($userRow['type'] == 1 OR $userRow['type'] == 2){
            echo "<div class='alert alert-danger'>صفحة المطلوبة غير موجودة </div>"; 
            echo '<meta http-equiv="refresh" content="1; url=index.php"> '; 
            exit;
            }
          $main = $DB_con->prepare("SELECT * FROM `officielpage`");
          $main->execute(); 
          $infos = $main->fetch(PDO::FETCH_OBJ);


        if(isset($_POST['UpdateSetting'])){
    
           $ep  = $_POST['e_terms'];

            $sql = "UPDATE `officielpage` SET  
            e_terms = :e_terms";
            $UPD = $DB_con->prepare($sql);                                  
            $UPD->bindParam(':e_terms', $ep, PDO::PARAM_STR);       
            $UPD->execute(); 

           echo"<div class='alert alert-block alert-success'>ثم تعديل البيانات بنجاح </div>";
           echo'<meta http-equiv="refresh" content="3; url=terms.php" />';	   
            
			
			
        }
        
?>
<div class='TitleTag'>شروط الإستخدام </div>

      <form class='rgt' action='' method='post' style='margin:10px;padding:10px;text-align:right;font-size:14px;'>

        <div class='rgt form-group' style='margin-right:5px;'>
            <label for='inputPassword'> شروط الإستخدام </label>
            <textarea name='e_terms' id='mytextarea' class='form-control' style='width:950px;text-align:right;height:360px;border-radius:0px;'><?php echo"".$infos->e_terms.""; ?></textarea>
            <script type="text/javascript" src="tinymce/tinymce.min.js"></script>
            <script type="text/javascript">
            tinymce.init({
                width:"910px",
                height:"500px",
                selector: "#mytextarea",
                theme: "modern",
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern imagetools"
                ],
                toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                toolbar2: "print preview media | forecolor backcolor emoticons",
                image_advtab: true,
                templates: [
                    {title: 'Test template 1', content: 'Test 1'},
                    {title: 'Test template 2', content: 'Test 2'}
                ]
            });
            </script>
        </div>
        

        <div class='clr'></div>
        <input name='UpdateSetting' type='submit' class='rgt btn btn-primary' value='تعديل البيانات '>
    </form>
