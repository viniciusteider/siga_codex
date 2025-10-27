<form action="#" name="frm_produtos_sub_grupo" id="frm_produtos_sub_grupo" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_produto_grupo">Grupo:</label>
                    <?php
                    $objGrupos  = new ProdutosGrupo();
                    $objGrupos->setIdGrupo($_SESSION['usuario']['id_grupo']);
                    $registros = $objGrupos->ListarCombo();
                    echo Componente::GerarSelectPDO("id_produto_grupo", "id_produto_grupo", "", $registros, array($linha['id_produto_grupo']), array('','Selecione um Grupoo'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','data-validar="select2"');
                    ?>
<!--                    <input type="text" name="id_produto_grupo"  id="id_produto_grupo" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_produto_grupo'];?><!--"/>-->
                    <div class="text-muted"> Selecioneo Grupo </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="nome">Nome:</label>
                    <input type="text" name="nome"  id="nome" maxlength="45" class="form-control  " value="<?=$linha['nome'];?>"/>
                    <div class="text-muted"> Preencha o campo  Nome </div>
                </div>
            </div>
            <!--/span-->
        </div>
</form>
