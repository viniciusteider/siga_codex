<div class="row p-t-20">
    <div class="col-md-3 mb-2">
        <div class="form-group">
            <label class="form-label" for="nome">Nome</label>
            <input type="text" name="nome"  id="nome" maxlength="150" class="form-control  " value="<?=$linha['nome'];?>"/>
        </div>
    </div>
    <!--/span-->
    <div class="col-md-2 mb-2">
        <div class="form-group">
            <label class="form-label" for="rg">Rg</label>
            <input type="text" name="rg"  id="rg" maxlength="15" class="form-control  " value="<?=$linha['rg'];?>"/>
        </div>
    </div>
    <!--/span-->
    <div class="col-md-2 mb-2">
        <div class="form-group">
            <label class="form-label" for="cpf">Cpf</label>
            <input type="text" name="cpf"  id="cpf" maxlength="25" class="form-control mask-cpf " value="<?=$linha['cpf'];?>"/>
        </div>
    </div>
    <div class="col-md-1 mb-2">
        <div class="form-group">
            <label class="form-label" for="idade">Idade</label>
            <input type="text" name="idade"  id="idade" maxlength="" class="form-control  mask-numero" value="<?=$linha['idade'];?>"/>
        </div>
    </div>
    <!--/span-->
    <div class="col-md-2 mb-2">
        <div class="form-group">
            <label class="form-label" for="id_etnia">Etnia</label>
            <?php
            $objEtinia = new PessoalEtnia();
            $registros = $objEtinia->ListarCombo($linha['id_etnia']);
            echo Componente::GerarSelectPDO("id_etnia", "id_etnia", "", $registros, array($linha['id_etnia']), array('','Selecione Etnia'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',''.$onchange);
            ?>
            <!--                    <input type="text" name="id_etnia"  id="id_etnia" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_etnia'];?><!--"/>-->
            </div>
    </div>
    <!--/span-->
    <div class="col-md-2 mb-2">
        <div class="form-group">
            <label class="form-label" for="sexo">Sexo</label>
            <select class="form-select" id="sexo" name="sexo">
                <option value="" <?php if($linha['sexo'] == "")  echo 'selected'; ?>>Não Informado</option>
                <option value="M" <?php if($linha['sexo'] == "M")  echo 'selected'; ?> >Masculino</option>
                <option value="F" <?php if($linha['sexo'] == "F")  echo 'selected'; ?>>Feminino</option>
            </select>
            <!--                                        <input type="text" name="genero"  id="genero" maxlength="10" class="form-control  " value="--><?//=$linha['genero'];?><!--"/>-->
            <div class="text-muted"> Preencha o campo  Gênero </div> </div>
    </div>
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
            echo Componente::GerarSelectPDO("id_estado", "id_estado", "", $registros, array($linha['id_estado']), array('','Selecione um Estado'), array("id", "nome","sigla"), false, 'form-select  m-b-20 m-r-10',' '.$onchange);
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
            echo Componente::GerarSelectPDO("id_cidade","id_cidade","",$registros,array($linha['id_cidade']),Array("","-- Selecione uma Cidade --"),Array("id", "nome"),false, "form-select  m-b-20 m-r-10 ",' ');
            ?>
        </div>
    </div>
    <!--/span-->
    <!-- <div class="col-md-2 mb-4">
        <label class="form-label" for="cep">Cep</label>
        <div class="input-group"   >
            <input type="text" name="cep"  id="cep" onblur="Squall.BuscarCep(this.value)"  class="form-control  mask-cep" value="<?=$linha['cep'];?>"/>
            <span class="input-group-text" >
                                    <i class="fas fa-search"></i>
                                </span>
        </div>
    </div> -->
    <!--/span-->
    <div class="col-md-6 mb-4">
        <div class="form-group">
            <label class="form-label" for="referencia">Referencia</label>
            <input type="text" name="referencia"  id="referencia"  maxlength="255"  class="form-control  " value="<?=$linha['referencia'];?>"/>
        </div>
    </div>
    <!--/span-->
    <div class="col-md-2 mb-4">
        <label class="form-label" for="telefone">Telefone</label>
        <div class="input-group"   >
            <input type="text" name="telefone"  id="telefone"  class="form-control  " value="<?=$linha['telefone'];?>"/>
            <span class="input-group-text" >
                                    <i class="fas fa-phone"></i>
                                </span>
        </div>
    </div>
    <!--/span-->
    <div class="col-md-2 mb-4">
        <label class="form-label" for="cep">Comercial</label>
        <div class="input-group"   >
            <input type="text" name="comercial"  id="comercial"  class="form-control  " value="<?=$linha['comercial'];?>"/>
            <span class="input-group-text" >
                                    <i class="fas fa-phone"></i>
                                </span>
        </div>
    </div>
    <!--/span-->
    <div class="col-md-2 mb-4">
        <label class="form-label" for="celular">Celular</label>
        <div class="input-group"   >
            <input type="text" name="celular"  id="celular"  class="form-control   " value="<?=$linha['celular'];?>"/>
            <span class="input-group-text" >
                                    <i class="fas fa-mobile"></i>
                                </span>
        </div>
    </div>
    <!--/span-->
</div>
