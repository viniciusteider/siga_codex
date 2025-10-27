<form action="#" name="frm_medicos" id="frm_medicos" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="crm">*CRM</label>
                    <input type="text" name="crm"  id="crm" maxlength="11" class="form-control validar-obrigatorio " value="<?=$linha['crm'];?>"/>
                    <div class="text-muted"> Preencha o campo  Crm </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="nome">*Nome</label>
                    <input type="text" name="nome"  id="nome" maxlength="150" class="form-control validar-obrigatorio " value="<?=$linha['nome'];?>"/>
                    <div class="text-muted"> Preencha o campo  Nome </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="tipo_inscricao">Tipo Inscricao</label>
                    <input type="text" name="tipo_inscricao"  id="tipo_inscricao" maxlength="45" class="form-control  " value="<?=$linha['tipo_inscricao'];?>"/>
                    <div class="text-muted"> Preencha o campo  Tipo Inscricao </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="situacao_inscricao">Situacao Inscricao</label>
                    <input type="text" name="situacao_inscricao"  id="situacao_inscricao" maxlength="45" class="form-control  " value="<?=$linha['situacao_inscricao'];?>"/>
                    <div class="text-muted"> Preencha o campo  Situacao Inscricao </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="especialidade">Especialidade</label>
                    <textarea class="form-control  " name="especialidade"  id="especialidade" placeholder="Insira o texto" ><?=$linha['especialidade'];?></textarea>
                    <div class="text-muted"> Preencha o campo  Especialidade </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="cro_crm">Cro Crm</label>
                    <input type="text" name="cro_crm"  id="cro_crm" maxlength="3" class="form-control  " value="<?=$linha['cro_crm'];?>"/>
                    <div class="text-muted"> Preencha o campo  Cro Crm </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="UF">UF</label>
                    <input type="text" name="UF"  id="UF" maxlength="4" class="form-control  " value="<?=$linha['UF'];?>"/>
                    <div class="text-muted"> Preencha o campo  UF </div> </div>
            </div>
            <!--/span-->
        </div>
</form>
