                <form action="#" name="frm_sinais_clinicos" id="frm_sinais_clinicos" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="sinais">*Sinais:</label>
			<input type="text" name="sinais"  id="sinais" maxlength="50" class="form-control validar-obrigatorio " value="<?=$linha['sinais'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Sinais </div> 
 </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
