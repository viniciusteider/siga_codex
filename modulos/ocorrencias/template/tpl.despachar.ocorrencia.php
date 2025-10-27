<div class="row mb-3">
    <!--begin::Label-->
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Nº Ocorrência / Data Hora:</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-10">
        <span class="fw-bold fs-6 text-gray-800"><span class="badge badge-dark"><?=$linha['id']?></span></span> &nbsp; &nbsp; &nbsp;
        <span class="fw-bold fs-6 text-gray-800"><?=Conexao::PrepararDataPHP($linha['data_hora'],$_SESSION['usuario']['timezone'])?></span>
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->
<!--begin::Input group-->
<div class="row mb-3">
    <!--begin::Label-->
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Endereço:</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-10 fv-row">
        <span class="fw-semibold text-gray-800 fs-6"><?=$linha['logradouro']?>, <?=$linha['numero']?>, bairro <?=$linha['bairro']?>, <?=$linha['cidade']?></span>
    </div>
    <!--end::Col-->
</div>
<!--end::Input group-->

<!--begin::Input group-->
<div class="row mb-2">
    <!--begin::Label-->
    <label class="col-lg-2 fw-semibold text-muted text-md-end">

        Latitude/Longitude:</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-6 fv-row">
        <span class="fw-semibold text-gray-800 fs-6"><?=$linha['latitude']?>,<?=$linha['longitude']?>    <a target="_blank" href="https://maps.google.com/?q=<?=$linha['latitude'];?>,<?=$linha['longitude'];?>">  <i class="fa fa-map-marker-alt fs-1 text-danger "></i></a></span>
    </div>
    <!--end::Col-->
    <!--end::Col-->
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Tipo Solicitante:</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-2">
        <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary"><?=$linha['nome_tipo_solicitante']?></a>
    </div>
    <!--end::Col-->
</div>
<!--end::Input group-->
<!--begin::Input group-->
<div class="row mb-3">
    <!--begin::Label-->
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Telefone:</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-10 d-flex align-items-center">
        <span class="fw-bold fs-6 text-gray-800 me-2"><?=$linha['telefone']?></span>
        <!--            <span class="badge badge-success">Verified</span>-->
    </div>
    <!--end::Col-->
</div>
<!--end::Input group-->
<!--begin::Input group-->
<div class="row mb-3">
    <!--begin::Label-->

    <!--begin::Label-->
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Solicitante:</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-2">
        <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary"><?=$linha['nome']?></a>
    </div>
    <!--end::Col-->
    <!--begin::Label-->
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Atendente:</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-2">
        <span class="fw-bold fs-6 text-gray-800"><?=$linha['nome_atendente']?></span>
    </div>
    <!--end::Col-->
    <!--begin::Label-->
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Regulador:</label>
    <!--end::Label-->
    <!--begin::Col-->
    <div class="col-lg-2">
        <span class="fw-bold fs-6 text-gray-800"><?=$linha['nome_regulador']?></span>
    </div>
    <!--end::Col-->
</div>

<div class="row mb-3">
    <!--begin::Label-->
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Evento:</label>
    <!--begin::Label-->
    <!--begin::Label-->
    <div class="col-lg-2">
            <span class="fw-semibold fs-6 text-gray-800">
                <?=$linha['nome_evento']?>
            </span>
    </div>
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Subevento:</label>
    <!--begin::Label-->
    <!--begin::Label-->
    <div class="col-lg-2">
            <span class="fw-semibold fs-6 text-gray-800">
                <?=$linha['nome_subevento']?>
            </span>
    </div>
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Classificação:</label>
    <!--begin::Label-->
    <!--begin::Label-->
    <div class="col-lg-2">
            <span class="fw-semibold fs-6 text-gray-800">
                <?=$linha['nome_classificacao']?>
            </span>
    </div>
    <!--begin::Label-->
</div>

<div class="row mb-3">
    <!--begin::Label-->
    <label class="col-lg-2 fw-semibold text-muted text-md-end">Descritivo:</label>
    <!--begin::Label-->
    <!--begin::Label-->
    <div class="col-lg--10">
            <span class="fw-semibold fs-6 text-gray-800">
                <?=$linha['descritivo']?>
            </span>
    </div>
    <!--begin::Label-->
</div>

<h3>Recursos</h3>
<div class="row p-3">
    <div class="col-md-1 mb-3">
        <!--begin::Label-->
        <label class="col-lg-3 fw-semibold text-muted">USA</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-9">
            <span class="fw-semibold fs-6 text-gray-800">
                <?=$linha['usa']?>
            </span>
        </div>
        <!--begin::Label-->
    </div>

    <div class="col-md-1 mb-3">
        <!--begin::Label-->
        <label class="col-lg-3 fw-semibold text-muted">USB</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-9">
            <span class="fw-semibold fs-6 text-gray-800">
                <?=$linha['usb']?>
            </span>
        </div>
        <!--begin::Label-->
    </div>

    <div class="col-md-1 mb-3">
        <!--begin::Label-->
        <label class="col-lg-3 fw-semibold text-muted">Bombeiro</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-9">
            <span class="fw-semibold fs-6 text-gray-800">
                <?=$linha['siate']?>
            </span>
        </div>
        <!--begin::Label-->
    </div>

    <div class="col-md-1 mb-3">
        <!--begin::Label-->
        <label class="col-lg-3 fw-semibold text-muted">VIR</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-9">
            <span class="fw-semibold fs-6 text-gray-800">
                <?=$linha['vir']?>
            </span>
        </div>
        <!--begin::Label-->
    </div>

</div>

<section id="content">
    <section id="main2">
        <form name="form-recursos-disponiveis" id="form-recursos-disponiveis">
            <input type="hidden" name="id" id="id" value="<?=$_REQUEST['app_codigo']?>">
            <h4 class="titulo-tabela">Recursos Disponíveis</h4>
            <div class="row text-right pb-4">
                <div class="col-md-12" style="float: left">

                </div></div><!-- .row -->
            <div class="table-responsive">
                <table class="table tablegrid  table-hover table-bordered table-striped  border " id="id_tabela_ocorrencias_recursos">
                    <thead class=" table-dark ">
                    <tr class="fw-semibold fs-6">
                        <th class="checkboxes" width="40" valign="middle">#</th>
                        <th class=" " valign="middle">PREFIXO</th>
                        <th class=" " valign="middle">EQUIPE</th>
                        <th class=" " valign="middle">BASE</th>
                        <th class=" " valign="middle">STATUS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $objOcorrenciasRecursos = new Escala();
                        $listar = $objOcorrenciasRecursos->BuscarRecursosEscalasMensais($_SESSION['usuario']['id_grupo']);
                        $x = 0;
                        if (is_array($listar) && count($listar) > 0 ) {
                            foreach ($listar as $linha) {
                                if($linha['id'] == "") continue;
                                if($linha['id_ocorrencias_recursos'] == "")
                                    $status = "Disponível";
                                elseif($linha['horario_saida_base']!= "" && $linha['horario_chegada_local']== "")
                                    $status = "Atendimento ( Saiu da Base)";
                                elseif($linha['horario_chegada_local']!= "" && $linha['horario_saida_local']== "")
                                    $status = "Atendimento (Local de Atendimento)";
                                elseif($linha['horario_saida_local']!= "" && $linha['horario_chegada_hospital']== "")
                                    $status = "Atendimento (Caminho do Hospital)";
                                elseif($linha['horario_chegada_hospital']!= "" && $linha['horario_saida_hospital']== "")
                                    $status = "Voltando Antendimento";
                                elseif($linha['horario_saida_hospital']!= "" && $linha['horario_chegada_base']== "")
                                    $status = "Voltando para Base";
                                else{
                                    $status = "Despachado mas ainda na base";
                                }
                                echo  '<tr>
                                        <td class="checkboxes" valign="middle">
                                        <input type="hidden" name="id_ocorrencias_recursos['.$linha["id"].']" id="id_ocorrencias_recursos_'.$linha["id"].'" value="'.$linha['id_ocorrencias_recursos'].'">
                                        <input type="hidden" name="id_equipes['.$linha["id"].']" id="id_equipes'.$linha["id"].'" value="'.$linha['id_equipes'].'">
                                        <input class="form-check-input ms-3"  type="checkbox" value="'.$linha["id"].'" name="lista_recuros[]" id="lista_recuros_'.$linha["id"].'">
                                        </td>
                                        <td valign="middle">'.$linha["prefixo"].'</td>
                                        <td valign="middle">'.$linha["nome_equipe"].'</td>
                                        <td valign="middle">'.$linha["nome_base"].'</td>
                                        <td valign="middle">'.$status.'</td>
                                    </tr>';
                                $x++;
                            }
                        }?>

                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </form>
    </section>
</section>







