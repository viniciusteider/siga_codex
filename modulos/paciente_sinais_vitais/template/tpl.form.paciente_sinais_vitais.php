<form action="#" name="frm_paciente_sinais_vitais" id="frm_paciente_sinais_vitais" method="post">
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
                    <label class="form-label" for="horario">Horario:</label>
                    <input type="text" name="horario"  id="horario"  class="form-control  " value="<?=$linha['horario'];?>"/>
                    <div class="text-muted"> Preencha o campo  Horario </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="pressao_arterial_minima">Pressao Arterial Minima:</label>
                    <input type="text" name="pressao_arterial_minima"  id="pressao_arterial_minima" maxlength="" class="form-control  mask-numero" value="<?=$linha['pressao_arterial_minima'];?>"/>
                    <div class="text-muted"> Preencha o campo  Pressao Arterial Minima </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="pressao_arterial_maxima">Pressao Arterial Maxima:</label>
                    <input type="text" name="pressao_arterial_maxima"  id="pressao_arterial_maxima" maxlength="" class="form-control  mask-numero" value="<?=$linha['pressao_arterial_maxima'];?>"/>
                    <div class="text-muted"> Preencha o campo  Pressao Arterial Maxima </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="frequencia_cardiaca">Frequencia Cardiaca:</label>
                    <input type="text" name="frequencia_cardiaca"  id="frequencia_cardiaca" maxlength="" class="form-control  mask-numero" value="<?=$linha['frequencia_cardiaca'];?>"/>
                    <div class="text-muted"> Preencha o campo  Frequencia Cardiaca </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="frequencia_respiratoria">Frequencia Respiratoria:</label>
                    <input type="text" name="frequencia_respiratoria"  id="frequencia_respiratoria" maxlength="" class="form-control  mask-numero" value="<?=$linha['frequencia_respiratoria'];?>"/>
                    <div class="text-muted"> Preencha o campo  Frequencia Respiratoria </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="saturacao_o2">Saturacao O2:</label>
                    <input type="text" name="saturacao_o2"  id="saturacao_o2" maxlength="" class="form-control  mask-numero" value="<?=$linha['saturacao_o2'];?>"/>
                    <div class="text-muted"> Preencha o campo  Saturacao O2 </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="glasgow">Glasgow:</label>
                    <input type="text" name="glasgow"  id="glasgow" maxlength="" class="form-control  mask-numero" value="<?=$linha['glasgow'];?>"/>
                    <div class="text-muted"> Preencha o campo  Glasgow </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="temperatura">Temperatura:</label>
                    <input type="text" name="temperatura"  id="temperatura" maxlength="" class="form-control  mask-numero" value="<?=$linha['temperatura'];?>"/>
                    <div class="text-muted"> Preencha o campo  Temperatura </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="hgt">Hgt:</label>
                    <input type="text" name="hgt"  id="hgt" maxlength="" class="form-control  mask-numero" value="<?=$linha['hgt'];?>"/>
                    <div class="text-muted"> Preencha o campo  Hgt </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="escala_trauma">Escala Glasgow:</label>
                    <input type="text" name="escala_trauma"  id="escala_trauma" maxlength="" class="form-control  mask-numero" value="<?=$linha['escala_trauma'];?>"/>
                    <div class="text-muted"> Preencha o campo  Escala Glasgow </div>
                </div>
            </div>
            <!--/span-->
        </div>
</form>
