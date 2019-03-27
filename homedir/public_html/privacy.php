<?php include 'header.php'; 
    $officielpage = $DB_con->prepare("SELECT e_privacy FROM `officielpage`");
    $officielpage->execute(); 
    $OP = $officielpage->fetch(PDO::FETCH_OBJ);
?>
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
        <div class="row">
            <div class="panel panel-default" style='margin-right:10px;border-radius:0px;'>
              <div class="panel-heading" style='font-size:17px;background:#2c3e50;border-radius:0px;color:white;border-color:#2c3e50;'><span class="lft glyphicon glyphicon-question-sign"></span>  شروط و قوانين الموقع  </div>
              <div class="panel-body" style='line-height:25px;font-size:16px;margin:10px;'>
                <div class="alert alert-info" style='border-radius:0px;'>
                    جميع شروط و قوانين الموقع تجدها في هذا الصفحة 
                </div>
                <div class='clr'></div>
                <?php echo "".$OP->e_privacy.""; ?>  
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
        
        
        
        
