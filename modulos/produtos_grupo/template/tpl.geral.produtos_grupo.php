<?php 
	include("modulos/produtos_grupo/template/js.produtos_grupo.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Produtos Grupo";
echo $objApp->GerarBreadCrumb($configTitulo);
?> 
<form action="#" method="post" id="frm_produtos_grupo_geral" name="frm_produtos_grupo">
		<input type="hidden" name="pagina" id="pagina" value="<?=$_SESSION['FILTRO_PRODUTOS_GRUPO']['pagina']?>">
		<input type="hidden" name="ordem" id="ordem" value="<?=$_SESSION['FILTRO_PRODUTOS_GRUPO']['ordem']?>">
		<input type="hidden" name="filtro" id="filtro" value="<?=$_SESSION['FILTRO_PRODUTOS_GRUPO']['filtro']?>">
		<input type="hidden" name="retomar_filtro" id="retomar_filtro" value="<?=$_SESSION['FILTRO_PRODUTOS_GRUPO']['retomar_filtro']?>">
		<input type="hidden" name="numero_registro_hidden" id="numero_registro_hidden" value="<?=$_SESSION['FILTRO_PRODUTOS_GRUPO']['numero_registro_hidden']?>">
		<div id="kt_app_content_container" class="app-container  p-0">
			<div class="card shadow-sm">
				<div class="card-body" id="filtro">
					<div class="row">
						<div class="col-md-4   ">
							<div class="form-group">
								<label class="form-label" for="periodo">Período</label>
								<div class="input-group mb-5">
									<input type="text" class="form-control validar-obrigatorio" placeholder="selecione um data" name="periodo"  value="<?=$_SESSION['FILTRO_PRODUTOS_GRUPO']['periodo']?>"  id="periodo" aria-label="Selecione o periodo" aria-describedby="basic-addon2">
									<span class="input-group-text" id="basic-addon2">
									<i class="fas fa-calendar fs-4"></i>
									</span>
								</div>
							</div>
						</div>
					<div class="form-search col-md-4" >
					<label class="form-label" for="nome">Buscar por:</label>
						<div class="input-group ">
							<input type="text" value="<?=$_SESSION['FILTRO_PRODUTOS_GRUPO']['busca']?>" class="form-control" id="busca" name="busca" placeholder="digite o que gostaria de buscar">
								<span class="input-group-text cursor-pointer btn  btn-success"  onclick="AtualizarGridProdutosGrupo({});"><i class="fas fa-search"></i> Filtrar</span>
								</div><!-- .form-group -->
								</div>
							</div>
						</div>
					</div>
				</div>
		</form>
	<br>
<?php 
	include("modulos/produtos_grupo/template/tpl.modal.produtos_grupo.php");
$configModulo['titulo_card'] = "Listagem Produtos Grupo";
$configModulo['id_card'] = "conteudo_produtos_grupo";
echo $objApp->GerarCardContainer($configModulo);
