<?php
   class Upload {

   private $allowedExts = array('doc','docx','pdf','txt','jpg','png');
   private $maxSize;
   private $file;
   private $uploadsDirecotry;
   private $fileUrl;
   private $filenames = array();

   function __construct($file,$allowedExts,$uploadsDirecotry,$maxSize){
       if(is_array($allowedExts) AND is_int($maxSize)){
         $this->file  = $file;
         $this->allowedExts = $allowedExts;
         $this->maxSize = $maxSize;
         $this->uploadsDirecotry = $uploadsDirecotry;

       }else{
         throw new Exception("File extension must be in an array and max size value must be intger value.");
       }

       }
   function uploadFiles(){

        $file = $this->file;
        $allowedExts = $this->allowedExts;
        $maxsize = $this->maxSize;
        $uploadsDir = $this->uploadsDirecotry;

    for($i = 0; $i < count($file['name']); $i++){

      $errors = array();

      // print_r($_FILES);
      $filename    = $file['name'][$i];
      $fileext    = strtolower(end(explode('.',$filename)));
      $filesize    = $file['size'][$i];
      $filetmpname = $file['tmp_name'][$i];

    if(in_array($fileext, $allowedExts) === FALSE){
       $errors[] = "Extension in sot allowed";
    }

     if($filesize > $maxsize){
        $errors[] = "File size must be less than {$maxsize} KB !";
     }

     if(empty($errors)){

        $random = rand(0,199);
        $this->fileUrl = $random . "_" . date("d-m-Y") . "_" . $filename;
        $destination = $uploadsDir. $random."_".date("d-m-Y") . "_" . $filename;
        move_uploaded_file($filetmpname, $destination);
        $this->filenames[] = $this->fileUrl;

     }else{

       foreach($errors as $error){
        throw new Exception($error);
       }
     }
          } // end for

          return TRUE;
   }

   function getFileUrl()
   {
         return $this->fileUrl;
       }

   function getFilesNames()
   {
         return $this->filenames;
       }

   }


?>