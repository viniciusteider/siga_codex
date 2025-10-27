<form action="#" name="frm_uniforme_peca" id="frm_uniforme_peca" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_uniforme_grupo">* Grupo</label>
                    <?php
                    $grupo = new UniformeGrupoTamanho();
                    $registros = $grupo->ListarCombo();
                    echo Componente::GerarSelectPDO("id_uniforme_grupo","id_uniforme_grupo","",$registros,array($linha['id_uniforme_grupo']),Array("","-- Selecione um Grupo--"),Array("id", "nome"),false, "form-select  ",' data-validar="select2"');
                    ?>
<!--                    <input type="text" name="id_uniforme_grupo"  id="id_uniforme_grupo" maxlength="" class="form-control validar-obrigatorio mask-numero" value="--><?//=$linha['id_uniforme_grupo'];?><!--"/>-->
                    <div class="text-muted">Selecione o Grupo</div> </div>
            </div>
            <!--/span-->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="nome">*Nome</label>
                    <input type="text" name="nome"  id="nome" maxlength="255" class="form-control validar-obrigatorio " value="<?=$linha['nome'];?>"/>
                    <div class="text-muted"> Preencha o campo  Nome </div> </div>
            </div>
            <!--/span-->
        </div>
</form>
