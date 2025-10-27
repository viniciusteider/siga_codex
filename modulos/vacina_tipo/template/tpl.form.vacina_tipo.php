<form action="#" name="frm_vacina_tipo" id="frm_vacina_tipo" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="nome">*Nome</label>
                    <input type="text" name="nome"  id="nome" maxlength="100" class="form-control validar-obrigatorio " value="<?=$linha['nome'];?>"/>
                    <div class="text-muted"> Preencha o campo  Nome </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="qt_doses">Quantidade de Doses</label>
                    <input type="text" name="qt_doses"  id="qt_doses" maxlength="" class="form-control  mask-numero" value="<?=$linha['qt_doses'];?>"/>
                    <div class="text-muted"> Preencha o campo  Qt Doses </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="indicacao">Indicação</label>
                    <input type="text" name="indicacao"  id="indicacao" maxlength="150" class="form-control  " value="<?=$linha['indicacao'];?>"/>
                    <div class="text-muted"> Preencha o campo  Indicacao </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="intervalo_doses">Intervalo Doses</label>
                    <input type="text" name="intervalo_doses"  id="intervalo_doses" maxlength="" class="form-control  mask-numero" value="<?=$linha['intervalo_doses'];?>"/>
                    <div class="text-muted"> Preencha o campo  Intervalo Doses </div> </div>
            </div>
            <!--/span-->
        </div>
</form>
