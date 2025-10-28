<?php
include("modulos/ocorrencias/template/js.pesquisa.ocorrencias.php");

$paginaAtual = isset($_REQUEST['pagina']) ? $_REQUEST['pagina'] : 0;
$ordemAtual = isset($_REQUEST['ordem']) ? $_REQUEST['ordem'] : '';
$filtroAtual = isset($_REQUEST['filtro']) ? $_REQUEST['filtro'] : '';
$numeroRegistroHidden = isset($_REQUEST['numero_registro_hidden']) ? $_REQUEST['numero_registro_hidden'] : '';
$periodo = isset($_REQUEST['periodo']) ? $_REQUEST['periodo'] : '';
$idOcorrencia = isset($_REQUEST['id_ocorrencia']) ? $_REQUEST['id_ocorrencia'] : '';
$endereco = isset($_REQUEST['endereco']) ? $_REQUEST['endereco'] : '';
$nomeVitima = isset($_REQUEST['nome_vitima']) ? $_REQUEST['nome_vitima'] : '';

$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Ocorrências";
$configTitulo['titulo_modulo'] = "Pesquisa de Ocorrências";
echo $objApp->GerarBreadCrumb($configTitulo);
?>
<form action="#" method="post" id="frm_pesquisa_ocorrencias" name="frm_pesquisa_ocorrencias">
    <input type="hidden" name="pagina" id="pagina" value="<?=htmlspecialchars($paginaAtual, ENT_QUOTES, 'UTF-8')?>">
    <input type="hidden" name="ordem" id="ordem" value="<?=htmlspecialchars($ordemAtual, ENT_QUOTES, 'UTF-8')?>">
    <input type="hidden" name="filtro" id="filtro" value="<?=htmlspecialchars($filtroAtual, ENT_QUOTES, 'UTF-8')?>">
    <input type="hidden" name="numero_registro_hidden" id="numero_registro_hidden" value="<?=htmlspecialchars($numeroRegistroHidden, ENT_QUOTES, 'UTF-8')?>">
    <div id="kt_app_content_container" class="app-container  p-0">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-5">
                    <div class="col-md-3">
                        <label class="form-label" for="id_ocorrencia">ID da Ocorrência</label>
                        <input type="text" class="form-control" id="id_ocorrencia" name="id_ocorrencia" value="<?=htmlspecialchars($idOcorrencia, ENT_QUOTES, 'UTF-8')?>" placeholder="Digite o ID">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="periodo">Período</label>
                        <div class="input-group">
                            <input type="text" class="form-control mask-data" placeholder="Selecione o período" name="periodo" value="<?=htmlspecialchars($periodo, ENT_QUOTES, 'UTF-8')?>" id="periodo" aria-label="Selecione o período" aria-describedby="periodo-addon">
                            <span class="input-group-text" id="periodo-addon">
                                <i class="fas fa-calendar fs-4"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="endereco">Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" value="<?=htmlspecialchars($endereco, ENT_QUOTES, 'UTF-8')?>" placeholder="Logradouro, bairro, cidade...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="nome_vitima">Nome da Vítima</label>
                        <input type="text" class="form-control" id="nome_vitima" name="nome_vitima" value="<?=htmlspecialchars($nomeVitima, ENT_QUOTES, 'UTF-8')?>" placeholder="Digite o nome da vítima">
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-primary me-2" id="btn-pesquisar-ocorrencias">
                            <i class="fas fa-search"></i> Pesquisar
                        </button>
                        <button type="button" class="btn btn-light" id="btn-resetar-pesquisa">
                            <i class="fas fa-eraser"></i> Limpar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
$configModulo['titulo_card'] = "Resultados da Pesquisa";
$configModulo['id_card'] = "conteudo_pesquisa_ocorrencias";
echo $objApp->GerarCardContainer($configModulo);
?>
