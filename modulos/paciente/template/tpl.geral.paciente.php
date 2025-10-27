<?php 
	include("modulos/paciente/template/js.paciente.php");
$objApp = new App();
if($_REQUEST['id_ocorrencia'] != "") $_SESSION['FILTRO_PACIENTE']['id_ocorrencia'] = $_REQUEST['id_ocorrencia'];
?>

<form action="#" method="post" id="frm_paciente_geral" name="frm_paciente">
		<input type="hidden" name="pagina" id="pagina" value="<?=$_SESSION['FILTRO_PACIENTE']['pagina']?>">
		<input type="hidden" name="id_ocorrencia" id="id_ocorrencia" value="<?=$_SESSION['FILTRO_PACIENTE']['id_ocorrencia']?>">
		<input type="hidden" name="ordem" id="ordem" value="<?=$_SESSION['FILTRO_PACIENTE']['ordem']?>">
		<input type="hidden" name="filtro" id="filtro" value="<?=$_SESSION['FILTRO_PACIENTE']['filtro']?>">
		<input type="hidden" name="retomar_filtro" id="retomar_filtro" value="<?=$_SESSION['FILTRO_PACIENTE']['retomar_filtro']?>">
		<input type="hidden" name="numero_registro_hidden" id="numero_registro_hidden" value="<?=$_SESSION['FILTRO_PACIENTE']['numero_registro_hidden']?>">
		</form>
	<br>
<?php 
	include("modulos/paciente/template/tpl.modal.paciente.php");
//$configModulo['titulo_card'] = "Listagem Pacientes";
$configModulo['id_card'] = "conteudo_paciente";
echo $objApp->GerarCardContainer($configModulo);
