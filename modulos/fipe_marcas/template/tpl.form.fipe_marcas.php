                <form action="#" name="frm_fipe_marcas" id="frm_fipe_marcas" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_fipe_tipo">*Id Fipe Tipo:</label>
			<input type="text" name="id_fipe_tipo"  id="id_fipe_tipo" maxlength="" class="form-control validar-obrigatorio mask-numero" value="<?=$linha['id_fipe_tipo'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Fipe Tipo </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="codigo_marca">Codigo Marca:</label>
			<input type="text" name="codigo_marca"  id="codigo_marca" maxlength="" class="form-control  mask-numero" value="<?=$linha['codigo_marca'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Codigo Marca </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="nome">Nome:</label>
			<input type="text" name="nome"  id="nome" maxlength="45" class="form-control  " value="<?=$linha['nome'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Nome </div> 
 </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
