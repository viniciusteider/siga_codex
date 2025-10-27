<form action="#" name="frm_paciente_medicamentos" id="frm_paciente_medicamentos" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_paciente">Id Paciente:</label>
                    <input type="text" name="id_paciente"  id="id_paciente" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_paciente'];?>"/>
                    <div class="text-muted"> Preencha o campo  Id Paciente </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_medicamento">Id Medicamento:</label>
                    <input type="text" name="id_medicamento"  id="id_medicamento" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_medicamento'];?>"/>
                    <div class="text-muted"> Preencha o campo  Id Medicamento </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_via">Id Via:</label>
                    <input type="text" name="id_via"  id="id_via" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_via'];?>"/>
                    <div class="text-muted"> Preencha o campo  Id Via </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_efetivo">Id Efetivo:</label>
                    <input type="text" name="id_efetivo"  id="id_efetivo" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_efetivo'];?>"/>
                    <div class="text-muted"> Preencha o campo  Id Efetivo </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="horario">Horario:</label>
                    <input type="text" name="horario"  id="horario"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['horario'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Horario </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="dose">Dose:</label>
                    <input type="text" name="dose"  id="dose" maxlength="" class="form-control  mask-numero" value="<?=$linha['dose'];?>"/>
                    <div class="text-muted"> Preencha o campo  Dose </div>
                </div>
            </div>
            <!--/span-->
        </div>
</form>
