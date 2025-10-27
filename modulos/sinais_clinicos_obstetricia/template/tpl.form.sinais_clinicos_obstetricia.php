                <form action="#" name="frm_sinais_clinicos_obstetricia" id="frm_sinais_clinicos_obstetricia" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_estagio_parto">Id Estagio Parto:</label>
			<input type="text" name="id_estagio_parto"  id="id_estagio_parto" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_estagio_parto'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Estagio Parto </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="procedimentos">Procedimentos:</label>
			<input type="text" name="procedimentos"  id="procedimentos" maxlength="50" class="form-control  " value="<?=$linha['procedimentos'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Procedimentos </div> 
 </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
