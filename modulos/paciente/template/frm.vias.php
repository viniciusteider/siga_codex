<div class="row ">
    <div class="separator separator-content border-dark my-15 mt-5 mb-8"><span class="w-250px fw-bold h1">Sinais Vitais  </span></div>
    <?php include_once ('modulos/paciente/template/frm.sinais.php');?>
</div>
<div class="row ">
    <div class="col-md-4 ">
        <div class=" rounded border p-5" >
            <h4 class="mb-5"> Vias Aéreas Superiores</h4>
            <?php
            $objViasAereas = new ViasAereas();
            $itens = $objViasAereas->ListarCombo();
            if(is_array($itens) && count($itens) > 0)
            {
                foreach($itens as $item)
                {
                    $checked = ($linha['id_vias_aereas'] == $item['id']) ? 'checked="checked"' : '';
                    echo '
                           <label class="d-flex flex-stack mb-2 cursor-pointer">
                                <span class="d-flex align-items-center me-2">
                                    <span class="d-flex flex-column">
                                        <span class="fw-bold fs-6 text-muted">'.$item['nome'].'</span>
                                    </span>
                                </span>
                                <span class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" '.$checked.'  name="id_vias_aereas" id="id_vias_aereas_'.$item['id'].'" value="'.$item['id'].'"/>
                                </span>
                            </label>';
                }
            }
            ?>
        </div>
    </div>
    <div class="col-md-4  ">
        <div class="rounded border p-5">
            <h4 class="mb-5"> Respiração</h4>
            <?php
            $objRespiracao = new Respiracao();
            $itens = $objRespiracao->ListarCombo();
            if(is_array($itens) && count($itens) > 0)
            {
                foreach($itens as $item)
                {
                    $checked = ($linha['id_respiracao'] == $item['id']) ? 'checked="checked"' : '';
                    echo '
                           <label class="d-flex flex-stack mb-2 cursor-pointer">
                                <span class="d-flex align-items-center me-2">
                                    <span class="d-flex flex-column">
                                        <span class="fw-bold fs-6 text-muted">'.$item['nome'].'</span>
                                    </span>
                                </span>
                                <span class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" '.$checked.'  name="id_respiracao" id="id_respiracao_'.$item['id'].'" value="'.$item['id'].'"/>
                                </span>
                            </label>';
                }
            }
            ?>

        </div>
    </div>
    <div class="col-md-4 ">
        <div class="rounded border p-5 ">
            <h4 class="mb-3"> Pupilas</h4>
            <div class="d-flex mb-3">
                <div class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" <?php if($linha['id_pupilas'] == 1) echo 'checked ="checked"';?>  value="1" id="pipilas_tipo1" name="id_pupilas"/>
                    <label class="form-check-label" for="pipilas_tipo">
                        Isocórica
                    </label>
                </div>

                <div class="form-check form-check-custom form-check-solid ms-2">
                    <input class="form-check-input" type="radio" value="2" <?php if($linha['id_pupilas'] == 2) echo 'checked ="checked"';?> id="pipilas_tipo2" name="id_pupilas"/>
                    <label class="form-check-label" for="pipilas_tipo">
                        Anisocórica
                    </label>
                </div>

            </div>
            <?php
            $objPupilas = new PupilasSintomas();
            $itens = $objPupilas->ListarPupilaspPaciente($linha['id']);

//            Conexao::pr($itens);

            if(is_array($itens) && count($itens) > 0)
            {
                foreach($itens as $item)
                {
                    $checkked_direita = ($item['direita'] != "" && $item['direita'] == 1) ? 'checked="checked"' : "";
                    $checkked_esquerda = ($item['esquerda'] != "" && $item['esquerda'] == 1) ? 'checked="checked"' : "";

                    echo '<div class="d-flex mb-2">
                        <span class="fw-bold fs-6 text-muted w-md-125px">'.$item['nome'].'</span>
                            <div class="form-check form-check-custom form-check-solid form-check-sm me-10">
                                <input class="form-check-input " type="checkbox" value="1" '.$checkked_direita.' name="pupilas_sintomas['.$item['id'].'][direita]"  id="pupilas_sintomas_equerda_'.$item['id'].'"/>
                                <label class="form-check-label" for="pupilas_sintomas_equerda_'.$item['id'].'">
                                    D
                                </label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid form-check-sm me-10">
                                <input class="form-check-input " value="1" type="checkbox" '.$checkked_esquerda.' name="pupilas_sintomas['.$item['id'].'][esquerda]" id="pupilas_sintomas_direita_'.$item['id'].'"/>
                                <label class="form-check-label" for="pupilas_sintomas_direita_'.$item['id'].'">
                                    E
                                </label>
                            </div>
                            </div>
                            ';
                }
            }
            ?>
        </div>
    </div>
        <div class="col-md-12 mt-3">
            <!--begin::Example-->
            <div class="separator separator-content border-dark my-15 mt-3 mb-5"><span class="w-250px fw-bold h1">Circulação</span></div>
            <!--end::Example-->
            <div class="row">
                <?php
                $objCirculacaoLocal = new CirculacaoLocal();
                $itens = $objCirculacaoLocal->ListarCombo();
                if(is_array($itens) && count($itens) > 0) {
                    foreach ($itens as $item) {
                        echo '
                            <div class="col-md-4 ">
                                <div class="rounded border p-5 ">
                                     <h4 class="mb-5"> '.$item['nome'].'</h4>
                        ';
                                $objCirculacao = new Circulacao();
                                $itens2 = $objCirculacao->ListarCombolocal($item['id'],$linha['id']);

                                if (is_array($itens2) && count($itens2) > 0) {
                                    foreach ($itens2 as $item2) {
                                         $checked2 = ($item2['id_paciente_circulacao'] != "") ? 'checked="checked"' : '';
                                        echo '
                                       <label class="d-flex flex-stack mb-2 cursor-pointer">
                                            <span class="d-flex align-items-center me-2">
                                                <span class="d-flex flex-column">
                                                    <span class="fw-bold fs-6 text-muted">'.$item2['nome'].'</span>
                                                </span>
                                            </span>
                                            <span class="form-check form-check-custom form-check-solid">
                                                <input class="form-check-input" type="radio" '.$checked2.'  name="circulacao['.$item['id'].']" id="circulacao_'.$item['id'].'_'.$item2['id'].'" value="'.$item2['id'].'"/>
                                            </span>
                                        </label>';
                                    }
                                }


                        echo '    </div>
                            </div>';
                    }
                }
                ?>


            </div>

        </div>


</div>