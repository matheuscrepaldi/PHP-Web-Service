<?php 

    if($_SERVER['REQUEST_METHOD']=='POST'){

         $imagem = $_POST['imagem'];
         $descricao = $_POST['descricao'];

         require_once('../model/model_denuncia_img.php');
        require_once('../class.denuncia.php');
        
        $denunciaImg = new DenunciaImg();
        $denuncia = new DENUNCIA();
        
        $ultimo_id = $denunciaImg->listarUltimo();

        $nome = $ultimo_id['idden_img'] + 1;
        
         $path = "imagens/".$nome.".png";

         $actualpath = "../controller/$path";
         
        
         if($denunciaImg->registrar($actualpath)){
             
             file_put_contents($actualpath,base64_decode($imagem));
             $denuncia->teste($descricao);
             echo "Cadastro realizado  com sucesso!";
         }

      
    }

    else{
        
        echo "Error";
    }

?>