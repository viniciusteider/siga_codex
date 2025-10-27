
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-9 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_usuario">Solicitante:</label>
                    <!--begin::Default example-->
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text">
                           <input type="checkbox" class=" form-check-input ms-3" onclick="LiberarCampo()" name="sem_cadastro" <?php if($linha['nome'] != "") echo 'checked="checked"'?> id="sem_cadastro">&nbsp;&nbsp;
                            <label for="sem_cadastro">Sem Cadastro</label>
                        </span>
                        <div class="overflow-hidden flex-grow-1">
                            <input type="text" name="nome"  id="nome" maxlength="150" class="form-control rounded-start-0" style="display: none" value="<?=$linha['nome'];?>"/>
                            <?php
                            $objUsuarios  = new Usuario();
                            $registros = ($linha['id_usuario'] != "") ? $objUsuarios->ListarCombo($linha['id_usuario']) :[];
                            echo Componente::GerarSelectPDO("id_usuario", "id_usuario", "", $registros, array($linha['id_usuario']), array('','Selecione um Solicitante'), array("id", "nome"), false, 'form-select  rounded-start-0','data-validar="select2"');

                            ?>
                        </div>
                    </div>
                    <!--end::Default example-->
<!--                    <input type="text" name="id_usuario"  id="id_usuario" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_usuario'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Id Usuario </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data">Data:</label>
                    <input type="text" name="data"  id="data"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['data'],$_SESSION['usuario']['timezone'],'d/m/Y');?>"/>
                    <div class="text-muted"> Preencha o campo  Data </div>
                </div>
            </div>
            <!--/span-->
        </div>
    </div>

