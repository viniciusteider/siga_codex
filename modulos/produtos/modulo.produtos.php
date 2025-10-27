<?php

switch($app_comando)
{
	case "frm_adicionar_produtos":
		$template = "tpl.frm.produtos.php";
		break;

	case "frm_modal_produtos":
if($_REQUEST["app_codigo"] != "") {
		$produtos = new Produtos();
		$produtos->setId($_REQUEST["app_codigo"]);
		$linha = $produtos->Editar();
}		$template = "tpl.form.produtos.php";
		break;

	case "adicionar_produtos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutos = new Produtos($pdo);
			$objProdutos->setNome($_REQUEST['nome']);
			$objProdutos->setIdProdutoGrupo($_REQUEST['id_produto_grupo']);
			$objProdutos->setIdProdutoSubgrupo($_REQUEST['id_produto_subgrupo']);
			$objProdutos->setIdTipoProduto($_REQUEST['id_tipo_produto']);
			$objProdutos->setIdSetor($_REQUEST['id_setor']);
			$objProdutos->setIdFornecedor($_REQUEST['id_fornecedor']);
			$objProdutos->setIdFabricante($_REQUEST['id_fabricante']);
			$objProdutos->setIdCor($_REQUEST['id_cor']);
			$objProdutos->setIdUnidadeMedida($_REQUEST['id_unidade_medida']);
			$objProdutos->setEstoqueAtual($_REQUEST['estoque_atual']);
			$objProdutos->setEstoqueMinimo($_REQUEST['estoque_minimo']);
			$objProdutos->setCusto($_REQUEST['custo']);
			$objProdutos->setCodigoBarras($_REQUEST['codigo_barras']);
			$objProdutos->setIdMarca($_REQUEST['id_marca']);
			$objProdutos->setLocal($_REQUEST['local']);
			$objProdutos->setCompartimento($_REQUEST['compartimento']);
			$objProdutos->setReferencia($_REQUEST['referencia']);
			$objProdutos->setDataCadastro(Conexao::PrepararDataBD($_REQUEST['data_cadastro'], $_SESSION['usuario']['timezone']));
			$objProdutos->setDataValidade(Conexao::PrepararDataBD($_REQUEST['data_validade'], $_SESSION['usuario']['timezone']));
			$objProdutos->setRetornavel($_REQUEST['retornavel']);
			$objProdutos->setControlaEstoque($_REQUEST['controla_estoque']);
			$objProdutos->setIdAlmoxarifado($_REQUEST['id_almoxarifado']);
			$objProdutos->setSaldoInicial($_REQUEST['saldo_inicial']);
			$objProdutos->setTotal($_REQUEST['total']);
			$objProdutos->setCautelado($_REQUEST['cautelado']);

			$objProdutos->setPrefixo($_REQUEST['prefixo']);
			$objProdutos->setNumeroSerie($_REQUEST['numero_serie']);
			$objProdutos->setNumeroPatrimonio($_REQUEST['numero_patrimonio']);
			$objProdutos->setIdCaracteristica($_REQUEST['id_caracteristica']);
			$objProdutos->setIdTipo($_REQUEST['id_tipo']);
			$objProdutos->setIdEstoque($_REQUEST['id_estoque']);
			$objProdutos->setNumeroTamanho($_REQUEST['numero_tamanho']);
			$objProdutos->setIdModelo($_REQUEST['id_modelo']);
			$objProdutos->setAcabamento($_REQUEST['acabamento']);
			$objProdutos->setComprimento($_REQUEST['comprimento']);
			$objProdutos->setAltura($_REQUEST['altura']);
			$objProdutos->setProfundidade($_REQUEST['profundidade']);
			$objProdutos->setRegistro($_REQUEST['registro']);
			$objProdutos->setVisualizarRelatorios($_REQUEST['visualizar_relatorios']);
			$objProdutos->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
			$objProdutos->setIdRevestimento($_REQUEST['id_revestimento']);
			$objProdutos->setIdTipoBem($_REQUEST['id_tipo_bem']);
			$objProdutos->setCodigoInterno($_REQUEST['codigo_interno']);
			$objProdutos->setCodigoPrefeitura($_REQUEST['codigo_prefeitura']);
			$objProdutos->setQuantidadeDiaCautela($_REQUEST['quantidade_dia_cautela']);
            if (count($_FILES) > 0) {
                $upload = new Upload("upload/produtos/");

                $vet = explode(".", $_FILES['foto']['name']);
                $extensao = end($vet);
                Upload::ChecarExtensoesImagem($extensao);
                $temp   = $_FILES['foto']['tmp_name'];
                $novo   = str_replace(" ","_",$vet[0]) . (mktime()) . ".$extensao";
                $imagem = $upload->Preparar($temp, $novo);
                $objProdutos->setFoto($imagem);

            }

			$novoId = $objProdutos->Adicionar();
			$msg["codigo"] = 0;
			$msg["mensagem"] = "Sucesso ao Adicionar registro";
			$pdo->commit();
		} catch (Exception $e) {
			$msg["codigo"] = 1;
			$msg["mensagem"] = ($e->getCode() == 2) ? $e->getMessage() : "Erro ao Executar Operação";
			$msg["debug"]["error"] = $e->getMessage();
			$msg["debug"]["file"] = $e->getFile();
			$msg["debug"]["line"] = $e->getLine();
			$pdo->rollBack();
		}
		echo json_encode($msg);
		$template = "ajax.produtos.php";
		break;

	case "frm_atualizar_produtos" :
		$produtos = new Produtos();
		$produtos->setId($_REQUEST["app_codigo"]);
		$linha = $produtos->Editar();
		$template = "tpl.frm.produtos.php";
		break;

	case "atualizar_produtos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutos = new Produtos($pdo);
			$objProdutos->setId($_REQUEST['id']);
			$objProdutos->setNome($_REQUEST['nome']);
			$objProdutos->setIdProdutoGrupo($_REQUEST['id_produto_grupo']);
			$objProdutos->setIdProdutoSubgrupo($_REQUEST['id_produto_subgrupo']);
			$objProdutos->setIdTipoProduto($_REQUEST['id_tipo_produto']);
			$objProdutos->setIdSetor($_REQUEST['id_setor']);
			$objProdutos->setIdFornecedor($_REQUEST['id_fornecedor']);
			$objProdutos->setIdFabricante($_REQUEST['id_fabricante']);
			$objProdutos->setIdCor($_REQUEST['id_cor']);
			$objProdutos->setIdUnidadeMedida($_REQUEST['id_unidade_medida']);
			$objProdutos->setEstoqueAtual($_REQUEST['estoque_atual']);
			$objProdutos->setEstoqueMinimo($_REQUEST['estoque_minimo']);
			$objProdutos->setCusto($_REQUEST['custo']);
			$objProdutos->setCodigoBarras($_REQUEST['codigo_barras']);
			$objProdutos->setIdMarca($_REQUEST['id_marca']);
			$objProdutos->setLocal($_REQUEST['local']);
			$objProdutos->setCompartimento($_REQUEST['compartimento']);
			$objProdutos->setReferencia($_REQUEST['referencia']);
			$objProdutos->setDataCadastro(Conexao::PrepararDataBD($_REQUEST['data_cadastro'], $_SESSION['usuario']['timezone']));
			$objProdutos->setDataValidade(Conexao::PrepararDataBD($_REQUEST['data_validade'], $_SESSION['usuario']['timezone']));
			$objProdutos->setRetornavel($_REQUEST['retornavel']);
			$objProdutos->setControlaEstoque($_REQUEST['controla_estoque']);
			$objProdutos->setIdAlmoxarifado($_REQUEST['id_almoxarifado']);
			$objProdutos->setSaldoInicial($_REQUEST['saldo_inicial']);
			$objProdutos->setTotal($_REQUEST['total']);
			$objProdutos->setCautelado($_REQUEST['cautelado']);
            if (count($_FILES) > 0) {
                $upload = new Upload("upload/produtos/");

                $vet = explode(".", $_FILES['foto']['name']);
                $extensao = end($vet);
                Upload::ChecarExtensoesImagem($extensao);
                $temp   = $_FILES['foto']['tmp_name'];
                $novo   = str_replace(" ","_",$vet[0]) . (mktime()) . ".$extensao";
                $imagem = $upload->Preparar($temp, $novo);
                $objProdutos->setFoto($imagem);

            }
			$objProdutos->setPrefixo($_REQUEST['prefixo']);
			$objProdutos->setNumeroSerie($_REQUEST['numero_serie']);
			$objProdutos->setNumeroPatrimonio($_REQUEST['numero_patrimonio']);
			$objProdutos->setIdCaracteristica($_REQUEST['id_caracteristica']);
			$objProdutos->setIdTipo($_REQUEST['id_tipo']);
			$objProdutos->setIdEstoque($_REQUEST['id_estoque']);
			$objProdutos->setNumeroTamanho($_REQUEST['numero_tamanho']);
			$objProdutos->setIdModelo($_REQUEST['id_modelo']);
			$objProdutos->setAcabamento($_REQUEST['acabamento']);
			$objProdutos->setComprimento($_REQUEST['comprimento']);
			$objProdutos->setAltura($_REQUEST['altura']);
			$objProdutos->setProfundidade($_REQUEST['profundidade']);
			$objProdutos->setRegistro($_REQUEST['registro']);
			$objProdutos->setVisualizarRelatorios($_REQUEST['visualizar_relatorios']);
			$objProdutos->setIdRevestimento($_REQUEST['id_revestimento']);
			$objProdutos->setIdTipoBem($_REQUEST['id_tipo_bem']);
			$objProdutos->setCodigoInterno($_REQUEST['codigo_interno']);
			$objProdutos->setCodigoPrefeitura($_REQUEST['codigo_prefeitura']);
			$objProdutos->setQuantidadeDiaCautela($_REQUEST['quantidade_dia_cautela']);
			$objProdutos->Modificar();
			$msg["codigo"] = 0;
			$msg["mensagem"] = "Sucesso ao modificar registro";
			$pdo->commit();
		} catch (Exception $e) {
			$msg["codigo"] = 1;
			$msg["mensagem"] = ($e->getCode() == 2) ? $e->getMessage() : "Erro ao Executar Operação";
			$msg["debug"]["error"] = $e->getMessage();
			$msg["debug"]["file"] = $e->getFile();
			$msg["debug"]["line"] = $e->getLine();
			$pdo->rollBack();
		}
		echo json_encode($msg);
		$template = "ajax.produtos.php";
		break;

	case "listar_produtos":
		$template = "tpl.geral.produtos.simples.php";
		break;

	case "listar_produtos_autocomplete":
		$objprodutos = new Produtos();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objprodutos->BuscarAutoComplete($busca));
		$template = "ajax.produtos.php";
		break;

	case "deletar_produtos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutos = new Produtos($pdo);
			$objProdutos->Remover($_REQUEST['registros']);
			$msg["codigo"] = 0;
			$msg["mensagem"] = "Sucesso ao executar operação";
			$pdo->commit();
		} catch (Exception $e) {
			$msg["codigo"] = 1;
			$msg["mensagem"] = ($e->getCode() == 2) ? $e->getMessage() : "Erro ao Executar Operação";
			$msg["debug"]["error"] = $e->getMessage();
			$msg["debug"]["file"] = $e->getFile();
			$msg["debug"]["line"] = $e->getLine();
			$pdo->rollBack();
		}
		echo json_encode($msg);
		$template = "ajax.produtos.php";
		break;

	case "ajax_listar_produtos":
		$template = "tpl.lis.produtos.php";
		break;

	case "produtos_pdf":
		$template = "tpl.lis.produtos.pdf.php";
		break;

	case "produtos_xlsx":
		$template = "tpl.lis.produtos.xlsx.php";
		break;

	case "produtos_print":
		$template = "tpl.lis.produtos.print.php";
		break;

}
