<form action="#" name="frm_pessoal_punicao" id="frm_pessoal_punicao" method="post">
    <input type="hidden" name="id_punicao"  id="id_punicao"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_tipo_punicao">* Tipo Punição</label>
                    <?php
                    $punicao= new TipoPunicao();
                    $registros = $punicao->ListarCombo($linha['id_tipo_punicao']);
                    echo Componente::GerarSelectPDO("id_tipo_punicao","id_tipo_punicao","",$registros,array($linha['id_tipo_punicao']),Array("","-- Selecione o Tipo de Punição --"),Array("id", "nome"),false, "form-select  ",' data-validar="select2"');
                    ?>
<!--                    <input type="text" name="id_tipo_punicao"  id="id_tipo_punicao" maxlength="" class="form-control validar-obrigatorio mask-numero" value="--><?//=$linha['id_tipo_punicao'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Id Tipo Punicao </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="gradacao">Gradação</label>
                    <input type="text" name="gradacao"  id="gradacao" maxlength="45" class="form-control  " value="<?=$linha['gradacao'];?>"/>
                    <div class="text-muted"> Preencha o campo  Gradacao </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="nr_dias">N.º Dias</label>
                    <input type="text" name="nr_dias"  id="nr_dias" maxlength="" class="form-control  mask-numero" value="<?=$linha['nr_dias'];?>"/>
                    <div class="text-muted"> Preencha o campo  Nr Dias </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_punicao">Data Punição</label>
                    <input type="text" name="data_punicao"  id="data_punicao"  class="form-control  mask-data" value="<?=Conexao::PrepararDataPHP($linha['data_punicao'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Punicao </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="observacoes">Observacões</label>
                    <textarea class="form-control  " name="observacoes"  id="observacoes" placeholder="Insira o texto" ><?=$linha['observacoes'];?></textarea>
                    <div class="text-muted"> Preencha o campo  Observacoes </div> </div>
            </div>
            <!--/span-->
        </div>
</form>
<?php
include_once("modulos/pessoal_punicao/template/js.modal.pessoal_punicao.php");
?>
