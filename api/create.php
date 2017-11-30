<?php
require '../lib/Database.php';
$db = new Database();

       $name = $_POST['name'];
       $email = $_POST['email'];
       $body = $_POST['body'];
      

       $type = explode('.', $_FILES['filedoc']['name']);
       $type = $type[count($type)-1];
       $url = "../upload/".uniqid(rand()).'.'.$type;

        
       
           if(in_array($type, array('gif', 'jpg', 'jpeg', 'png'))) {
        if(is_uploaded_file($_FILES['filedoc']['tmp_name'])) {
            if(move_uploaded_file($_FILES['filedoc']['tmp_name'], $url)) {
 
                // insert into database
                $sql = "INSERT INTO tbl_received_write (name, email,body,filedoc) VALUES ('$name','$email','$body', '$url')";
                $sql = $db->insert($sql);
                 header("Location:../index.php");
 
                if($sql){
                    $valid['success'] = true;
                    $valid['messages'] = "Successfully Uploaded";
                } 
                else {
                    $valid['success'] = false;
                    $valid['messages'] = "Error while uploading";
                }
 
                exit();
 
            }
            else {
                $valid['success'] = false;
                $valid['messages'] = "Error while uploading";
            }
        }

    }
 
 
 
?>

