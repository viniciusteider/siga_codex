                <form action="#" name="frm_paciente_sinais_clinicos_obstetricia" id="frm_paciente_sinais_clinicos_obstetricia" method="post">
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
                                      <label class="form-label" for="id_sinais_clinicos_obstetrica">Id Sinais Clinicos Obstetrica:</label>
			<input type="text" name="id_sinais_clinicos_obstetrica"  id="id_sinais_clinicos_obstetrica" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_sinais_clinicos_obstetrica'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Sinais Clinicos Obstetrica </div> 
 </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
