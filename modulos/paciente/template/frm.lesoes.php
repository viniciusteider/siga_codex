<style>
    #tb_lesoes > :not(caption) > * > * {
        padding: 0.35rem 0.35rem !important;
    }
</style>
<div class="row">
    <div class="col-md-7">
        <h4> Principais Lesões</h4>
        <table class="table  table-bordered table-striped table-hover" id="tb_lesoes">
            <thead>
            <tr>
                <th>Lesão</th>
                <?php
                $objPartesCorpo = new PartesCorpo();
                $itensPartes = $objPartesCorpo->ListarCombo();
                if(is_array($itensPartes) && count($itensPartes) > 0) {
                    foreach ($itensPartes as $item) {
                        echo ' <th align="center">'.$item['nome'].'</th>';
                    }
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            $array_selecionados = array();
            $objPacienteLesoes = new PacienteLesoes();
            $selecionados = $objPacienteLesoes->ListarPaciente($linha['id']);
            if(is_array($selecionados) && count($selecionados) > 0) {
                foreach ($selecionados as $sl) $array_selecionados[$sl['id_lesao']][]= $sl['id_parte_corpo'];
            }
//            Conexao::pr($array_selecionados);
            $objlesoes = new Lesoes();
            $itens = $objlesoes->ListarCombo();
            $x = 0;
            if(is_array($itens) && count($itens) > 0) {

                foreach ($itens as $item) {
                    echo '
                        <tr>
                            <td>'.$item['nome'].'</td>';

                    foreach ($itensPartes as $parte)
                    {
                        $lesoes = (is_array($array_selecionados[$item['id']])) ? $array_selecionados[$item['id']] : [];
                        if( array_search($parte['id'],$lesoes)  !== false)
                        {
                             $checked2 = 'checked="checked"';
                        }
                        else
                            $checked2 = '';

                        echo '<td align="center">
                                <label for="lesoes_'.$item['id'].'_'.$parte['id'].'" style="width:100%;height:100%" >
                                <input class="form-check-input " '.$checked2.' type="checkbox" value="'.$parte['id'].'" id="lesoes_'.$item['id'].'_'.$parte['id'].'" name="lesoes['.$item['id'].'][]"/>
                                </label>
                            </td>';
                        $x++;
                    }
                    echo '</tr>';

                }
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-5">
        <h4> Obstetrícia</h4>
        <div class="rounded border p-5 ">
            <div class="row p-t-20">
                <div class="col-md-12 mb-2">
                    <div class="form-group">
                        <label class="form-label" for="id_tipo_obstetricia">Tipo Obstetrícia</label>
                        <?php
                        $objTipoOb  = new TipoObstetricia();
                        $registros = $objTipoOb->ListarCombo($linha['id_tipo_obstetricia']);
                        echo Componente::GerarSelectPDO("id_tipo_obstetricia", "id_tipo_obstetricia", "", $registros, array($linha['id_tipo_obstetricia']), array('','Selecione Tipo Obstetrícia'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',''.$onchange);
                        ?>
                         </div>
                </div>
                <!--/span-->
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="form-label" for="idade_gestacional">Idade Gestacional</label>
                        <input type="text" name="idade_gestacional"  id="idade_gestacional" maxlength="" class="form-control  mask-numero" value="<?=$linha['idade_gestacional'];?>"/>
                        </div>
                </div>
                <!--/span-->
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="form-label" for="bcf">BCF</label>
                        <input type="text" name="bcf"  id="bcf" maxlength="" class="form-control  mask-numero" value="<?=$linha['bcf'];?>"/>
                         </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                    <?php
                    $objEstagioParto = new EstagioParto();
                    $itens = $objEstagioParto->ListarCombo();
                    if(is_array($itens) && count($itens) > 0) {
                        foreach ($itens as $item) {
                            echo '
                      
                            <div class="col-md-6 ">
                                <div class="rounded border p-3 ">
                                     <h4> '.$item['nome'].'</h4>
                        ';
                            $objSinais = new SinaisClinicosObstetricia();
                            $itens2 = $objSinais->ListarComboEstagio($item['id'],$linha['id']);
                            if (is_array($itens2) && count($itens2) > 0) {
                                foreach ($itens2 as $item2) {
                                    $checked = ($item2['id_paciente_sinais'] != "") ? 'checked="checked"' : '';
                                    echo '
                                       <label class="d-flex flex-stack mb-1 cursor-pointer">
                                            <span class="d-flex align-items-center me-2">
                                                <span class="d-flex flex-column">
                                                    <span class="fw-bold fs-6 text-muted">'.$item2['procedimentos'].'</span>
                                                </span>
                                            </span>
                                            <span class="form-check form-check-custom form-check-solid">
                                                <input class="form-check-input" type="radio" '.$checked.'  name="obstetricia['.$item['id'].']" id="circulacao_'.$item['id'].'_'.$item2['id'].'" value="'.$item2['id'].'"/>
                                            </span>
                                        </label>';
                                }
                            }


                            echo '    </div>
                                 </div>
                        ';
                        }
                    }
                    ?>
                    </div>
                </div>
                <!--/span-->
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="form-label" for="apgar_1">Apgar #1</label>
                        <input type="text" name="apgar_1"  id="apgar_1" maxlength="" class="form-control  mask-numero" value="<?=$linha['apgar_1'];?>"/>
                         </div>
                </div>
                <!--/span-->
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="form-label" for="apgar_5">Apgar #5</label>
                        <input type="text" name="apgar_5"  id="apgar_5" maxlength="" class="form-control  mask-numero" value="<?=$linha['apgar_5'];?>"/>
                        </div>
                </div>
                <!--/span-->
            </div>
        </div>
    </div>
</div>