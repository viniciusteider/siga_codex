<?php 
	include("modulos/almoxarifado_controle_estoque/template/js.almoxarifado_controle_estoque.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Almoxarifado Controle Estoque";
echo $objApp->GerarBreadCrumb($configTitulo);
?> 
<form action="#" method="post" id="frm_almoxarifado_controle_estoque_geral" name="frm_almoxarifado_controle_estoque">
		<input type="hidden" name="pagina" id="pagina" value="<?=$_SESSION['FILTRO_ALMOXARIFADO_CONTROLE_ESTOQUE']['pagina']?>">
		<input type="hidden" name="ordem" id="ordem" value="<?=$_SESSION['FILTRO_ALMOXARIFADO_CONTROLE_ESTOQUE']['ordem']?>">
		<input type="hidden" name="filtro" id="filtro" value="<?=$_SESSION['FILTRO_ALMOXARIFADO_CONTROLE_ESTOQUE']['filtro']?>">
		<input type="hidden" name="retomar_filtro" id="retomar_filtro" value="<?=$_SESSION['FILTRO_ALMOXARIFADO_CONTROLE_ESTOQUE']['retomar_filtro']?>">
		<input type="hidden" name="numero_registro_hidden" id="numero_registro_hidden" value="<?=$_SESSION['FILTRO_ALMOXARIFADO_CONTROLE_ESTOQUE']['numero_registro_hidden']?>">
		<div id="kt_app_content_container" class="app-container  p-0">
			<div class="card shadow-sm">
				<div class="card-body" id="filtro">
					<div class="row">
						<div class="col-md-4   ">
							<div class="form-group">
								<label class="form-label" for="periodo">Período</label>
								<div class="input-group mb-5">
									<input type="text" class="form-control validar-obrigatorio" placeholder="selecione um data" name="periodo"  value="<?=$_SESSION['FILTRO_ALMOXARIFADO_CONTROLE_ESTOQUE']['periodo']?>"  id="periodo" aria-label="Selecione o periodo" aria-describedby="basic-addon2">
									<span class="input-group-text" id="basic-addon2">
									<i class="fas fa-calendar fs-4"></i>
									</span>
								</div>
							</div>
						</div>
					<div class="form-search col-md-4" >
					<label class="form-label" for="nome">Buscar por:</label>
						<div class="input-group ">
							<input type="text" value="<?=$_SESSION['FILTRO_ALMOXARIFADO_CONTROLE_ESTOQUE']['busca']?>" class="form-control" id="busca" name="busca" placeholder="digite o que gostaria de buscar">
								<span class="input-group-text cursor-pointer btn  btn-success"  onclick="AtualizarGridAlmoxarifadoControleEstoque();"><i class="fas fa-search"></i> Filtrar</span>
								</div><!-- .form-group -->
								</div>
							</div>
						</div>
					</div>
				</div>
		</form>
	<br>
<?php 
	include("modulos/almoxarifado_controle_estoque/template/tpl.modal.almoxarifado_controle_estoque.php");
$configModulo['titulo_card'] = "Listagem Almoxarifado Controle Estoque";
$configModulo['id_card'] = "conteudo_almoxarifado_controle_estoque";
echo $objApp->GerarCardContainer($configModulo);
