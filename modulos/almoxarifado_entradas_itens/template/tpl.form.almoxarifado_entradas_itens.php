<div class="form-body" data-repeater-list="produtos">
    <?php
        $almoxarifado_entradas_itens = new AlmoxarifadoEntradasItens();
        $almoxarifado_entradas_itens->setIdEntrada($linha["id"]);
        $itens = $almoxarifado_entradas_itens->ListarItensEntrada();
        if(count($itens ?? []) > 0 )
        {
            foreach ($itens as $item) {
                ?>
                 <div class="row p-t-20"  data-repeater-item >
                     <input type="hidden" name="id_item_produto"  maxlength="" data-kt-repeater="id_item_produto" class="form-control  mask-numero" value="<?=$item['id'];?>"/>
                    <div class="col-md-5 mb-2">
                        <div class="form-group">
                            <label class="form-label" for="id_produto">Produto:</label>
                            <select name="id_produto" class=" form-select " data-kt-repeater="id_produto" data-placeholder="Selecione um Produto"  >
                                <?php
                                $objProdutos =  new Produtos();
                                $objProdutos->setIdGrupo($_SESSION['usuario']['id_grupo']);
                                $registros = $objProdutos->ListarCombo($item['id_produto']);
                                foreach ($registros as $row)
                                {
                                    $selected = ($item['id_produto'] == $row['id']) ? 'selected="selected"' : '';
                                    echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nome'].'</option>';
                                }
                                ?>
                            </select>
                            <!--                <input type="text" name="id_produto" maxlength="" data-kt-repeater="id_produto" class="form-control  mask-numero" value="--><?//=$linha['id_produto'];?><!--"/>-->
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-3 mb-2">
                        <div class="form-group">
                            <label class="form-label" for="quantidade">Quantidade:</label>
                            <input type="text" name="quantidade"  maxlength="" data-kt-repeater="quantidade" class="form-control  mask-numero" value="<?=$item['quantidade'];?>"/>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="form-label" for="valor">Valor:</label>
                            <div class="input-group mb-5">
                                <span class="input-group-text">R$</span>
                                <input type="text" name="valor"    class="form-control " data-kt-repeater="valor"   value="<?=number_format($item['valor'],'2',',','.');?>"/>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-1">
                        <a href="javascript:;" data-repeater-delete class="btn  btn-danger btn-icon mt-3 mt-md-8">
                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                        </a>
                    </div>
                    <!--/span-->
                </div>
                <?
            }
        }
        else
        {
            ?>
            <div class="row p-t-20"  data-repeater-item >
                <div class="col-md-5 mb-2">
                    <div class="form-group">
                        <label class="form-label" for="id_produto">Produto:</label>
                        <select name="id_produto" class=" form-select " data-kt-repeater="id_produto" data-placeholder="Selecione um Produto"  >
                            <?php
                            $objProdutos =  new Produtos();
                            $objProdutos->setIdGrupo($_SESSION['usuario']['id_grupo']);
                            $registros = $objProdutos->ListarCombo($linha['id_produto']);
                            foreach ($registros as $row)
                            {
                                $selected = ($linha_produtos['id_produto'] == $row['id']) ? 'selected="selected"' : '';
                                echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nome'].'</option>';
                            }
                            ?>
                        </select>
                        <!--                <input type="text" name="id_produto" maxlength="" data-kt-repeater="id_produto" class="form-control  mask-numero" value="--><?//=$linha['id_produto'];?><!--"/>-->
                    </div>
                </div>
                <!--/span-->
                <div class="col-md-3 mb-2">
                    <div class="form-group">
                        <label class="form-label" for="quantidade">Quantidade:</label>
                        <input type="text" name="quantidade"  maxlength="" data-kt-repeater="quantidade" class="form-control  mask-numero" value="<?=$linha['quantidade'];?>"/>
                    </div>
                </div>
                <!--/span-->
                <div class="col-md-3 mb-3">
                    <div class="form-group">
                        <label class="form-label" for="valor">Valor:</label>
                        <div class="input-group mb-5">
                            <span class="input-group-text">R$</span>
                            <input type="text" name="valor"    class="form-control " data-kt-repeater="valor"   value="<?=number_format($linha['valor'],'2',',','.');?>"/>
                        </div>

                    </div>
                </div>
                <div class="col-md-1">
                    <a href="javascript:;" data-repeater-delete class="btn  btn-danger btn-icon mt-3 mt-md-8">
                        <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                    </a>
                </div>
                <!--/span-->
            </div>
            <?
        }

    ?>


</div>
<div class="col-md-3 mb-2">
    <a href="javascript:;" data-repeater-create class="btn btn-primary mt-2 ">
        <i class="ki-duotone ki-plus fs-3"></i>Adicionar mais produtos
    </a>
</div>

