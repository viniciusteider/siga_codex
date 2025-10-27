<?php
include("modulos/ocorrencias_apoio/template/js.ocorrencias_apoio.php");
$objApp = new App();
if($_REQUEST['id_ocorrencia'] != "") $_SESSION['FILTRO_OCORRENCIAS_APOIO']['id_ocorrencia'] = $_REQUEST['id_ocorrencia'];
?>
    <form action="#" method="post" id="frm_ocorrencias_apoio_geral" name="frm_ocorrencias_apoio">
        <input type="hidden" name="pagina" id="pagina" value="<?=$_SESSION['FILTRO_OCORRENCIAS_APOIO']['pagina']?>">
        <input type="hidden" name="id_ocorrencia" id="id_ocorrencia" value="<?=$_SESSION['FILTRO_OCORRENCIAS_APOIO']['id_ocorrencia']?>">
        <input type="hidden" name="ordem" id="ordem" value="<?=$_SESSION['FILTRO_OCORRENCIAS_APOIO']['ordem']?>">
        <input type="hidden" name="filtro" id="filtro" value="<?=$_SESSION['FILTRO_OCORRENCIAS_APOIO']['filtro']?>">
        <input type="hidden" name="retomar_filtro" id="retomar_filtro" value="<?=$_SESSION['FILTRO_OCORRENCIAS_APOIO']['retomar_filtro']?>">
        <input type="hidden" name="numero_registro_hidden" id="numero_registro_hidden" value="<?=$_SESSION['FILTRO_OCORRENCIAS_APOIO']['numero_registro_hidden']?>">
    </form>
<?php
include("modulos/ocorrencias_apoio/template/tpl.modal.ocorrencias_apoio.php");
//$configModulo['titulo_card'] = "Listagem Ocorrencias Apoio";
$configModulo['id_card'] = "conteudo_ocorrencias_apoio";
echo $objApp->GerarCardContainer($configModulo);
