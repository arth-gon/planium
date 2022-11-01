<?php
    $planos = file_get_contents("inc/plans.json");
    $planos = json_decode($planos,true);
    $precos = file_get_contents("inc/prices.json");
    $precos = json_decode($precos,true);
    $cliente = file_get_contents("inc/beneficiarios.json");
    $cliente = json_decode($cliente,true);
    foreach($cliente as $indice=>$beneficiario)
    {
       if(!is_array($beneficiario))
       {
        ${$indice} = $beneficiario;
       }
       else
       {
        foreach($beneficiario as $registro=>$valor)
        {
            ${$indice}[]=$valor;
        }
       }
    }
    $i=0;
    foreach ($precos as $planos)
    {
        if($planos['codigo']==$idplano)
        {
            $minimo_vidas[$i] = $planos['minimo_vidas'];
        }
        $i++;
    }
    foreach($minimo_vidas as $indice=>$vidas)
    {
        if($qtd>=$vidas)
        {
            $valores = $indice;
        }
    }
    $fx_valores = $precos[$valores];
    $i=0;
    $total=0;
    foreach($idade as $indice=>$valor)
    {
        if($valor<=17)
        {
            $beneficiarios[] = array("nome"=>$nome[$indice],"idade"=>$valor,"preco"=>$fx_valores['faixa1']);
            $total += $fx_valores['faixa1'];
        }
        else
        {
            if($valor<=40)
            {
                $beneficiarios[] = array("nome"=>$nome[$indice],"idade"=>$valor,"preco"=>$fx_valores['faixa2']);
                $total += $fx_valores['faixa2'];
            }
            else
            {
                $beneficiarios[] = array("nome"=>$nome[$indice],"idade"=>$valor,"preco"=>$fx_valores['faixa3']);
                $total += $fx_valores['faixa3'];
            }
        }
    }
    $beneficiarios[count($beneficiarios)] = array("total"=>$total);
    $js_beneficiarios = json_encode($beneficiarios,JSON_FORCE_OBJECT | JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE); 
    file_put_contents("inc/proposta.json",$js_beneficiarios);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Planium</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="build/css/custom.css?v=<?=filemtime("build/css/custom.css")?>">
    </head>
    <body>
        <!-- MultiStep Form -->
        <div class="container-fluid" id="grad1">
            <div class="row justify-content-center align-items-center telacheia mt-0">
                <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
                    <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                        <h2><strong>Planium</strong></h2>
                        <div class="row">
                            <div class="col-md-12 mx-0">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nome do Beneficiário</th>
                                            <th>Idade do Beneficiário</th>
                                            <th>Preço do Plano</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach($beneficiarios as $indice=>$segurado)
                                        {
                                            if(is_array($segurado)&& count($segurado)>1)
                                            {
                                    ?>
                                        <tr>
                                            <td><?=$segurado['nome']?></td>
                                            <td><?=$segurado['idade']?></td>
                                            <td>R$ <?=number_format($segurado['preco'],2,",",".")?></td>
                                        </tr>
                                        <?php
                                            }
                                            else
                                            {
                                        ?>
                                    </tbody>
                                    <tfooter>
                                        <tr>
                                            <th colspan="2">Preço Total do Plano:</th>
                                            <td>R$ <?=number_format($total,2,",",".")?></td>
                                        </tr>
                                    </tfooter>
                                        <?php
                                            }
                                        }
                                        ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    </body>
</html>