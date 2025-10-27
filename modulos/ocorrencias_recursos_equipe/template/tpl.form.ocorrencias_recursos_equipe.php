                <form action="#" name="frm_ocorrencias_recursos_equipe" id="frm_ocorrencias_recursos_equipe" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_ocorrencias_recursos">Id Ocorrencias Recursos:</label>
			<input type="text" name="id_ocorrencias_recursos"  id="id_ocorrencias_recursos" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_ocorrencias_recursos'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Ocorrencias Recursos </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_efetivo">Id Efetivo:</label>
			<input type="text" name="id_efetivo"  id="id_efetivo" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_efetivo'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Efetivo </div> 
 </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
