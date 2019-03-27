<?php
class Add{
    private $db;
 
    public function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
    
    
        
    public function AddData($data, $tablename){

      foreach ($data as $key => $value){

        $keys[]  = $key;
        $values[] = $value;
      }

        $tblKeys = implode($keys,",");
        // $dataValues = '"'.implode($values, '","').'"';
        
        $keyes = ':'.implode($keys,",:");
        
        $sql = "INSERT INTO `$tablename` ($tblKeys) VALUES ($keyes)";
        $query = $this->db->prepare($sql);
        
        foreach ($keys as $key){
          $query->bindParam(":$key", $data[$key]);    
        }
       
        
        if($query->execute()){
           return TRUE;
        }else{
          throw new Exception("<div class='alert alert-success'>Added Success</div>");
          return FALSE;
        }

        
    }
    
    public function UpdateData($id, $data, $tablename){

      foreach ($data as $key => $value){

        $keys[]  = $key;
        $values[] = $value;
      }

        $tblKeys = implode($keys,",");
        // $dataValues = '"'.implode($values, '","').'"';
        
        $keyes = ':'.implode($keys,",:");
        
        $sql = "UPDATE `$tablename` SET ($tblKeys) VALUES ($keyes) WHERE `id`=".$id."";
        $query = $this->db->prepare($sql);
        
        foreach ($keys as $key){
          $query->bindParam(":$key", $data[$key]);    
        }
       
        
        if($query->execute()){
           return TRUE;
        }else{
          throw new Exception("<div class='alert alert-success'>ثم تعديل الموضوع بنجاح </div>");
          return FALSE;
        }

        
    }
    
}

class Pagination{
  var $data;

  function Paginate($values,$per_page){
     $total_values = count($values);


  if(isset($_GET['page'])){
    $current_page = $_GET['page'];

  }else{
    $current_page = 1;
  }

  $counts = ceil($total_values / $per_page);
  $param1 = ($current_page - 1) * $per_page;
  $this->data = @array_slice($values,$param1,$per_page);

    if(($current_page > $this->data) or ($current_page <= 0)){
      die('
      <div style="color:white;font-size:30px;text-align:center;">No Film</div>
      <meta http-equiv="refresh" content="8; url=index.php">
      ');

  }

  for($x=1; $x<= $counts; $x++){
    $numbers[] = $x;
  }
  return $numbers;
}

  function fetchResult(){
   $resultsValues = $this->data;
   return $resultsValues;
  }
}
?>