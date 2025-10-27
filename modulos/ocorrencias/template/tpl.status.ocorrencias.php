<!--begin::Table Widget 7-->
<div class="card card-xl-stretch mb-xl-8">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1"><?=$titulo?></span>
            <span class="text-muted mt-1 fw-semibold fs-7"><?=$subtitulo?></span>
        </h3>
        <div class="card-toolbar">
            <!--begin::Menu-->
            <button class="btn btn-icon btn-sm btn-color-gray-400 btn-active-color-primary justify-content-end" onclick="UpdateListagem('<?= $app_comando ?>')" >
                <i class="ki-duotone ki-arrows-circle  fs-1 text-gray-900 me-n1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                </i>
            </button>

            <!--end::Menu 2-->
            <!--end::Menu-->
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-3 card-scroll      ">
        <div class="tab-content">
            <!--begin::Tap pane-->
            <div class="tab-pane fade show active" id="kt_table_widget_7_tab_1" role="tabpanel">
                <!--begin::Table container-->
                <div class="table-responsive " style="height: 32vh">
                    <!--begin::Table-->
                    <table class="table align-middle table-striped table-bordered  table-hover gs-0 gy-3">
                        <!--begin::Table head-->
                        <thead>
                        <tr>
                        <th class="p-0 w-20px"></th>
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
                        //                        Conexao::pr($listar);
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
                                $ok = ($item['completo'] > 0  && $item['incompleto'] == 0) ? ' <span class="symbol-badge badge badge-circle bg-light-success  start-100"><i class="fa fa-thumbs-up"></i></span>' : '';
                                $dbclick = ($_SESSION['usuario']['id_usuario_tipo'] != 4 && $_SESSION['usuario']['id_usuario_tipo'] != 6 && $_SESSION['usuario']['id_usuario_tipo'] != 2) ? 'ondblclick="AbrirOcorrenciaAberta('.$item['id'].')"' : '';
                                $html =  ' <tr '.$dbclick.'>
                                            <td valign="middle" align="center" class="p-0 "  '.($item['cor_classificacao_risco'] ? 'style="--bs-table-accent-bg: '.$item['cor_classificacao_risco'].' !important"' : '').' >
                                            </td>
                                            <td valign="middle" align="center">
                                                 <div class="symbol symbol-35px symbol-sm-30px symbol-circle   " style="vertical-align: middle">
                                                    <span title="'.$item['nome_status'].'" class="symbol-label text-light fw-semibold  bg-'.$thema.'">'.strtoupper(substr($item['nome_status'],0,2)).'</span>
                                                     '.$ok.'
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6">N.º '.$item['id'].'</a>
                                                <span class="text-muted fw-semibold d-block fs-7"> '.$item['endereco_completo'].'</span>
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
                                   <!--begin::Menu wrapper-->
                                                <div>
                                                    <!--begin::Toggle-->
                                                    <button type="button" class="btn btn-light btn-sm rotate" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="2px, 2px">
                                                        ...
                                                        <i class="ki-duotone ki-down  rotate-180 ms-1 me-0"></i>
                                                    </button>
                                                    <!--end::Toggle-->
                                                
                                                    <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true" style="top:-25px !important">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Menu de Ações</div>
                                                        </div>
                                                        <!--end::Menu item-->
                                                
                                                        <!--begin::Menu separator-->
                                                        <div class="separator mb-3 opacity-75"></div>
                                                        <!--end::Menu separator-->';
                                if($_SESSION['usuario']['id_usuario_tipo'] != 4 && $_SESSION['usuario']['id_usuario_tipo'] != 7 && $_SESSION['usuario']['id_usuario_tipo'] != 2)
                                {
                                    $menu = [];
                                    $menu['href'] = 'javascript:;';
                                    $menu['texto'] = 'Regular';
                                    $menu['icone'] = 'fa fa-user-doctor';
                                    $menu['onclick'] = 'AbrirOcorrenciaAberta('.$item['id'].')';
                                    $html .= App::GerarItemMenuOcorrencias($menu);


                                }
                                if($_SESSION['usuario']['id_usuario_tipo'] == 2 || $_SESSION['usuario']['id_usuario_tipo'] == 4 || $_SESSION['usuario']['id_usuario_tipo'] == 7)
                                {
                                    $menu = [];
                                    $menu['href'] = 'javascript:;';
                                    $menu['texto'] = 'Pacientes';
                                    $menu['icone'] = 'fa fa-user';
                                    $menu['onclick'] = 'ModalListagemPaciente2('.$item['id'].')';
                                    $html .= App::GerarItemMenuOcorrencias($menu);
                                }

                                #if($_SESSION['usuario']['id_usuario_tipo'] != 4  && $_SESSION['usuario']['id_usuario_tipo'] != 7 && $_SESSION['usuario']['id_usuario_tipo'] != 3)
                                if($_SESSION['usuario']['id_usuario_tipo'] != 4  && $_SESSION['usuario']['id_usuario_tipo'] != 3)    
                                {
                                    $menu = [];
                                    $menu['href'] = 'javascript:;';
                                    $menu['texto'] = 'Despachar';
                                    $menu['icone'] = 'fa fa-person-running';
                                    $menu['onclick'] = 'AbrirOcorrenciaDespachar('.$item['id'].')';
                                    $html .= App::GerarItemMenuOcorrencias($menu);

                                }
                                $menu = [];
                                $menu['href'] = 'javascript:;';
                                $menu['texto'] = 'Apoios';
                                $menu['icone'] = 'ki-solid ki-car-2';
                                $menu['onclick'] = 'ModalListagemApoio('.$item['id'].')';
                                $html .= App::GerarItemMenuOcorrencias($menu);

                                #if($_SESSION['usuario']['id_usuario_tipo'] != 4 && $_SESSION['usuario']['id_usuario_tipo'] != 6 && $_SESSION['usuario']['id_usuario_tipo'] != 7 && $_SESSION['usuario']['id_usuario_tipo'] != 3)

                                if($_SESSION['usuario']['id_usuario_tipo'] != 4 && $_SESSION['usuario']['id_usuario_tipo'] != 3)
                                {
                                    if($item['id_ocorrencia_status'] == 3)
                                    {
                                        $menu = [];
                                        $menu['href'] = 'javascript:;';
                                        $menu['texto'] = 'Atualizar Localização';
                                        $menu['icone'] = 'ki-solid ki-update-file';
                                        $menu['onclick'] = 'AtualizarOcorrencia('.$item['id'].')';
                                        $html .= App::GerarItemMenuOcorrencias($menu);

                                    }

                                }
                                if($item['id_evento'] == 3)
                                {
                                    $menu = [];
                                    $menu['href'] = 'javascript:;';
                                    $menu['texto'] = 'Veículos Acidentes';
                                    $menu['icone'] = 'fa fa-car-burst';
                                    $menu['onclick'] = 'VeiculosAcidentes('.$item['id'].')';
                                    $html .= App::GerarItemMenuOcorrencias($menu);
                                }
                                $menu = [];
                                $menu['href'] = 'javascript:;';
                                $menu['texto'] = 'Visualizar';
                                $menu['icone'] = 'ki-solid ki-shield-search';
                                $menu['onclick'] = 'VisualizarOcorrencia('.$item['id'].')';
                                $html .= App::GerarItemMenuOcorrencias($menu);


                                $html .='       
                           
                                                    </div>
                                                    <!--end::Menu-->
                                                </div>
                                                <!--end::Dropdown wrapper-->
                                            </td>
                                        </tr>';

                                echo $html;
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
<!--end::Tables Widget 7-->
<script>

    $(document).ready(function (){
        KTMenu.createInstances();
    });
</script>

