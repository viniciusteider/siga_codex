                <form action="#" name="frm_ocorrencias_recursos" id="frm_ocorrencias_recursos" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_recurso">Id Recurso:</label>
			<input type="text" name="id_recurso"  id="id_recurso" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_recurso'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Recurso </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_ocorrencia">Id Ocorrencia:</label>
			<input type="text" name="id_ocorrencia"  id="id_ocorrencia" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_ocorrencia'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Ocorrencia </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="data">Data:</label>
			<input type="text" name="data"  id="data"  class="form-control  mask-data" value="<?=Conexao::PrepararDataPHP($linha['data'],$_SESSION['usuario']['timezone']);?>"/>
                                    <div class="text-muted"> Preencha o campo  Data </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="horario_saida_base">Horario Saida Base:</label>
			<input type="text" name="horario_saida_base"  id="horario_saida_base"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['horario_saida_base'],$_SESSION['usuario']['timezone']);?>"/>
                                    <div class="text-muted"> Preencha o campo  Horario Saida Base </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="horario_chegada_local">Horario Chegada Local:</label>
			<input type="text" name="horario_chegada_local"  id="horario_chegada_local"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['horario_chegada_local'],$_SESSION['usuario']['timezone']);?>"/>
                                    <div class="text-muted"> Preencha o campo  Horario Chegada Local </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="horario_saida_local">Horario Saida Local:</label>
			<input type="text" name="horario_saida_local"  id="horario_saida_local"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['horario_saida_local'],$_SESSION['usuario']['timezone']);?>"/>
                                    <div class="text-muted"> Preencha o campo  Horario Saida Local </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="horario_chegada_hospital">Horario Chegada Hospital:</label>
			<input type="text" name="horario_chegada_hospital"  id="horario_chegada_hospital"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['horario_chegada_hospital'],$_SESSION['usuario']['timezone']);?>"/>
                                    <div class="text-muted"> Preencha o campo  Horario Chegada Hospital </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="horario_chegada_base">Horario Chegada Base:</label>
			<input type="text" name="horario_chegada_base"  id="horario_chegada_base"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['horario_chegada_base'],$_SESSION['usuario']['timezone']);?>"/>
                                    <div class="text-muted"> Preencha o campo  Horario Chegada Base </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="qta">Qta:</label>
			<input type="text" name="qta"  id="qta" maxlength="10" class="form-control  " value="<?=$linha['qta'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Qta </div> 
 </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="ultimo_qta">Ultimo Qta:</label>
			<input type="text" name="ultimo_qta"  id="ultimo_qta" maxlength="" class="form-control  mask-numero" value="<?=$linha['ultimo_qta'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Ultimo Qta </div> 
 </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
