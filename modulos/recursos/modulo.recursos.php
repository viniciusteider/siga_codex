<?php

switch($app_comando)
{
	case "frm_adicionar_recursos":
		$template = "tpl.frm.recursos.php";
		break;

	case "frm_modal_recursos":
if($_REQUEST["app_codigo"] != "") {
		$recursos = new Recursos();
		$recursos->setId($_REQUEST["app_codigo"]);
		$linha = $recursos->Editar();
}		$template = "tpl.form.recursos.php";
		break;

	case "adicionar_recursos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
            $objRecursos = new Recursos($pdo);
            if (count($_FILES) > 0) {
                $diretorio = "upload/fotos_recursos/";
                $upload = new Upload($diretorio);
                if($_FILES['foto_frente']['name'] != "")
                {
//                    list($nome, $extensao) = explode(".", $_FILES['foto_frente']['name']);
                    $tramento_nome = Upload::TratarNomeArquivo($_FILES['foto_frente']['name']);
                    $extensao = $tramento_nome[1];
                    Utils::ChecarExtensoesImagem($extensao);
                    $temp   = $_FILES['foto_frente']['tmp_name'];
                    $novo   = md5($_SESSION['usuario']['id'] . (mktime())) . "_frente.$extensao";
                    $imagem = $upload->Preparar($temp, $novo);
                    $objRecursos->setFotoFrente($imagem);
                }
                if($_FILES['foto_traseira']['name'] != "")
                {
//                    list($nome, $extensao) = explode(".", $_FILES['foto_traseira']['name']);
                    $tramento_nome = Upload::TratarNomeArquivo($_FILES['foto_traseira']['name']);
                    $extensao = $tramento_nome[1];
                    Utils::ChecarExtensoesImagem($extensao);
                    $temp   = $_FILES['foto_traseira']['tmp_name'];
                    $novo   = md5($_SESSION['usuario']['id'] . (mktime())) . "_traseira.$extensao";
                    $imagem = $upload->Preparar($temp, $novo);
                    $objRecursos->setFotoTraseira($imagem);
                }

                if($_FILES['foto_direita']['name'] != "")
                {
//                    list($nome, $extensao) = explode(".", $_FILES['foto_direita']['name']);
                    $tramento_nome = Upload::TratarNomeArquivo($_FILES['foto_direita']['name']);
                    $extensao = $tramento_nome[1];
                    Utils::ChecarExtensoesImagem($extensao);
                    $temp   = $_FILES['foto_direita']['tmp_name'];
                    $novo   = md5($_SESSION['usuario']['id'] . (mktime())) . "_direita.$extensao";
                    $imagem = $upload->Preparar($temp, $novo);
                    $objRecursos->setFotoDireita($imagem);
                }
                if($_FILES['foto_esquerda']['name'] != "")
                {
//                    list($nome, $extensao) = explode(".", $_FILES['foto_esquerda']['name']);
                    $tramento_nome = Upload::TratarNomeArquivo($_FILES['foto_esquerda']['name']);
                    $extensao = $tramento_nome[1];
                    Utils::ChecarExtensoesImagem($extensao);
                    $temp   = $_FILES['foto_esquerda']['tmp_name'];
                    $novo   = md5($_SESSION['usuario']['id'] . (mktime())) . "_esquerda.$extensao";
                    $imagem = $upload->Preparar($temp, $novo);
                    $objRecursos->setFotoEsquerda($imagem);
                }
            }

            $objRecursos->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
			$objRecursos->setPrefixo($_REQUEST['prefixo']);
			$objRecursos->setIdTipoRecurso($_REQUEST['id_tipo_recurso']);
			$objRecursos->setPlaca($_REQUEST['placa']);
			$objRecursos->setUfplaca($_REQUEST['ufplaca']);
			$objRecursos->setIdModelo($_REQUEST['id_modelo']);
			$objRecursos->setAnoModelo($_REQUEST['ano_modelo']);
			$objRecursos->setAnoFabricacao($_REQUEST['ano_fabricacao']);
			$objRecursos->setRenavam($_REQUEST['renavam']);
			$objRecursos->setChassi($_REQUEST['chassi']);
			$objRecursos->setIdConsorcio($_REQUEST['id_consorcio']);
			$objRecursos->setIdBase($_REQUEST['id_base']);
			$objRecursos->setFotoFrente($_REQUEST['foto_frente']);
			$objRecursos->setFotoTraseira($_REQUEST['foto_traseira']);
			$objRecursos->setFotoDireita($_REQUEST['foto_direita']);
			$objRecursos->setFotoEsquerda($_REQUEST['foto_esquerda']);
			$objRecursos->setDataCarga(Conexao::PrepararDataBD($_REQUEST['data_carga'], $_SESSION['usuario']['timezone']));
			$objRecursos->setObservacao($_REQUEST['observacao']);
			$objRecursos->setIdTipoCombustivel($_REQUEST['id_tipo_combustivel']);
			$objRecursos->setIdCor($_REQUEST['id_cor']);
			$objRecursos->setValorAquisicao($_REQUEST['valor_aquisicao']);
			$objRecursos->setValorMercado($_REQUEST['valor_mercado']);
			$objRecursos->setKmAquisicao($_REQUEST['km_aquisicao']);
			$objRecursos->setKmAtual($_REQUEST['km_atual']);
			$objRecursos->setPotencia($_REQUEST['potencia']);
			$objRecursos->setCilindradas($_REQUEST['cilindradas']);
			$objRecursos->setPesoLiquido($_REQUEST['peso_liquido']);
			$objRecursos->setTanque($_REQUEST['tanque']);
			$objRecursos->setDisponibilidade($_REQUEST['disponibilidade']);
			$objRecursos->setProprietario($_REQUEST['proprietario']);
			$objRecursos->setDataBaixa(Conexao::PrepararDataBD($_REQUEST['data_baixa'], $_SESSION['usuario']['timezone']));
			$objRecursos->setDestinoBaixa($_REQUEST['destino_baixa']);
			$objRecursos->setDataFinalGarantia(Conexao::PrepararDataBD($_REQUEST['data_final_garantia'], $_SESSION['usuario']['timezone']));
			$objRecursos->setCapacidadeCarga($_REQUEST['capacidade_carga']);
			$objRecursos->setLatitude($_REQUEST['latitude']);
			$objRecursos->setLongitude($_REQUEST['longitude']);
			$objRecursos->setIdUnidadeRastreamento($_REQUEST['id_unidade_rastreamento']);
			$novoId = $objRecursos->Adicionar();

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
		$template = "ajax.recursos.php";
		break;

	case "frm_atualizar_recursos" :
		$recursos = new Recursos();
		$recursos->setId($_REQUEST["app_codigo"]);
		$linha = $recursos->Editar();
		$template = "tpl.frm.recursos.php";
		break;

	case "atualizar_recursos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
            $objRecursos = new Recursos($pdo);
            $objRecursos->setId($_REQUEST['id']);
            $linha = $objRecursos->editar();
            if (count($_FILES) > 0) {
                $diretorio = "upload/fotos_recursos/";
                $upload = new Upload($diretorio);
                if($_FILES['foto_frente']['name'] != "")
                {
                    @unlink($linha['foto_frente']);
                    $tramento_nome = Upload::TratarNomeArquivo($_FILES['foto_frente']['name']);
                    $extensao = $tramento_nome[1];
                    Utils::ChecarExtensoesImagem($extensao);
                    $temp   = $_FILES['foto_frente']['tmp_name'];
                    $novo   = md5($_SESSION['usuario']['id'] . (mktime())) . "_frente.$extensao";
                    $imagem = $upload->Preparar($temp, $novo);
                    $objRecursos->setFotoFrente($imagem);
                }
                if($_FILES['foto_traseira']['name'] != "")
                {
                    @unlink($linha['foto_traseira']);
                    $tramento_nome = Upload::TratarNomeArquivo($_FILES['foto_traseira']['name']);
                    $extensao = $tramento_nome[1];
                    Utils::ChecarExtensoesImagem($extensao);
                    $temp   = $_FILES['foto_traseira']['tmp_name'];
                    $novo   = md5($_SESSION['usuario']['id'] . (mktime())) . "_traseira.$extensao";
                    $imagem = $upload->Preparar($temp, $novo);
                    $objRecursos->setFotoTraseira($imagem);
                }

                if($_FILES['foto_direita']['name'] != "")
                {
                    @unlink($linha['foto_direita']);
//                    list($nome, $extensao) = explode(".", $_FILES['foto_direita']['name']);
                    $tramento_nome = Upload::TratarNomeArquivo($_FILES['foto_direita']['name']);
                    $extensao = $tramento_nome[1];
                    Utils::ChecarExtensoesImagem($extensao);
                    $temp   = $_FILES['foto_direita']['tmp_name'];
                    $novo   = md5($_SESSION['usuario']['id'] . (mktime())) . "_direita.$extensao";
                    $imagem = $upload->Preparar($temp, $novo);
                    $objRecursos->setFotoDireita($imagem);
                }
                if($_FILES['foto_esquerda']['name'] != "")
                {
                    @unlink($linha['foto_esquerda']);
//                    list($nome, $extensao) = explode(".", $_FILES['foto_esquerda']['name']);
                    $tramento_nome = Upload::TratarNomeArquivo($_FILES['foto_esquerda']['name']);
                    $extensao = $tramento_nome[1];
                    Utils::ChecarExtensoesImagem($extensao);
                    $temp   = $_FILES['foto_esquerda']['tmp_name'];
                    $novo   = md5($_SESSION['usuario']['id'] . (mktime())) . "_esquerda.$extensao";
                    $imagem = $upload->Preparar($temp, $novo);
                    $objRecursos->setFotoEsquerda($imagem);
                }
            }

            $objRecursos->setId($_REQUEST['id']);
			$objRecursos->setPrefixo($_REQUEST['prefixo']);
			$objRecursos->setIdTipoRecurso($_REQUEST['id_tipo_recurso']);
			$objRecursos->setPlaca($_REQUEST['placa']);
			$objRecursos->setUfplaca($_REQUEST['ufplaca']);
			$objRecursos->setIdModelo($_REQUEST['id_modelo']);
			$objRecursos->setAnoModelo($_REQUEST['ano_modelo']);
			$objRecursos->setAnoFabricacao($_REQUEST['ano_fabricacao']);
			$objRecursos->setRenavam($_REQUEST['renavam']);
			$objRecursos->setChassi($_REQUEST['chassi']);
			$objRecursos->setIdConsorcio($_REQUEST['id_consorcio']);
			$objRecursos->setIdBase($_REQUEST['id_base']);
			$objRecursos->setDataCarga(Conexao::PrepararDataBD($_REQUEST['data_carga'], $_SESSION['usuario']['timezone']));
			$objRecursos->setObservacao($_REQUEST['observacao']);
			$objRecursos->setIdTipoCombustivel($_REQUEST['id_tipo_combustivel']);
			$objRecursos->setIdCor($_REQUEST['id_cor']);
			$objRecursos->setValorAquisicao($_REQUEST['valor_aquisicao']);
			$objRecursos->setValorMercado($_REQUEST['valor_mercado']);
			$objRecursos->setKmAquisicao($_REQUEST['km_aquisicao']);
			$objRecursos->setKmAtual($_REQUEST['km_atual']);
			$objRecursos->setPotencia($_REQUEST['potencia']);
			$objRecursos->setCilindradas($_REQUEST['cilindradas']);
			$objRecursos->setPesoLiquido($_REQUEST['peso_liquido']);
			$objRecursos->setTanque($_REQUEST['tanque']);
			$objRecursos->setDisponibilidade($_REQUEST['disponibilidade']);
			$objRecursos->setProprietario($_REQUEST['proprietario']);
			$objRecursos->setDataBaixa(Conexao::PrepararDataBD($_REQUEST['data_baixa'], $_SESSION['usuario']['timezone']));
			$objRecursos->setDestinoBaixa($_REQUEST['destino_baixa']);
			$objRecursos->setDataFinalGarantia(Conexao::PrepararDataBD($_REQUEST['data_final_garantia'], $_SESSION['usuario']['timezone']));
			$objRecursos->setCapacidadeCarga($_REQUEST['capacidade_carga']);
			$objRecursos->setLatitude($_REQUEST['latitude']);
			$objRecursos->setLongitude($_REQUEST['longitude']);
			$objRecursos->Modificar();
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
		$template = "ajax.recursos.php";
		break;

	case "listar_recursos":
		$template = "tpl.geral.recursos.php";
		break;

	case "listar_recursos_autocomplete":
		$objrecursos = new Recursos();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objrecursos->BuscarAutoComplete($busca));
		$template = "ajax.recursos.php";
		break;

	case "deletar_recursos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objRecursos = new Recursos($pdo);
			$objRecursos->Remover($_REQUEST['registros']);

            $objEscalaLocais = new EscalaLocais($pdo);
            $objEscalaLocais->RemoverRecurso($_REQUEST['registros']);

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
		$template = "ajax.recursos.php";
		break;

	case "ajax_listar_recursos":
		$template = "tpl.lis.recursos.php";
		break;

	case "recursos_pdf":
		$template = "tpl.lis.recursos.pdf.php";
		break;

	case "recursos_xlsx":
		$template = "tpl.lis.recursos.xlsx.php";
		break;

	case "recursos_print":
		$template = "tpl.lis.recursos.print.php";
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
			$_SESSION["configuracao_usuario"]["recursos"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("recursos");
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
		$template = "ajax.recursos.php";
		break;
}
