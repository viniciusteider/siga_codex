<!--begin::Table Widget 7-->
<div class="card card-xl-stretch mb-xl-8">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">Ocorrências</span>
            <span class="text-muted mt-1 fw-semibold fs-7">listagem de ocorrências com minha participação</span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-3 card-scroll      ">
        <div class="tab-content">
            <!--begin::Tap pane-->
            <div class="tab-pane fade show active" id="kt_table_widget_7_tab_1" role="tabpanel">
                <!--begin::Table container-->
                <div class="table-responsive " >
                    <!--begin::Table-->
                    <table class="table align-middle table-striped table-bordered  table-hover gs-0 gy-3">
                        <!--begin::Table head-->
                        <thead>
                        <tr>
                            <th class="p-0 w-50px"></th>
                            <th class="p-0 "></th>
                            <th class="p-0 "></th>
                            <th class="p-0" ></th>
                            <th class="p-0 "></th>
                            <th class="p-0 "></th>
                        </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                        <?php
                        if(is_array($listar) && count($listar))
                        {

                            foreach ($listar as $item) {
                                switch($item['id_ocorrencia_status'])
                                {
                                    case 1:
                                        $thema = "success";
                                        break;
                                    case 2:
                                        $thema = "info";
                                        break;
                                    case 3:
                                        $thema = "primary";
                                        break;
                                    case 4:
                                        $thema = "dark";
                                        break;
                                    case 5:
                                        $thema = "light";
                                        break;
                                }

                                #$dbclick = ($_SESSION['usuario']['id_usuario_tipo'] != 4 && $_SESSION['usuario']['id_usuario_tipo'] != 6 && $_SESSION['usuario']['id_usuario_tipo'] != 2) ? 'ondblclick="AbrirOcorrenciaAberta('.$item['id'].')"' : '';
                                $dbclick = ($_SESSION['usuario']['id_usuario_tipo'] != 4 && $_SESSION['usuario']['id_usuario_tipo'] != 2) ? 'ondblclick="AbrirOcorrenciaAberta('.$item['id'].')"' : '';
                                $html =  ' <tr '.$dbclick.'>
                                            <td valign="middle" align="center">
                                                 <div class="symbol symbol-35px symbol-sm-30px symbol-circle   " style="vertical-align: middle">
                                                    <span title="'.$item['nome_status'].'" class="symbol-label text-light fw-semibold  bg-'.$thema.'">'.strtoupper(substr($item['nome_status'],0,2)).'</span>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6">N.º '.$item['id'].'</a>
                                                <span class="text-muted fw-semibold d-block fs-7"> '.$item['logradouro'].'</span>
                                            </td>
                                            <td >
                                                <span class="text-muted fw-semibold d-block fs-8"><i class="fa fa-phone"></i> '.$item['telefone'].'</span>
                       
                                            </td>     
                                            <td class="text-end">
                                                <span class="text-muted fw-semibold d-block fs-8"> '.$item['nome_evento'].'</span>
                                                <span class="text-dark fw-bold d-block fs-7"> '.$item['nome_subevento'].'</span>
                                            </td>
                                            <td class="fs-sm-8">
                                                <strong> '.Conexao::PrepararDataPHP($item['data_hora']).'</strong>
                                            </td>
                                            <td >
                                                    <a href="javascript:;" onclick="ModalListagemPaciente('.$item['id'].')" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .60rem;" data-placement="top" data-original-title="Pacientes" title="Pacientes" data-bs-toggle="tooltip" class="btn btn-sm btn-icon  btn-info "><i class="fas fa-user " title="Pacientes"></i></a>
                                                    <a href="javascript:;" onclick="ModalListagemApoio('.$item['id'].')" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .60rem;" data-placement="top" data-original-title="Pacientes" title="Pacientes" data-bs-toggle="tooltip" class="btn btn-sm btn-icon  btn-dark "><i class="fas fa-users " title="Apoios"></i></a>
                                                    <a href="javascript:;" onclick="VeiculosAcidentes('.$item['id'].')" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .60rem;" data-placement="top" data-original-title="Pacientes" title="Pacientes" data-bs-toggle="tooltip" class="btn btn-sm btn-icon  btn-danger "><i class="fas fa-car-crash " title="Veiculos Acidentes"></i></a>
                                                    
                                            </td>
                                        </tr>';

                                echo $html;

//                                <a href="javascript:;" onclick="ModalListagemApoio('.$item['id'].')" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .60rem;" data-placement="top" data-original-title="Pacientes" title="Pacientes" data-bs-toggle="tooltip" class="btn btn-sm btn-icon  btn-dark "><i class="ki-solid ki-car-2 " title="Pacientes"></i></a>
                            }
                        }
                        ?>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                </div>
                <!--end::Table-->
            </div>

        </div>
    </div>
    <!--end::Body-->
</div>

