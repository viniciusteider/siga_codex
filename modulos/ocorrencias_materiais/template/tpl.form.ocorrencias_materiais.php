<form action="#" name="frm_ocorrencias_materiais" id="frm_ocorrencias_materiais" method="post">
    <input type="hidden" name="id_ocorrencia_material"  id="id_ocorrencia_material"   value="<?=$linha['id'];?>"/>
    <div class="row" id="div_materiais_itens">
        <div class="form-body" data-repeater-list="itens">
            <div class="row p-t-20">

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="form-label" for="id_hospital">Hospital:</label>
                        <?php
                        $objHospital  = new Hospital();
                        $registros = $objHospital->ListarCombo($linha['id_hospital']);
                        echo Componente::GerarSelectPDO("id_hospital", "id_hospital", "", $registros, array($linha['id_hospital']), array('','Selecione Hospital'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',''.$onchange);
                        ?>
                        <!--                        <input type="text" name="id_hospital"  id="id_hospital" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_hospital'];?><!--"/>-->
                        <div class="text-muted"> Selecione  Id Hospital </div>
                    </div>
                </div>
                <!--/span-->
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="form-label" for="responsavel_hospital">Responsavel Hospital:</label>
                        <input type="text" name="responsavel_hospital"  id="responsavel_hospital" maxlength="100" class="form-control  " value="<?=$linha['responsavel_hospital'];?>"/>
                        <div class="text-muted"> Preencha o campo  Responsavel Hospital </div>
                    </div>
                </div>
                <!--/span-->
            </div>
            <?php
            $objItens = new OcorrenciasMateriaisItens();
            $itens = $objItens->ListarCombo($linha['id']);
            if(count($itens ?? []) > 0)
            {
                foreach ($itens as $item)
                {
                    ?>
                    <div class="row p-t-20"  data-repeater-item >
                        <input name="id_materiais_itens" type="hidden" value="<?=$item['id'];?>" data-kt-repeater="id_materiais_itens">
                        <div class="col-md-8 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="id_item">Item:</label>
                                <?php
                                $objItens  = new MateriaisItens();
                                $registros = $objItens->ListarCombo($item['id_item']);
                                echo Componente::GerarSelectPDO("id_item", "id_item", "", $registros, array($item['id_item']), array('','Selecione Item'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',' data-kt-repeater="id_item" '.$onchange);
                                ?>
                                <!--                        <input type="text" name="id_item"  id="id_item" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_item'];?><!--"/>-->
                                <div class="text-muted"> Selecione o Item </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-3 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="quantidade">Quantidade:</label>
                                <input type="text" name="quantidade"  id="quantidade" maxlength="" data-kt-repeater="quantidade" class="form-control  mask-numero" value="<?=$item['quantidade'];?>"/>
                                <div class="text-muted"> Quantidade deste item </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-1">
                            <a href="javascript:;" data-repeater-delete class="btn btn-light-danger btn-icon mt-3 mt-md-8">
                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            </a>
                        </div>
                    </div>
                    <?
                }
            }
            else
            {
                ?>
                <div class="row p-t-20"  data-repeater-item >
                    <div class="col-md-8 mb-2">
                        <div class="form-group">
                            <label class="form-label" for="id_item">Item:</label>
                            <?php
                            $objItens  = new MateriaisItens();
                            $registros = $objItens->ListarCombo($linha['id_item']);
                            echo Componente::GerarSelectPDO("id_item", "id_item", "", $registros, array($linha['id_item']), array('','Selecione Item'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',' data-kt-repeater="id_item" '.$onchange);
                            ?>
                            <!--                        <input type="text" name="id_item"  id="id_item" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_item'];?><!--"/>-->
                            <div class="text-muted"> Preencha o campo  Id Item </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-3 mb-2">
                        <div class="form-group">
                            <label class="form-label" for="quantidade">Quantidade:</label>
                            <input type="text" name="quantidade"  id="quantidade" maxlength="" data-kt-repeater="quantidade" class="form-control  mask-numero" value="<?=$linha['quantidade'];?>"/>
                            <div class="text-muted"> Preencha o campo  Quantidade </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-1">
                        <a href="javascript:;" data-repeater-delete class="btn btn-light-danger btn-icon mt-3 mt-md-8">
                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                        </a>
                    </div>
                </div>
                <?
            }
            ?>

        </div>
        <div class="form-group mt-5">
            <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                <i class="ki-duotone ki-plus fs-3"></i>
                Adicionar
            </a>
        </div>
    </div>
</form>
<?php
include_once("modulos/ocorrencias_materiais/template/js.modal.ocorrencias_materiais.php");
?>
