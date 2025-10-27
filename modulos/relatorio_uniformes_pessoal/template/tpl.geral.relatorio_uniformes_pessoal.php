<?php
include("modulos/relatorio_uniformes_pessoal/template/js.relatorio_uniformes_pessoal.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Relatórios";
$configTitulo['titulo_modulo'] = "Relatórios Uniformes Pessoal";
echo $objApp->GerarBreadCrumb($configTitulo);
?>
    <form action="#" method="post" id="frm_relatorio_uniformes_pessoal" name="frm_relatorio_uniformes_pessoal">
        <input type="hidden" name="pagina" id="pagina" value="<?=$_SESSION['FILTRO_RELATORIO_UNIFORMES_PESSOAL']['pagina']?>">
        <input type="hidden" name="ordem" id="ordem" value="<?=$_SESSION['FILTRO_RELATORIO_UNIFORMES_PESSOAL']['ordem']?>">
        <input type="hidden" name="filtro" id="filtro" value="<?=$_SESSION['FILTRO_RELATORIO_UNIFORMES_PESSOAL']['filtro']?>">
        <input type="hidden" name="retomar_filtro" id="retomar_filtro" value="<?=$_SESSION['FILTRO_RELATORIO_UNIFORMES_PESSOAL']['retomar_filtro']?>">
        <input type="hidden" name="numero_registro_hidden" id="numero_registro_hidden" value="<?=$_SESSION['FILTRO_RELATORIO_UNIFORMES_PESSOAL']['numero_registro_hidden']?>">
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
                                echo Componente::GerarSelectPDO("id_base", "id_base", "", $lista, array($_SESSION['FILTRO_RELATORIO_UNIFORMES_PESSOAL']['id_base']), array('','Todas as Bases'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','"');
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
                                echo Componente::GerarSelectPDO("id_estado", "id_estado", "", $registros, array($_SESSION['FILTRO_RELATORIO_UNIFORMES_PESSOAL']['id_estado']), array('','Todos os Estados'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',' '.$onchange . $outros);
                                ?>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-3 mb-4">
                            <div class="form-group">
                                <label class="form-label" for="cidade">Cidade</label>
                                <?php
                                $cidade = new Cidades();
                                $cidade->setIdEstado($_SESSION['FILTRO_RELATORIO_PACIENTE_IDADE']['id_estado']);
                                $registros = $cidade->ComboCidade();
                                $outros = 'data-placeholder="Todas as Cidades" data-allow-clear="true"';
                                echo Componente::GerarSelectPDO("id_cidade","id_cidade","",$registros,array($_SESSION['FILTRO_RELATORIO_UNIFORMES_PESSOAL']['id_cidade']),Array(),Array("id", "nome"),false, "form-select  m-b-20 m-r-10 ",''.$outros);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-3   ">
                            <div class="form-group">
                                <label class="form-label" for="periodo">Período</label>
                                <div class="input-group mb-5">
                                    <input type="text" class="form-control mask-data  validar-obrigatorio" placeholder="selecione um data" name="periodo"  value="<?=$_SESSION['FILTRO_RELATORIO_UNIFORMES_PESSOAL']['periodo']?>"  id="periodo" aria-label="Todos os Períodos" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">
									<i class="fas fa-calendar fs-4"></i>
									</span>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 pt-3">
                                <a class="btn  m-r-5 m-b-5 btn-light-primary" id="gerar" onclick="GerarRelatorio()"><i class="fa fa-filter"></i> Gerar</a>
                                <a class='btn  m-r-5 m-b-5 btn-light-dark'  onclick='Imprimir()'><i class="fa fa-print"></i>Imprimir</a>
                                <a class='btn  m-r-5 m-b-5 btn-light-danger'   onclick='Pdf()'><i class="fa fa-file-pdf"></i> PDF</a>
                                <a class='btn  m-r-5 m-b-5 btn-light-success' onclick='Xls()'><i class="fa fa-file-excel"> </i>Excel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>
<?php
$configModulo['titulo_card'] = "Resultado";
$configModulo['id_card'] = "conteudo_relatorio_uniformes_pessoal";
echo $objApp->GerarCardContainer($configModulo,"&nbsp;");
