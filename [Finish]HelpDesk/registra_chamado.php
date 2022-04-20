<?php

    session_start();



    $arquivo = fopen('arquivo.txt','a');

    $titulo = str_replace('#','-',$_POST['titulo']);
    $categoria=str_replace('#','-',$_POST['categoria']);
    $descricao=str_replace('#','-',$_POST['descricao']);

    $texto =$_SESSION['id']  ."#" .$titulo ." #". $categoria ."#". $descricao . PHP_EOL;

   

    fwrite($arquivo, $texto);
    fclose($arquivo);

    echo $texto;
?>