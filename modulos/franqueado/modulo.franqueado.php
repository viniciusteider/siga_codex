<?php
switch($app_comando)
{
	case "frm_adicionar_franqueado":
		$template = "tpl.frm.franqueado.php";
		break;

	case "adicionar_franqueado":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {

            $objEndereco = new Endereco($pdo);
            $objEndereco->setLogradouro($_REQUEST['logradouro']);
            $objEndereco->setNumero($_REQUEST['numero']);
            $objEndereco->setComplemento($_REQUEST['complemento']);
            $objEndereco->setBairro($_REQUEST['bairro']);
            $objEndereco->setCidade($_REQUEST['cidade']);
            $objEndereco->setIdCidade($_REQUEST['id_cidade']);
            $objEndereco->setEstado($_REQUEST['estado']);
            $objEndereco->setCep($_REQUEST['cep']);
            $objEndereco->setReferencia($_REQUEST['referencia']);
            $objEndereco->setObservacao($_REQUEST['observacao']);
            $objEndereco->setTelefone($_REQUEST['telefone']);
            $objEndereco->setComercial($_REQUEST['comercial']);
            $objEndereco->setCelular($_REQUEST['celular']);
            $objEndereco->setEmail($_REQUEST['email']);
            $objEndereco->setEmailMkt($_REQUEST['email_mkt']);
            $objEndereco->setEmailMkt2($_REQUEST['email_mkt2']);
            $objEndereco->setLatitude($_REQUEST['latitude']);
            $objEndereco->setLongitude($_REQUEST['longitude']);
            $idEndereco = $objEndereco->Adicionar();

            $objGrupo = new Grupo($pdo);
            $objGrupo->setId(3);
            $dados_grupo = $objGrupo->Editar();
            $objGrupo->setId_grupo_pai(3);
            $objGrupo->setNome($_REQUEST['nome']);
            $objGrupo->setId_modelo(1);
            $objGrupo->setArvore($dados_grupo['arvore'].$_REQUEST['id_grupo'].";");
            $grupo_retorno = $objGrupo->AdicionarGrupoFranqueado();

            //Busca as ações  padrão do grupo matriz
            $objAcoes = new Franqueado;
            $acoes_padrao = $objAcoes->BuscaAcoesPadrao();

            //Adiciona as ações padrao da matriz
            foreach ($acoes_padrao as $acoes){
                $objAdicionaAcoes = new Franqueado();
                $objAdicionaAcoes->AdicionarGrupoAcaoPadrao($grupo_retorno,$acoes['id_acao'],0);
            }

            $objFranqueado = new Franqueado($pdo);
			$objFranqueado->setIdEndereco($idEndereco);
			$objFranqueado->setIdGrupo($grupo_retorno);
			$objFranqueado->setNome($_REQUEST['nome']);
			$objFranqueado->setCodigo($_REQUEST['codigo']);
			$objFranqueado->setCnpj($_REQUEST['cnpj']);
			$objFranqueado->setInscricaoEstadual($_REQUEST['inscricao_estadual']);
			$objFranqueado->setResponsavel($_REQUEST['responsavel']);
			$objFranqueado->setCpfResponsavel($_REQUEST['cpf_responsavel']);
			$objFranqueado->setStatus($_REQUEST['status']);
			$objFranqueado->setAcessoBloqueado($_REQUEST['acesso_bloqueado']);
			$novoIdFranqueado = $objFranqueado->Adicionar();

			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_ADICIONAR;
			$pdo->commit();
		} catch (Exception $e) {
			$msg["codigo"] = 1;
			$msg["mensagem"] = TXT_ALERT_ERRO_OPERACAO . " ". $e->getMessage();
			$msg["debug"]['error'] = $e->getMessage();
			$msg["debug"]['file'] = $e->getFile();
			$msg["debug"]['line'] = $e->getLine();
			$pdo->rollBack();
		}
		echo json_encode($msg);
		$template = "ajax.franqueado.php";
		break;

	case "frm_atualizar_franqueado" :
		$franqueado = new Franqueado();
		$franqueado->setId($_REQUEST["app_codigo"]);
		$linha = $franqueado->Editar();
		$template = "tpl.frm.franqueado.php";
		break;

	case "atualizar_franqueado":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {

            $objEndereco = new Endereco($pdo);
            $objEndereco->setId($_POST['id_endereco']);
            $objEndereco->setLogradouro($_REQUEST['logradouro']);
            $objEndereco->setNumero($_REQUEST['numero']);
            $objEndereco->setComplemento($_REQUEST['complemento']);
            $objEndereco->setBairro($_REQUEST['bairro']);
            $objEndereco->setCidade($_REQUEST['cidade']);
            $objEndereco->setIdCidade($_REQUEST['id_cidade']);
            $objEndereco->setEstado($_REQUEST['estado']);
            $objEndereco->setCep($_REQUEST['cep']);
            $objEndereco->setReferencia($_REQUEST['referencia']);
            $objEndereco->setObservacao($_REQUEST['observacao']);
            $objEndereco->setTelefone($_REQUEST['telefone']);
            $objEndereco->setComercial($_REQUEST['comercial']);
            $objEndereco->setCelular($_REQUEST['celular']);
            $objEndereco->setEmail($_REQUEST['email']);
            $objEndereco->setEmailMkt($_REQUEST['email_mkt']);
            $objEndereco->setEmailMkt2($_REQUEST['email_mkt2']);
            $objEndereco->setLatitude($_REQUEST['latitude']);
            $objEndereco->setLongitude($_REQUEST['longitude']);
            $idEndereco = $objEndereco->Modificar();

			$objFranqueado = new Franqueado($pdo);
			$objFranqueado->setId($_REQUEST['id']);
			$objFranqueado->setNome($_REQUEST['nome']);
			$objFranqueado->setCodigo($_REQUEST['codigo']);
			$objFranqueado->setCnpj($_REQUEST['cnpj']);
			$objFranqueado->setInscricaoEstadual($_REQUEST['inscricao_estadual']);
			$objFranqueado->setResponsavel($_REQUEST['responsavel']);
			$objFranqueado->setCpfResponsavel($_REQUEST['cpf_responsavel']);
			$objFranqueado->Modificar();
			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_MODIFICAR;
			$pdo->commit();
		} catch (Exception $e) {
			$msg["codigo"] = 1;
			$msg["mensagem"] = TXT_ALERT_ERRO_OPERACAO. " ". $e->getMessage();
			$msg["debug"] = $e->getMessage();
			$pdo->rollBack();
		}
		echo json_encode($msg);
		$template = "ajax.franqueado.php";
		break;

	case "listar_franqueado":
		$template = "tpl.geral.franqueado.php";
		break;

	case "deletar_franqueado":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objFranqueado = new Franqueado($pdo);
			$objFranqueado->Remover($_REQUEST['registros']);
			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_OPERACAO;
			$pdo->commit();
		} catch (Exception $e) {
			$msg["codigo"] = 1;
			$msg["mensagem"] = TXT_ALERT_ERRO_OPERACAO. " ". $e->getMessage();
			$msg["debug"] = $e->getMessage();
			$pdo->rollBack();
		}
		echo json_encode($msg);
		$template = "ajax.franqueado.php";
		break;

	case "ajax_listar_franqueado":
		$template = "tpl.lis.franqueado.php";
		break;

	case "franqueado_pdf":
		$template = "tpl.lis.franqueado.pdf.php";
		break;

	case "franqueado_xlsx":
		$template = "tpl.lis.franqueado.xlsx.php";
		break;

	case "franqueado_print":
		$template = "tpl.lis.franqueado.print.php";
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
			$_SESSION["configuracao_usuario"]["franqueado"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("franqueado");
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
		$template = "ajax.franqueado.php";
		break;
}
