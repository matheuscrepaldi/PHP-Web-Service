<?php
require("dbconfig.php");

// Start XML file, create parent node
$doc = domxml_new_doc("1.0");
$node = $doc->create_element("pontos");
$parnode = $doc->append_child($node);

// Opens a connection to a MySQL server
$connection=mysql_connect ('localhost', $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table
$query = "SELECT * FROM pontos WHERE 1";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  $node = $doc->create_element("ponto");
  $newnode = $parnode->append_child($node);

  $newnode->set_attribute("nome_ponto", $row['nome_ponto']);
  $newnode->set_attribute("end_ponto", $row['end_ponto']);
  $newnode->set_attribute("lat_ponto", $row['lat_ponto']);
  $newnode->set_attribute("lng_ponto", $row['lng_ponto']);
  $newnode->set_attribute("tipo_ponto", $row['tipo_ponto']);
}

    $xmlfile = $doc->dump_mem();
    echo $xmlfile;

?>