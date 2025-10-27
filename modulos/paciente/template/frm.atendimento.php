<div class="rounded border p-5 ">
    <div class="row p-t-20">
        <div class="col-md-2 pt-10">
            <div class="form-check form-switch form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="1"  <?php if($linha['recusa_atendimento'] == 1) echo 'checked ="checked"';?>  id="recusa_atendimento" name="recusa_atendimento"/>
                <label class="form-check-label" for="recusa_atendimento">
                    Recusa Atendimento
                </label>
            </div>
        </div>
        <div class="col-md-2 pt-10">
            <div class="form-check form-switch form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="1"  <?php if($linha['recusa_transporte'] == 1) echo 'checked ="checked"';?>  id="recusa_transporte" name="recusa_transporte"/>
                <label class="form-check-label" for="recusa_transporte">
                    Recusa Transporte
                </label>
            </div>
        </div>
        <div class="col-md-5 mb-2">
            <div class="form-group">
                <label class="form-label" for="id_hospital">Hospital</label>
                <?php
                $objHospital  = new Hospital();
                $registros = $objHospital->ListarCombo($linha['id_hospital']);
                echo Componente::GerarSelectPDO("id_hospital", "id_hospital", "", $registros, array($linha['id_hospital']), array('','Selecione Hospital'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',''.$onchange);
                ?>
                <!--                    <input type="text" name="id_hospital"  id="id_hospital" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_hospital'];?><!--"/>-->
                <div class="text-muted"> Preencha o campo  Id Hospital </div> </div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="form-group">
                <label class="form-label" for="id_situacao">Situação</label>
                <?php
                $objSituacaoo =  new PacienteSituacao();
                echo $objSituacaoo->GerarSelec($linha['id_situacao'],'id_situacao','id_situacao','data-placeholder="Selecione Situação" data-validar="select2" ' );
                ?>
                <div class="text-muted"> Preencha o campo  Id Hospital </div>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-3 mb-2">
            <div class="form-group">
                <label class="form-label" for="data_recebimento">Data Recebimento</label>
                <input type="text" name="data_recebimento"  id="data_recebimento"  class="form-control  mask-data" value="<?=Conexao::PrepararDataPHP($linha['data_recebimento'],$_SESSION['usuario']['timezone']);?>"/>
                <div class="text-muted"> Preencha o campo  Data Recebimento </div> </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="form-label" for="profissional">Profissional</label>
                <input type="text" name="profissional"  id="profissional" maxlength="100" class="form-control  " value="<?=$linha['profissional'];?>"/>
                <div class="text-muted"> Preencha o campo  Profissional </div> </div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="form-group">
                <label class="form-label" for="profissional">Tipo Encaminhamento</label>
                <select name="tipo_encaminhamento" id="tipo_encaminhamento" class="form-select">
                    <option value="1" <?php if($linha['tipo_encaminhamento'] == 1) echo'selected="selected"'?> >Regular</option>
                    <option value="2"  <?php if($linha['tipo_encaminhamento'] == 2) echo'selected="selected"'?>>Vaga Zero</option>
                </select>
<!--                <input type="text" name="profissional"  id="profissional" maxlength="100" class="form-control  " value="--><?//=$linha['profissional'];?><!--"/>-->
                <div class="text-muted"> Selecione Tipo  </div>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-12 mb-4">
            <div class="form-group">
                <label class="form-label" for="observacao">Observações</label>
                <textarea class="form-control  " name="observacao" rows="7"  id="observacao" placeholder="Insira o texto" ><?=$linha['observacao'];?></textarea>

            </div>
        </div>
    </div>
</div>
