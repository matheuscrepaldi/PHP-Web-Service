<?php 

    if($_SERVER['REQUEST_METHOD']=='POST'){
        
        $imagem = '';
        $imagem2 = '';
        $imagem3 = '';
        $imagem4 = '';
        
         if(isset($_POST['imagem'])){
            $imagem = $_POST['imagem'];
         }
        
        if(isset($_POST['imagem2'])){
            $imagem2 = $_POST['imagem2'];
         }
        
        if(isset($_POST['imagem3'])){
            $imagem3 = $_POST['imagem3'];
         }
        
        if(isset($_POST['imagem4'])){
            $imagem4 = $_POST['imagem4'];
         }
        
        // $imagem2 = $_POST['imagem2'];
       //  $imagem3 = $_POST['imagem3'];
       //  $imagem4 = $_POST['imagem4'];
         $user = $_POST['user'];
         $descricao = $_POST['descricao'];
         $latitude = $_POST['latitude'];
         $longitude = $_POST['longitude'];
         $endereco = $_POST['endereco'];
         $cidade = $_POST['cidade'];
         $bairro = $_POST['bairro'];
        
        if($_POST['categoria'] > 0){
            
            $id_cat = $_POST['categoria'];   
        }
        
        else {
            
            echo "A denúncia não foi cadastrada, favor inserir uma categoria!";
            exit;
        }
        
        $id_cat = $_POST['categoria'];
        
         require_once('../model/model_denuncia_img.php');
        require_once('../class.denuncia.php');
        
        $denunciaImg = new DenunciaImg();
        $denuncia = new DENUNCIA();
        
        $ultimo_id = $denunciaImg->listarUltimo();
        
        if($imagem != ''){
            
            $nome = $ultimo_id['idden_img'] + 1;

            $path = "imagens/".$nome.".png";

            $actualpath = "../controller/$path";
        }
        
        if($imagem2 != ''){
            
            $nome2 = $ultimo_id['idden_img'] + 2;

            $path2 = "imagens/".$nome2.".png";

            $actualpath2 = "../controller/$path2";
        }
        
        if($imagem3 != ''){
            
            $nome3 = $ultimo_id['idden_img'] + 3;

            $path3 = "imagens/".$nome3.".png";

            $actualpath3 = "../controller/$path3";
        }
        
        if($imagem4 != ''){
            
            $nome4 = $ultimo_id['idden_img'] + 4;

            $path4 = "imagens/".$nome4.".png";

            $actualpath4 = "../controller/$path4";
        }
        
         if($imagem != ''){
             
             $denunciaImg->register($actualpath);
             file_put_contents($actualpath,base64_decode($imagem));
             $denuncia->inserir($descricao, $id_cat, $latitude, $longitude, $endereco, $cidade, $bairro, $user);
             
              if($imagem2 != ''){
                $denunciaImg->register($actualpath2);
                file_put_contents($actualpath2,base64_decode($imagem2));           
              }
             
              if($imagem3 != ''){
                $denunciaImg->register($actualpath3);
                file_put_contents($actualpath3,base64_decode($imagem3));           
              }
             
              if($imagem4 != ''){
                $denunciaImg->register($actualpath4);
                file_put_contents($actualpath4,base64_decode($imagem4));           
              }
             
             echo "Cadastro realizado  com sucesso!";
         }

      
    }

    else{
        
        echo "Error";
    }

?>