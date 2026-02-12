<?php
// require 'dados.php';

$id = $_REQUEST["id"];

$filtrado = array_filter($livros, function ($l) use ($id) {
    return $l['id'] == $id;
});

$livro = array_pop($filtrado);
$view = 'livro';
require 'views/template/app.php';
?>
