<form action="#" name="frm_escala_mensal" id="frm_escala_mensal" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">

        <!--begin::Repeater-->
        <div  id="kt_docs_repeater_basic">
            <!--begin::Form group-->
            <div class="form-group">
                <div data-repeater-list="dias" >
                    <div data-repeater-item class="row">
                        <!--/span-->
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="id_equipe">Equipe:</label>
                                <select name="id_equipe"  class=" form-select border-end  " data-kt-repeater="id_equipe" data-placeholder="Selecione o Local"   >
                                    <?php
                                    $objEquipes = new Equipes();
                                    $registros = ($linha['id_equipe'] != "") ? $objEquipes->ListarCombo($linha['id_equipe'],$_SESSION['usuario']['id_grupo']) :[];
                                    $lista = (is_array($registros) && count($registros) > 0) ? $registros : [['id' => '', 'nome' => "Selecione Equipe"]] ;
                                    foreach ($registros as $row)
                                    {
                                        $selected = ($linha['id_local'] == $row['id']) ? 'selected="selected"' : '';
                                        echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nome'].'</option>';
                                    }
                                    ?>
                                </select>
                                <div class="text-muted"> Selecione Equipe </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="id_local">Local:</label>
                                <select name="id_local"  class=" form-select border-end  " data-kt-repeater="id_local" data-placeholder="Selecione o Local"   >
                                    <?php
                                    $locais  = new EscalaLocais();
                                    $registros = $locais->ListarComboComRecursos($_SESSION['usuario']['id_grupo']);
                                    $lista = (is_array($registros) && count($registros) > 0) ? $registros : [['id' => '', 'nome' => "Selecione Local"]] ;
                                    foreach ($registros as $row)
                                    {
                                        $selected = ($linha['id_local'] == $row['id']) ? 'selected="selected"' : '';
                                        echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nome'].'</option>';
                                    }
                                    ?>
                                </select>

                                <!--<input type="text" name="id_local"  id="id_local" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_local'];?><!--"/>-->
                                <div class="text-muted"> Selecione Local </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-2 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="data_hora_entrada">Data Hora Entrada:</label>
                                <input type="text" name="data_hora_entrada"  id="data_hora_entrada" data-kt-repeater="data_hora_entrada"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['data_hora_entrada'],$_SESSION['usuario']['timezone']);?>"/>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-2 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="data_hora_saida">Data Hora Saida:</label>
                                <input type="text" name="data_hora_saida"  id="data_hora_saida"   data-kt-repeater="data_hora_saida" class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['data_hora_saida'],$_SESSION['usuario']['timezone']);?>"/>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-1">
                            <a href="javascript:;" data-repeater-delete class="btn btn-light-danger btn-icon mt-3 mt-md-8">
                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-5">
                    <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                        <i class="ki-duotone ki-plus fs-3"></i>
                        Adicionar
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
