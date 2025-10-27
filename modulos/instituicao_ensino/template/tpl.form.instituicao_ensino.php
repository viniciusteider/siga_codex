<form action="#" name="frm_instituicao_ensino" id="frm_instituicao_ensino" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="nome_instituicao">*Nome Instituicao</label>
                    <input type="text" name="nome_instituicao"  id="nome_instituicao" maxlength="255" class="form-control validar-obrigatorio " value="<?=$linha['nome_instituicao'];?>"/>
                    <div class="text-muted"> Preencha o campo  Nome Instituicao </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="dependencia">Dependencia</label>
                    <input type="text" name="dependencia"  id="dependencia" maxlength="15" class="form-control  " value="<?=$linha['dependencia'];?>"/>
                    <div class="text-muted"> Preencha o campo  Dependencia </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="instituicao">Instituicao</label>
                    <input type="text" name="instituicao"  id="instituicao" maxlength="15" class="form-control  " value="<?=$linha['instituicao'];?>"/>
                    <div class="text-muted"> Preencha o campo  Instituicao </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-4">
                <div class="form-group">
                    <label class="form-label" for="estado">Estado</label>
                    <?php
                    $objEstados     = new Estados();
                    $registros = $objEstados->ComboEstados();
                    $onchange = ' onchange="Squall.ListarSelect2(\'index_xml.php?app_modulo=cidades&app_comando=filtrar_cidade&app_codigo=\',\'#id_cidade\',this.value)"';
                    echo Componente::GerarSelectPDO("id_estado", "id_estado", "", $registros, array($linha['id_estado']), array('','Selecione um Estado'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',' data-validar="select2" '.$onchange);
                    ?>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-4">
                <div class="form-group">
                    <label class="form-label" for="cidade">Cidade</label>
                    <?php
                    $cidade = new Cidades();
                    $cidade->setIdEstado($linha['id_estado']);
                    $registros = $cidade->ComboCidade();
                    echo Componente::GerarSelectPDO("id_cidade","id_cidade","",$registros,array($linha['id_cidade']),Array("","-- Selecione uma Cidade --"),Array("id", "nome"),false, "form-select  m-b-20 m-r-10 ",' data-validar="select2"');
                    ?>
                </div>
            </div>
        </div>
</form>
