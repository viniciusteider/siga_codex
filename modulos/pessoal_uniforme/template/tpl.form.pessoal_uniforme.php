<form action="#" name="frm_pessoal_uniforme" id="frm_pessoal_uniforme" method="post">
    <input type="hidden" name="id_uniforme"  id="id_uniforme"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">

            <div class="col-md-5 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_peca">Peça</label>
                    <?php
                    $peca = new UniformePeca();
                    $registros = $peca->ListarCombo();
                    $onchange = ' onchange="Squall.ListarSelect2(\'index_xml.php?app_modulo=uniforme_tamanho&app_comando=listar_uniforme_tamanho_filtro_id&app_codigo=\',\'#id_tamanho\',this.value)"';
                    echo Componente::GerarSelectPDO("id_peca","id_peca","",$registros,array($linha['id_peca']),Array("","-- Selecione um Peça--"),Array("id", "nome"),false, "form-select  ",$onchange. ' data-validar="select2"');
                    ?>
<!--                    <input type="text" name="id_peca"  id="id_peca" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_peca'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Id Peca </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-5 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_tamanho">Tamanho</label>
                    <?php
                    $tamanho = new UniformeTamanho();
                    $registros = $tamanho->BuscarPorIdTamanho($linha['id_peca']);
                    echo Componente::GerarSelectPDO("id_tamanho","id_tamanho","",$registros,array($linha['id_tamanho']),Array("","-- Selecione um Tamanho--"),Array("id", "nome"),false, "form-select  ",' data-validar="select2"');
                    ?>
<!--                    <input type="text" name="id_tamanho"  id="id_tamanho" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_tamanho'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Id Tamanho </div> </div>
            </div>
            <!--/span-->
<!--            <div class="col-md-4 mb-2">-->
<!--                <div class="form-group">-->
<!--                    <label class="form-label" for="resp_casdastro">Resp Casdastro</label>-->
<!--                    <input type="text" name="resp_casdastro"  id="resp_casdastro" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['resp_casdastro'];?><!--"/>-->
<!--                    <div class="text-muted"> Preencha o campo  Resp Casdastro </div> </div>-->
<!--            </div>-->
            <!--/span-->
        </div>
</form>
<?php
include_once("modulos/pessoal_uniforme/template/js.modal.pessoal_uniforme.php");
?>
