                <form action="#" name="frm_fipe_anos" id="frm_fipe_anos" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_fipe_modelos">Id Fipe Modelos:</label>
			<input type="text" name="id_fipe_modelos"  id="id_fipe_modelos" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_fipe_modelos'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Fipe Modelos </div> 
 </div>
                            </div>
                            <!--/span-->
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
                                      <label class="form-label" for="ano">Ano:</label>
			<input type="text" name="ano"  id="ano" maxlength="5" class="form-control  " value="<?=$linha['ano'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Ano </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="combustivel">Combustivel:</label>
			<input type="text" name="combustivel"  id="combustivel" maxlength="45" class="form-control  " value="<?=$linha['combustivel'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Combustivel </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="valor">Valor:</label>
			<input type="text" name="valor"  id="valor"  class="form-control  " value="<?=$linha['valor'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Valor </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="mes_referencia">Mes Referencia:</label>
			<input type="text" name="mes_referencia"  id="mes_referencia" maxlength="45" class="form-control  " value="<?=$linha['mes_referencia'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Mes Referencia </div> 
 </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
