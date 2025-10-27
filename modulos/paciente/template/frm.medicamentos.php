<style>
    .datepicker {
        z-index: 1100 !important;
    }

    #ui-datepicker-div {
        width: 30% !important;
    }
</style>
<!--begin::Repeater-->
<div id="kt_medicamentos">
    <!--begin::Form group-->
    <div class="form-group">
        <div data-repeater-list="medicamentos">
            <?php
            $objPacienteMedicamentos = new PacienteMedicamentos();
            $objPacienteMedicamentos->setIdPaciente($linha['id']);
            $medicamentos = $objPacienteMedicamentos->Editar();
            if (is_array($medicamentos) && count($medicamentos)) {
                foreach ($medicamentos as $medic) {
                    list($data, $hora) = explode(" ", $medic['horario']);
            ?>
                    <div data-repeater-item>
                        <input type="hidden" value="<?= $medic['id']; ?>" data-kt-repeater="id_paciente_medicamento" name="id_paciente_medicamento" id="id_paciente_medicamento">
                        <div class="row ">
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="id_medicamento">Medicamento:</label>
                                    <select name="id_medicamento" class=" form-select " data-kt-repeater="id_medicamento" data-placeholder="Selecione um Medicamento">
                                        <?php
                                        $objMedicamentos = new Medicamentos();
                                        $registros = $objMedicamentos->ListarCombo($medic['id_medicamento']);
                                        foreach ($registros as $row) {
                                            $selected = ($medic['id_medicamento'] == $row['id']) ? 'selected="selected"' : '';
                                            echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['nome'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-2 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="id_via">Via:</label>
                                    <select name="id_via" class=" form-select " data-kt-repeater="id_via" data-placeholder="Selecione uma Via">
                                        <?php
                                        $objVias = new Vias();
                                        $registros = $objVias->ListarCombo($medic['id_via']);
                                        foreach ($registros as $row) {
                                            $selected = ($medic['id_via'] == $row['id']) ? 'selected="selected"' : '';
                                            echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['nome'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-2 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="horario">Data:</label>
                                    <input type="text" name="data_medicamento" id="data_medicamento" data-kt-repeater="data_medicamento" class="form-control  mask-datetime" value="<?= Conexao::PrepararDataPHP($medic['horario'], $_SESSION['usuario']['timezone'], 'd/m/Y'); ?>" />
                                </div>
                            </div>
                            <div class="col-md-1 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="horario">Horario:</label>
                                    <input type="time" name="horario_medicamento" id="horario_medicamento" data-kt-repeater="horario_medicamento" class="form-control  mask-datetime" value="<?= $hora; ?>" />
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-1 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="dose">Dose:</label>
                                    <input type="text" name="dose" id="dose" maxlength="" data-kt-repeater="dose" class="form-control  mask-numero" value="<?= $medic['dose']; ?>" />
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-2 d-flex align-items-center">
                            <div class="form-group">
                                <label class="form-label" for="unidade_medida_id">Unidade</label>
                                <?php
                                $objUnidade = new UnidadeMedida();
                                $registros = $objUnidade->ListarComboMedicamento();
                                echo Componente::GerarSelectPDO("unidade_medida_id", "unidade_medida_id", "", $registros, array($medic['unidade_medida_id']), array('', 'Selecione Unidade'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10', '' . $onchange);
                                ?>
                            </div>
                                <a href="javascript:;" data-repeater-delete class="btn  btn-light-danger btn-icon mt-3 mt-md-8">
                                    <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?
                }
            } else {
                ?>
                <div data-repeater-item>

                    <div class="row ">
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="id_medicamento">Medicamento:</label>
                                <select name="id_medicamento" class=" form-select " data-kt-repeater="id_medicamento" data-placeholder="Selecione um Medicamento">
                                </select>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-2 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="id_via">Via:</label>
                                <select name="id_via" class=" form-select " data-kt-repeater="id_via" data-placeholder="Selecione uma Via">
                                </select>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-2 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="horario">Data:</label>
                                <input type="text" name="data_medicamento" id="data_medicamento" data-kt-repeater="data_medicamento" class="form-control  mask-datetime" value="" />
                            </div>
                        </div>
                        <div class="col-md-1 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="horario">Horario:</label>
                                <input type="time" name="horario_medicamento" id="horario_medicamento" data-kt-repeater="horario_medicamento" class="form-control  mask-datetime" value=">" />
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-1 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="dose">Dose:</label>
                                <input type="text" name="dose" id="dose" maxlength="" data-kt-repeater="dose" class="form-control  mask-numero" value="" />
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-2 d-flex align-items-center">
                            <div class="form-group">
                                <label class="form-label" for="unidade_medida_id">Unidade</label>
                                <?php
                                $objUnidade = new UnidadeMedida();
                                $registros = $objUnidade->ListarComboMedicamento();
                                echo Componente::GerarSelectPDO("unidade_medida_id", "unidade_medida_id", "", $registros, array(), array('', 'Selecione Unidade'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10', '' . $onchange);
                                ?>
                            </div>
                            <a href="javascript:;" data-repeater-delete class="btn  btn-light-danger btn-icon mt-3 mt-md-8">
                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?
            }
            ?>


        </div>
        <a href="javascript:;" data-repeater-create class="btn btn-primary mt-2 ">
            <i class="ki-duotone ki-plus fs-3"></i>Adicionar mais Medicamentos
        </a>
    </div>
    <!--end::Form group-->


</div>
<!--end::Repeater-->