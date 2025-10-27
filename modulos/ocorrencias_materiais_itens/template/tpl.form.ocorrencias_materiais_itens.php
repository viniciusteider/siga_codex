<form action="#" name="frm_ocorrencias_materiais_itens" id="frm_ocorrencias_materiais_itens" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_ocorencia_entrega">Id Ocorencia Entrega:</label>
                    <input type="text" name="id_ocorencia_entrega"  id="id_ocorencia_entrega" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_ocorencia_entrega'];?>"/>
                    <div class="text-muted"> Preencha o campo  Id Ocorencia Entrega </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_item">Id Item:</label>
                    <input type="text" name="id_item"  id="id_item" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_item'];?>"/>
                    <div class="text-muted"> Preencha o campo  Id Item </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="quantidade">Quantidade:</label>
                    <input type="text" name="quantidade"  id="quantidade" maxlength="" class="form-control  mask-numero" value="<?=$linha['quantidade'];?>"/>
                    <div class="text-muted"> Preencha o campo  Quantidade </div>
                </div>
            </div>
            <!--/span-->
        </div>
</form>
