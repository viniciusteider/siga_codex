                <form action="#" name="frm_ocorencias_historico" id="frm_ocorencias_historico" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_ocorrencia">*Id Ocorrencia:</label>
			<input type="text" name="id_ocorrencia"  id="id_ocorrencia" maxlength="" class="form-control validar-obrigatorio mask-numero" value="<?=$linha['id_ocorrencia'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Ocorrencia </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_usuario">Id Usuario:</label>
			<input type="text" name="id_usuario"  id="id_usuario" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_usuario'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Usuario </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="descricao">Descricao:</label>
			<textarea class="form-control  " name="descricao"  id="descricao" placeholder="Insira o texto" ><?=$linha['descricao'];?></textarea>
                                    <div class="text-muted"> Preencha o campo  Descricao </div> 
 </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
