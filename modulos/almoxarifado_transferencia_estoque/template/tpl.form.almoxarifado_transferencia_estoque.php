                <form action="#" name="frm_almoxarifado_transferencia_estoque" id="frm_almoxarifado_transferencia_estoque" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_grupo">Id Grupo:</label>
			<input type="text" name="id_grupo"  id="id_grupo" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_grupo'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Grupo </div> 
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
                                      <label class="form-label" for="id_produto">Id Produto:</label>
			<input type="text" name="id_produto"  id="id_produto" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_produto'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Produto </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_almoxarifado">Id Almoxarifado:</label>
			<input type="text" name="id_almoxarifado"  id="id_almoxarifado" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_almoxarifado'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Almoxarifado </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_tipo_movimento">Id Tipo Movimento:</label>
			<input type="text" name="id_tipo_movimento"  id="id_tipo_movimento" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_tipo_movimento'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Tipo Movimento </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_almoxarifado_destino">Id Almoxarifado Destino:</label>
			<input type="text" name="id_almoxarifado_destino"  id="id_almoxarifado_destino" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_almoxarifado_destino'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Almoxarifado Destino </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="estoque_atual">Estoque Atual:</label>
			<input type="text" name="estoque_atual"  id="estoque_atual" maxlength="" class="form-control  mask-numero" value="<?=$linha['estoque_atual'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Estoque Atual </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="data_movimento">Data Movimento:</label>
			<input type="text" name="data_movimento"  id="data_movimento"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['data_movimento'],$_SESSION['usuario']['timezone']);?>"/>
                                    <div class="text-muted"> Preencha o campo  Data Movimento </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="quantidade_tranferir">Quantidade Tranferir:</label>
			<input type="text" name="quantidade_tranferir"  id="quantidade_tranferir" maxlength="" class="form-control  mask-numero" value="<?=$linha['quantidade_tranferir'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Quantidade Tranferir </div> 
 </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
