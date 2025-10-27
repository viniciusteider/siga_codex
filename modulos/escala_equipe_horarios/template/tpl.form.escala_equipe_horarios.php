                <form action="#" name="frm_escala_equipe_horarios" id="frm_escala_equipe_horarios" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_escala_equipe">Id Escala Equipe</label>
			<input type="text" name="id_escala_equipe"  id="id_escala_equipe" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_escala_equipe'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Escala Equipe </div> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="id_escala_horarios">Id Escala Horarios</label>
			<input type="text" name="id_escala_horarios"  id="id_escala_horarios" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_escala_horarios'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Id Escala Horarios </div> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="data">Data</label>
			<input type="text" name="data"  id="data"  class="form-control  mask-data" value="<?=Conexao::PrepararDataPHP($linha['data'],$_SESSION['usuario']['timezone']);?>"/>
                                    <div class="text-muted"> Preencha o campo  Data </div> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="hora_inicio">Hora Inicio</label>
			<input type="text" name="hora_inicio"  id="hora_inicio"  class="form-control  " value="<?=$linha['hora_inicio'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Hora Inicio </div> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                      <label class="form-label" for="hora_fim">Hora Fim</label>
			<input type="text" name="hora_fim"  id="hora_fim"  class="form-control  " value="<?=$linha['hora_fim'];?>"/>
                                    <div class="text-muted"> Preencha o campo  Hora Fim </div> </div>
                            </div>
                            <!--/span-->
                            </div>
                    </form>
