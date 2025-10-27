<form action="#" name="frm_escala_equipe" id="frm_escala_equipe" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_escala">Id Escala</label>
                    <input type="text" name="id_escala"  id="id_escala" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_escala'];?>"/>
                    <div class="text-muted"> Preencha o campo  Id Escala </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_efetivo">Id Efetivo</label>
                    <input type="text" name="id_efetivo"  id="id_efetivo" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_efetivo'];?>"/>
                    <div class="text-muted"> Preencha o campo  Id Efetivo </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_funcao">Id Funcao</label>
                    <input type="text" name="id_funcao"  id="id_funcao" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_funcao'];?>"/>
                    <div class="text-muted"> Preencha o campo  Id Funcao </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_base">Id Base</label>
                    <input type="text" name="id_base"  id="id_base" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_base'];?>"/>
                    <div class="text-muted"> Preencha o campo  Id Base </div> </div>
            </div>
            <!--/span-->
        </div>
</form>
