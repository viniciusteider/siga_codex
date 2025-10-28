<div id="kt_app_content_container" class="app-container  p-0">
    <div class="card shadow-sm">
        <div class="card-body">
            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x  mb-5 fs-6" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#tab_dados_ocorrencia" role="tab">
                        <i class="fa fa-file-alt"></i>&nbsp;Dados da ocorrência
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab_recursos_viaturas" role="tab">
                        <i class="fa fa-ambulance"></i>&nbsp;Recursos/Viaturas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab_pacientes_vitimas" role="tab">
                        <i class="fa fa-users"></i>&nbsp;Pacientes/Vítimas
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="tab_ocorrencia_content">
                <div class="tab-pane fade show active" id="tab_dados_ocorrencia" role="tabpanel">
                    <div class="row mb-3">
                        <label class="col-lg-2 fw-semibold text-muted text-md-end">Nº Ocorrência / Data Hora:</label>
                        <div class="col-lg-10">
                            <span class="fw-bold fs-6 text-gray-800">
                                <span class="badge badge-dark"><?=$linha['id']?></span>
                            </span>
                            <span class="fw-bold fs-6 text-gray-800 ms-4"><?=Conexao::PrepararDataPHP($linha['data_hora'],$_SESSION['usuario']['timezone'])?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 fw-semibold text-muted text-md-end">Endereço:</label>
                        <div class="col-lg-10">
                            <span class="fw-semibold text-gray-800 fs-6"><?=$linha['logradouro']?>, <?=$linha['numero']?>, bairro <?=$linha['bairro']?>, <?=$linha['cidade']?> - <?=$linha['estado']?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 fw-semibold text-muted text-md-end">Latitude/Longitude:</label>
                        <div class="col-lg-6">
                            <span class="fw-semibold text-gray-800 fs-6"><?=$linha['latitude']?>,<?=$linha['longitude']?>
                                <a target="_blank" href="https://maps.google.com/?q=<?=$linha['latitude'];?>,<?=$linha['longitude'];?>">
                                    <i class="fa fa-map-marker-alt fs-1 text-danger ms-2"></i>
                                </a>
                            </span>
                        </div>
                        <label class="col-lg-2 fw-semibold text-muted text-md-end">Tipo Solicitante:</label>
                        <div class="col-lg-2">
                            <span class="fw-semibold fs-6 text-gray-800"><?=$linha['nome_tipo_solicitante']?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 fw-semibold text-muted text-md-end">Telefone:</label>
                        <div class="col-lg-10 d-flex align-items-center">
                            <span class="fw-bold fs-6 text-gray-800 me-2"><?=$linha['telefone']?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 fw-semibold text-muted text-md-end">Solicitante:</label>
                        <div class="col-lg-2">
                            <span class="fw-semibold fs-6 text-gray-800"><?=$linha['nome']?></span>
                        </div>
                        <label class="col-lg-2 fw-semibold text-muted text-md-end">Atendente:</label>
                        <div class="col-lg-2">
                            <span class="fw-bold fs-6 text-gray-800"><?=$linha['nome_atendente']?></span>
                        </div>
                        <label class="col-lg-2 fw-semibold text-muted text-md-end">Regulador:</label>
                        <div class="col-lg-2">
                            <span class="fw-bold fs-6 text-gray-800"><?=$linha['nome_regulador']?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 fw-semibold text-muted text-md-end">Evento:</label>
                        <div class="col-lg-2">
                            <span class="fw-semibold fs-6 text-gray-800"><?=$linha['nome_evento']?></span>
                        </div>
                        <label class="col-lg-2 fw-semibold text-muted text-md-end">Subevento:</label>
                        <div class="col-lg-2">
                            <span class="fw-semibold fs-6 text-gray-800"><?=$linha['nome_subevento']?></span>
                        </div>
                        <label class="col-lg-2 fw-semibold text-muted text-md-end">Classificação:</label>
                        <div class="col-lg-2">
                            <span class="fw-semibold fs-6 text-gray-800"><?=$linha['nome_classificacao']?></span>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <label class="col-lg-2 fw-semibold text-muted text-md-end">Descritivo:</label>
                        <div class="col-lg-10">
                            <span class="fw-semibold text-gray-800 fs-6"><?=$linha['descritivo']?></span>
                        </div>
                    </div>
                    <div class="separator separator-dashed border-success my-5"></div>
                    <div class="card card-flush">
                        <div class="card-header pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Histórico</span>
                                <span class="text-gray-400 pt-2 fw-semibold fs-6">Descritivos médicos</span>
                            </h3>
                        </div>
                        <div class="card-body pt-6">
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
                            <div class="timeline-label">
                                <?php
                                $objHistorico = new OcorenciasHistorico();
                                $objHistorico->setIdOcorrencia($linha['id']);
                                $rows = $objHistorico->ListarHistoricos();
                                if (is_array($rows) && count($rows) > 0) {
                                    foreach ($rows as $row) {
                                        ?>
                                        <div class="timeline-item">
                                            <div class="timeline-label fw-bold text-gray-800 fs-8 ajuste" style="width: 80px !important;">
                                                <?=str_replace(" ", "<br>", Conexao::PrepararDataPHP($row['data_hora_cadastro'], $_SESSION['usuario']['timezone'], 'd/m/y H:i:s'));?>
                                            </div>
                                            <div class="timeline-badge">
                                                <i class="ki ki-abstract-8 text-gray-600"></i>
                                            </div>
                                            <div class="fw-semibold text-gray-700 ps-3 fs-7"><?=$row['descricao']?></div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="fw-semibold text-gray-500 fs-7">Nenhum histórico cadastrado.</div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab_recursos_viaturas" role="tabpanel">
                    <div class="row g-5 mb-5">
                        <div class="col-md-3">
                            <span class="text-muted fw-semibold d-block">USA</span>
                            <span class="fw-bold fs-5 text-gray-800"><?=$linha['usa']?></span>
                        </div>
                        <div class="col-md-3">
                            <span class="text-muted fw-semibold d-block">USB</span>
                            <span class="fw-bold fs-5 text-gray-800"><?=$linha['usb']?></span>
                        </div>
                        <div class="col-md-3">
                            <span class="text-muted fw-semibold d-block">Bombeiro</span>
                            <span class="fw-bold fs-5 text-gray-800"><?=$linha['siate']?></span>
                        </div>
                        <div class="col-md-3">
                            <span class="text-muted fw-semibold d-block">VIR</span>
                            <span class="fw-bold fs-5 text-gray-800"><?=$linha['vir']?></span>
                        </div>
                    </div>
                    <?php if (is_array($linha_recursos) && count($linha_recursos) > 0): ?>
                        <div class="table-responsive mb-5">
                            <table class="table table-row-bordered align-middle gs-0 gy-3">
                                <thead class="bg-light align-middle">
                                <tr class="fw-semibold text-gray-600 text-uppercase fs-7">
                                    <th>Viatura</th>
                                    <th>Equipe</th>
                                    <th>Saída Base</th>
                                    <th>Chegada Local</th>
                                    <th>Saída Local</th>
                                    <th>Chegada Hospital</th>
                                    <th>Saída Hospital</th>
                                    <th>Chegada Base</th>
                                </tr>
                                </thead>
                                <tbody class="fs-7 text-gray-700">
                                <?php foreach ($linha_recursos as $rec): ?>
                                    <tr>
                                        <td><?=$rec['prefixo']?></td>
                                        <td><?=$rec['nome_equipe']?></td>
                                        <td><?=Conexao::PrepararDataPHP($rec['horario_saida_base'], $_SESSION['usuario']['timezone'], 'd/m/y H:i')?></td>
                                        <td><?=Conexao::PrepararDataPHP($rec['horario_chegada_local'], $_SESSION['usuario']['timezone'], 'd/m/y H:i')?></td>
                                        <td><?=Conexao::PrepararDataPHP($rec['horario_saida_local'], $_SESSION['usuario']['timezone'], 'd/m/y H:i')?></td>
                                        <td><?=Conexao::PrepararDataPHP($rec['horario_chegada_hospital'], $_SESSION['usuario']['timezone'], 'd/m/y H:i')?></td>
                                        <td><?=Conexao::PrepararDataPHP($rec['horario_saida_hospital'], $_SESSION['usuario']['timezone'], 'd/m/y H:i')?></td>
                                        <td><?=Conexao::PrepararDataPHP($rec['horario_chegada_base'], $_SESSION['usuario']['timezone'], 'd/m/y H:i')?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-light-info">Nenhuma viatura deslocada para esta ocorrência.</div>
                    <?php endif; ?>

                    <?php if (is_array($linha_Apoio) && count($linha_Apoio) > 0): ?>
                        <div class="separator separator-dashed border-success my-5"></div>
                        <h5 class="fw-bold text-gray-800 mb-4">Órgãos de apoio</h5>
                        <div class="row g-5">
                            <?php foreach ($linha_Apoio as $apo): ?>
                                <div class="col-md-6">
                                    <div class="border rounded p-5 h-100">
                                        <div class="fw-bold text-gray-800 fs-6 mb-3"><?=$apo['nome_orgao']?></div>
                                        <div class="text-gray-600 fs-7 mb-2"><strong>Responsável:</strong> <?=$apo['responsavel_apoio']?></div>
                                        <div class="text-gray-600 fs-7 mb-2"><strong>Serviço realizado:</strong> <?=$apo['solicitacao']?></div>
                                        <div class="text-gray-600 fs-7"><strong>Vtrs/Pessoas:</strong> <?=$apo['total_veiculos']?> vrts / <?=$apo['total_pessoas']?> pessoas</div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="tab-pane fade" id="tab_pacientes_vitimas" role="tabpanel">
                    <?php
                    include_once "modulos/paciente/template/js.paciente.php";
                    $idOcorrenciaFicha = $linha['id'];
                    $filtroPacienteSessao = $_SESSION['FILTRO_PACIENTE'] ?? [];
                    if (($filtroPacienteSessao['id_ocorrencia'] ?? null) !== $idOcorrenciaFicha) {
                        $filtroPacienteSessao = [];
                    }
                    $filtroPacienteSessao = array_merge([
                        'pagina' => 0,
                        'ordem' => '',
                        'filtro' => '',
                        'retomar_filtro' => '',
                        'numero_registro_hidden' => '',
                    ], $filtroPacienteSessao);
                    $filtroPacienteSessao['id_ocorrencia'] = $idOcorrenciaFicha;
                    $_SESSION['FILTRO_PACIENTE'] = $filtroPacienteSessao;
                    ?>
                    <form action="#" method="post" id="frm_paciente_geral" class="d-none">
                        <input type="hidden" name="pagina" id="pagina" value="<?=$filtroPacienteSessao['pagina']; ?>">
                        <input type="hidden" name="id_ocorrencia" id="id_ocorrencia" value="<?=$filtroPacienteSessao['id_ocorrencia']; ?>">
                        <input type="hidden" name="ordem" id="ordem" value="<?=$filtroPacienteSessao['ordem']; ?>">
                        <input type="hidden" name="filtro" id="filtro" value="<?=$filtroPacienteSessao['filtro']; ?>">
                        <input type="hidden" name="retomar_filtro" id="retomar_filtro" value="<?=$filtroPacienteSessao['retomar_filtro']; ?>">
                        <input type="hidden" name="numero_registro_hidden" id="numero_registro_hidden" value="<?=$filtroPacienteSessao['numero_registro_hidden']; ?>">
                    </form>
                    <div class="card card-flush">
                        <div class="card-header align-items-center">
                            <h3 class="card-title fw-bold text-dark mb-0">Pacientes/Vítimas</h3>
                        </div>
                        <div class="card-body" id="conteudo_paciente">
                            <div class="fa-2x"><i class="fa fs-2x fa-solid fa-spinner fa-spin-pulse"></i> Carregando...</div>
                        </div>
                    </div>
                    <?php include_once "modulos/paciente/template/tpl.modal.paciente.php"; ?>
                </div>
            </div>
        </div>
    </div>
</div>
