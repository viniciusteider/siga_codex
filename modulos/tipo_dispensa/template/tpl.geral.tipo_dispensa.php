<?php
include("modulos/tipo_dispensa/template/js.tipo_dispensa.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Tipos de Dispensas";
echo $objApp->GerarBreadCrumb($configTitulo);
?>
    <form action="#" method="post" id="frm_tipo_dispensa_geral" name="frm_tipo_dispensa">
        <input type="hidden" name="pagina" id="pagina" value="<?=$_SESSION['FILTRO_TIPO_DISPENSA']['pagina']?>">
        <input type="hidden" name="ordem" id="ordem" value="<?=$_SESSION['FILTRO_TIPO_DISPENSA']['ordem']?>">
        <input type="hidden" name="filtro" id="filtro" value="<?=$_SESSION['FILTRO_TIPO_DISPENSA']['filtro']?>">
        <input type="hidden" name="retomar_filtro" id="retomar_filtro" value="<?=$_SESSION['FILTRO_TIPO_DISPENSA']['retomar_filtro']?>">
        <input type="hidden" name="numero_registro_hidden" id="numero_registro_hidden" value="<?=$_SESSION['FILTRO_TIPO_DISPENSA']['numero_registro_hidden']?>">
        <div id="kt_app_content_container" class="app-container  p-0">
            <div class="card shadow-sm">
                <div class="card-body" id="filtro">
                    <div class="row">
                        <div class="form-search col-md-4" >
                            <label class="form-label" for="nome">Buscar por:</label>
                            <div class="input-group ">
                                <input type="text" value="<?=$_SESSION['FILTRO_TIPO_DISPENSA']['busca']?>" class="form-control" id="busca" name="busca" placeholder="digite o que gostaria de buscar">
                                <span class="input-group-text cursor-pointer btn  btn-success"  onclick="AtualizarGridTipoDispensa();"><i class="fas fa-search"></i> Filtrar</span>
                            </div><!-- .form-group -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>
<?php
include("modulos/tipo_dispensa/template/tpl.modal.tipo_dispensa.php");
$configModulo['titulo_card'] = "Listagem Tipos de Dispensas";
$configModulo['id_card'] = "conteudo_tipo_dispensa";
echo $objApp->GerarCardContainer($configModulo);
