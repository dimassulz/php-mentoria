<?php
    /*
        https://www.w3schools.com/php/
    */
    // Mostra informações na tela
    echo "<h1>Iniciando com o PHP 8</h1>";

    ECHO "Hello World!<br>"; // Hello World! <- Vai mostrar e não vai gerar erro!
    echo "Hello World!<br>"; // Hello World! <- Vai mostrar e não vai gerar erro!
    EcHo "Hello World!<br>"; // Hello World! <- Vai mostrar e não vai gerar erro!

    $carro = 'Gol'; 
    
    $cArRo = 'Polo';
    
    $carrO = 'Tiguan';

    echo "Comprei um ".$carro." na v12 motors <br>"; //TIGUAN

    $carro = 'Voyage';
    echo "Comprei um ".$carro." na v12 motors <br>"; //VOYAGE

    echo "<h1> Tipos de variaveis $carro </h1>";

    $texto = "Variaveis de Texto <br>"; //string
    $numerica = 5; //number
    $decimal = 10.5; //float
    $booleana = true; //false boolean
    $GLOBALS['nomeDoSistema'] = 'Sistema de Usuarios'; // tipo variável global

    echo "<h2> $nomeDoSistema </h2>";

    echo $texto;

?>