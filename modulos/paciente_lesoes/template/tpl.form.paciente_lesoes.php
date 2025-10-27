                <form action="#" name="frm_paciente_lesoes" id="frm_paciente_lesoes" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_parte_corpo">Id Parte Corpo:</label>
			<input type="text" name="id_parte_corpo"  id="id_parte_corpo" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_parte_corpo'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Parte Corpo </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_lesao">Id Lesao:</label>
			<input type="text" name="id_lesao"  id="id_lesao" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_lesao'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Lesao </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_paciente">Id Paciente:</label>
			<input type="text" name="id_paciente"  id="id_paciente" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_paciente'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Paciente </div> 
 </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
