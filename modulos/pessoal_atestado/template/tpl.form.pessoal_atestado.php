<form action="#" name="frm_pessoal_atestado" id="frm_pessoal_atestado" method="post">
    <input type="hidden" name="id_atestado"  id="id_atestado"   value="<?=$linha['id'];?>"/>
    <input type="hidden" name="id_usuario"  id="id_usuario"   value="<?=$_REQUEST['id_usuario'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_cid">Cid</label>
                    <select name="id_cid" id="id_cid" class=" form-select "  data-placeholder="Selecione o CID"  >
                        <?php
                        $cid = new Cid();
                        $registros = $cid->ListarCombo($linha['id_cid']);
                        foreach ($registros as $row)
                        {
                            $selected = ($linha['id_cid'] == $row['id']) ? 'selected="selected"' : '';
                            echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nome'].'</option>';
                        }
                        ?>
                    </select>
<!--                    <input type="text" name="id_cid"  id="id_cid" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_cid'];?><!--"/>-->
                    <div class="text-muted"> Preencha o CID </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_tipo_afastamento">* Tipo Afastamento</label>
                    <select name="id_tipo_afastamento" id="id_tipo_afastamento" class=" form-select"  data-placeholder="Selecione o Tipo de afastamento"  >
                        <?php
                        $afastamento = new TipoAfastamento();
                        $registros = $afastamento->ListarCombo($linha['id_tipo_afastamento']);
                        foreach ($registros as $row)
                        {
                            $selected = ($linha['id_tipo_afastamento'] == $row['id']) ? 'selected="selected"' : '';
                            echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nome'].'</option>';
                        }
                        ?>
                    </select>
<!--                    <input type="text" name="id_tipo_afastamento"  id="id_tipo_afastamento" maxlength="" class="form-control validar-obrigatorio mask-numero" value="--><?//=$linha['id_tipo_afastamento'];?><!--"/>-->
                    <div class="text-muted"> Selecione o Tipo Afastamento </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_medico">Médico</label>

                    <?php
                    $medico = new Medicos();
                    $registros = $medico->ListarCombo($linha['id_medico']);
                    echo Componente::GerarSelectPDO("id_medico","id_medico","",$registros,array($linha['id_medico']),Array("","-- Selecione o Médico --"),Array("id", "nome"),false, "form-select  ",' data-validar="select2"');
                    ?>
<!--                    <input type="text" name="id_medico"  id="id_medico" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_medico'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Id Medico </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_inicio">Data Início</label>
                    <input type="text" name="data_inicio"  id="data_inicio"  class="form-control  mask-data" value="<?=Conexao::PrepararDataPHP($linha['data_inicio'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Inicio </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_termino">Data Término</label>
                    <input type="text" name="data_termino"  id="data_termino"  class="form-control  mask-data" value="<?=Conexao::PrepararDataPHP($linha['data_termino'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Termino </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="texto_homologacao">Texto Homologação</label>
                    <textarea class="form-control  " name="texto_homologacao"  id="texto_homologacao" placeholder="Insira o texto" ><?=$linha['texto_homologacao'];?></textarea>
                    <div class="text-muted"> Preencha o campo  Texto Homologacao </div> </div>
            </div>
            <!--/span-->
        </div>
</form>
<?php
include_once("modulos/pessoal_atestado/template/js.modal.pessoal_atestado.php");