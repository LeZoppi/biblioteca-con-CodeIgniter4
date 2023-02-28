<?= $cabecera ?>
<br>
<br>
<a href="<?= base_url('crear') ?>"class="btn btn-success">Ingresar un libro</a>
<br>
<br>
<form id="buscar" method="GET" action="<?=base_url('/buscar')?>">
<input type="text" id="query" name="query"/>
<input type="submit" id="buscar" value="buscar"class="btn btn-info" type="button"/>
</form>
<br/>
<br/>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Imagen</th>
            <th>Nombre del libro</th>
            <th>Nombre del autor</th>
            <th>fecha de edicion</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>


    <?php foreach($libros as $libro): ?>
<tr>
    <td> <?php echo $libro['id'];  ?> </td>
    <td>

    <img class="img-thumbnail" 
     src="<?=base_url()?>/uploads/<?=$libro['imagen'];?>" 
     width="100" alt=""> 

     
    </td>
    <td> <?php echo $libro['nombre']; ?></td>
    <td> <?php echo $libro['autor']; ?></td>
    <td> <?php echo $libro['fechaedit']; ?></td>
    <td>
        <a href="<?=base_url('editar/'.$libro['id']);?>"class="btn btn-info" type="button">Editar</a>
        <a href="<?=base_url('borrar/'.$libro['id']);?>"class="btn btn-danger" type="button">Borrar</a>
    </td>
</tr>

    <?php endforeach; ?>

</tbody>
</table>

<?phpif($result){
    foreach($result->result() as $row){
        echo $row->nombre."<br />";
}
}
?>

<?= $pie ?>
