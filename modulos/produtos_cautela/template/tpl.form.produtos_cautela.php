                <form action="#" name="frm_produtos_cautela" id="frm_produtos_cautela" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_agente">Id Agente:</label>
			<input type="text" name="id_agente"  id="id_agente" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_agente'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Agente </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_setor">Id Setor:</label>
			<input type="text" name="id_setor"  id="id_setor" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_setor'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Setor </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="data_retirada">Data Retirada:</label>
			<input type="text" name="data_retirada"  id="data_retirada"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['data_retirada'],$_SESSION['usuario']['timezone']);?>"/>
                                    <div class="text-muted"> Preencha o campo  Data Retirada </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="data_devolucao">Data Devolucao:</label>
			<input type="text" name="data_devolucao"  id="data_devolucao"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['data_devolucao'],$_SESSION['usuario']['timezone']);?>"/>
                                    <div class="text-muted"> Preencha o campo  Data Devolucao </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="local_uso">Local Uso:</label>
			<input type="text" name="local_uso"  id="local_uso" maxlength="45" class="form-control  " value="<?=$linha['local_uso'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Local Uso </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="finalidade">Finalidade:</label>
			<input type="text" name="finalidade"  id="finalidade" maxlength="45" class="form-control  " value="<?=$linha['finalidade'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Finalidade </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_grupo">Id Grupo:</label>
			<input type="text" name="id_grupo"  id="id_grupo" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_grupo'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Grupo </div> 
 </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
