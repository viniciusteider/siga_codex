<?php 
	include("modulos/ocorrencias_recursos_equipe/template/js.ocorrencias_recursos_equipe.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Ocorrencias Recursos Equipe";
echo $objApp->GerarBreadCrumb($configTitulo);
?> 
<form action="#" method="post" id="frm_ocorrencias_recursos_equipe_geral" name="frm_ocorrencias_recursos_equipe">
		<input type="hidden" name="pagina" id="pagina" value="<?=$_SESSION['FILTRO_OCORRENCIAS_RECURSOS_EQUIPE']['pagina']?>">
		<input type="hidden" name="ordem" id="ordem" value="<?=$_SESSION['FILTRO_OCORRENCIAS_RECURSOS_EQUIPE']['ordem']?>">
		<input type="hidden" name="filtro" id="filtro" value="<?=$_SESSION['FILTRO_OCORRENCIAS_RECURSOS_EQUIPE']['filtro']?>">
		<input type="hidden" name="retomar_filtro" id="retomar_filtro" value="<?=$_SESSION['FILTRO_OCORRENCIAS_RECURSOS_EQUIPE']['retomar_filtro']?>">
		<input type="hidden" name="numero_registro_hidden" id="numero_registro_hidden" value="<?=$_SESSION['FILTRO_OCORRENCIAS_RECURSOS_EQUIPE']['numero_registro_hidden']?>">
		<div id="kt_app_content_container" class="app-container  p-0">
			<div class="card shadow-sm">
				<div class="card-body" id="filtro">
					<div class="row">
						<div class="col-md-4   ">
							<div class="form-group">
								<label class="form-label" for="periodo">Período</label>
								<div class="input-group mb-5">
									<input type="text" class="form-control mask-data  validar-obrigatorio" placeholder="selecione um data" name="periodo"  value="<?=$_SESSION['FILTRO_OCORRENCIAS_RECURSOS_EQUIPE']['periodo']?>"  id="periodo" aria-label="Selecione o periodo" aria-describedby="basic-addon2">
									<span class="input-group-text" id="basic-addon2">
									<i class="fas fa-calendar fs-4"></i>
									</span>
								</div>
							</div>
						</div>
					<div class="form-search col-md-4" >
					<label class="form-label" for="nome">Buscar por:</label>
						<div class="input-group ">
							<input type="text" value="<?=$_SESSION['FILTRO_OCORRENCIAS_RECURSOS_EQUIPE']['busca']?>" class="form-control" id="busca" name="busca" placeholder="digite o que gostaria de buscar">
								<span class="input-group-text cursor-pointer btn  btn-success"  onclick="AtualizarGridOcorrenciasRecursosEquipe();"><i class="fas fa-search"></i> Filtrar</span>
								</div><!-- .form-group -->
								</div>
							</div>
						</div>
					</div>
				</div>
		</form>
	<br>
<?php 
	include("modulos/ocorrencias_recursos_equipe/template/tpl.modal.ocorrencias_recursos_equipe.php");
$configModulo['titulo_card'] = "Listagem Ocorrencias Recursos Equipe";
$configModulo['id_card'] = "conteudo_ocorrencias_recursos_equipe";
echo $objApp->GerarCardContainer($configModulo);
