<?php
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Permissões Padrões";
echo $objApp->GerarBreadCrumb($configTitulo);
?>
<div id="kt_app_content_container" class="app-container  p-0">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title"> Permissões Padrões para Corporações</h3>
            <div class="card-toolbar">
                <a href='#index_xml.php?app_modulo=permissao_padrao&app_comando=listar_permissao_padrao'  class="btn btn-sm btn-light "> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</a>
            </div>
        </div>
        <div class="card-body" id="formulario_permissao_padrao">
            <form action="#" name="frm__permissao_padrao" id="frm_permissao_padrao" method="post">
                <div class="form-body">
                    <div class="row p-t-20">

                        <div class="col-md-12">
                            <div class="form-group" id="div_acoes">
                                <label class="form-label" for="treeAcoes">Permissões</label>
                                <?
                                $permnissao_padrao = new PermissaoPadrao();
                                $teste = $permnissao_padrao->ListarFuncionalidades();
                                //                                        echo  'dqwesad';
                                //                                        Conexao::pr($teste);
                                $html = "<div id='treeAcoes' ><ul>";
                                if(count($teste) > 0)
                                {
                                    foreach ($teste AS $modulo => $acoes) {
                                        $html .= "<li class='jstree-open'>$modulo<ul>";
                                        foreach ($acoes AS $acao) {
                                            $selecionado = "";
                                            if ($acao['selecionado'] > 0) {
                                                $selecionado = 'data-checkstate="checked"';
                                            }
                                            $html .= '<li ' . $selecionado . ' id=' . $acao['id_acao'] . ' class="tree">' . $acao['nome_acao'] . '</li>';
                                        }
                                        $html .= "</ul></li>";
                                    }
                                }

                                $html .= '</ul></div>';
                                echo $html;
                                ?>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
            </form>


        </div>
        <div class="card-footer d-flex flex-row-reverse">
            <button type="button" class="btn btn-success ms-3" id="bt_salvar"> <i class="fas fa-check"></i> Salvar</button>
            <button type="button" class="btn btn-light " id="bt_voltar" onclick="history.back()"> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</button>
        </div>
    </div>
</div>

<?php
include_once("modulos/permissao_padrao/template/js.frm.permissao_padrao.php");
?>
