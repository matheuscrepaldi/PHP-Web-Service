<?php

    $pdo = new PDO('mysql:host=localhost;dbname=u633448963_login', 'root', '');
    // define para que o PDO lance exceções caso ocorra erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $consulta = $pdo->query("SELECT data_den, desc_den, cat_den, rua_den, cidade_den FROM denuncias;");

    $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
   

?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js">



<script>
    
    $(document).ready(function() {
    $('#example').DataTable();
} );
    
    
</script>  
    




<table id="example" class="display" width="100%" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Endereço</th>
                <th>Cidade</th>
                <th>Data</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Endereço</th>
                <th>Cidade</th>
                <th>Data</th>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <?php while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    <td><?php echo $linha['desc_den']?></td>
                    <td><?php echo $linha['cat_den']?></td>
                    <td><?php echo $linha['rua_den']?></td>
                    <td><?php echo $linha['cidade_den']?></td>
                    <td><?php echo $linha['data_den']?></td>
                    }
                ?>           
            </tr>
        </tbody>
    </table>