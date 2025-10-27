<?php
include("modulos/escala_mensal/template/js.copia.escala_mensal.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Cópiar Escala";
echo $objApp->GerarBreadCrumb($configTitulo);
?>
<div id="kt_app_content_container" class="app-container  p-0">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title"> Escalas encontradas</h3>
            <div class="card-toolbar">
                <a href='javascript:;'  class="btn btn-sm btn-light " onclick="history.back()"> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</a>
            </div>
        </div>
        <div class="card-body" id="filtro">
            <form action="#" name="frm_escala_mensal" id="frm_escala_mensal" method="post">
                <?php
                $parametros['data_copia'] = Conexao::PrepararDataBD($_REQUEST['data_copia'] );
                $parametros['data_para'] = Conexao::PrepararDataBD($_REQUEST['data_para'] );
                $objEscalaMensal = new EscalaMensal();
                $listar = $objEscalaMensal->ListarCopia($_SESSION['usuario']['id_grupo'],$parametros);

                if(is_array($listar) && count($listar) > 0)
                {
                    echo '<table class="table tablegrid  table-hover table-bordered table-striped  border " id="copia_escala">
				<thead class=" table-dark ">
					<tr class="fw-semibold fs-6">
						<th valign="middle"  class=" ">LOCAL</th>
						<th valign="middle"  >NOME</th>
						<th valign="middle"  >FUNÇÃO</th>
						<th valign="middle"  >ENTRADA</th>
						<th valign="middle"  >SAÍDA</th>
						<th valign="middle"  >REMOVER</th>
					</tr>
				</thead>
				<tbody data-repeater-list="dias">
					
						';
                    $x = 0;
                    foreach ($listar as $linhas) {
                        $rowspan = count($linhas);
                        echo '
                    <tr data-repeater-item>
                    ';
                        foreach ($linhas as $linha) {

                            list($data,$hora) = explode (" ",$linha['data_hora_entrada']);
                            list($data2,$hora2) = explode (" ",$linha['data_hora_saida']);
                            $data_alterada_entrada = $_REQUEST['data_para']." ".$hora;
                            $data_alterada_saida = ($data2 == $data) ? $_REQUEST['data_para']." ".$hora2 : '';
                            echo '

                        <td valign="middle" align="center"><strong>'.$linha['nome_local'].'</strong></td>
						<td valign="middle">'.$linha['nome_usuario'].'</td>
						<td valign="middle">'.$linha['nome_funcao'].'</td>
						<td valign="middle">
						    <input type="text" name="dias['.$x.'][data_hora_entrada]"  id="data_hora_entrada_'.$linha['id'].'" data-kt-repeater="data_hora_entrada"  class="form-control  mask-datetime validar-obrigatorio setdate" value="'.Conexao::PrepararDataPHP($data_alterada_entrada,$_SESSION['usuario']['timezone']).'"/>
                        </td>
						<td valign="middle">
						   <input type="text" name="dias['.$x.'][data_hora_saida]"  id="data_hora_saida_'.$linha['id'].'" data-kt-repeater="data_hora_saida"  class="form-control  mask-datetime validar-obrigatorio setdate" value="'.Conexao::PrepararDataPHP($data_alterada_saida,$_SESSION['usuario']['timezone']).'"/>
                        </td>
						<td valign="middle" >
						 <input type="hidden" name="dias['.$x.'][id_usuario]"   id="id_usuario_'.$linha['id'].'"   value="'.$linha['id_usuario'].'"/>
						 <input type="hidden" name="dias['.$x.'][id_equipe]"   id="id_equipe_'.$linha['id'].'"   value="'.$linha['id_equipe'].'"/>
                        <input type="hidden" name="dias['.$x.'][id_local]"   id="id_local_'.$linha['id'].'"   value="'.$linha['id_local'].'"/>
                        <input type="hidden" name="dias['.$x.'][id_funcao]"   id="id_funcao_'.$linha['id'].'"   value="'.$linha['id_funcao'].'"/>
						        <a href="javascript:;" onclick=" $(this).parent().parent().remove();" data-repeater-delete class="btn btn-light-danger ">
                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                Remover
                            </a>
                        </td>
                        </tr>
				';
                            $x++;
                        }
                        echo '    
                        <tr class="bg-dark">
                            <td valign="middle" colspan="8"></td>
                        </tr>
				';
                    }
                    echo '</tbody>
				<tfoot>
				</tfoot>
			</table>';
                }
                ?>
            </form>
        </div>
        <div class="card-footer d-flex flex-row-reverse">
            <button type="button" class="btn btn-success ms-3" id="bt_salvar"  onclick="ExecutarAcaoCopiaEscala()"> <i class="fas fa-check"></i> Salvar</button>
            <button type="button" class="btn btn-light " id="bt_voltar" onclick="history.back()"> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</button>
        </div>
    </div>
</div>

