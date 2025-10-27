<form action="#" name="frm_almoxarifado" id="frm_almoxarifado" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="nome">*Nome:</label>
                    <input type="text" name="nome"  id="nome" maxlength="45" class="form-control validar-obrigatorio " value="<?=$linha['nome'];?>"/>
                    <div class="text-muted"> Preencha o campo  Nome </div>
                </div>
            </div>
        </div>
</form>
