<h2 class="fs-title mb-4">Nome dos Beneficiários:</h2>
<div class="row">
<?php
    $qtd = $_POST['qtd'];
    if(!empty($qtd))
    {
        for($i=1;$i<=$qtd;$i++)
        {
?>
    <div class="col-3">
        <label class="mt-2" for="nome<?=$i?>">Nome do Beneficiário <?=$i?>:</label>
    </div>
    <div class="col-9">
        <input type="text" name="nome[]" class="nome" placeholder="Informe aqui o nome do beneficiário <?=$i?>" required>
    </div>
<?php
        }
    }
    else
    {
?>
    <div class="col-12">
        <h3>A quantidade de beneficiários não foi informada</h3>
    </div>
<?php
    }
?>
</div>