                <form action="#" name="frm_fipe_tipo" id="frm_fipe_tipo" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="nome">*Nome:</label>
			<input type="text" name="nome"  id="nome" maxlength="45" class="form-control validar-obrigatorio " value="<?=$linha['nome'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Nome </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="nome_url">*Nome Url:</label>
			<input type="text" name="nome_url"  id="nome_url" maxlength="45" class="form-control validar-obrigatorio " value="<?=$linha['nome_url'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Nome Url </div> 
 </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
