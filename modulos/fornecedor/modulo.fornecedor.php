<?php

switch($app_comando)
{
	case "frm_adicionar_fornecedor":
		$template = "tpl.frm.fornecedor.php";
		break;

	case "frm_modal_fornecedor":
if($_REQUEST["app_codigo"] != "") {
		$fornecedor = new Fornecedor();
		$fornecedor->setId($_REQUEST["app_codigo"]);
		$linha = $fornecedor->Editar();
}		$template = "tpl.form.fornecedor.php";
		break;

	case "adicionar_fornecedor":
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

			$objFornecedor = new Fornecedor($pdo);
			$objFornecedor->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
			$objFornecedor->setNome($_REQUEST['nome']);
			$objFornecedor->setLatitude($_REQUEST['latitude']);
			$objFornecedor->setLongitude($_REQUEST['longitude']);
			$objFornecedor->setIdEndereco($idEndereco);
			$objFornecedor->setCpf($_REQUEST['cpf']);
			$objFornecedor->setCnpj($_REQUEST['cnpj']);
			$objFornecedor->setQualificacao($_REQUEST['qualificacao']);
			$objFornecedor->setRamoAtividde($_REQUEST['ramo_atividde']);
			$novoId = $objFornecedor->Adicionar();
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
		$template = "ajax.fornecedor.php";
		break;

	case "frm_atualizar_fornecedor" :
		$fornecedor = new Fornecedor();
		$fornecedor->setId($_REQUEST["app_codigo"]);
		$linha = $fornecedor->Editar();
		$template = "tpl.frm.fornecedor.php";
		break;

	case "atualizar_fornecedor":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {

            $objEndereco = new Endereco($pdo);
            $objEndereco->setId($_REQUEST['id_endereco']);
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
            $objEndereco->Modificar();

			$objFornecedor = new Fornecedor($pdo);
			$objFornecedor->setId($_REQUEST['id']);
			$objFornecedor->setNome($_REQUEST['nome']);
			$objFornecedor->setLatitude($_REQUEST['latitude']);
			$objFornecedor->setLongitude($_REQUEST['longitude']);
			$objFornecedor->setCpf($_REQUEST['cpf']);
			$objFornecedor->setCnpj($_REQUEST['cnpj']);
			$objFornecedor->setQualificacao($_REQUEST['qualificacao']);
			$objFornecedor->setRamoAtividde($_REQUEST['ramo_atividde']);
			$objFornecedor->Modificar();
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
		$template = "ajax.fornecedor.php";
		break;

	case "listar_fornecedor":
		$template = "tpl.geral.fornecedor.php";
		break;

	case "listar_fornecedor_autocomplete":
		$objfornecedor = new Fornecedor();
        $objfornecedor->setIdGrupo($_SESSION['usuario']['id_grupo']);
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objfornecedor->BuscarAutoComplete($busca));
		$template = "ajax.fornecedor.php";
		break;

	case "deletar_fornecedor":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objFornecedor = new Fornecedor($pdo);
			$objFornecedor->Remover($_REQUEST['registros']);
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
		$template = "ajax.fornecedor.php";
		break;

	case "ajax_listar_fornecedor":
		$template = "tpl.lis.fornecedor.php";
		break;

	case "fornecedor_pdf":
		$template = "tpl.lis.fornecedor.pdf.php";
		break;

	case "fornecedor_xlsx":
		$template = "tpl.lis.fornecedor.xlsx.php";
		break;

	case "fornecedor_print":
		$template = "tpl.lis.fornecedor.print.php";
		break;

}
