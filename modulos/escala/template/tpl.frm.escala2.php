<?php
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Escala";
echo $objApp->GerarBreadCrumb($configTitulo);

//Conexao::pr($linha);

?>
<style>
    #tb_escala > :not(caption) > * > * {
        padding: 0.25rem 0.25rem !important;
    }
    .form-select-sm {
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
        padding-left: 0.25rem;
        font-size: 0.95rem;
        border-radius: 0.425rem;
    }
</style>
<div id="kt_app_content_container" class="app-container  p-0">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title"> Formulário Escala</h3>
            <div class="card-toolbar">
                <a href='javascript:;'  class="btn btn-sm btn-light " onclick="history.back()"> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</a>
            </div>
        </div>
        <div class="card-body" id="formulario_escala">
            <form action="#" name="frm_escala" id="frm_escala" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                <div class="d-flex align-items-center mb-12">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/files/fil008.svg-->
                    <span class="svg-icon svg-icon-4qx svg-icon-success ms-n2 me-3">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM11.7 17.7L16 14C16.4 13.6 16.4 12.9 16 12.5C15.6 12.1 15.4 12.6 15 13L11 16L9 15C8.6 14.6 8.4 14.1 8 14.5C7.6 14.9 8.1 15.6 8.5 16L10.3 17.7C10.5 17.9 10.8 18 11 18C11.2 18 11.5 17.9 11.7 17.7Z" fill="currentColor"></path>
                        <path d="M10.4343 15.4343L9.25 14.25C8.83579 13.8358 8.16421 13.8358 7.75 14.25C7.33579 14.6642 7.33579 15.3358 7.75 15.75L10.2929 18.2929C10.6834 18.6834 11.3166 18.6834 11.7071 18.2929L16.25 13.75C16.6642 13.3358 16.6642 12.6642 16.25 12.25C15.8358 11.8358 15.1642 11.8358 14.75 12.25L11.5657 15.4343C11.2533 15.7467 10.7467 15.7467 10.4343 15.4343Z" fill="currentColor"></path>
                        <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"></path>
                    </svg>
                </span>
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    <!--begin::Content-->
                    <div class="d-flex flex-column">
                        <!--begin::Title-->
                        <h3 class="text-gray-800 fw-semibold">Escala Equipe : (<?=$linha['nome']?>)</h3>
                        <!--end::Title-->
                        <!--begin::Info-->
                        <div class="">
                            <!--begin::Label-->
                            <span class="fw-semibold text-gray-600  me-6">Coordenador:
                            <strong><?=$linha['nome_coordenador']?></strong></span>
                            <!--end::Label-->
                            <!--begin::Label-->
                            <span class="fw-semibold text-gray-600  me-6">Início:
			                <strong><?=Conexao::PrepararDataPHP($linha['data_inicio'])?></strong></span>
                            <!--end::Label-->
                            <!--begin::Label-->
                            <span class="fw-semibold text-muted">Fim :
							<span class="fw-bold text-gray-600 me-1"><strong><?=Conexao::PrepararDataPHP($linha['data_fim'])?></strong></span>
                        </span>
                            <!--end::Label-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Content-->
                </div>

                <div>
                    <h5>Legenda:</h5>

                    <?php
                    $objEscalaHorarios = new EscalaHorarios();
                    $rs = $objEscalaHorarios->ListarCombo('',$_SESSION['usuario']['id_grupo']);
                    if(is_array($rs) && count($rs) > 0)
                    {
                        foreach ($rs as $ro) {
                            $cortexto = ( Utils::LiminosidadeCor($ro['cor']) > 128 ) ? '#000' : '#fff';
                            echo '<span class="badge " style="color: '.$cortexto.' ;background-color: '.$ro['cor'].'">'.$ro['nome'].'</span> &nbsp;';
                        }
                    }
                    ?>
                </div>


                <!--        --><?php //include_once("modulos/escala/template/tpl.form.escala.php");?>
                <div class="table-responsive">
                    <table class="table dataTable  table-bordered" style="font-size: 10px" id="tb_escala">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <?php
                            $firstday = date('Y-m-d', strtotime($linha['data_inicio']));
                            $startDate = new \DateTime($firstday);
                            $endDate = new \DateTime(date('Y-m-d', strtotime($linha['data_fim'])));
                            $y =0;
                            for($date = $startDate; $date <= $endDate; $date->modify('+1 day')){

                                $semana= $date->format('w');
                                $cor = ($semana == 6 || $semana == 0) ? 'style="background-color: #FFCCBC"' : '' ;
                                $y++;
                                echo ' <th '.$cor.'>'.Utils::NomeDiaSemana($semana).'</th>';
                            }
                            ?>

                        </tr>
                        <tr>
                            <th>NOME</th>
                            <th>FUNÇÃO</th>
                            <th>LOCAL</th>
                            <?php
                            $firstday = date('Y-m-d', strtotime($linha['data_inicio']));
                            $startDate = new \DateTime($firstday);
                            $endDate = new \DateTime(date('Y-m-d', strtotime($linha['data_fim'])));
                            $y =0;
                            for($date = $startDate; $date <= $endDate; $date->modify('+1 day')){
                                $dia= $date->format('d');
                                $y++;
                                echo ' <th>'.$dia.'</th>';
                            }
                            ?>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $objEquipesEfetivo = new EquipesEfetivo();
                        $efetivos = $objEquipesEfetivo->ListarEscalaEquipe($linha['id']);

//                        Conexao::pr($efetivos);
                        if(is_array($efetivos) && count($efetivos) > 0)
                        {
                            foreach ($efetivos as $efetivo) {

                                $objEscalaEquipeHorarios = new EscalaEquipeHorarios();
                                $horarios = $objEscalaEquipeHorarios->ListarEscalaHorarios($linha['id'],$efetivo['id_usuario']);
//
                                ?>
                                <tr>
                                    <td valign="middle">
                                        <input  type="hidden" name="id_escala_equipe[<?=$efetivo['id_usuario']?>]" value="<?=$efetivo['id_escala_equipe']?>" id="id_escala_equipe_<?=$efetivo['id_usuario']?>"/>
                                        <input  type="hidden" name="id_funcao[<?=$efetivo['id_usuario']?>]" value="<?=$efetivo['id_funcao']?>" id="id_funcao_<?=$efetivo['id_usuario']?>"/>
                                        <input  type="hidden" name="id_usuario[]" value="<?=$efetivo['id_usuario']?>" id="id_usuario_<?=$efetivo['id_usuario']?>"/>
                                        <?=$efetivo['nome_usuario']?>
                                    </td>
                                    <td valign="middle"><?=$efetivo['nome_cargo']?></td>
                                    <td valign="middle">
                                        <?php
                                        $locais  = new EscalaLocais();
                                        $registros = $locais->ListarCombo('',$_SESSION['usuario']['id_grupo']);
                                        $lista = (is_array($registros) && count($registros) > 0) ? $registros : [['id' => '', 'nome' => "Selecione Local"]] ;
                                        echo Componente::GerarSelectPDO("id_local[".$efetivo['id_usuario']."]", "id_local_".$efetivo['id_usuario']."", "", $lista, array($efetivo['id_local']), array('','Selecione Local'), array("id", "nome"), false, 'form-select slt2 form-select-sm','"');
                                        ?>
                                    </td>
                                    <?php
                                    $firstday = date('Y-m-d', strtotime($linha['data_inicio']));
                                    $startDate = new \DateTime($firstday);
                                    $endDate = new \DateTime(date('Y-m-d', strtotime($linha['data_fim'])));
                                    $y =0;
                                    for($date = $startDate; $date <= $endDate; $date->modify('+1 day')){
                                        $data= $date->format('Y-m-d');
                                        $cor = ($horarios[$data]['cor'] != "") ? 'style="background-color: '.$horarios[$data]['cor'].'"' : '' ;

                                        $dia= $date->format('d');
                                        $data= $date->format('d/m/Y');
                                        $y++;
                                        echo ' <td '.$cor.'><div class="form-check form-check-custom form-check-solid form-check-sm"><input class="form-check-input check-dias" type="checkbox" name="dias['.$efetivo['id_usuario'].'][]" value="'.$data.'" id="dia_'.$efetivo['id_usuario'].'_'.$dia.'"/></div></td>';
                                    }
                                    ?>

                                </tr>
                                <?
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>


                <div class="modal fade" tabindex="-1" id="modal_horarios">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Horários</h5>

                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                                <!--end::Close-->
                            </div>

                            <div class="modal-body" id="div_modal_escala_tipo">
                                <div class="form-body">
                                    <div class="row p-t-20">
                                        <div class="col-md-12 mb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="nome">*Escala hoários</label>
                                                <?php
                                                $objEscalaHorarios  = new EscalaHorarios();
                                                $registros = ($linha['id_escala_horarios'] != "") ? $objEscalaHorarios->ListarCombo($linha['id_escala_horarios'],$_SESSION['usuario']['id_grupo']) :[];
                                                echo Componente::GerarSelectPDO("id_escala_horarios", "id_escala_horarios", "", $registros, array($linha['id_escala_horarios']), array('','Selecione um Coodenador'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','data-validar="select2"');

                                                ?>
                                                <div class="text-muted"> Preencha o campo  Nome </div> </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                                    <button type="button" class="btn btn-primary" id="bt_modal_salvar_escala_horarios" onclick="ExecutarAcaoEscalas()">Salvar</button>
                                </div>
                            </div>
                        </div>
                    </div>

            </form>
        </div>
        <div class="card-footer d-flex flex-row-reverse">
            <button type="button" class="btn btn-success ms-3" id="bt_print" onclick="ImprimirRelatorio(<?=$linha['id']?>)"> <i class="fas fa-file-excel"></i> Imprimir</button>
            <button type="button" class="btn btn-info ms-3" id="bt_salvar"> <i class="fas fa-check"></i> Atualizar Escala</button>
            <button type="button" class="btn btn-light " id="bt_voltar" onclick="history.back()"> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</button>
        </div>
    </div>
</div>


<?php
include_once("modulos/escala/template/js.frm.escala2.php");
?>
