<form action="#" name="frm_cid" id="frm_cid" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="capitulo">*Capitulo</label>
                    <input type="text" name="capitulo"  id="capitulo"  class="form-control validar-obrigatorio " value="<?=$linha['capitulo'];?>"/>
                    <div class="text-muted"> Preencha o campo  Capitulo </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="agrupamento">*Agrupamento</label>
                    <input type="text" name="agrupamento"  id="agrupamento" maxlength="" class="form-control validar-obrigatorio mask-numero" value="<?=$linha['agrupamento'];?>"/>
                    <div class="text-muted"> Preencha o campo  Agrupamento </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="categoria">*Categoria</label>
                    <input type="text" name="categoria"  id="categoria" maxlength="" class="form-control validar-obrigatorio mask-numero" value="<?=$linha['categoria'];?>"/>
                    <div class="text-muted"> Preencha o campo  Categoria </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="sub_categoria">Sub Categoria</label>
                    <input type="text" name="sub_categoria"  id="sub_categoria" maxlength="" class="form-control  mask-numero" value="<?=$linha['sub_categoria'];?>"/>
                    <div class="text-muted"> Preencha o campo  Sub Categoria </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="codigo">*Codigo</label>
                    <input type="text" name="codigo"  id="codigo" maxlength="5" class="form-control validar-obrigatorio " value="<?=$linha['codigo'];?>"/>
                    <div class="text-muted"> Preencha o campo  Codigo </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="nome">Nome</label>
                    <input type="text" name="nome"  id="nome" maxlength="255" class="form-control  " value="<?=$linha['nome'];?>"/>
                    <div class="text-muted"> Preencha o campo  Nome </div> </div>
            </div>
            <!--/span-->
        </div>
</form>
