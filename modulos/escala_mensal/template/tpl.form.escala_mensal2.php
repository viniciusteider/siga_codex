<form action="#" name="frm_escala_mensal" id="frm_escala_mensal" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_usuario">Usuário:</label>
                    <?php
                    $objUsuarios  = new Usuario();
                    $registros = ($linha['id_usuario'] != "") ? $objUsuarios->ListarCombo($linha['id_usuario']) :[];
                    echo Componente::GerarSelectPDO("id_usuario", "id_usuario", "", $registros, array($linha['id_usuario']), array('','Selecione um Coodenador'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','data-validar="select2"');

                    ?>
<!--                    <input type="text" name="id_usuario"  id="id_usuario" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_usuario'];?><!--"/>-->
                    <div class="text-muted"> Selecione Equipe </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_local">Local:</label>
                    <?php
                    $locais  = new EscalaLocais();
                    $registros = $locais->ListarComboComRecursos($_SESSION['usuario']['id_grupo']);
                    $lista = (is_array($registros) && count($registros) > 0) ? $registros : [['id' => '', 'nome' => "Selecione Local"]] ;
                    echo Componente::GerarSelectPDO("id_local", "id_local", "", $lista, array($linha['id_local']), array('','Selecione Local'), array("id", "nome"), false, 'form-select slt2 ','"');
                    ?>
<!--                    <input type="text" name="id_local"  id="id_local" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_local'];?><!--"/>-->
                    <div class="text-muted"> Selecione Local </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_hora_entrada">Data Hora Entrada:</label>
                    <input type="text" name="data_hora_entrada"  id="data_hora_entrada"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['data_hora_entrada'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Hora Entrada </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_hora_saida">Data Hora Saida:</label>
                    <input type="text" name="data_hora_saida"  id="data_hora_saida"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['data_hora_saida'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Hora Saida </div>
                </div>
            </div>
            <!--/span-->
        </div>
</form>
