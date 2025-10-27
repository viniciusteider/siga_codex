                <form action="#" name="frm_ligacoes" id="frm_ligacoes" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_usuario">Id Usuario</label>
			<input type="text" name="id_usuario"  id="id_usuario" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_usuario'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Usuario </div> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="numero">*Numero</label>
			<input type="text" name="numero"  id="numero" maxlength="40" class="form-control validar-obrigatorio " value="<?=$linha['numero'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Numero </div> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="tempo">*Tempo</label>
			<input type="text" name="tempo"  id="tempo"  class="form-control validar-obrigatorio " value="<?=$linha['tempo'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Tempo </div> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_classificacao">Id Classificacao</label>
			<input type="text" name="id_classificacao"  id="id_classificacao" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_classificacao'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Classificacao </div> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="latitude">Latitude</label>
			<input type="text" name="latitude"  id="latitude"  class="form-control  " value="<?=$linha['latitude'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Latitude </div> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="longitude">Longitude</label>
			<input type="text" name="longitude"  id="longitude"  class="form-control  " value="<?=$linha['longitude'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Longitude </div> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="descritivo">Descritivo</label>
			<textarea class="form-control  " name="descritivo"  id="descritivo" placeholder="Insira o texto" ><?=$linha['descritivo'];?></textarea>
                                    <div class="text-muted"> Preencha o campo  Descritivo </div> </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
