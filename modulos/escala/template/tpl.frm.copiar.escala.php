<form action="#" name="frm_copiar_escala" id="frm_copiar_escala" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="nome">*Nome</label>
                    <input type="text" name="nome"  id="nome" maxlength="100" class="form-control validar-obrigatorio " value="<?=$linha['nome'];?>"/>
                    <div class="text-muted"> Preencha o campo  Nome </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_inicio">*Data Inicio</label>
                    <input type="text" name="data_inicio"  id="data_inicio"  class="form-control validar-obrigatorio mask-data" value="<?=Conexao::PrepararDataPHP($linha['data_inicio'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Inicio </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_fim">*Data Fim</label>
                    <input type="text" name="data_fim"  id="data_fim"  class="form-control validar-obrigatorio mask-data" value="<?=Conexao::PrepararDataPHP($linha['data_fim'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Fim </div> </div>
            </div>
            <!--/span-->
        </div>
</form>
<?php
include_once ('modulos/escala/template/js.frm.copiar.escala.php');
