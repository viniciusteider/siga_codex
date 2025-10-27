<?php
include("modulos/tipo_afastamento/template/js.tipo_afastamento.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Tipos de Afastamentos";
echo $objApp->GerarBreadCrumb($configTitulo);
?>
    <form action="#" method="post" id="frm_tipo_afastamento_geral" name="frm_tipo_afastamento">
        <input type="hidden" name="pagina" id="pagina" value="<?=$_SESSION['FILTRO_TIPO_AFASTAMENTO']['pagina']?>">
        <input type="hidden" name="ordem" id="ordem" value="<?=$_SESSION['FILTRO_TIPO_AFASTAMENTO']['ordem']?>">
        <input type="hidden" name="filtro" id="filtro" value="<?=$_SESSION['FILTRO_TIPO_AFASTAMENTO']['filtro']?>">
        <input type="hidden" name="retomar_filtro" id="retomar_filtro" value="<?=$_SESSION['FILTRO_TIPO_AFASTAMENTO']['retomar_filtro']?>">
        <input type="hidden" name="numero_registro_hidden" id="numero_registro_hidden" value="<?=$_SESSION['FILTRO_TIPO_AFASTAMENTO']['numero_registro_hidden']?>">
        <div id="kt_app_content_container" class="app-container  p-0">
            <div class="card shadow-sm">
                <div class="card-body" id="filtro">
                    <div class="row">
                        <div class="form-search col-md-8" >
                            <label class="form-label" for="nome">Buscar por:</label>
                            <div class="input-group ">
                                <input type="text" value="<?=$_SESSION['FILTRO_TIPO_AFASTAMENTO']['busca']?>" class="form-control" id="busca" name="busca" placeholder="digite o que gostaria de buscar">
                                <span class="input-group-text cursor-pointer btn  btn-success"  onclick="AtualizarGridTipoAfastamento();"><i class="fas fa-search"></i> Filtrar</span>
                            </div><!-- .form-group -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>
<?php
include("modulos/tipo_afastamento/template/tpl.modal.tipo_afastamento.php");
$configModulo['titulo_card'] = "Tipos de Afastamentos";
$configModulo['id_card'] = "conteudo_tipo_afastamento";
echo $objApp->GerarCardContainer($configModulo);
