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
        <span class="fw-semibold text-gray-800 fs-6"><?=$linha['logradouro']?>, <?=$linha['numero']?>, bairro <?=$linha['bairro']?>, <?=$linha['nome_cidade']?></span>
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

<div class="row">
    <div class="col-md-12 table-responsive ">
        <table class="dataTable table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th >Prefixo</th>
                <th align="center">QTA</th>
                <th align="center">Saída da base</th>
                <th align="center">Chegada Local</th>
                <th align="center">Saída Local</th>
                <th align="center">Chegada Hospital</th>
                <th align="center">Saída Hospital</th>
                <th align="center">Chegada Base</th>
            </tr>
            </thead>

            <?php
            $objRecursoOcorrencia = new OcorrenciasRecursos();
            $recursos = $objRecursoOcorrencia->ListarDespachadas($linha['id']);
            if(is_array($recursos) && count($recursos))
            {
                foreach ($recursos as $recurso) {
                    $qta = Componente::GerarBotao([
                        "tamanho" => false,
                        "href" => "javascript:;",
                        "onclick" => 'AtualizarPosicao(6,\''.$recurso["id"].'\')',
                        "class" => 'btn btn-sm   btn-info ',
                        "icon_class" => 'fas fa-minus ',
                        "texto" => "QTA",
                        "title" => "QTA"
                    ]);
                    $qta_bt = ($recurso['horario_saida_base'] != "")? $qta : 'Aguardando Saída da Base';
                    $saida_base = Componente::GerarBotao([
                        "tamanho" => false,
                        "href" => "javascript:;",
                        "onclick" => 'AtualizarPosicao(1,\''.$recurso["id"].'\')',
                        "class" => 'btn btn-sm   btn-info ',
                        "icon_class" => 'fas fa-clock ',
                        "texto" => "Saída Local",
                        "title" => "Saída Local"
                    ]);
                  $chegada_local = Componente::GerarBotao([
                        "tamanho" => false,
                        "href" => "javascript:;",
                        "onclick" => 'AtualizarPosicao(2,\''.$recurso["id"].'\')',
                        "class" => 'btn btn-sm   btn-info ',
                        "icon_class" => 'fas fa-clock ',
                        "texto" => "Chegada Local",
                        "title" => "Chegada Local"
                    ]);
                    $saida_local = Componente::GerarBotao([
                        "tamanho" => false,
                        "href" => "javascript:;",
                        "onclick" => 'AtualizarPosicao(3,\''.$recurso["id"].'\')',
                        "class" => 'btn btn-sm   btn-info ',
                        "icon_class" => 'fas fa-clock ',
                        "texto" => "Saída Local",
                        "title" => "Saída Local"
                    ]);
                    $chegada_hospital = Componente::GerarBotao([
                        "tamanho" => false,
                        "href" => "javascript:;",
                        "onclick" => 'AtualizarPosicao(4,\''.$recurso["id"].'\')',
                        "class" => 'btn btn-sm   btn-info ',
                        "icon_class" => 'fas fa-clock ',
                        "texto" => "Chegada Hospital",
                        "title" => "Chegada Hospital"
                    ]);
                    $saida_hospital = Componente::GerarBotao([
                        "tamanho" => false,
                        "href" => "javascript:;",
                        "onclick" => 'AtualizarPosicao(7,\''.$recurso["id"].'\')',
                        "class" => 'btn btn-sm   btn-info ',
                        "icon_class" => 'fas fa-clock ',
                        "texto" => "Saída Hospital",
                        "title" => "Saída Hospital"
                    ]);
                    $chegada_base = Componente::GerarBotao([
                        "tamanho" => false,
                        "href" => "javascript:;",
                        "onclick" => 'AtualizarPosicao(5,\''.$recurso["id"].'\')',
                        "class" => 'btn btn-sm   btn-info ',
                        "icon_class" => 'fas fa-clock ',
                        "texto" => "Chegada Base",
                        "title" => "Chegada Base"
                    ]);
                    if($recurso['horario_chegada_base'] == "")
                    {
                        $saida_base_bt = ($recurso['horario_saida_base'] != "") ? Conexao::PrepararDataPHP($recurso['horario_saida_base'],$_SESSION['usuario']['timezone']) : $saida_base;
                        if($recurso['horario_saida_base'] != "") $chegada_local_bt = ($recurso['horario_chegada_local'] != "" && $recurso['horario_saida_base'] != "") ? Conexao::PrepararDataPHP($recurso['horario_chegada_local'],$_SESSION['usuario']['timezone']) : $chegada_local;
                        if($recurso['horario_chegada_local'] != "")$saida_local_bt = ($recurso['horario_saida_local'] != "" && $recurso['horario_chegada_local'] != "" ) ? Conexao::PrepararDataPHP($recurso['horario_saida_local'],$_SESSION['usuario']['timezone']) : $saida_local;
                        if($recurso['horario_saida_local'] != "")$checada_hospital_bt = ($recurso['horario_chegada_hospital'] != "" && $recurso['horario_saida_local'] != "") ? Conexao::PrepararDataPHP($recurso['horario_chegada_hospital'],$_SESSION['usuario']['timezone']) : $chegada_hospital;
                        if($recurso['horario_chegada_hospital'] != "")$saida_hospital_bt = ($recurso['horario_saida_hospital'] != "" && $recurso['horario_chegada_hospital'] != "") ? Conexao::PrepararDataPHP($recurso['horario_saida_hospital'],$_SESSION['usuario']['timezone']) : $saida_hospital;
                        $chegada_base_bt = ($recurso['horario_chegada_base'] != "" && $recurso['horario_saida_hospital'] != "") ? Conexao::PrepararDataPHP($recurso['horario_chegada_base'],$_SESSION['usuario']['timezone']) : $chegada_base;
                    }
                    else
                    {

                        $saida_base_bt =           '<span><i class="fa fa-edit cursor-pointer" onclick="EditarHorarioDespacho('.$recurso['id'].',1,'.$linha['id'].')"></i> '.Conexao::PrepararDataPHP($recurso['horario_saida_base'],$_SESSION['usuario']['timezone'])."</span>";
                        $chegada_local_bt =        '<span><i class="fa fa-edit cursor-pointer" onclick="EditarHorarioDespacho('.$recurso['id'].',2,'.$linha['id'].')"></i> '.Conexao::PrepararDataPHP($recurso['horario_chegada_local'],$_SESSION['usuario']['timezone'])."</span>";
                        $saida_local_bt =          '<span><i class="fa fa-edit cursor-pointer" onclick="EditarHorarioDespacho('.$recurso['id'].',3,'.$linha['id'].')"></i> '.Conexao::PrepararDataPHP($recurso['horario_saida_local'],$_SESSION['usuario']['timezone']);
                        $checada_hospital_bt =     '<span><i class="fa fa-edit cursor-pointer" onclick="EditarHorarioDespacho('.$recurso['id'].',4,'.$linha['id'].')"></i> '.Conexao::PrepararDataPHP($recurso['horario_chegada_hospital'],$_SESSION['usuario']['timezone'])."</span>";
                        $saida_hospital_bt =       '<span><i class="fa fa-edit cursor-pointer" onclick="EditarHorarioDespacho('.$recurso['id'].',5,'.$linha['id'].')"></i> '.Conexao::PrepararDataPHP($recurso['horario_saida_hospital'],$_SESSION['usuario']['timezone'])."</span>";
                        $chegada_base_bt =         '<span><i class="fa fa-edit cursor-pointer" onclick="EditarHorarioDespacho('.$recurso['id'].',6,'.$linha['id'].')"></i> '.Conexao::PrepararDataPHP($recurso['horario_chegada_base'],$_SESSION['usuario']['timezone'])."</span>";
                        $qta_bt = "";
                    }



                    echo '<tr>
                            <td valign="middle"><h4>'.$recurso['nome_prefixo'].'</h4></td>
                            <td valign="middle">'.$qta_bt.'</td>
                            <td valign="middle">'.$saida_base_bt.'</td>
                            <td valign="middle">'.$chegada_local_bt.'</td>
                            <td valign="middle">'.$saida_local_bt.'</td>
                            <td valign="middle">'.$checada_hospital_bt.'</td>
                            <td valign="middle">'.$saida_hospital_bt.'</td>
                            <td valign="middle">'.$chegada_base_bt.'</td>
                        </tr>';
                }
            }
            ?>
        </table>
    </div>
</div>
