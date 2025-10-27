                <form action="#" name="frm_equipes_efetivo" id="frm_equipes_efetivo" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_equipe">*Id Equipe</label>
			<input type="text" name="id_equipe"  id="id_equipe" maxlength="" class="form-control validar-obrigatorio mask-numero" value="<?=$linha['id_equipe'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Equipe </div> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_efetivo">*Id Efetivo</label>
			<input type="text" name="id_efetivo"  id="id_efetivo" maxlength="" class="form-control validar-obrigatorio mask-numero" value="<?=$linha['id_efetivo'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Efetivo </div> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="ordem">Ordem</label>
			<input type="text" name="ordem"  id="ordem" maxlength="" class="form-control  mask-numero" value="<?=$linha['ordem'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Ordem </div> </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
