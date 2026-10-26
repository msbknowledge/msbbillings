<?php
    require 'connImage.php';

if(isset($_POST['submit'])){
    // $title=$_POST['name'];
  $name=$_POST['name'];
  $phone=$_POST['phone'];
  $address=$_POST['address'];
   $image_capture = $_POST['image'];
   $folderPath = "upload/";
    // $image_parts = explode(";base64,", $image_capture);
    // $image_type_aux = explode("image/", $image_parts[0]);
    // $image_type = $image_type_aux[1];
    // $image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.png';
    $file = $folderPath . $fileName;
   // file_put_contents($file);
   $comment=$_POST['comment'];
  $insertquery="insert into tb_prescription(Name,phone,address,image_capture,status) values 
  ('$name','$phone','$address','$image_capture','$comment')";
  //echo "hello";
  
 // var_dump($insertquery);
  $req = mysqli_query($conn,$insertquery);    
  if($req){
     echo " Your Data Inserted Successfully ";
  // header('location:storeImage.php');
  }else{
      echo "Your Data Not Inserted Please Insert New";
  }
  }

    //  $img = $_POST['image'];
    // $folderPath = "upload/";
    // $image_parts = explode(";base64,", $img);
    // $image_type_aux = explode("image/", $image_parts[0]);
    // $image_type = $image_type_aux[1];
  
    // $image_base64 = base64_decode($image_parts[1]);
    // $fileName = uniqid() . '.png';
  
    // $file = $folderPath . $fileName;
    // file_put_contents($file, $image_base64);
  
    // print_r($fileName);
  
?>