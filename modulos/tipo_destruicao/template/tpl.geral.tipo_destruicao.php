<?php 
	include("modulos/tipo_destruicao/template/js.tipo_destruicao.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Tipo Destruicao";
echo $objApp->GerarBreadCrumb($configTitulo);
?> 
<form action="#" method="post" id="frm_tipo_destruicao_geral" name="frm_tipo_destruicao">
		<input type="hidden" name="pagina" id="pagina" value="<?=$_SESSION['FILTRO_TIPO_DESTRUICAO']['pagina']?>">
		<input type="hidden" name="ordem" id="ordem" value="<?=$_SESSION['FILTRO_TIPO_DESTRUICAO']['ordem']?>">
		<input type="hidden" name="filtro" id="filtro" value="<?=$_SESSION['FILTRO_TIPO_DESTRUICAO']['filtro']?>">
		<input type="hidden" name="retomar_filtro" id="retomar_filtro" value="<?=$_SESSION['FILTRO_TIPO_DESTRUICAO']['retomar_filtro']?>">
		<input type="hidden" name="numero_registro_hidden" id="numero_registro_hidden" value="<?=$_SESSION['FILTRO_TIPO_DESTRUICAO']['numero_registro_hidden']?>">
		<div id="kt_app_content_container" class="app-container  p-0">
			<div class="card shadow-sm">
				<div class="card-body" id="filtro">
					<div class="row">
						<div class="col-md-4   ">
							<div class="form-group">
								<label class="form-label" for="periodo">Período</label>
								<div class="input-group mb-5">
									<input type="text" class="form-control mask-data  validar-obrigatorio" placeholder="selecione um data" name="periodo"  value="<?=$_SESSION['FILTRO_TIPO_DESTRUICAO']['periodo']?>"  id="periodo" aria-label="Selecione o periodo" aria-describedby="basic-addon2">
									<span class="input-group-text" id="basic-addon2">
									<i class="fas fa-calendar fs-4"></i>
									</span>
								</div>
							</div>
						</div>
					<div class="form-search col-md-4" >
					<label class="form-label" for="nome">Buscar por:</label>
						<div class="input-group ">
							<input type="text" value="<?=$_SESSION['FILTRO_TIPO_DESTRUICAO']['busca']?>" class="form-control" id="busca" name="busca" placeholder="digite o que gostaria de buscar">
								<span class="input-group-text cursor-pointer btn  btn-success"  onclick="AtualizarGridTipoDestruicao();"><i class="fas fa-search"></i> Filtrar</span>
								</div><!-- .form-group -->
								</div>
							</div>
						</div>
					</div>
				</div>
		</form>
	<br>
<?php 
	include("modulos/tipo_destruicao/template/tpl.modal.tipo_destruicao.php");
$configModulo['titulo_card'] = "Listagem Tipo Destruicao";
$configModulo['id_card'] = "conteudo_tipo_destruicao";
echo $objApp->GerarCardContainer($configModulo);
