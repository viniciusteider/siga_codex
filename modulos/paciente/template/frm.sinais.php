<!--begin::Repeater-->
<div id="sinais_vitais" class="mb-4">
    <!--begin::Form group-->
    <div class="form-group">
        <div data-repeater-list="sinais">
            <?php
            $objSinais = new PacienteSinaisVitais();
            $objSinais->setIdPaciente($linha['id']);
            $linha_sinais = $objSinais->Editar();
            if (is_array($linha_sinais) && count($linha_sinais)) {
                foreach ($linha_sinais as $sinais) {
            ?>
                    <div data-repeater-item class="rounded border p-5 mb-2">

                        <input type="hidden" value="<?= $sinais['id']; ?>" data-kt-repeater="id_paciente_sinais" name="id_paciente_sinais" id="id_paciente_sinais">
                        <div class="form-group row">
                            <div class="col-md-1 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="horario">Horario:</label>
                                    <input type="time" name="horario" id="horario" data-kt-repeater="horario" class="form-control  " value="<?= $sinais['horario']; ?>" />
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-1 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="pressao_arterial_maxima">PA Max:</label>
                                    <input type="text" name="pressao_arterial_maxima" data-kt-repeater="pressao_arterial_maxima" id="pressao_arterial_maxima" maxlength="" class="form-control  mask-numero" value="<?= $sinais['pressao_arterial_maxima']; ?>" />
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-1 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="pressao_arterial_minima">PA Min:</label>
                                    <input type="text" name="pressao_arterial_minima" data-kt-repeater="pressao_arterial_minima" id="pressao_arterial_minima" maxlength="" class="form-control  mask-numero" value="<?= $sinais['pressao_arterial_minima']; ?>" />
                                </div>
                            </div>
                            <!--/span-->

                            <div class="col-md-2 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="frequencia_cardiaca">F.Cardiaca:</label>
                                    <input type="text" name="frequencia_cardiaca" data-kt-repeater="frequencia_cardiaca" id="frequencia_cardiaca" maxlength="" class="form-control  mask-numero" value="<?= $sinais['frequencia_cardiaca']; ?>" />
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-2 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="frequencia_respiratoria">F.Respiratória:</label>
                                    <input type="text" name="frequencia_respiratoria" data-kt-repeater="frequencia_respiratoria" id="frequencia_respiratoria" maxlength="" class="form-control  mask-numero" value="<?= $sinais['frequencia_respiratoria']; ?>" />
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-2 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="saturacao_o2">Saturação O2:</label>
                                    <input type="text" name="saturacao_o2" data-kt-repeater="saturacao_o2" id="saturacao_o2" maxlength="" class="form-control  mask-numero" value="<?= $sinais['saturacao_o2']; ?>" />
                                </div>
                            </div>
                            <div class="col-md-1 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="temperatura">Temp.º:</label>
                                    <input type="text" name="temperatura" data-kt-repeater="temperatura" id="temperatura" maxlength="" class="form-control  mask-numero" value="<?= $sinais['temperatura']; ?>" />
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-1 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="hgt">HGT:</label>
                                    <input type="text" name="hgt" id="hgt" data-kt-repeater="hgt" maxlength="" class="form-control  mask-numero" value="<?= $sinais['hgt']; ?>" />
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-1 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="escala_trauma">E.Glasgow:</label>
                                    <input type="text" name="escala_trauma" data-kt-repeater="escala_trauma" id="escala_trauma" maxlength="" class="form-control  mask-numero" value="<?= $sinais['escala_trauma']; ?>" />
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="abertura_ocular_id">Abertura Ocular</label>
                                    <?php
                                    $objAberturaOcular = new Paciente();
                                    $registros = $objAberturaOcular->ListarAberturaOcularCombo($sinais['abertura_ocular_id']);
                                    echo Componente::GerarSelectPDO("abertura_ocular_id", "abertura_ocular_id", "", $registros, array($sinais['abertura_ocular_id']), array('', 'Selecione Abertura Ocular'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10', '' . $onchange);
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="resposta_verbal_id">Resposta Verbal</label>
                                    <?php
                                    $objRespostaVerbal = new Paciente();
                                    $registros = $objRespostaVerbal->ListarRespostaVerbalCombo($sinais['resposta_verbal_id']);
                                    echo Componente::GerarSelectPDO("resposta_verbal_id", "resposta_verbal_id", "", $registros, array($sinais['resposta_verbal_id']), array('', 'Selecione Resposta Verbal'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10', '' . $onchange);
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="resposta_motora_id">Resposta Motora</label>
                                    <?php
                                    $objRespostaMotora = new Paciente();
                                    $registros = $objRespostaMotora->ListarRespostaMotoraCombo($sinais['resposta_motora_id']);
                                    echo Componente::GerarSelectPDO("resposta_motora_id", "resposta_motora_id", "", $registros, array($sinais['resposta_motora_id']), array('', 'Selecione Resposta Motora'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10', '' . $onchange);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <a href="javascript:;" data-repeater-delete class="btn  btn-light-danger ">
                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                Remover
                            </a>
                        </div>
                    </div>
                <?
                }
            } else {
                ?>
                <div data-repeater-item class="rounded border p-5 mb-2">
                    <div class="form-group row">
                        <div class="col-md-1 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="horario">Horario:</label>
                                <input type="time" name="horario" id="horario" data-kt-repeater="horario" class="form-control  " />
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-1 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="pressao_arterial_maxima">PA Max:</label>
                                <input type="text" name="pressao_arterial_maxima" data-kt-repeater="pressao_arterial_maxima" id="pressao_arterial_maxima" maxlength="" class="form-control  mask-numero" />
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-1 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="pressao_arterial_minima">PA Min:</label>
                                <input type="text" name="pressao_arterial_minima" data-kt-repeater="pressao_arterial_minima" id="pressao_arterial_minima" maxlength="" class="form-control  mask-numero" />
                            </div>
                        </div>
                        <!--/span-->

                        <div class="col-md-2 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="frequencia_cardiaca">F.Cardiaca:</label>
                                <input type="text" name="frequencia_cardiaca" data-kt-repeater="frequencia_cardiaca" id="frequencia_cardiaca" maxlength="" class="form-control  mask-numero" />
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-2 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="frequencia_respiratoria">F.Respiratória:</label>
                                <input type="text" name="frequencia_respiratoria" data-kt-repeater="frequencia_respiratoria" id="frequencia_respiratoria" maxlength="" class="form-control  mask-numero" />
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-2 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="saturacao_o2">Saturação O2:</label>
                                <input type="text" name="saturacao_o2" data-kt-repeater="saturacao_o2" id="saturacao_o2" maxlength="" class="form-control  mask-numero" />
                            </div>
                        </div>
                        <div class="col-md-1 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="temperatura">Temp.º:</label>
                                <input type="text" name="temperatura" data-kt-repeater="temperatura" id="temperatura" maxlength="" class="form-control  mask-numero" />
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-1 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="hgt">HGT:</label>
                                <input type="text" name="hgt" id="hgt" data-kt-repeater="hgt" maxlength="" class="form-control  mask-numero" value="<?= $linha['hgt']; ?>" />
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-1 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="escala_trauma">E.Trauma:</label>
                                <input type="text" name="escala_trauma" data-kt-repeater="escala_trauma" id="escala_trauma" maxlength="" class="form-control  mask-numero" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="abertura_ocular_id">Abertura Ocular</label>
                                    <?php
                                    $objAberturaOcular = new Paciente();
                                    $registros = $objAberturaOcular->ListarAberturaOcularCombo($sinais['abertura_ocular_id']);
                                    echo Componente::GerarSelectPDO("abertura_ocular_id", "abertura_ocular_id", "", $registros, array($sinais['abertura_ocular_id']), array('', 'Selecione Abertura Ocular'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10', '' . $onchange);
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="resposta_verbal_id">Resposta Verbal</label>
                                    <?php
                                    $objRespostaVerbal = new Paciente();
                                    $registros = $objRespostaVerbal->ListarRespostaVerbalCombo($sinais['resposta_verbal_id']);
                                    echo Componente::GerarSelectPDO("resposta_verbal_id", "resposta_verbal_id", "", $registros, array($sinais['resposta_verbal_id']), array('', 'Selecione Resposta Verbal'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10', '' . $onchange);
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="resposta_motora_id">Resposta Motora</label>
                                    <?php
                                    $objRespostaMotora = new Paciente();
                                    $registros = $objRespostaMotora->ListarRespostaMotoraCombo($sinais['resposta_motora_id']);
                                    echo Componente::GerarSelectPDO("resposta_motora_id", "resposta_motora_id", "", $registros, array($sinais['resposta_motora_id']), array('', 'Selecione Resposta Motora'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10', '' . $onchange);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <a href="javascript:;" data-repeater-delete class="btn  btn-light-danger ">
                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                Remover
                            </a>
                        </div>
                </div>
            <?
            }
            ?>
        </div>
        <a href="javascript:;" data-repeater-create class="btn btn-primary ">
            <i class="ki-duotone ki-plus fs-3"></i>Adicionar mais Sinais
        </a>
    </div>
</div>
<div class="separator border-5 my-10 mt-4"></div>
<!--end::Repeater-->