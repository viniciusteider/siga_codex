<form action="#" name="frm_produtos" id="frm_produtos" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="prefixo">Prefixo:</label>
                    <input type="text" name="prefixo"  id="prefixo" maxlength="45" class="form-control  " value="<?=$linha['prefixo'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="nome">Nome:</label>
                    <input type="text" name="nome"  id="nome" maxlength="45" class="form-control validar-obrigatorio " value="<?=$linha['nome'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_produto_grupo"> Produto Grupo:</label>
                    <?php
                    $produto_grupo    = new ProdutosGrupo();
                    $produto_grupo->setIdGrupo($_SESSION['usuario']['id_grupo']);
                    $registros = $produto_grupo->ListarCombo();
                    $onchange = ' onchange="Squall.ListarSelect2(\'index_xml.php?app_modulo=produtos_sub_grupo&app_comando=listar_subgrupos_select&app_codigo=\',\'#id_produto_subgrupo\',this.value)"';
                    echo Componente::GerarSelectPDO("id_produto_grupo", "id_produto_grupo", "", $registros, array($linha['id_produto_grupo']), array('','Selecione Grupo'), array("id", "nome"), false, 'form-select pf-select','data-placeholder="Selecione o Grupo" data-validar="select2"' . $onchange);
                    ?>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_produto_subgrupo">Produto Subgrupo:</label>
                    <?php
                    $produto_subgrupo    = new ProdutosSubGrupo();
                    $produto_subgrupo->setIdProdutoGrupo($linha['id_produto_grupo']);
                    $registros = $produto_subgrupo->ListarCombo();
                    echo Componente::GerarSelectPDO("id_produto_subgrupo", "id_produto_subgrupo", "", $registros, array($linha['id_produto_subgrupo']), array('','Selecione Sub-Grupo'), array("id", "nome"), false, 'form-select pf-select','data-placeholder="Selecione o SubGrupo" data-validar="select2"');
                    ?>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_tipo_produto">Tipo Produto:</label>
                    <?php
                    $produto_tipo    = new ProdutosTipo();
                    $registros = $produto_tipo->ListarCombo();
                    echo Componente::GerarSelectPDO("id_tipo_produto", "id_tipo_produto", "", $registros, array($linha['id_tipo_produto']), null, array("id", "nome"), false, 'form-select pf-select','data-placeholder="Selecione o Tipo" data-validar="select2"');
                    ?>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_fornecedor">Fornecedor:</label>
                    <?php
                    $fornecedor    = new Fornecedor();
                    $fornecedor->setIdGrupo($_SESSION['usuario']['id_grupo']);
                    $registros = $fornecedor->ListarCombo();
                    echo Componente::GerarSelectPDO("id_fornecedor", "id_fornecedor", "", $registros, array($linha['id_fornecedor']), null, array("id", "nome"), false, 'form-select pf-select','data-placeholder="Selecione o Fornecedor" data-validar="select2"');
                    ?>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_fabricante">Fabricante:</label>
                    <?php
                    $fabricante  = new Fabricante();
                    $registros = $fabricante->ListarCombo();
                    echo Componente::GerarSelectPDO("id_fabricante", "id_fabricante", "", $registros, array($linha['id_fabricante']), null, array("id", "nome"), false, 'form-select pf-select','data-placeholder="Selecione a Fabricante" data-validar="select2"');
                    ?>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_cor">Cor:</label>
                    <?php
                    $produto_cor   = new ProdutosCor();
                    $registros = $produto_cor->ListarCombo();
                    echo Componente::GerarSelectPDO("id_cor", "id_cor", "", $registros, array($linha['id_cor']), null, array("id", "nome"), false, 'form-select pf-select','data-placeholder="Selecione a cor" data-validar="select2"');
                    ?>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_unidade_medida"> Unidade Medida:</label>
                    <?php
                    $UnidadeMedida  = new UnidadeMedida();
                    $UnidadeMedida->setIdGrupo($_SESSION['usuario']['id_grupo']);
                    $registros = $UnidadeMedida->ListarCombo();
                    echo Componente::GerarSelectPDO("id_unidade_medida", "id_unidade_medida", "", $registros, array($linha['id_unidade_medida']), null, array("id", "nome"), false, 'form-select pf-select','data-placeholder="Selecione a Fabricante" data-validar="select2"');
                    ?>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="estoque_atual">Estoque Atual:</label>
                    <input type="text" name="estoque_atual"  id="estoque_atual" maxlength="" class="form-control  mask-numero" value="<?=$linha['estoque_atual'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="estoque_minimo">Estoque Minimo:</label>
                    <input type="text" name="estoque_minimo"  id="estoque_minimo" maxlength="" class="form-control  mask-numero" value="<?=$linha['estoque_minimo'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="custo">Custo:</label>
                    <input type="text" name="custo"  id="custo"  class="form-control  mask-dinheiro" value="<?=number_format($linha['custo'],'2',',','.');?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="codigo_barras">Codigo Barras:</label>
                    <input type="text" name="codigo_barras"  id="codigo_barras" maxlength="" class="form-control  mask-numero" value="<?=$linha['codigo_barras'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_marca">Marca:</label>
                    <?php
                    $produto_marca   = new ProdutosMarca();
                    $registros = $produto_marca->ListarCombo();
                    echo Componente::GerarSelectPDO("id_marca", "id_marca", "", $registros, array($linha['id_marca']), null, array("id", "nome"), false, 'form-select pf-select','data-placeholder="Selecione a Marca" data-validar="select2"');
                    ?>
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_modelo">Modelo:</label>
                    <?php
                    $produtoModelo   = new ProdutosModelo();
                    $registros = $produtoModelo->ListarCombo();
                    echo Componente::GerarSelectPDO("id_modelo", "id_modelo", "", $registros, array($linha['id_modelo']), null, array("id", "nome"), false, 'form-select pf-select','data-placeholder="Selecione o Modelo" data-validar="select2"');
                    ?>
                </div>
            </div>
            <!--/span-->
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="local">Local:</label>
                    <input type="text" name="local"  id="local" maxlength="" class="form-control  mask-numero" value="<?=$linha['local'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="compartimento">Compartimento:</label>
                    <input type="text" name="compartimento"  id="compartimento" maxlength="" class="form-control  mask-numero" value="<?=$linha['compartimento'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="referencia">Referencia:</label>
                    <input type="text" name="referencia"  id="referencia" maxlength="45" class="form-control  " value="<?=$linha['referencia'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">

                <div class="form-group">
                    <label class="form-label" for="data_validade">Data Validade:</label>
                    <div class="input-group mb-5">
                        <input type="text" class="form-control " placeholder="selecione um data" name="data_validade"  value="<?=Conexao::PrepararDataPHP($linha['data_validade'],$_SESSION['usuario']['timezone']);?>"  id="data_validade" aria-label="Selecione o Data" aria-describedby="basic-addon2">
                        <span class="input-group-text" id="basic-addon2">
									<i class="fas fa-calendar fs-4"></i>
									</span>
                    </div>
                </div>
            </div>
            <!--/span-->
<!--            <div class="col-md-2 mb-2">-->
<!--                <div class="form-group">-->
<!--                    <label class="form-label" for="retornavel">Retornavel:</label>-->
<!--                    <input type="text" name="retornavel"  id="retornavel" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['retornavel'];?><!--"/>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-2 mb-2">-->
<!--                <div class="form-group">-->
<!--                    <label class="form-label" for="controla_estoque">Controla Estoque:</label>-->
<!--                    <input type="text" name="controla_estoque"  id="controla_estoque" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['controla_estoque'];?><!--"/>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-2 mb-2">-->
<!--                <div class="form-group">-->
<!--                    <label class="form-label" for="saldo_inicial">Saldo Inicial:</label>-->
<!--                    <input type="text" name="saldo_inicial"  id="saldo_inicial" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['saldo_inicial'];?><!--"/>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-2 mb-2">-->
<!--                <div class="form-group">-->
<!--                    <label class="form-label" for="total">Total:</label>-->
<!--                    <input type="text" name="total"  id="total"  class="form-control  " value="--><?//=$linha['total'];?><!--"/>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-2 mb-2">-->
<!--                <div class="form-group">-->
<!--                    <label class="form-label" for="cautelado">Cautelado:</label>-->
<!--                    <input type="text" name="cautelado"  id="cautelado" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['cautelado'];?><!--"/>-->
<!--                </div>-->
<!--            </div>-->

            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="numero_serie">Número Serie:</label>
                    <input type="text" name="numero_serie"  id="numero_serie" maxlength="45" class="form-control  " value="<?=$linha['numero_serie'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="numero_patrimonio">Número Patrimônio:</label>
                    <input type="text" name="numero_patrimonio"  id="numero_patrimonio" maxlength="45" class="form-control  " value="<?=$linha['numero_patrimonio'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_caracteristica">Caracteristica:</label>

                    <input type="text" name="id_caracteristica"  id="id_caracteristica" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_caracteristica'];?>"/>
                </div>
            </div>
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="numero_tamanho">Numero Tamanho:</label>
                    <input type="text" name="numero_tamanho"  id="numero_tamanho" maxlength="10" class="form-control  " value="<?=$linha['numero_tamanho'];?>"/>
                </div>
            </div>
            <!--/span-->

            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="acabamento">Acabamento:</label>
                    <input type="text" name="acabamento"  id="acabamento" maxlength="45" class="form-control  " value="<?=$linha['acabamento'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="comprimento">Comprimento:</label>
                    <input type="text" name="comprimento"  id="comprimento" maxlength="45" class="form-control  " value="<?=$linha['comprimento'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="altura">Altura:</label>
                    <input type="text" name="altura"  id="altura" maxlength="" class="form-control  mask-numero" value="<?=$linha['altura'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="profundidade">Profundidade:</label>
                    <input type="text" name="profundidade"  id="profundidade" maxlength="" class="form-control  mask-numero" value="<?=$linha['profundidade'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="registro">Registro:</label>
                    <input type="text" name="registro"  id="registro" maxlength="45" class="form-control  " value="<?=$linha['registro'];?>"/>
                </div>
            </div>
            <!--/span-->
<!--            <div class="col-md-2 mb-2">-->
<!--                <div class="form-group">-->
<!--                    <label class="form-label" for="visualizar_relatorios">Visualizar Relatorios:</label>-->
<!--                    <input type="text" name="visualizar_relatorios"  id="visualizar_relatorios" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['visualizar_relatorios'];?><!--"/>-->
<!--                </div>-->
<!--            </div>-->
            <!--/span-->

            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_revestimento">Revestimento:</label>
                    <?php
                    $produtoRevestimento   = new ProdutosRevestimento();
                    $registros = $produtoRevestimento->ListarCombo();
                    echo Componente::GerarSelectPDO("id_revestimento", "id_revestimento", "", $registros, array($linha['id_revestimento']), null, array("id", "nome"), false, 'form-select pf-select','data-placeholder="Selecione o Revestimento" data-validar="select2"');
                    ?>
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="codigo_interno">Código Interno:</label>
                    <input type="text" name="codigo_interno"  id="codigo_interno" maxlength="" class="form-control  mask-numero" value="<?=$linha['codigo_interno'];?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="codigo_prefeitura">Código Prefeitura:</label>
                    <input type="text" name="codigo_prefeitura"  id="codigo_prefeitura" maxlength="" class="form-control  mask-numero" value="<?=$linha['codigo_prefeitura'];?>"/>
                </div>
            </div>
            <!--/span-->
<!--            <div class="col-md-2 mb-2">-->
<!--                <div class="form-group">-->
<!--                    <label class="form-label" for="quantidade_dia_cautela">Quantidade Dia Cautela:</label>-->
<!--                    <input type="text" name="quantidade_dia_cautela"  id="quantidade_dia_cautela" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['quantidade_dia_cautela'];?><!--"/>-->
<!--                </div>-->
<!--            </div>-->
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="foto">Foto:</label>
                    <input type="file" name="foto"  id="foto"  class="form-control dropify " data-default-file="<?php echo $linha['foto'];?>"  value="<?=$linha['foto'];?>"/>
                </div>
            </div>
            <!--/span-->
        </div>
</form>
