                <form action="#" name="frm_circulacao" id="frm_circulacao" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_circulacao_local">Id Circulacao Local:</label>
			<input type="text" name="id_circulacao_local"  id="id_circulacao_local" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_circulacao_local'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Circulacao Local </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="nome">Nome:</label>
			<input type="text" name="nome"  id="nome" maxlength="50" class="form-control  " value="<?=$linha['nome'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Nome </div> 
 </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
