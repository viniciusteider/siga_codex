                <form action="#" name="frm_tipo_combustivel" id="frm_tipo_combustivel" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="tipo_combustivel">*Tipo Combustivel</label>
			<input type="text" name="tipo_combustivel"  id="tipo_combustivel" maxlength="60" class="form-control validar-obrigatorio " value="<?=$linha['tipo_combustivel'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Tipo Combustivel </div> </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
