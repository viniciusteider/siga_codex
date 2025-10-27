<?php
include("modulos/tipo_curso/template/js.tipo_curso.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Tipos de Cursos";
echo $objApp->GerarBreadCrumb($configTitulo);
?>
    <form action="#" method="post" id="frm_tipo_curso_geral" name="frm_tipo_curso">
        <input type="hidden" name="pagina" id="pagina" value="<?=$_SESSION['FILTRO_TIPO_CURSO']['pagina']?>">
        <input type="hidden" name="ordem" id="ordem" value="<?=$_SESSION['FILTRO_TIPO_CURSO']['ordem']?>">
        <input type="hidden" name="filtro" id="filtro" value="<?=$_SESSION['FILTRO_TIPO_CURSO']['filtro']?>">
        <input type="hidden" name="retomar_filtro" id="retomar_filtro" value="<?=$_SESSION['FILTRO_TIPO_CURSO']['retomar_filtro']?>">
        <input type="hidden" name="numero_registro_hidden" id="numero_registro_hidden" value="<?=$_SESSION['FILTRO_TIPO_CURSO']['numero_registro_hidden']?>">
        <div id="kt_app_content_container" class="app-container  p-0">
            <div class="card shadow-sm">
                <div class="card-body" id="filtro">
                    <div class="row">
                        <div class="form-search col-md-4" >
                            <label class="form-label" for="nome">Buscar por:</label>
                            <div class="input-group ">
                                <input type="text" value="<?=$_SESSION['FILTRO_TIPO_CURSO']['busca']?>" class="form-control" id="busca" name="busca" placeholder="digite o que gostaria de buscar">
                                <span class="input-group-text cursor-pointer btn  btn-success"  onclick="AtualizarGridTipoCurso();"><i class="fas fa-search"></i> Filtrar</span>
                            </div><!-- .form-group -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>
<?php
include("modulos/tipo_curso/template/tpl.modal.tipo_curso.php");
$configModulo['titulo_card'] = "Listagem Tipos de Cursos";
$configModulo['id_card'] = "conteudo_tipo_curso";
echo $objApp->GerarCardContainer($configModulo);
