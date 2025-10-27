<form action="#" name="frm_procedimentos" id="frm_procedimentos" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_procedimento_tipo">Tipo de Procediemnto</label>
                    <select name="id_procedimento_tipo" id="id_procedimento_tipo"  class=" form-select" data-placeholder="Selecione Tipo de procedimento" data-validar="select2"  >
                        <?php
                        $objtipo =  new ProcedimentosTipo();
                        $user = $objtipo->ListarCombo();
                        echo Componente::GerarCombo($user,'id','nome',$linha['id_procedimento_tipo'],'','');
                        ?>
                    </select>
<!--                    <input type="text" name="id_procedimento_tipo"  id="id_procedimento_tipo" maxlength="" class="form-control  mask-numero" value="--><?//=$linha['id_procedimento_tipo'];?><!--"/>-->
                    <div class="text-muted"> Selecione o tipo de procedimento </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label" for="procedimento">Procedimento</label>
                    <input type="text" name="procedimento"  id="procedimento" maxlength="50" class="form-control  " value="<?=$linha['procedimento'];?>"/>
                    <div class="text-muted"> Preencha o campo  Procedimento </div> </div>
            </div>
            <!--/span-->
        </div>
</form>
