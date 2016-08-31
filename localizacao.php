<?php 
require_once('dbconfig.php');

$sql = mysql_query("SELECT * FROM denuncias WHERE id_denuncia = $_GET[id]");
$dados = mysql_fetch_array($sql);

$endereco_imovel = $dados[latitude];

$sql2 = mysql_query("SELECT * FROM denuncias WHERE descricao = '$dados[descricao]'");
$dados2 = mysql_fetch_array($sql2);

?>

 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUd6nzucTwkmTv7SAk4qF7udfDUa641GY&signed_in=true&callback=initMap"
        async defer>
    </script>
<script type="text/javascript">

	var map;
	var gdir;
	var geocoder = null;
	var addressMarker;
	
	var minhaLocalizacao = "<?php echo $endereco_imovel; ?> - <?php echo $dados2[descricao]; ?>, SP" //Localização inicial passada como ponto de partida

	function inicializar_gmaps() {
	  if (GBrowserIsCompatible()) {	  
		map = new GMap2(document.getElementById("div_mapa")); //Local onde o mapa gerado deve ficar
		gdir = new GDirections(map, document.getElementById("direcoes")); //Local para ficar o "passo-a-passo" pra chegar ao destino
		GEvent.addListener(gdir, "error", gmaps_erros); //Define qual função vai manipular os erros retornados
	  }
	}

	function gmaps_erros() {
	if (gdir.getStatus().code == G_GEO_UNKNOWN_ADDRESS)
		gdir.getStatus().code

	else if (gdir.getStatus().code == G_GEO_SERVER_ERROR)
		alert("A geocoding or directions request could not be successfully processed, yet the exact reason for the failure is not known.\n Error code: " + gdir.getStatus().code);

	else if (gdir.getStatus().code == G_GEO_MISSING_QUERY)
		alert("The HTTP q parameter was either missing or had no value. For geocoder requests, this means that an empty address was specified as input. For directions requests, this means that no query was specified in the input.\n Error code: " + gdir.getStatus().code);
	
	else if (gdir.getStatus().code == G_GEO_BAD_KEY)
	alert("The given key is either invalid or does not match the domain for which it was given. \n Error code: " + gdir.getStatus().code);
	
	else if (gdir.getStatus().code == G_GEO_BAD_REQUEST)
	alert("A directions request could not be successfully parsed.\n Error code: " + gdir.getStatus().code);
	
	else alert("Um erro desconhecido aconteceu.");
	   
	}
	
	function mapsPesquisa(irPara) {
	//Responsavel por iniciar o carregamento dos mapas nos locais especificos
	gdir.load("from: " + minhaLocalizacao + " to: " + irPara);
}

</script>
<body onload="inicializar_gmaps(); mapsPesquisa(document.getElementById('irPara').value);" >

<div id="tabela_maps">
<table class="directions">

<tr>
<td valign="top"><div id="div_mapa" style="width: 600px; height: 400px"></div></td>
</tr>
</table>
<table>
<tr>
<td><strong>Perdido? Digite seu endereço:</strong></td>
<td><input type="text" size="25" id="irPara" value="<?php echo $endereco_imovel; ?> - <?php echo $dados2[nome_cidade]; ?>, RS" /></td>
<td><input type="button" value="Procurar" onClick="mapsPesquisa(document.getElementById('irPara').value)" /></td>
</tr>
</table>
</div>

</body>
</html>