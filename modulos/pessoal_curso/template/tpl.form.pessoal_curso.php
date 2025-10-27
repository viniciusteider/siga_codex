<form action="#" name="frm_pessoal_curso" id="frm_pessoal_curso" method="post">
    <input type="hidden" name="id_curso"  id="id_curso"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_tipo_curso">*Tipo Curso</label>
                    <?php
                    $curso = new TipoCurso();
                    $registros = $curso->ListarCombo($linha['id_tipo_curso']);
                    echo Componente::GerarSelectPDO("id_tipo_curso","id_tipo_curso","",$registros,array($linha['id_tipo_curso']),Array("","-- Selecione o Tipo do Curso --"),Array("id", "nome"),false, "form-select  ",' data-validar="select2"');
                    ?>
<!--                    <input type="text" name="id_tipo_curso"  id="id_tipo_curso" maxlength="" class="form-control validar-obrigatorio mask-numero" value="--><?//=$linha['id_tipo_curso'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Id Tipo Curso </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_instituicao_ensino">* Instituição de Ensino</label>
                    <?php
                    $inst = new InstituicaoEnsino();
                    $registros = $inst->ListarCombo($linha['id_instituicao_ensino']);
                    echo Componente::GerarSelectPDO("id_instituicao_ensino","id_instituicao_ensino","",$registros,array($linha['id_instituicao_ensino']),Array("","-- Selecione uma Instituição de Ensino --"),Array("id", "nome_instituicao"),false, "form-select  ",' data-validar="select2"');
                    ?>
<!--                    <input type="text" name="id_instituicao_ensino"  id="id_instituicao_ensino" maxlength="" class="form-control validar-obrigatorio mask-numero" value="--><?//=$linha['id_instituicao_ensino'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Id Instituicao Ensino </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_matricula">Data Matrícula</label>
                    <input type="text" name="data_matricula"  id="data_matricula"  class="form-control  mask-data" value="<?=Conexao::PrepararDataPHP($linha['data_matricula'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Matricula </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_inicio">Data Início</label>
                    <input type="text" name="data_inicio"  id="data_inicio"  class="form-control  mask-data" value="<?=Conexao::PrepararDataPHP($linha['data_inicio'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Inicio </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_termino">Data Término</label>
                    <input type="text" name="data_termino"  id="data_termino"  class="form-control  mask-data" value="<?=Conexao::PrepararDataPHP($linha['data_termino'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Termino </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="media_final">Media Final</label>
                    <input type="text" name="media_final"  id="media_final"  class="form-control mask-dinheiro " value="<?=number_format($linha['media_final'],'2',',','.');?>"/>
                    <div class="text-muted"> Preencha o campo  Media Final </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="carga_horaria">Carga Horaria</label>
                    <input type="text" name="carga_horaria"  id="carga_horaria" maxlength="" class="form-control  mask-numero" value="<?=$linha['carga_horaria'];?>"/>
                    <div class="text-muted"> Preencha o campo  Carga Horaria </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="formato_curso">Formato Curso</label>
                    <select class="form-select" id="formato_curso" name="formato_curso">
                        <option value="1" <?php if($linha['formato_curso'] == "1")  echo 'selected'; ?>>Presencial</option>
                        <option value="2" <?php if($linha['formato_curso'] == "2")  echo 'selected'; ?> >Á Distância</option>
                        <option value="3" <?php if($linha['formato_curso'] == "3")  echo 'selected'; ?>>Hibrido</option>
                    </select>
<!--                    <input type="text" name="formato_curso"  id="formato_curso" maxlength="50" class="form-control  " value="--><?//=$linha['formato_curso'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Formato Curso </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="observacoes">Observacoes</label>
                    <textarea class="form-control  " name="observacoes"  id="observacoes" placeholder="Insira o texto" ><?=$linha['observacoes'];?></textarea>
                    <div class="text-muted"> Preencha o campo  Observacoes </div> </div>
            </div>
            <!--/span-->
        </div>
</form>
<?php
include_once("modulos/pessoal_curso/template/js.modal.pessoal_curso.php");
?>
