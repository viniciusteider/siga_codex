                <form action="#" name="frm_fipe_modelos" id="frm_fipe_modelos" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_fipe_marcas">Id Fipe Marcas:</label>
			<input type="text" name="id_fipe_marcas"  id="id_fipe_marcas" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_fipe_marcas'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Fipe Marcas </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="codigo_modelo">Codigo Modelo:</label>
			<input type="text" name="codigo_modelo"  id="codigo_modelo" maxlength="" class="form-control  mask-numero" value="<?=$linha['codigo_modelo'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Codigo Modelo </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="codigo_fipe">Codigo Fipe:</label>
			<input type="text" name="codigo_fipe"  id="codigo_fipe" maxlength="10" class="form-control  " value="<?=$linha['codigo_fipe'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Codigo Fipe </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="nome">*Nome:</label>
			<input type="text" name="nome"  id="nome" maxlength="100" class="form-control validar-obrigatorio " value="<?=$linha['nome'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Nome </div> 
 </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
