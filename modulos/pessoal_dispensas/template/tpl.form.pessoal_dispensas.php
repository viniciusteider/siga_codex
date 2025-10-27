<form action="#" name="frm_pessoal_dispensas" id="frm_pessoal_dispensas" method="post">
    <input type="hidden" name="id_dispensa"  id="id_dispensa"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_tipo_dispensa">*Tipo Dispensa</label>
                    <?php
                    $dispensa= new TipoDispensa();
                    $registros = $dispensa->ListarCombo($linha['id_tipo_dispensa']);
                    echo Componente::GerarSelectPDO("id_tipo_dispensa","id_tipo_dispensa","",$registros,array($linha['id_tipo_dispensa']),Array("","-- Selecione o Tipo de afastamento --"),Array("id", "nome"),false, "form-select  ",' data-validar="select2"');
                    ?>
<!--                    <input type="text" name="id_tipo_dispensa"  id="id_tipo_dispensa" maxlength="" class="form-control validar-obrigatorio mask-numero" value="--><?//=$linha['id_tipo_dispensa'];?><!--"/>-->
                    <div class="text-muted"> Selecione o  Tipo Dispensa </div> </div>
            </div>
            <!--/span-->

            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_inicio">Data Início</label>
                    <input type="text" name="data_inicio"  id="data_inicio"  class="form-control  mask-data" value="<?=Conexao::PrepararDataPHP($linha['data_inicio'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Inicio </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_termino">Data Término</label>
                    <input type="text" name="data_termino"  id="data_termino"  class="form-control  mask-data" value="<?=Conexao::PrepararDataPHP($linha['data_termino'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Termino </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="motivo">Motivo</label>
                    <input type="text" name="motivo"  id="motivo" maxlength="100" class="form-control  " value="<?=$linha['motivo'];?>"/>
                    <div class="text-muted"> Preencha o campo  Motivo </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="observacao">Observação</label>
                    <textarea class="form-control  " name="observacao"  id="observacao" placeholder="Insira o texto" ><?=$linha['observacao'];?></textarea>
                    <div class="text-muted"> Preencha o campo  Observacao </div> </div>
            </div>
            <!--/span-->
        </div>
</form>
<?php
include_once("modulos/pessoal_dispensas/template/js.modal.pessoal_dispensas.php");
?>