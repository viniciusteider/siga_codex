
<!--begin::Drawer-->
<div
    id="modal_ocorrencia_direita"
    class="bg-white"
    data-kt-drawer="true"
    data-kt-drawer-activate="true"
    data-kt-drawer-toggle="#kt_drawer_example_permanent_toggle"
    data-kt-drawer-close="#kt_drawer_example_permanent_close"
    data-kt-drawer-overlay="true"
    data-kt-drawer-permanent="false"
    data-kt-drawer-width="{default:'400px', 'md': '600px'}"
>
    <!--begin::Card-->
    <div class="card rounded-0 w-100">
        <!--begin::Card header-->
        <div class="card-header pe-5">
            <!--begin::Title-->
            <div class="card-title">
                Regular Ocorrência
            </div>
            <!--end::Title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-light-primary" id="kt_drawer_example_permanent_close">
                    <span class="svg-icon fs-1">
                       <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                    </span>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body hover-scroll-overlay-y" id="div_ocorrencias_direita">
            <div class="text-center">
                <span class="spinner-border text-primary" role="status"></span><br>
                <span class="text-gray-800 fs-6 fw-semibold mt-5">Carregando...</span>
            </div>

        </div>
        <!--end::Card body-->
        <div class="card-footer d-flex flex-row-reverse">
            <!--begin::Dismiss button-->
            <button class="btn btn-success"  id="bt_salvar_despacho" onclick="ExecutarAcaoDespachoOcorrencias()"><i class="fa fa-check"></i> Salvar</button>
            <!--end::Dismiss button-->
            <!--begin::Dismiss button-->
            <button class="btn btn-danger me-1" data-kt-drawer-dismiss="true"><i class="fa fa-door-closed"></i> Fechar</button>
            <!--end::Dismiss button-->
            <!--begin::Dismiss button-->
            <button class="btn btn-dark  me-1"  id="bt_salvar_despacho" onclick="FinalizarOcorrenica()"><i class="fa fa-hand-point-up"></i> Finalizar</button>
            <!--end::Dismiss button-->
            <!--begin::Dismiss button-->
            <button class="btn btn-info  me-1"  id="bt_paciente" onclick="ModalListagemPaciente()"><i class="fa fa-user"></i> Paciente</button>
            <!--end::Dismiss button-->
        </div>
    </div>
    <!--end::Card-->
</div>
<!--end::Drawer-->

<!--begin::Drawer-->
<div
        id="modal_ocorrencia_despachar"
        class="bg-white"
        data-kt-drawer="true"
        data-kt-drawer-activate="true"
        data-kt-drawer-toggle="#kt_drawer_example_permanent_toggle"
        data-kt-drawer-close="#kt_drawer_example_permanent_close"
        data-kt-drawer-overlay="true"
        data-kt-drawer-permanent="false"
        data-kt-drawer-width="{default:'400px', 'md': '600px'}"
>
    <!--begin::Card-->
    <div class="card rounded-0 w-100">
        <!--begin::Card header-->
        <div class="card-header pe-5">
            <!--begin::Title-->
            <div class="card-title">
                Despachar Ocorrência
            </div>
            <!--end::Title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-light-primary" id="kt_drawer_example_permanent_close">
                    <span class="svg-icon fs-1">
                       <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                    </span>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body hover-scroll-overlay-y" id="div_ocorrencias_despachar">
            <div class="text-center">
                <span class="spinner-border text-primary" role="status"></span><br>
                <span class="text-gray-800 fs-6 fw-semibold mt-5">Carregando...</span>
            </div>

        </div>
        <!--end::Card body-->
        <div class="card-footer d-flex flex-row-reverse">
            <!--begin::Dismiss button-->
            <button class="btn btn-light-success"  id="bt_salvar_despacho" onclick="ExecutarAcaoDespachoOcorrencias()">Salvar</button>
            <!--end::Dismiss button-->
            <!--begin::Dismiss button-->
            <button class="btn btn-light-danger me-1" data-kt-drawer-dismiss="true">Fechar</button>
            <!--end::Dismiss button-->
            <!--begin::Dismiss button-->
            <button class="btn btn-light-dark  me-1"  id="bt_salvar_despacho" onclick="FinalizarOcorrenica()">Finalizar</button>
            <!--end::Dismiss button-->

        </div>
    </div>
    <!--end::Card-->
</div>
<!--end::Drawer-->
<!--begin::Drawer-->
<div
        id="modal_ocorrencia_esquerda"
        class="bg-white"
        data-kt-drawer="true"
        data-kt-drawer-activate="true"
        data-kt-drawer-toggle="#kt_drawer_example_permanent_toggle"
        data-kt-drawer-close="#kt_drawer_example_permanent_close"
        data-kt-drawer-overlay="true"
        data-kt-drawer-permanent="false"
        data-kt-drawer-width="{default:'700px', 'md': '900px'}"
        data-kt-drawer-direction="start"
>
    <!--begin::Card-->
    <div class="card rounded-0 w-100">
        <!--begin::Card header-->
        <div class="card-header pe-5">
            <!--begin::Title-->
            <div class="card-title">
                Visualizar Ocorrência
            </div>
            <!--end::Title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-light-primary" id="kt_drawer_example_permanent_close">
                    <span class="svg-icon fs-1">
                       <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                    </span>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body hover-scroll-overlay-y" id="div_ocorrencias_esquerda">
            <div class="text-center">
                <span class="spinner-border text-primary" role="status"></span><br>
                <span class="text-gray-800 fs-6 fw-semibold mt-5">Carregando...</span>
            </div>

        </div>
        <!--end::Card body-->
        <div class="card-footer d-flex flex-row-reverse">
            <!--begin::Dismiss button-->
            <button class="btn btn-light-danger me-1" data-kt-drawer-dismiss="true">Fechar</button>
            <!--end::Dismiss button-->
        </div>
    </div>
    <!--end::Card-->
</div>
<!--end::Drawer-->

<!--begin::Modal - Create App-->
<div class="modal fade" id="modal_despachar_ocorrencia" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered " style="min-width: 70vw ; min-height: 80vh">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2>Despachar Atendimento</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
								</svg>
							</span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body  p-4 m-4" id="div_despachar_ocorrencia">

            </div>
            <!--end::Modal body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="ExecutarAcaoDespacharOcorrencia()" id="bt_despahcar_ocorrencia_modal">Despachar</button>
            </div>
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Create App-->


<!--begin::Modal - Create App-->
<div class="modal fade" id="modal_atualizar_ocorrencia" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered " style="min-width: 70vw ; min-height: 80vh">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2>Atualizar Localização Atendimento</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
								</svg>
							</span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body  p-4 m-4" id="div_atualizar_ocorrencia">

            </div>
            <!--end::Modal body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
<!--                <button type="button" class="btn btn-primary" onclick="ExecutarAcaoDespacharOcorrencia()" id="bt_despahcar_ocorrencia_modal">Despachar</button>-->
            </div>
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Create App-->



<!--<div class="modal fade" tabindex="-1" id="modal_modulo_paciente">-->
<!--    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " style="min-width: 70vw ; min-height: 80vh">-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <h5 class="modal-title">Paciente</h5>-->
<!---->
<!--                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">-->
<!--                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="modal-body" id="div_modal_paciente">-->
<!---->
<!--            </div>-->
<!---->
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>-->
<!--                <button type="button" class="btn btn-primary" id="bt_modal_salvar_paciente">Salvar</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->


<div class="modal fade " id="modal_listar_paciente">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " style="min-width: 85vw ; height: 90vh">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pacientes desta Ocorrência</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 " data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body" id="div_listar_paciente">

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade " id="modal_listar_apoio">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " style="min-width: 85vw ; height: 90vh">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Apoio desta Ocorrência</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 " data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body" id="div_listar_apoio">

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade " id="modal_veiculos_acidentes">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " style="min-width: 85vw ; height: 90vh">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Veículos desta Ocorrência</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 " data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body" id="div_veiculos_acidentes">

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="modal_horarios_despacho">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alterar Horario</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 " data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body" id="div_horarios_despacho">

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="ExecutarHoraiosDespacho()" id="bt_horario_dispacho">Alterar</button>
            </div>
        </div>
    </div>
</div>


