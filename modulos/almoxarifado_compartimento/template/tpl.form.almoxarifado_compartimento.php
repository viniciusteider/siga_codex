                <form action="#" name="frm_almoxarifado_compartimento" id="frm_almoxarifado_compartimento" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="nome">Nome:</label>
			<input type="text" name="nome"  id="nome" maxlength="45" class="form-control  " value="<?=$linha['nome'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Nome </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_estoque">Id Estoque:</label>
			<input type="text" name="id_estoque"  id="id_estoque" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_estoque'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Estoque </div> 
 </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
