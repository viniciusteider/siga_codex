<form action="#" name="frm_fabricante" id="frm_fabricante" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-7 mb-2">
                <div class="form-group">
                    <label class="form-label" for="nome">*Nome:</label>
                    <input type="text" name="nome"  id="nome" maxlength="50" class="form-control validar-obrigatorio " value="<?=$linha['nome'];?>"/>
                    <div class="text-muted"> Preencha o campo  Nome </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="cnpj">Cnpj:</label>
                    <input type="text" name="cnpj"  id="cnpj" maxlength="20" class="form-control mask-cnpj " value="<?=$linha['cnpj'];?>"/>
                    <div class="text-muted"> Preencha o campo  Cnpj </div>
                </div>
            </div>
            <div class="col-md-2 mb-2 mt-12 ">
                <div class="form-group">
                    <input class="form-check-input ms-3" type="checkbox" <?php if($linha['liberado'] == 1) echo 'checked="checked"' ?> value="1" name="liberado" id="liberado">
                    <label class="form-label" for="liberado">Liberado:</label>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="contatos_tecnicos">Contatos Tecnicos:</label>
                    <textarea class="form-control  " name="contatos_tecnicos"  id="contatos_tecnicos" placeholder="Insira o texto" ><?=$linha['contatos_tecnicos'];?></textarea>
                    <div class="text-muted"> Preencha o campo  Contatos Tecnicos </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="contatos_comerciais">Contatos Comerciais:</label>
                    <textarea class="form-control  " name="contatos_comerciais"  id="contatos_comerciais" placeholder="Insira o texto" ><?=$linha['contatos_comerciais'];?></textarea>
                    <div class="text-muted"> Preencha o campo  Contatos Comerciais </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="observacoes">Observacoes:</label>
                    <textarea class="form-control  " name="observacoes"  id="observacoes" placeholder="Insira o texto" ><?=$linha['observacoes'];?></textarea>
                    <div class="text-muted"> Preencha o campo  Observacoes </div>
                </div>
            </div>
            <!--/span-->

            <!--/span-->
        </div>
</form>
