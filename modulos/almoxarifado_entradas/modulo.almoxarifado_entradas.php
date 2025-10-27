<?php

switch($app_comando)
{
	case "frm_adicionar_almoxarifado_entradas":
		$template = "tpl.frm.almoxarifado_entradas.php";
		break;

	case "frm_modal_almoxarifado_entradas":
if($_REQUEST["app_codigo"] != "") {
		$almoxarifado_entradas = new AlmoxarifadoEntradas();
		$almoxarifado_entradas->setId($_REQUEST["app_codigo"]);
		$linha = $almoxarifado_entradas->Editar();
}		$template = "tpl.form.almoxarifado_entradas.php";
		break;

	case "adicionar_almoxarifado_entradas":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objAlmoxarifadoEntradas = new AlmoxarifadoEntradas($pdo);
			$objAlmoxarifadoEntradas->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
			$objAlmoxarifadoEntradas->setIdAlmoxarifado($_REQUEST['id_almoxarifado']);
			$objAlmoxarifadoEntradas->setIdSetor($_REQUEST['id_setor']);
			$objAlmoxarifadoEntradas->setNumeroNotaFiscal($_REQUEST['numero_nota_fiscal']);
			$objAlmoxarifadoEntradas->setDataEmissaoNotaFiscal(Conexao::PrepararDataBD($_REQUEST['data_emissao_nota_fiscal'], $_SESSION['usuario']['timezone']));
			$objAlmoxarifadoEntradas->setNumeroDocumento($_REQUEST['numero_documento']);
			$objAlmoxarifadoEntradas->setNumeroEmpenho($_REQUEST['numero_empenho']);
			$objAlmoxarifadoEntradas->setNumeroRequisicao($_REQUEST['numero_requisicao']);
			$objAlmoxarifadoEntradas->setDataSolicitacao(Conexao::PrepararDataBD($_REQUEST['data_solicitacao'], $_SESSION['usuario']['timezone']));
			$objAlmoxarifadoEntradas->setDataRecebimento(Conexao::PrepararDataBD($_REQUEST['data_recebimento'], $_SESSION['usuario']['timezone']));
			$objAlmoxarifadoEntradas->setValorNota($_REQUEST['valor_nota']);
			$objAlmoxarifadoEntradas->setDescricao($_REQUEST['descricao']);
			$novoId = $objAlmoxarifadoEntradas->Adicionar();

			if(count($_REQUEST['produtos'] ?? []) > 0)
            {
                foreach ($_REQUEST['produtos'] as $row)
                {
                    $objAlmoxarifadoEntradasItens = new AlmoxarifadoEntradasItens($pdo);
                    $objAlmoxarifadoEntradasItens->setIdEntrada($novoId);
                    $objAlmoxarifadoEntradasItens->setIdProduto($row['id_produto']);
                    $objAlmoxarifadoEntradasItens->setQuantidade($row['quantidade']);
                    $objAlmoxarifadoEntradasItens->setValor($row['valor']);
                    $objAlmoxarifadoEntradasItens->Adicionar();

                    $objProdutos = new Produtos($pdo);
                    $objProdutos->setId($row['id_produto']);
                    $objProdutos->setEstoqueAtual($row['quantidade']);
                    $objProdutos->setCusto($row['valor']);
                    $objProdutos->AtualizarEstoque();

                }
            }


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
		$template = "ajax.almoxarifado_entradas.php";
		break;

	case "frm_atualizar_almoxarifado_entradas" :
		$almoxarifado_entradas = new AlmoxarifadoEntradas();
		$almoxarifado_entradas->setId($_REQUEST["app_codigo"]);
		$linha = $almoxarifado_entradas->Editar();
		$template = "tpl.frm.almoxarifado_entradas.php";
		break;

	case "atualizar_almoxarifado_entradas":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objAlmoxarifadoEntradas = new AlmoxarifadoEntradas($pdo);
			$objAlmoxarifadoEntradas->setId($_REQUEST['id']);
			$objAlmoxarifadoEntradas->setIdAlmoxarifado($_REQUEST['id_almoxarifado']);
			$objAlmoxarifadoEntradas->setIdSetor($_REQUEST['id_setor']);
			$objAlmoxarifadoEntradas->setNumeroNotaFiscal($_REQUEST['numero_nota_fiscal']);
			$objAlmoxarifadoEntradas->setDataEmissaoNotaFiscal(Conexao::PrepararDataBD($_REQUEST['data_emissao_nota_fiscal'], $_SESSION['usuario']['timezone']));
			$objAlmoxarifadoEntradas->setNumeroDocumento($_REQUEST['numero_documento']);
			$objAlmoxarifadoEntradas->setNumeroEmpenho($_REQUEST['numero_empenho']);
			$objAlmoxarifadoEntradas->setNumeroRequisicao($_REQUEST['numero_requisicao']);
			$objAlmoxarifadoEntradas->setDataSolicitacao(Conexao::PrepararDataBD($_REQUEST['data_solicitacao'], $_SESSION['usuario']['timezone']));
			$objAlmoxarifadoEntradas->setDataRecebimento(Conexao::PrepararDataBD($_REQUEST['data_recebimento'], $_SESSION['usuario']['timezone']));
			$objAlmoxarifadoEntradas->setValorNota($_REQUEST['valor_nota']);
			$objAlmoxarifadoEntradas->setDescricao($_REQUEST['descricao']);
			$objAlmoxarifadoEntradas->Modificar();

            if(count($_REQUEST['produtos'] ?? []) > 0)
            {
                foreach ($_REQUEST['produtos'] as $row)
                    $not_in[] = $row['id_item_produto'];
                if(count(array_filter($not_in) ?? []) > 0)
                {
                    $objAlmoxarifadoEntradasItens = new AlmoxarifadoEntradasItens($pdo);
                    $objAlmoxarifadoEntradasItens->setIdEntrada($_REQUEST['id']);
                    $removidos = $objAlmoxarifadoEntradasItens->ListarRemovidos(array_filter($not_in));
                    if(count($removidos ?? []) > 0)
                    {
                        foreach ($removidos as $removido)
                        {
                            $objProdutos = new Produtos($pdo);
                            $objProdutos->setId($removido['id_produto']);
                            $objProdutos->setEstoqueAtual($removido['quantidade']);
                            $objProdutos->RemoverEstoque();
                        }
                    }
                    $objAlmoxarifadoEntradasItens->RemoverAll(array_filter($not_in));
                }


                foreach ($_REQUEST['produtos'] as $row)
                {
                    $objAlmoxarifadoEntradasItens->setId($row['id_item_produto']);
                    $item_anterior = $objAlmoxarifadoEntradasItens->Editar();
                    $objAlmoxarifadoEntradasItens->setIdProduto($row['id_produto']);
                    $objAlmoxarifadoEntradasItens->setQuantidade($row['quantidade']);
                    $objAlmoxarifadoEntradasItens->setValor($row['valor']);
                    if($row['id_item_produto'] != "")
                        $objAlmoxarifadoEntradasItens->Modificar();
                    else
                        $objAlmoxarifadoEntradasItens->Adicionar();

                    // AO ALTERAR O VALOR DE UM ITEM , ELE REMOVO O VALOR ANTIGO E ADICIONA O NOVO.
                    $objProdutos = new Produtos($pdo);
                    $objProdutos->setId($row['id_produto']);
                    $objProdutos->setEstoqueAtual($row['quantidade']);
                    $objProdutos->setCusto($row['valor']);
                    $objProdutos->AtualizarEstoque($item_anterior['quantidade']);

                }
            }

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
		$template = "ajax.almoxarifado_entradas.php";
		break;

	case "listar_almoxarifado_entradas":
		$template = "tpl.geral.almoxarifado_entradas.php";
		break;

	case "listar_almoxarifado_entradas_autocomplete":
		$objalmoxarifado_entradas = new AlmoxarifadoEntradas();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objalmoxarifado_entradas->BuscarAutoComplete($busca));
		$template = "ajax.almoxarifado_entradas.php";
		break;

	case "deletar_almoxarifado_entradas":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objAlmoxarifadoEntradas = new AlmoxarifadoEntradas($pdo);
            if(count($_REQUEST['registros'] ?? []) > 0)
            {
                foreach ($_REQUEST['registros'] as $reg)
                {
                    $objAlmoxarifadoEntradasItens = new AlmoxarifadoEntradasItens($pdo);
                    $objAlmoxarifadoEntradasItens->setIdEntrada($reg);
                    $removidos = $objAlmoxarifadoEntradasItens->ListarItensEntrada();
                    if(count($removidos ?? []) > 0)
                    {
                        foreach ($removidos as $removido)
                        {
                            $objProdutos = new Produtos($pdo);
                            $objProdutos->setId($removido['id_produto']);
                            $objProdutos->setEstoqueAtual($removido['quantidade']);
                            $objProdutos->RemoverEstoque();
                        }
                    }
                }
            }
			$objAlmoxarifadoEntradas->Remover($_REQUEST['registros']);
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
		$template = "ajax.almoxarifado_entradas.php";
		break;

	case "ajax_listar_almoxarifado_entradas":
		$template = "tpl.lis.almoxarifado_entradas.php";
		break;

	case "almoxarifado_entradas_pdf":
		$template = "tpl.lis.almoxarifado_entradas.pdf.php";
		break;

	case "almoxarifado_entradas_xlsx":
		$template = "tpl.lis.almoxarifado_entradas.xlsx.php";
		break;

	case "almoxarifado_entradas_print":
		$template = "tpl.lis.almoxarifado_entradas.print.php";
		break;

	case "frm_configurar_listagem":
		$template = "configuracao_listagem.php";
		break;

	case "configurar_listagem":
		$usuarioConfiguracao = new UsuarioConfiguracao();
		foreach ($_POST as $checkbox => $idCampo) {
			if ($checkbox == "limite_colunas") {
				continue;
			}
			if (is_array($idCampo)) {
				if ($idCampo["valor"] == "") {
					continue;
				} else {
					$colunasSelecionadas[$checkbox] = ["id_campo" => $idCampo["id"], "valor_campo" => $idCampo["valor"]];
				}
			} else {
				$colunasSelecionadas[$checkbox] = $idCampo;
			}
		}
		$countColunasSelecionadas = count($colunasSelecionadas);
		if ($countColunasSelecionadas > 0) {
			if (($countColunasSelecionadas > $_REQUEST["limite_colunas"]) && $_REQUEST["limite_colunas"] != "0" && $_REQUEST["limite_colunas"] != "") {
				$msg["codigo"]   = 1;
				$msg["mensagem"] = TXT_LIMITE_COLUNAS_EXCEDIDO_RESOLUCAO;
				echo json_encode($msg);
				die();
			}
			$_SESSION["configuracao_usuario"]["almoxarifado_entradas"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("almoxarifado_entradas");
			$usuarioConfiguracao->LimparConfiguracoes();
			foreach ($colunasSelecionadas AS $nomeCampo => $idCampo) {
				if (is_array($idCampo)) {
					$usuarioConfiguracao->setIdCampoModulo($idCampo["id_campo"]);
					$usuarioConfiguracao->setValorCampo($idCampo["valor_campo"]);
				} else {
					$usuarioConfiguracao->setIdCampoModulo($idCampo);
				}
				$resultado = $usuarioConfiguracao->AdicionarUsuarioConfiguracao();
				if (!$resultado) {
					break;
				}
			}
			if ($resultado) {
				$msg["codigo"]   = 0;
				$msg["mensagem"] = "Sucesso ao executar operação";
			} else {
				$msg["codigo"]   = 1;
				$msg["mensagem"] = "Erro ao executar operação";
			}
		} else {
			$msg["codigo"]   = 1;
			$msg["mensagem"] = TXT_ALERT_SELECIONAR_COLUNAS;
		}
		echo json_encode($msg);
		$template = "ajax.almoxarifado_entradas.php";
		break;
}
