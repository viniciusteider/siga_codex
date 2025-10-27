<form action="#" name="frm_produtos_modelo" id="frm_produtos_modelo" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_produto_marca">Marca:</label>
                    <?php
                    $objMarca  = new ProdutosMarca();
                    $registros = $objMarca->ListarCombo();
                    echo Componente::GerarSelectPDO("id_produto_marca", "id_produto_marca", "", $registros, array($linha['id_produto_marca']), array('','Selecione uma Marca'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','data-validar="select2"');
                    ?>
<!--                    <input type="text" name="id_produto_marca"  id="id_produto_marca" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_produto_marca'];?><!--"/>-->
                    <div class="text-muted"> Selecione Marca </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="nome">Nome:</label>
                    <input type="text" name="nome"  id="nome" maxlength="45" class="form-control  " value="<?=$linha['nome'];?>"/>
                    <div class="text-muted"> Preencha o campo  Nome </div>
                </div>
            </div>
            <!--/span-->
        </div>
</form>
