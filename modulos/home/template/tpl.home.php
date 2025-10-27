<?php
$date = date('d/m/Y');
?>
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Dashboard - Siga</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="javascript:;" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Dashboard</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Primary button-->
            <!--        --><?php //if($_SESSION['PERMISSAO']['frm_adicionar_servicos'] != "") echo' <a href="#index_xml.php?app_modulo=servicos&app_comando=frm_adicionar_servicos" class="btn btn-sm fw-bold btn-primary" > <i class="fa fa-plus-circle"></i> Novo Agendamento</a>';?>
            <!--end::Primary button-->
        </div>
        <!--end::Actions-->
    </div>

    <div id="kt_app_content_container" class="app-container  p-0">
        <div class="row g-5 g-xl-8">
            <div class="col-xl-3">

                <!--begin::Statistics Widget 5-->
                <a href="#" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <span class="text-dark fw-bold fs-5x "><i class="ki-duotone ki-calendar  text-dark fs-3x ms-n1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i></span>
                            <h2 id="contador_confirmado"><i class="fa-solid fa-spinner fa-spin fs-3 text-dark"></i></h2>
                        </div>

                        <div class="text-dark fw-bold fs-2 mb-2 mt-5">
                            Abertos
                        </div>

                        <div class="fw-semibold text-dark">
                            Confirmados para <?=$date?>     </div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->    </div>
            <div class="col-xl-3">

                <!--begin::Statistics Widget 5-->
                <a href="#" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span class="text-dark fw-bold fs-5x "><i class="ki-duotone ki-calendar  text-dark fs-3x ms-n1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i></span>
                            <h2 id="contador_andamento"><i class="fa-solid fa-spinner fa-spin fs-3 text-dark"></i></h2>
                        </div>
                        <div class="text-dark fw-bold fs-2 mb-2 mt-5">
                            Em Andamento
                        </div>

                        <div class="fw-semibold text-dark">
                            Em Andamento para <?=$date?>        </div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->    </div>
            <div class="col-xl-3">

                <!--begin::Statistics Widget 5-->
                <a href="#" class="card bg-dark hoverable card-xl-stretch mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span class="text-light fw-bold fs-5x "><i class="ki-duotone ki-calendar  text-light fs-3x ms-n1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i></span>
                            <h2 class="text-light" id="contador_realizado"><i class="fa-solid fa-spinner fa-spin fs-3 text-dark"></i></h2>
                        </div>
                        <div class="text-light fw-bold fs-2 mb-2 mt-5">
                            Em Avaliação
                        </div>

                        <div class="fw-semibold text-light">
                            Realizados para <?=$date?></div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->    </div>
            <div class="col-xl-3">

                <!--begin::Statistics Widget 5-->
                <a href="#" class="card bg-success hoverable card-xl-stretch mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span class="text-dark fw-bold fs-5x "><i class="ki-duotone ki-calendar  text-dark fs-3x ms-n1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i></span>
                            <h2 id="contador_concluido"><i class="fa-solid fa-spinner fa-spin fs-3 text-dark"></i></h2>
                        </div>
                        <div class="text-dark fw-bold fs-2 mb-2 mt-5">
                            Concluidos
                        </div>

                        <div class="fw-semibold text-dark">
                            Concluidos para <?=$date?>       </div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->    </div>
        </div>

    </div>

    <div id="kt_app_content_container" class="app-container mt-6 ">
        <div class="row g-5 g-xl-8">
            <!--begin::Col-->
            <div class="col-xl-12" id="div_ocorrencias_despachadas">

            </div>
            <!--end::Col-->
        </div>
    </div>


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

<?php
//Conexao::pr(R$_SESSION);
include("modulos/home/template/js.home.php");
?>