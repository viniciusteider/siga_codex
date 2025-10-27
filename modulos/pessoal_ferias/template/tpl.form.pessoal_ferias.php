<form action="#" name="frm_pessoal_ferias" id="frm_pessoal_ferias" method="post">
    <input type="hidden" name="id_ferias"  id="id_ferias"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_inicio">Data Inicio</label>
                    <input type="text" name="data_inicio"  id="data_inicio"  class="form-control  mask-data" value="<?=Conexao::PrepararDataPHP($linha['data_inicio'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Inicio </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_termino">Data Termino</label>
                    <input type="text" name="data_termino"  id="data_termino"  class="form-control  mask-data" value="<?=Conexao::PrepararDataPHP($linha['data_termino'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Termino </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="observacoes">Observacoes</label>
                    <textarea class="form-control  " name="observacoes"  id="observacoes" placeholder="Insira o texto" ><?=$linha['observacoes'];?></textarea>
                    <div class="text-muted"> Preencha o campo  Observacoes </div> </div>
            </div>
            <!--/span-->
        </div>
</form>
<?php
include_once("modulos/pessoal_ferias/template/js.modal.pessoal_ferias.php");
?>
