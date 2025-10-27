<form action="#" name="frm_fornecedor" id="frm_fornecedor" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <input type="hidden" name="id_endereco"  id="id_endereco"   value="<?=$linha['id_endereco'];?>"/>
    <input type="hidden" name="latitude"  id="latitude"   value="<?=$linha['latitude'];?>"/>
    <input type="hidden" name="longitude"  id="longitude"   value="<?=$linha['longitude'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="nome">Nome:</label>
                    <input type="text" name="nome"  id="nome" maxlength="45" class="form-control  " value="<?=$linha['nome'];?>"/>
                    <div class="text-muted"> Preencha o campo  Nome </div>
                </div>
            </div>
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="cpf">Cpf:</label>
                    <input type="text" name="cpf"  id="cpf" maxlength="45" class="form-control  mask-cpf" value="<?=$linha['cpf'];?>"/>
                    <div class="text-muted"> Preencha o campo  Cpf </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="cnpj">Cnpj:</label>
                    <input type="text" name="cnpj"  id="cnpj" maxlength="45" class="form-control mask-cnpj " value="<?=$linha['cnpj'];?>"/>
                    <div class="text-muted"> Preencha o campo  Cnpj </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="qualificacao">Qualificacao:</label>
                    <input type="text" name="qualificacao"  id="qualificacao" maxlength="" class="form-control  mask-numero" value="<?=$linha['qualificacao'];?>"/>
                    <div class="text-muted"> Preencha o campo  Qualificacao </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="ramo_atividde">Ramo Atividde:</label>
                    <input type="text" name="ramo_atividde"  id="ramo_atividde" maxlength="" class="form-control  mask-numero" value="<?=$linha['ramo_atividde'];?>"/>
                    <div class="text-muted"> Preencha o campo  Ramo Atividde </div>
                </div>
            </div>
            <!--/span-->



            <!--/span-->
            <div class="col-md-6 mb-4">
                <div class="form-group">
                    <label class="form-label" for="logradouro">Logradouro</label>
                    <input type="text" name="logradouro"  id="logradouro" maxlength="255" class="form-control  " value="<?=$linha['logradouro'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-4">
                <div class="form-group">
                    <label class="form-label" for="numero">Numero</label>
                    <input type="text" name="numero"  id="numero" maxlength="10" class="form-control  " value="<?=$linha['numero'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-4">
                <div class="form-group">
                    <label class="form-label" for="complemento">Complemento</label>
                    <input type="text" name="complemento"  id="complemento" maxlength="50" class="form-control  " value="<?=$linha['complemento'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-4">
                <div class="form-group">
                    <label class="form-label" for="bairro">Bairro</label>
                    <input type="text" name="bairro"  id="bairro" maxlength="255" class="form-control  " value="<?=$linha['bairro'];?>"/>
                </div>
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
            <!--/span-->
            <div class="col-md-3 mb-4">
                <label class="form-label" for="cep">Cep</label>
                <div class="input-group"   >
                    <input type="text" name="cep"  id="cep" onblur="Squall.BuscarCep(this.value)"  class="form-control  mask-cep" value="<?=$linha['cep'];?>"/>
                    <span class="input-group-text" >
                                    <i class="fas fa-search"></i>
                                </span>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-6 mb-4">
                <div class="form-group">
                    <label class="form-label" for="referencia">Referencia</label>
                    <input type="text" name="referencia"  id="referencia"  maxlength="255"  class="form-control  " value="<?=$linha['referencia'];?>"/>
                </div>
            </div>
            <!--/span-->

            <div class="col-md-3 mb-4">
                <label class="form-label" for="telefone">Telefone</label>
                <div class="input-group"   >
                    <input type="text" name="telefone"  id="telefone"  class="form-control  " value="<?=$linha['telefone'];?>"/>
                    <span class="input-group-text" >
                                    <i class="fas fa-phone"></i>
                                </span>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-4">
                <label class="form-label" for="cep">Comercial</label>
                <div class="input-group"   >
                    <input type="text" name="comercial"  id="comercial"  class="form-control  " value="<?=$linha['comercial'];?>"/>
                    <span class="input-group-text" >
                                    <i class="fas fa-phone"></i>
                                </span>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-4">
                <label class="form-label" for="celular">Celular</label>
                <div class="input-group"   >
                    <input type="text" name="celular"  id="celular"  class="form-control  " value="<?=$linha['celular'];?>"/>
                    <span class="input-group-text" >
                                    <i class="fas fa-mobile"></i>
                                </span>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-6 mb-4">
                <div class="form-group">
                    <label class="form-label" for="email_mkt">Email</label>
                    <input type="text" name="email_mkt"  id="email_mkt" maxlength="150" class="form-control  " value="<?=$linha['email_mkt'];?>"/>

                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="form-group">
                    <label class="form-label" for="observacao">Observação de endereço</label>
                    <textarea class="form-control  " name="observacao" rows="7"  id="observacao" placeholder="Insira o texto" ><?=$linha['observacao'];?></textarea>

                </div>
            </div>
            <!--/span-->

        </div>
</form>
