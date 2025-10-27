<?php
include("modulos/relatorio_quantitativo_atendimento/template/js.relatorio_quantitativo_atendimento.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Relatórios";
$configTitulo['titulo_modulo'] = "Pacientes Atendimentos";
echo $objApp->GerarBreadCrumb($configTitulo);

?>
    <form action="#" method="post" id="frm_relatorio_paciente" name="frm_relatorio_paciente">
        <input type="hidden" name="pagina" id="pagina" value="<?=$_SESSION['FILTRO_RELATORIO_PACIENTE_ATENDIMENTO']['pagina']?>">
        <input type="hidden" name="ordem" id="ordem" value="<?=$_SESSION['FILTRO_RELATORIO_PACIENTE_ATENDIMENTO']['ordem']?>">
        <input type="hidden" name="filtro" id="filtro" value="<?=$_SESSION['FILTRO_RELATORIO_PACIENTE_ATENDIMENTO']['filtro']?>">
        <input type="hidden" name="retomar_filtro" id="retomar_filtro" value="<?=$_SESSION['FILTRO_RELATORIO_PACIENTE_ATENDIMENTO']['retomar_filtro']?>">
        <input type="hidden" name="numero_registro_hidden" id="numero_registro_hidden" value="<?=$_SESSION['FILTRO_RELATORIO_PACIENTE_ATENDIMENTO']['numero_registro_hidden']?>">
        <div id="kt_app_content_container" class="app-container  p-0">
            <div class="card shadow-sm">
                <div class="card-body" id="filtro">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="id_base">Base</label>

                                <?php
                                $base   = new Base();
                                $base->setId($linha['id_base']);
                                $registros = $base->ComboBase();
                                $lista = (is_array($registros) && count($registros) > 0) ? $registros : [['id' => '', 'nome' => "Selecione uma Base"]] ;
                                echo Componente::GerarSelectPDO("id_base", "id_base", "", $lista, array($_SESSION['FILTRO_RELATORIO_PACIENTE_ATENDIMENTO']['id_base']), array('','Todas as Bases'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','"');
                                ?>
                                <div class="text-muted"> Preencha o campo  Id Base </div> </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="form-group">
                                <label class="form-label" for="estado">Estado</label>
                                <?php
                                $objEstados     = new Estados();
                                $registros = $objEstados->ComboEstados();
                                $onchange = ' onchange="Squall.ListarSelect2(\'index_xml.php?app_modulo=cidades&app_comando=filtrar_cidade&app_codigo=\',\'#id_cidade\',this.value)"';
                                $outros = 'data-placeholder="Todas os Estados" data-allow-clear="true"';
                                echo Componente::GerarSelectPDO("id_estado", "id_estado", "", $registros, array($_SESSION['FILTRO_RELATORIO_PACIENTE_ATENDIMENTO']['id_estado']), array('','Todos os Estados'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',' '.$onchange . $outros);
                                ?>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-3 mb-4">
                            <div class="form-group">
                                <label class="form-label" for="cidade">Cidade</label>
                                <?php
                                $cidade = new Cidades();
                                $cidade->setIdEstado($_SESSION['FILTRO_RELATORIO_PACIENTE_ATENDIMENTO']['id_estado']);
                                $registros = $cidade->ComboCidade();
                                $outros = 'data-placeholder="Todas as Cidades" data-allow-clear="true"';
                                echo Componente::GerarSelectPDO("id_cidade","id_cidade","",$registros,array($_SESSION['FILTRO_RELATORIO_PACIENTE_ATENDIMENTO']['id_cidade']),Array(),Array("id", "nome"),false, "form-select  m-b-20 m-r-10 ",''.$outros);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-3   ">
                            <div class="form-group">
                                <label class="form-label" for="periodo">Período</label>
                                <div class="input-group mb-5">
                                    <input type="text" class="form-control mask-data  validar-obrigatorio" placeholder="selecione um data" name="periodo"  value="<?=$_SESSION['FILTRO_RELATORIO_PACIENTE_ATENDIMENTO']['periodo']?>"  id="periodo" aria-label="Todos os Períodos" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">
									<i class="fas fa-calendar fs-4"></i>
									</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="id_evento">Evento</label>
                                <?php
                                $objEvento     = new Evento();
                                $registros = $objEvento->ComboEventos();
                                $onchange = ' onchange="Squall.ListarSelect2(\'index_xml.php?app_modulo=subevento&app_comando=filtrar_sub_eventos&app_codigo=\',\'#id_subevento\',this.value)" ';
                                $outros = ' data-placeholder="Todas os Eventos" data-allow-clear="true" ';
                                echo Componente::GerarSelectPDO("id_evento", "id_evento", "", $registros, array(), array("", "Todos os Eventos"), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',$onchange . $outros);
                                ?>
                                <div class="text-muted"> Preencha o campo   Evento </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-2 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="id_subevento">Sub-Evento</label>
                                <?php
                                $objSubEvento     = new Subevento();
                                $registros = $objSubEvento->ListarComboSubEventos($_SESSION['FILTRO_RELATORIO_PACIENTE_ATENDIMENTO']['id_subevento']);
                                $lista = (is_array($registros) && count($registros) > 0) ? $registros : [['id' => '', 'nome' => "Nenhum Registro Econtrado"]] ;
                                $outros = 'data-placeholder="Todas os Subventos" data-allow-clear="true"';
                                echo Componente::GerarSelectPDO("id_subevento", "id_subevento", "", $lista, array($_SESSION['FILTRO_RELATORIO_PACIENTE_ATENDIMENTO']['id_subevento']), array(), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',' '.$outros);
                                ?>
                                <!--                                            <input type="text" name="id_subevento"  id="id_subevento"  class="form-control  " value="--><?//=$_SESSION['FILTRO_RELATORIO_PACIENTE_ATENDIMENTO']['id_subevento'];?><!--"/>-->
                                <div class="text-muted"> Selecione   Subevento </div> </div>
                        </div>
                        <div class="col-md-6 pt-8">
                            <a href="javascript:;" onclick="AtualizarGridRelatorio()" class="btn btn-primary btn-icon-warning  me-2 mb-2">
                                <i class="fas fa-filter "><span class="path1"></span><span class="path2"></span></i>Filtrar
                            </a>
                            <a href="javascript:;" onclick="ImprimirRelatorio()" class="btn btn-bg-light btn-icon-warning btn-text-primary me-2 mb-2">
                                <i class="ki-duotone ki-printer fs-1"><span class="path1"></span><span class="path2"></span></i>Imprimir
                            </a>
                            <a href="javascript:;" onclick="GerarPdf()" class="btn btn-bg-light btn-icon-danger btn-text-primary me-2 mb-2">
                                <i class="fa fa-file-pdf fs-4"><span class="path1"></span><span class="path2"></span></i>PDF
                            </a>
                            <a href="javascript:;" onclick="GerarXml()" class="btn btn-bg-light btn-icon-success btn-text-primary me-2 mb-2">
                                <i class="fa fa-file-excel fs-4"><span class="path1"></span><span class="path2"></span></i>Excel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>
<?php
$configModulo['titulo_card'] = "Resultado";
$configModulo['id_card'] = "conteudo_relatorio";
echo $objApp->GerarCardContainer($configModulo);
