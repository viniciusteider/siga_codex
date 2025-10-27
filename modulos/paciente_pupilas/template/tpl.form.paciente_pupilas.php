                <form action="#" name="frm_paciente_pupilas" id="frm_paciente_pupilas" method="post">
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
                                      <label class="form-label" for="id_pupilas_sintomas">Id Pupilas Sintomas:</label>
			<input type="text" name="id_pupilas_sintomas"  id="id_pupilas_sintomas" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_pupilas_sintomas'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Pupilas Sintomas </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="direita">Direita:</label>
			<input type="text" name="direita"  id="direita" maxlength="5" class="form-control  " value="<?=$linha['direita'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Direita </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="esquerda">Esquerda:</label>
			<input type="text" name="esquerda"  id="esquerda" maxlength="5" class="form-control  " value="<?=$linha['esquerda'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Esquerda </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="tipo">Tipo:</label>
			<input type="text" name="tipo"  id="tipo" maxlength="" class="form-control  mask-numero" value="<?=$linha['tipo'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Tipo </div> 
 </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
