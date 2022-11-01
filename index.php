<?php
    $planos = file_get_contents("inc/plans.json");
    $planos = json_decode($planos,true);
    foreach($planos as $opcoes)
    {
        $opcao[$opcoes['codigo']] = $opcoes['nome'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Planium</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
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
                                <form id="msform" action="registro.php" method="post">
                                    <!-- progressbar -->
                                    <ul id="progressbar">
                                        <li class="active" id="qtd"></i><strong>Quantidade</strong></li>
                                        <li id="idade"><strong>Idade</strong></li>
                                        <li id="nome"><strong>Nome</strong></li>
                                        <li id="plano"><strong>Plano</strong></li>
                                    </ul>
                                    <!-- fieldsets -->
                                    <fieldset>
                                        <div class="form-card rounded">
                                            <h2 class="fs-title mb-4">Quantidade de Beneficiários:</h2>
                                            <input type="text" name="qtd" class="qtd" placeholder="Informe aqui a quantidade de beneficiários">
                                        </div>
                                        <input type="button" name="next" class="next action-button rounded" value="Próximo"/>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-card rounded" id="idadeBeneficiarios">
                                            
                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous" value="Anterior"/>
                                        <input type="button" name="next" class="next action-button" value="Próximo"/>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-card rounded nome">
                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous" value="Anterior"/>
                                        <input type="button" name="next" class="next action-button" value="Próximo"/>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-card rounded">
                                            <h2 class="fs-title text-center">Plano Escolhido</h2>
                                            <input type="hidden" id="idplano" name="idplano">
                                            <input class="form-control plano" list="datalistOptions" name="plano" placeholder="Informe o plano desejado">
                                            <datalist id="datalistOptions">
                                                <?php
                                                    foreach($opcao as $indice => $plano)
                                                    {
                                                ?>
                                                <option value="<?=$plano?>">
                                                <?php
                                                    }
                                                ?>
                                            </datalist>
                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous" value="Anterior"/>
                                        <input type="button" name="finish" class="next action-button submit" value="Enviar"/>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="build/js/custom.js?v=<?=filemtime("build/js/custom.js")?>"></script>
    </body>
</html>