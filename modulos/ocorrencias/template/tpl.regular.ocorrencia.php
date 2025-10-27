<form action="#" name="frm_despacho_ocorrencia" id="frm_despacho_ocorrencia" method="post">
<div class="row mb-3">
    <!--begin::Label-->
    <label class="col-lg-3 fw-semibold text-muted">Nº Ocorrência</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-9">
        <span class="fw-bold fs-6 text-gray-800"><?=$linha['id']?></span>
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->
<!--begin::Input group-->
<div class="row mb-3">
    <!--begin::Label-->
    <label class="col-lg-3 fw-semibold text-muted">Endereço</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-9 fv-row">
        <span class="fw-semibold text-gray-800 fs-6"><?=$linha['logradouro']?>, <?=$linha['numero']?>, bairro <?=$linha['bairro']?>, <?=$linha['cidade']?></span>
    </div>
    <!--end::Col-->
</div>
<!--end::Input group-->
<!--begin::Input group-->
<div class="row mb-3">
    <!--begin::Label-->
    <label class="col-lg-3 fw-semibold text-muted">Telefone</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-9 d-flex align-items-center">
        <span class="fw-bold fs-6 text-gray-800 me-2"><?=$linha['telefone']?></span>
        <!--            <span class="badge badge-success">Verified</span>-->
    </div>
    <!--end::Col-->
</div>
<!--end::Input group-->
<!--begin::Input group-->
<div class="row mb-3">
    <!--begin::Label-->
    <label class="col-lg-3 fw-semibold text-muted">Solicitante</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-9">
        <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary"><?=$linha['nome']?></a>
    </div>
    <!--end::Col-->
</div>
<!--end::Input group-->
<!--begin::Input group-->
<div class="row mb-3">
    <!--begin::Label-->
    <label class="col-lg-3 fw-semibold text-muted">Atendente</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-9">
        <span class="fw-bold fs-6 text-gray-800"><?=$linha['nome_atendente']?></span>
    </div>
    <!--end::Col-->
</div>
<!--end::Input group-->
<!--begin::Input group-->
<div class="row mb-3">
    <!--begin::Label-->
    <label class="col-lg-3 fw-semibold text-muted">Regulador</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-9">
        <span class="fw-bold fs-6 text-gray-800"><?=$linha['nome_regulador']?></span>
    </div>
    <!--end::Col-->
</div>
<!--end::Input group-->
<!--begin::Input group-->
<div class="row mb-10">
    <!--begin::Label-->
    <label class="col-lg-3 fw-semibold text-muted">Descritivo</label>
    <!--begin::Label-->
    <!--begin::Label-->
    <div class="col-lg-9">
            <span class="fw-semibold fs-6 text-gray-800">
                <?=$linha['descritivo']?>
            </span>
    </div>
    <!--begin::Label-->
</div>
    <?php
    if($linha['id_ocorrencia_status'] == 1)
    {
        echo '<div class="row mb-10">
            <!--begin::Label-->
            <label class="col-lg-3 fw-semibold text-muted">Regular Ocorrência</label>
            <!--begin::Label-->
            <!--begin::Label-->
            <div class="col-lg-9">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="regular" name="regular" />
                    <label class="form-check-label" for="flexCheckDefault">
                        Marque aqui para regular a ocorrência
                    </label>
                </div>
            </div>
            <!--begin::Label-->
        </div>';
    }
    ?>

<!--end::Input group-->
<!--begin::Example-->
<div class="separator separator-content my-5">Classificação</div>
<!--end::Example-->

    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <input type="hidden" name="cancelar"  id="cancelar"   value=""/>
    <div class="form-body">
        <div class="row ">
            <div class="col-md-12 mb-4 mt-3">
                <div class="form-group d-flex">
                    <div class="form-check form-check-custom  form-check-sm col-md-4">
                        <input class="form-check-input validar-radio" type="radio" <?php if($linha['id_ocorrencia_classificacao'] == 1) echo "checked='checked'" ?> value="1" id="classificacao_1" name="id_ocorrencia_classificacao"/>
                        <label class="form-check-label" for="classificacao_1">
                            Verde
                        </label>
                    </div>
                    <div class="form-check form-check-custom  form-check-sm col-md-4">
                        <input class="form-check-input validar-radio" type="radio" <?php if($linha['id_ocorrencia_classificacao'] == 2) echo "checked='checked'" ?> value="2" id="classificacao_2" name="id_ocorrencia_classificacao"/>
                        <label class="form-check-label" for="classificacao_2">
                            Amarelo
                        </label>
                    </div>
                    <div class="form-check form-check-custom  form-check-sm col-md-4">
                        <input class="form-check-input validar-radio" type="radio" <?php if($linha['id_ocorrencia_classificacao'] == 3) echo "checked='checked'" ?> value="3" id="classificacao_3" name="id_ocorrencia_classificacao"/>
                        <label class="form-check-label" for="classificacao_3">
                            Vermelho
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_evento">Evento</label>
                    <?php
                    $objEvento     = new Evento();
                    $registros = $objEvento->ComboEventos();
                    $onchange = ' onchange="Squall.ListarSelect2(\'index_xml.php?app_modulo=subevento&app_comando=filtrar_sub_eventos&app_codigo=\',\'#id_subevento\',this.value)"';
                    echo Componente::GerarSelectPDO("id_evento", "id_evento", "", $registros, array($linha['id_evento']), array('','Selecione um Evento'), array("id", "nome"), false, 'form-select   form-select-sm',' data-validar="select2" '.$onchange);
                    ?>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_subevento">Sub-Evento</label>
                    <?php
                    $objSubEvento     = new Subevento();
                    $registros = $objSubEvento->ListarComboSubEventos($linha['id_subevento']);
                    $lista = (is_array($registros) && count($registros) > 0) ? $registros : [['id' => '', 'nome' => "Nenhum Registro Econtrado"]] ;
                    echo Componente::GerarSelectPDO("id_subevento", "id_subevento", "", $lista, array($linha['id_subevento']), array(), array("id", "nome"), false, 'form-select   form-select-sm',' data-validar="select2" ');
                    ?>
                    <!--                                            <input type="text" name="id_subevento"  id="id_subevento"  class="form-control  " value="--><?//=$linha['id_subevento'];?><!--"/>-->
                </div>
            </div>

            <!--begin::Dialer-->
            <div class="col-md-3 mb-2 mt-2">
                <div class="form-group">
                    <label class="form-label" for="nome">USA</label>
                    <!--begin::Dialer-->
                    <div id="contador_usa" class="position-relative "
                         data-kt-dialer="true"
                         data-kt-dialer-min="0"
                         data-kt-dialer-max="10"
                         data-kt-dialer-step="1">

                        <!--begin::Decrease control-->
                        <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                            <i class="ki-duotone ki-minus-square fs-2"><span class="path1"></span><span class="path2"></span></i>
                        </button>
                        <!--end::Decrease control-->

                        <!--begin::Input control-->
                        <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input"  name="usa" readonly value="<?=$linha['usa']?>" />
                        <!--end::Input control-->

                        <!--begin::Increase control-->
                        <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                            <i class="ki-duotone ki-plus-square fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        </button>
                        <!--end::Increase control-->
                    </div>
                    <!--end::Dialer-->

                </div>
            </div>
            <div class="col-md-3 mb-2 mt-2">
                <div class="form-group">
                    <label class="form-label" for="nome">USB</label>
                    <!--begin::Dialer-->
                    <div id="contador_usb" class="position-relative "
                         data-kt-dialer="true"
                         data-kt-dialer-min="0"
                         data-kt-dialer-max="10"
                         data-kt-dialer-step="1">

                        <!--begin::Decrease control-->
                        <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                            <i class="ki-duotone ki-minus-square fs-2"><span class="path1"></span><span class="path2"></span></i>
                        </button>
                        <!--end::Decrease control-->

                        <!--begin::Input control-->
                        <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input"  name="usb" readonly value="<?=$linha['usb']?>" />
                        <!--end::Input control-->

                        <!--begin::Increase control-->
                        <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                            <i class="ki-duotone ki-plus-square fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        </button>
                        <!--end::Increase control-->
                    </div>
                    <!--end::Dialer-->
                </div>
            </div>
            <div class="col-md-3 mb-2 mt-2">
                <div class="form-group">
                    <label class="form-label" for="nome">Bombeiro</label>
                    <!--begin::Dialer-->
                    <div id="contador_siate" class="position-relative "
                         data-kt-dialer="true"
                         data-kt-dialer-min="0"
                         data-kt-dialer-max="10"
                         data-kt-dialer-step="1">

                        <!--begin::Decrease control-->
                        <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                            <i class="ki-duotone ki-minus-square fs-2"><span class="path1"></span><span class="path2"></span></i>
                        </button>
                        <!--end::Decrease control-->

                        <!--begin::Input control-->
                        <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input"  name="siate" readonly value="<?=$linha['siate']?>" />
                        <!--end::Input control-->

                        <!--begin::Increase control-->
                        <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                            <i class="ki-duotone ki-plus-square fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        </button>
                        <!--end::Increase control-->
                    </div>
                    <!--end::Dialer-->
                </div>
            </div>
            <div class="col-md-3 mb-2 mt-2">
                <div class="form-group">
                    <label class="form-label" for="nome">VIR</label>
                    <!--begin::Dialer-->
                    <div id="contador_vir" class="position-relative "
                         data-kt-dialer="true"
                         data-kt-dialer-min="0"
                         data-kt-dialer-max="10"
                         data-kt-dialer-step="1">

                        <!--begin::Decrease control-->
                        <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                            <i class="ki-duotone ki-minus-square fs-2"><span class="path1"></span><span class="path2"></span></i>
                        </button>
                        <!--end::Decrease control-->

                        <!--begin::Input control-->
                        <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input"  name="vir" readonly value="<?=$linha['vir']?>" />
                        <!--end::Input control-->

                        <!--begin::Increase control-->
                        <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                            <i class="ki-duotone ki-plus-square fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        </button>
                        <!--end::Increase control-->
                    </div>
                    <!--end::Dialer-->
                </div>
            </div>


            <!--begin::Example-->
            <div class="separator separator-content my-8">Parecer</div>
            <!--end::Example-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="nome">Descrição Médica</label>
                    <textarea name="descricao" id="descricao" onblur="ExecutarAcaoDespachoOcorrenciasDescricao()" rows="5" class="form-control validar-obrigatorio"></textarea>
                </div>
            </div>


        </div>
    </div>
</form>
<!--begin::List widget 14-->
<div class="card card-flush">
    <!--begin::Header-->
    <div class="card-header pt-5">
        <!--begin::Title-->
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-dark">Histórico</span>
            <span class="text-gray-400 pt-2 fw-semibold fs-6">Descritivos médicos</span>
        </h3>
        <!--end::Title-->
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <style>
        .timeline-label::before {
            content: "";
            position: absolute;
            left: 81px;
            width: 3px;
            top: 0;
            bottom: 0;
            background-color: var(--bs-gray-200);
        }
    </style>
    <div class="card-body pt-6"  id="div_historico_ocorrencia">

    </div>
    <!--end: Card Body-->
</div>
<!--end: List widget 14-->


<?php
include_once("modulos/ocorrencias/template/js.regular.ocorrencias.php");