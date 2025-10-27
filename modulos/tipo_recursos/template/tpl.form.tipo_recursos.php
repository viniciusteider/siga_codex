                <form action="#" name="frm_tipo_recursos" id="frm_tipo_recursos" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="nome">Nome</label>
			<input type="text" name="nome"  id="nome" maxlength="50" class="form-control  " value="<?=$linha['nome'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Nome </div> </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
