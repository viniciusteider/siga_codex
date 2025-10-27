<form action="#" name="frm_ocorrencias_apoio" id="frm_ocorrencias_apoio" method="post">
    <input type="hidden" name="id_ocorrencia_apoio"  id="id_ocorrencia_apoio"   value="<?=$linha['id'];?>"/>
    <input type="hidden" name="id_ocorrencia"  id="id_ocorrencia"   value="<?=$_REQUEST['id_ocorrencia'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="hora_pedido">Hora Pedido:</label>
                    <div class="input-group" id="kt_td_picker_custom_icons" data-td-target-input="nearest" data-td-target-toggle="nearest">

                        <input type="text" name="hora_pedido"  id="hora_pedido"  class="form-control  mask-datetime validar-obrigatorio" value="<?=Conexao::PrepararDataPHP($linha['hora_pedido'],$_SESSION['usuario']['timezone']);?>"/>
                        <!--                        <input id="kt_td_picker_custom_icons_input" type="text" class="form-control" data-td-target="#kt_td_picker_custom_icons"/>-->
                        <span class="input-group-text" data-td-target="#kt_td_picker_custom_icons" data-td-toggle="datetimepicker">
                        <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                    </span>
                    </div>
                    <div class="text-muted"> Preencha o campo  Hora Pedido </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_orgao_apoio">Orgão de Apoio:</label>
                    <?php
                    $objOrgao = new OrgaoApoio();
                    $registros = $objOrgao->ListarCombo($linha['id_etnia']);
                    echo Componente::GerarSelectPDO("id_orgao_apoio", "id_orgao_apoio", "", $registros, array($linha['id_orgao_apoio']), array('','Selecione Orgão'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',''.$onchange);
                    ?>
                    <!--                    <input type="text" name="id_orgao_apoio"  id="id_orgao_apoio" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_orgao_apoio'];?><!--"/>-->
                    <div class="text-muted"> Selecione Orgão de Apoio </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="responsavel_apoio">Responsável pelo Apoio:</label>
                    <input type="text" name="responsavel_apoio"  id="responsavel_apoio" maxlength="100" class="form-control  " value="<?=$linha['responsavel_apoio'];?>"/>
                    <div class="text-muted"> Preencha o campo  Responsavel Apoio </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-8 mb-2">
                <div class="form-group">
                    <label class="form-label" for="solicitacao">Solicitação:</label>
                    <textarea class="form-control  " name="solicitacao"  id="solicitacao" placeholder="Insira o texto" ><?=$linha['solicitacao'];?></textarea>
                    <div class="text-muted"> Preencha o campo  Solicitacao </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="total_pessoas">Total Pessoas:</label>
                    <input type="text" name="total_pessoas"  id="total_pessoas" maxlength="" class="form-control  mask-numero" value="<?=$linha['total_pessoas'];?>"/>
                    <div class="text-muted"> Total Pessoas </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="total_veiculos">Total Veiculos:</label>
                    <input type="text" name="total_veiculos"  id="total_veiculos" maxlength="" class="form-control  mask-numero" value="<?=$linha['total_veiculos'];?>"/>
                    <div class="text-muted"> Total Veiculos </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="obs_sv">Observações sobre o serviço realizado:</label>
                    <textarea class="form-control  " name="obs_sv"  id="obs_sv" placeholder="Insira o texto" ><?=$linha['obs_sv'];?></textarea>
                    <div class="text-muted"> Preencha o campo  Obs Sv </div>
                </div>
            </div>
            <!--/span-->
        </div>
</form>
<?php
include_once("modulos/ocorrencias_apoio/template/js.modal.ocorrencias_apoio.php");
?>
