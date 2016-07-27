<?
//CONFIGURAÇÕES DO BD MYSQL

	 $servidor = "mysql.hostinger.com.br";
     $bd = "u633448963_login";
     $usuario = "u633448963_root";
     $senha = "123456";
     $conn;

//TÍTULO DO RELATÓRIO
$titulo = "Relatório de denúncias.";
//LOGO QUE SERÁ COLOCADO NO RELATÓRIO

$imagem = "/img/logo.png";
//ENDEREÇO DA BIBLIOTECA FPDF
$end_fpdf = "/fpdf181/fpdf";
//NUMERO DE RESULTADOS POR PÁGINA
$por_pagina = 13;
//ENDEREÇO ONDE SERÁ GERADO O PDF

$end_final = "c:/artigo_php.pdf";

//TIPO DO PDF GERADO
//F-> SALVA NO ENDEREÇO ESPECIFICADO NA VAR END_FINAL
$tipo_pdf = "F";

/**************
NÃO MEXER DAQUI PRA BAIXO ***************/

//CONECTA COM O MYSQL
//$conn = mysql_connect($servidor, $usuario, $senha);
//$db = mysql_select_db($bd, $conn);
//$sql = mysql_query("SELECT id_denuncia, data_denuncia, assunto_denuncia FROM denuncias", $conn);
//$row = mysql_num_rows($sql);

 public function dbConnection()
	{
     
	    $this->conn = null;    
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->conn;
    }
//VERIFICA SE RETORNOU ALGUMA LINHA

if(!$row) { echo "Não retornou nenhum registro"; die; }

//CALCULA QUANTAS PÁGINAS VÃO SER NECESSÁRIAS
$paginas = ceil($row/$por_pagina);

//PREPARA PARA GERAR O PDF

define("FPDF_FONTPATH", "$end_fpdf/font/");
require_once("$end_fpdf/fpdf.php");
$pdf = new FPDF();

//INICIALIZA AS VARIÁVEIS
$linha_atual = 0;
$inicio = 0;

//PÁGINAS
for($x=1; $x<=$paginas; $x++) {

//VERIFICA
$inicio = $linha_atual;
$fim = $linha_atual + $por_pagina;
if($fim > $row) $fim = $row;

$pdf->Open();
$pdf->AddPage();
$pdf->SetFont("Arial", "B", 10);

$pdf->Image($imagem, 0, 8);
$pdf->Ln(2);
$pdf->Cell(185, 8, "Página $x de $paginas",
0, 0, ‘R’);

//QUEBRA DE LINHA
$pdf->Ln(20);

//MONTA  CABEÇALHO
$pdf->Cell(15, 8, "", 1, 0, ‘C’);
$pdf->Cell(85, 8, "DATA", 1, 0, ‘L’);

$pdf->Cell(85, 8, "ASSUNTO", 1, 1, ‘L’);

//EXIBE OS REGISTROS
for($i=$inicio; $i<$fim; $i++) {
$pdf->Cell(15, 8, mysql_result($sql, $i, "ID"),
1, 0, ‘C’);
$pdf->Cell(85, 8, mysql_result($sql, $i, "DATA"),
1, 0, ‘L’);
$pdf->Cell(85, 8, mysql_result($sql, $i, "ASSUNTO"),
1, 1, ‘L’);
$linha_atual++;
}//FECHA FOR(REGISTROS – i)
}//FECHA FOR(PAGINAS – x)

//SAIDA DO PDF
$pdf->Output("$end_final", "$tipo_pdf");
?> 