<?php
    $planos = file_get_contents("plans.json");
    $planos = json_decode($planos,true);
    foreach($planos as $opcoes)
    {
        $opcao[$opcoes['codigo']] = $opcoes['nome'];
    }
    $plano = $_POST['plano'];
    if(!array_search($plano,$opcao))
    {
        echo "Plano selecionado não existe!";
    }
    else
    {
        echo array_search($plano,$opcao);
    }
?>