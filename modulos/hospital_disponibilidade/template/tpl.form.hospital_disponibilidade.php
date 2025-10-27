<form action="#" name="frm_hospital_disponibilidade" id="frm_hospital_disponibilidade" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_hospital">Hospital</label>
                    <?php
                    $objHospital  = new Hospital();
                    $registros = $objHospital->ListarCombo($linha['id_hospital']);
                    echo Componente::GerarSelectPDO("id_hospital", "id_hospital", "", $registros, array($linha['id_hospital']), array('','Selecione Hospital'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',''.$onchange);
                    ?>
                    <div class="text-muted"> Preencha o campo  Id Hospital </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="complexidade">Complexidade:</label>
                    <input type="text" name="complexidade"  id="complexidade" maxlength="100" class="form-control  " value="<?=$linha['complexidade'];?>"/>
                    <div class="text-muted"> Preencha o campo  Complexidade </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="total_leitos">Leitos:</label>
                    <input type="text" name="total_leitos"  id="total_leitos" maxlength="" class="form-control  mask-numero" value="<?=$linha['total_leitos'];?>"/>
                    <div class="text-muted"> Preencha o campo  Total Leitos </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="leitos_disponiveis"> Leitos Disponíveis:</label>
                    <input type="text" name="leitos_disponiveis"  id="leitos_disponiveis" maxlength="" class="form-control  mask-numero" value="<?=$linha['leitos_disponiveis'];?>"/>
                    <div class="text-muted"> Preencha o campo  Leitos Disponíveis </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="vagas_uti">Vagas Uti:</label>
                    <input type="text" name="vagas_uti"  id="vagas_uti" maxlength="" class="form-control  mask-numero" value="<?=$linha['vagas_uti'];?>"/>
                    <div class="text-muted"> Preencha o campo  Vagas Uti </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="uti_disponiveis">Vagas Uti Disponíveis:</label>
                    <input type="text" name="uti_disponiveis"  id="uti_disponiveis" maxlength="" class="form-control  mask-numero" value="<?=$linha['uti_disponiveis'];?>"/>
                    <div class="text-muted"> Preencha o campo  Uti Disponiveis </div>
                </div>
            </div>
        </div>
</form>
