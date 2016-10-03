<?php 

    if($_SERVER['REQUEST_METHOD']=='POST'){

         $image = $_POST['image'];
         $name = $_POST['name'];

         require_once('../model/model_denuncia_img.php');
        
         $path = "imagens/teste.png";

         $actualpath = "../controller/$path";

         $denunciaImg = new DenunciaImg();
        
         if($denunciaImg->registrar($actualpath)){
             
             file_put_contents($actualpath,base64_decode($image));
             echo "Successfully Uploaded";
         }

      
    }

    else{
        
        echo "Error";
    }

?>