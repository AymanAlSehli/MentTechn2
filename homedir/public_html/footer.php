<div class='clr'></div>
<footer style='background:white;padding:5px;border-top:5px solid #E6E6E6;'>
<br/> <br/>   
<div class="row">
    <div class="col-md-12">
    <div class='col-md-2'>
    <div class="rgt list-group" style='border-radius:0px;'>
      <a href="#" class="list-group-item active" style='border-radius:0px;'>
        روابط مهمة 
      </a>
      <a href="aboutus.php" class="list-group-item">عن الموقع </a>
      <a href="terms.php" class="list-group-item">سياسة الخصوصية </a>
      <a href="termscopy.php" class="list-group-item">سياسة النقل  </a>                
      <a href="privacy.php" class="list-group-item">قوانين الموقع </a>
      <a href="contact.php" class="list-group-item">إتصل بنا </a>
    </div>
    <div class="rgt list-group" style='font-size:16px;'>
    <a href="#" class="list-group-item active" style='border-radius:0px;'>
        روابط مهمة 
      </a>    
      <a href="<?php echo $Setrows->fb; ?>" class="list-group-item"><img src='images/facebook.png' style='width:28px;'/> الفيسبوك</a>
      <a href="<?php echo $Setrows->tw; ?>" class="list-group-item"><img src='images/twitter.png' style='width:28px;'/> التويتر </a>
      <a href="<?php echo $Setrows->yt; ?>" class="list-group-item"><img src='images/youtube.png' style='width:28px;'/> يوتيوب </a>
    </div>       
    </div>    
    <div class="col-md-3">
        <div class="panel panel-default" style='border-radius:0px;'>
          <div class="panel-heading" style='font-family:JF Flat regular;font-size:17px;font-weight:bold;'><span class="lft glyphicon glyphicon-heart" style='color:#8E44AD;'></span> قد تعجبك </div>
          <?php 
            $stmt = $DB_con->prepare("SELECT * FROM `post` ORDER BY veiws DESC LIMIT 4");
            $stmt->execute();   

            foreach ($stmt->fetchAll() as $row) {
            $title = mb_substr($row['title'], 0, 60, 'UTF-8');    
            echo'
              <div class="panel-body">
                <div class="media">
                  <div class="media-left media-middle">
                    <a href="#">
                      <img class="fade media-object" src="imagespost/'.$row['image'].'" style="width:64px;height:64px;">
                    </a>
                  </div>
                  <div class="media-body">
                    <h5 class="media-heading"><a href="">'.$title.'</a></h5>
                    <span class="rgt" style="margin-top:8px;">
                        <img src="images/Fire_alarm-128.png" style="width:20px;"/> '.$row['veiws'].'</span>
                    <span class="lft" style="margin-top:8px;">
                        <img src="images/21-20.png" style="width:20px;"/></span>
                  </div>
                </div>  
              </div>
            ';    
            }
          ?>  
        </div>
                 
    </div>
    <div class="desktop-only col-md-3">
       <center>   
          <?php 
            $stmt = $DB_con->prepare("SELECT * FROM `category` ORDER BY veiws DESC LIMIT 6");
            $stmt->execute();   
          
            foreach ($stmt->fetchAll() as $row) {
            echo'
               <div class="sectionS2">
               <a href="cat.php?id='.$row['id'].'" style="color:white;text-decoration:none;">   
               <p style="margin-top:30px;"><img src="imagespost/'.$row['image'].'" /></p>   
               <p>'.$row['catname'].'</p> 
               </a>   
               </div>
            ';    
            }
          ?>
      </center> 
                
    </div>
    <div class="col-md-4">
        
        <div class="panel panel-default" style='border-radius:0px;'>
          <div class="panel-heading" style='font-family:JF Flat regular;font-size:17px;font-weight:bold;'><span class="lft glyphicon glyphicon-tags" style='color:#8E44AD;'></span> Tags </div>
          <div class="panel-body">
            <?php 

            $tags = $Setrows->key_site;  
            $new = explode(',', $tags);
            $count = count($new);
            $count2 = $count - 1;

            echo'
            <div class="">
                <div class="item-content-block tags">
            ';
            for ($x = 0; $x <= $count2; $x++) {
            echo '
                    <a href="search.php?query='.@$new[$x].'">'.@$new[$x].'</a>
            '; 

            }
            echo'
                </div>
            </div>
            ';


            ?>
          </div>

        </div>
        <div class="panel panel-default" style='border-radius:0px;'>
          <div class="panel-heading" style='font-family:JF Flat regular;font-size:17px;font-weight:bold;'><span class="lft glyphicon glyphicon-tags" style='color:#8E44AD;'></span> تغريدات  </div>
          <div class="panel-body">
<a class="twitter-timeline" data-height="400" href="https://twitter.com/MentTechn">MentTechn</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
          </div>

        </div>        
                    
    </div>
    <div class='clr'></div>
    <div class="copyright col-md-12">
     <p class='rgt' style='color:white;padding:10px;'> COPYRIGHT © 2015 جميع الحقوق محفوظة لموقع Ment Tech</p>   
     <a href='http://www.chakirdev.com' class='lft' target="_blank" style='padding:10px;text-decoration:none;'> POWRED BY CHAKIR DEVELOEPR</a>   
    </div>           
    </div>
  
</div>
   
</footer>

</div>
    <script src="js/bootstrap-arabic.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="js/bootstrap-arabic.min.js"></script>
    <script type="text/javascript">
        $(function(){
          var $searchlink = $('#searchtoggl i');
          var $searchbar  = $('#searchbar');

          $('#topnav ul li a').on('click', function(e){
            e.preventDefault();

            if($(this).attr('id') == 'searchtoggl') {
              if(!$searchbar.is(":visible")) { 
                // if invisible we switch the icon to appear collapsable
                $searchlink.removeClass('fa-search').addClass('fa-search-minus');
              } else {
                // if visible we switch the icon to appear as a toggle
                $searchlink.removeClass('fa-search-minus').addClass('fa-search');
              }

              $searchbar.slideToggle(300, function(){
                // callback after search bar animation
              });
            }
          });

          $('#searchform').submit(function(e){
            e.preventDefault(); // stop form submission
          });
        });
    </script>
<script type="text/javascript">
$(function() {
    var top = $('#sidebar').offset().top - parseFloat($('#sidebar').css('marginTop').replace(/auto/, 0));
    var footTop = $('#footer').offset().top - parseFloat($('#footer').css('marginTop').replace(/auto/, 0));

    var maxY = footTop - $('#sidebar').outerHeight();

    $(window).scroll(function(evt) {
        var y = $(this).scrollTop();
        if (y > top) {
            if (y < maxY) {
                $('#sidebar').addClass('fixed').removeAttr('style');
            } else {
                $('#sidebar').removeClass('fixed').css({
                    position: 'absolute',
                    top: (maxY - top) + 'px'
                });
            }
        } else {
            $('#sidebar').removeClass('fixed');
        }
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu2', this).not('.in .dropdown-menu2').stop(true,true).slideDown("400");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu2', this).not('.in .dropdown-menu2').stop(true,true).slideUp("400");
            $(this).toggleClass('open');       
        }
    );
});
</script>
  </body>
  </html>