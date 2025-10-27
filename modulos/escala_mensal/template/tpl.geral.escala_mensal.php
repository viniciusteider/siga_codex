<?php
include("modulos/escala_mensal/template/js.escala_mensal.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Escalas";

if($_SESSION['FILTRO_ESCALA_MENSAL']['periodo'] == "")
    $_SESSION['FILTRO_ESCALA_MENSAL']['periodo'] = date('d/m/Y') . " - " . date('d/m/Y');

echo $objApp->GerarBreadCrumb($configTitulo);
?>
    <form action="#" method="post" id="frm_escala_mensal_geral" name="frm_escala_mensal">
        <input type="hidden" name="pagina" id="pagina" value="<?=$_SESSION['FILTRO_ESCALA_MENSAL']['pagina']?>">
        <input type="hidden" name="ordem" id="ordem" value="<?=$_SESSION['FILTRO_ESCALA_MENSAL']['ordem']?>">
        <input type="hidden" name="filtro" id="filtro" value="<?=$_SESSION['FILTRO_ESCALA_MENSAL']['filtro']?>">
        <input type="hidden" name="retomar_filtro" id="retomar_filtro" value="<?=$_SESSION['FILTRO_ESCALA_MENSAL']['retomar_filtro']?>">
        <input type="hidden" name="numero_registro_hidden" id="numero_registro_hidden" value="<?=$_SESSION['FILTRO_ESCALA_MENSAL']['numero_registro_hidden']?>">
        <div id="kt_app_content_container" class="app-container  p-0">
            <div class="card shadow-sm">
                <div class="card-body" id="filtro">
                    <div class="row">
                        <div class="col-md-4   ">
                            <div class="form-group">
                                <label class="form-label" for="periodo">Período</label>
                                <div class="input-group mb-5">
                                    <input type="text" class="form-control validar-obrigatorio" placeholder="selecione um data" name="periodo"  value="<?=$_SESSION['FILTRO_ESCALA_MENSAL']['periodo']?>"  id="periodo" aria-label="Selecione o periodo" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">
									<i class="fas fa-calendar fs-4"></i>
									</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-search col-md-4" >
                            <label class="form-label" for="nome">Buscar por:</label>
                            <div class="input-group ">
                                <input type="text" value="<?=$_SESSION['FILTRO_ESCALA_MENSAL']['busca']?>" class="form-control" id="busca" name="busca" placeholder="digite o que gostaria de buscar">
                                <span class="input-group-text cursor-pointer btn  btn-success"  onclick="AtualizarGridEscalaMensal();"><i class="fas fa-search"></i> Filtrar</span>
                            </div><!-- .form-group -->
                        </div>
                        <div class="col-md-4 pt-8">

                            <a href="javascript:;" onclick="ImprimirRelatorio()" class="btn btn-bg-light btn-icon-warning btn-text-primary me-2 mb-2">
                                <i class="ki-duotone ki-printer fs-1"><span class="path1"></span><span class="path2"></span></i>Imprimir
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
$configModulo['titulo_card'] = "Listagem Escalas";
$configModulo['id_card'] = "conteudo_escala_mensal";
echo $objApp->GerarCardContainer($configModulo);

include_once('modulos/escala_mensal/template/tpl.modal.escala_mensal.php');
