<?php 
	include("modulos/veiculos_acidentes/template/js.veiculos_acidentes.php");
$objApp = new App();

if($_REQUEST['id_ocorrencia'] != "") $_SESSION['FILTRO_VEICULOS_ACIDENTES']['id_ocorrencia'] = $_REQUEST['id_ocorrencia'];
?> 
<form action="#" method="post" id="frm_veiculos_acidentes_geral" name="frm_veiculos_acidentes">
		<input type="hidden" name="pagina" id="pagina" value="<?=$_SESSION['FILTRO_VEICULOS_ACIDENTES']['pagina']?>">
		<input type="hidden" name="id_ocorrencia" id="id_ocorrencia" value="<?=$_SESSION['FILTRO_VEICULOS_ACIDENTES']['id_ocorrencia']?>">
		<input type="hidden" name="ordem" id="ordem" value="<?=$_SESSION['FILTRO_VEICULOS_ACIDENTES']['ordem']?>">
		<input type="hidden" name="filtro" id="filtro" value="<?=$_SESSION['FILTRO_VEICULOS_ACIDENTES']['filtro']?>">
		<input type="hidden" name="retomar_filtro" id="retomar_filtro" value="<?=$_SESSION['FILTRO_VEICULOS_ACIDENTES']['retomar_filtro']?>">
		<input type="hidden" name="numero_registro_hidden" id="numero_registro_hidden" value="<?=$_SESSION['FILTRO_VEICULOS_ACIDENTES']['numero_registro_hidden']?>">
		</form>
	<br>
<?php 
	include("modulos/veiculos_acidentes/template/tpl.modal.veiculos_acidentes.php");
//$configModulo['titulo_card'] = "Listagem Veiculos Acidentes";
$configModulo['id_card'] = "conteudo_veiculos_acidentes";
echo $objApp->GerarCardContainer($configModulo);
