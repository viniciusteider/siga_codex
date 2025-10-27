<form action="#" name="frm_almoxarifado_setor" id="frm_almoxarifado_setor" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_almoxarifado">* Almoxarifado:</label>
                    <?php
                    $objAlmoxarifado =  new Almoxarifado();
                    $objAlmoxarifado->setIdGrupo($_SESSION['usuario']['id_grupo']);
                    echo $objAlmoxarifado->GerarSelec($linha['id_almoxarifado'],'id_almoxarifado','id_almoxarifado','data-placeholder="Selecione Almoxarifado" data-validar="select2" ',["id","nome"],true );
                    ?>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="nome">*Nome:</label>
                    <input type="text" name="nome"  id="nome" maxlength="45" class="form-control validar-obrigatorio " value="<?=$linha['nome'];?>"/>
                    <div class="text-muted"> Preencha o campo  Nome </div>
                </div>
            </div>
            <!--/span-->
        </div>
</form>
