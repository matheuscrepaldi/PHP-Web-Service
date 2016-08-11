 <script language="JavaScript">
	
	function chama_gravar_valida(operacaox){
		
		 document.form_edita.operacao.value = operacaox;
		 document.form_edita.submit();
	}

	
</script>


	<form action="orgao_grava.php" method="post" name="form_edita" id="form_edita">

		<input name="operacao" type="hidden" id="operacao" value="nula">


      <input name="Button" type="button" class="yellowbutton" onClick="chama_gravar_valida('gravar')" value="Gravar">
    
      <input name="Submit2" type="button" class="yellowbutton" onClick="chama_gravar('cancelar')" value="Cancelar">
	 
      <input name="Submit3" type="button" class="yellowbutton" onClick="chama_gravar('excluir')" value="Excluir">


	</form>



<?php

    if($_POST['operacao'] == 'gravar'){
        
        
        gravar();

	   header(sprintf("Location: %s", "categorias.php"));

    }

    if($_POST['operacao'] == 'cancelar'){
        
    

	   header(sprintf("Location: %s", "categorias.php"));

    }
?>