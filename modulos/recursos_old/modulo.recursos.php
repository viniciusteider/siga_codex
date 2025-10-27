<?php

switch($app_comando)
{
	case "frm_adicionar_recursos":
		$template = "tpl.frm.recursos.php";
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
                    @unlink($linha['foto_frente']);
                    list($nome, $extensao) = explode(".", $_FILES['foto_frente']['name']);
                    Utils::ChecarExtensoesImagem($extensao);
                    $temp   = $_FILES['foto_frente']['tmp_name'];
                    $novo   = md5($_SESSION['usuario']['id'] . (mktime())) . "_frente.$extensao";
                    $imagem = $upload->Preparar($temp, $novo);
                    $objRecursos->setFotoFrente($imagem);
                }
                if($_FILES['foto_traseira']['name'] != "")
                {
                    @unlink($linha['foto_traseira']);
                    list($nome, $extensao) = explode(".", $_FILES['foto_traseira']['name']);
                    Utils::ChecarExtensoesImagem($extensao);
                    $temp   = $_FILES['foto_traseira']['tmp_name'];
                    $novo   = md5($_SESSION['usuario']['id'] . (mktime())) . "_traseira.$extensao";
                    $imagem = $upload->Preparar($temp, $novo);
                    $objRecursos->setFotoTraseira($imagem);
                }

                if($_FILES['foto_direita']['name'] != "")
                {
                    @unlink($linha['foto_direita']);
                    list($nome, $extensao) = explode(".", $_FILES['foto_direita']['name']);
                    Utils::ChecarExtensoesImagem($extensao);
                    $temp   = $_FILES['foto_direita']['tmp_name'];
                    $novo   = md5($_SESSION['usuario']['id'] . (mktime())) . "_direita.$extensao";
                    $imagem = $upload->Preparar($temp, $novo);
                    $objRecursos->setFotoDireita($imagem);
                }
                if($_FILES['foto_esquerda']['name'] != "")
                {
                    @unlink($linha['foto_esquerda']);
                    list($nome, $extensao) = explode(".", $_FILES['foto_esquerda']['name']);
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
			$objRecursos->setIdModelo($_REQUEST['id_modelo']);
			$objRecursos->setAnoModelo($_REQUEST['ano_modelo']);
			$objRecursos->setAnoFabricacao($_REQUEST['ano_fabricacao']);
			$objRecursos->setRenavam($_REQUEST['renavam']);
			$objRecursos->setChassi($_REQUEST['chassi']);
			$objRecursos->setCor($_REQUEST['cor']);
			$objRecursos->setIdConsorcio($_REQUEST['id_consorcio']);
			$objRecursos->setIdBase($_REQUEST['id_base']);
			$objRecursos->setDataCarga(Conexao::PrepararDataBD($_REQUEST['data_carga'], $_SESSION['usuario']['timezone']));
			$objRecursos->setObservacao($_REQUEST['observacao']);
			$novoId = $objRecursos->Adicionar();
			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_ADICIONAR;
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
                    list($nome, $extensao) = explode(".", $_FILES['foto_frente']['name']);
                    Utils::ChecarExtensoesImagem($extensao);
                    $temp   = $_FILES['foto_frente']['tmp_name'];
                    $novo   = md5($_SESSION['usuario']['id'] . (mktime())) . "_frente.$extensao";
                    $imagem = $upload->Preparar($temp, $novo);
                    $objRecursos->setFotoFrente($imagem);
                }
                if($_FILES['foto_traseira']['name'] != "")
                {
                    @unlink($linha['foto_traseira']);
                    list($nome, $extensao) = explode(".", $_FILES['foto_traseira']['name']);
                    Utils::ChecarExtensoesImagem($extensao);
                    $temp   = $_FILES['foto_traseira']['tmp_name'];
                    $novo   = md5($_SESSION['usuario']['id'] . (mktime())) . "_traseira.$extensao";
                    $imagem = $upload->Preparar($temp, $novo);
                    $objRecursos->setFotoTraseira($imagem);
                }

                if($_FILES['foto_direita']['name'] != "")
                {
                    @unlink($linha['foto_direita']);
                    list($nome, $extensao) = explode(".", $_FILES['foto_direita']['name']);
                    Utils::ChecarExtensoesImagem($extensao);
                    $temp   = $_FILES['foto_direita']['tmp_name'];
                    $novo   = md5($_SESSION['usuario']['id'] . (mktime())) . "_direita.$extensao";
                    $imagem = $upload->Preparar($temp, $novo);
                    $objRecursos->setFotoDireita($imagem);
                }
                if($_FILES['foto_esquerda']['name'] != "")
                {
                    @unlink($linha['foto_esquerda']);
                    list($nome, $extensao) = explode(".", $_FILES['foto_esquerda']['name']);
                    Utils::ChecarExtensoesImagem($extensao);
                    $temp   = $_FILES['foto_esquerda']['tmp_name'];
                    $novo   = md5($_SESSION['usuario']['id'] . (mktime())) . "_esquerda.$extensao";
                    $imagem = $upload->Preparar($temp, $novo);
                    $objRecursos->setFotoEsquerda($imagem);
                }
            }


			$objRecursos->setPrefixo($_REQUEST['prefixo']);
			$objRecursos->setIdTipoRecurso($_REQUEST['id_tipo_recurso']);
			$objRecursos->setPlaca($_REQUEST['placa']);
			$objRecursos->setIdModelo($_REQUEST['id_modelo']);
			$objRecursos->setAnoModelo($_REQUEST['ano_modelo']);
			$objRecursos->setAnoFabricacao($_REQUEST['ano_fabricacao']);
			$objRecursos->setRenavam($_REQUEST['renavam']);
			$objRecursos->setChassi($_REQUEST['chassi']);
			$objRecursos->setCor($_REQUEST['cor']);
			$objRecursos->setIdConsorcio($_REQUEST['id_consorcio']);
			$objRecursos->setIdBase($_REQUEST['id_base']);
			$objRecursos->setDataCarga(Conexao::PrepararDataBD($_REQUEST['data_carga'], $_SESSION['usuario']['timezone']));
			$objRecursos->setObservacao($_REQUEST['observacao']);
			$objRecursos->Modificar();


			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_MODIFICAR;
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

	case "deletar_recursos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objRecursos = new Recursos($pdo);
			$objRecursos->Remover($_REQUEST['registros']);
			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_OPERACAO;
			$pdo->commit();
		} catch (Exception $e) {
			$msg["codigo"] = 1;
			$msg["mensagem"] = TXT_ALERT_ERRO_OPERACAO. " ". $e->getMessage();
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
				$msg["mensagem"] = TXT_ALERT_SUCESSO_OPERACAO;
			} else {
				$msg["codigo"]   = 1;
				$msg["mensagem"] = TXT_ALERT_ERRO_OPERACAO;
			}
		} else {
			$msg["codigo"]   = 1;
			$msg["mensagem"] = TXT_ALERT_SELECIONAR_COLUNAS;
		}
		echo json_encode($msg);
		$template = "ajax.recursos.php";
		break;
}
