<?php
    foreach($_POST as $indice => $valor)
    {
        if(!is_array($valor) && preg_match("/\S+/",$valor)==0)
        {
            switch($indice)
            {
                case 'qtd': $alert = "Informe a quantidade de beneficiários";
                            break;
                case 'idplano': $alert = "Escolha o plano ofertado";
                                break;
            }
            if(isset($alert))
            {
                break;
            }
        }
        else
        {
            foreach($valor as $posicao=>$registro)
            {
                if(preg_match("/\S+/",$registro)==0)
                {
                    switch($indice)
                    {
                        case 'idade': $alert="Informe a idade do beneficiário ".$posicao+1;
                                     break;
                        case 'nome': $alert="Informe o nome do beneficiário ".$posicao+1;
                                     break;
                    }
                }
                if(isset($alert))
                {
                    break 2;
                }
            }
        }  
        if($indice !="plano")
        {
            $cliente[$indice] = $valor;
        }
        
    }
    if(isset($alert))
    {
        echo "<script>alert('$alert');location.href='index.php'</script>";
    }
    else
    {
        $json_cliente = json_encode($cliente,JSON_FORCE_OBJECT | JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
        file_put_contents("inc/beneficiarios.json",$json_cliente);
        if(is_file("inc/beneficiarios.json"))
        {
            header("location:resultado.php");
        }
        else
        {
            echo "Erro ao gerar o arquivo .json";
        }
    }
?>