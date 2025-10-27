<form action="#" name="frm_escala_horarios" id="frm_escala_horarios" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-5 mb-2">
                <div class="form-group">
                    <label class="form-label" for="nome">*Nome</label>
                    <input type="text" name="nome"  id="nome" maxlength="100" class="form-control validar-obrigatorio " value="<?=$linha['nome'];?>"/>
                    <div class="text-muted"> Preencha o campo  Nome </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="hora_inicio">Hora Inicio</label>
                    <input type="time" name="hora_inicio"  id="hora_inicio"  class="form-control  validar-obrigatorio" value="<?=$linha['hora_inicio'];?>"/>
                    <div class="text-muted"> Preencha o campo  Hora Inicio </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="hora_fim">Hora Fim</label>
                    <input type="time" name="hora_fim"  id="hora_fim"  class="form-control validar-obrigatorio " value="<?=$linha['hora_fim'];?>"/>
                    <div class="text-muted"> Preencha o campo  Hora Fim </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-3 mb-2">
                <div class="form-group">
                    <label class="form-label" for="cor">Cor</label>
                    <input type="color" name="cor"  id="cor" maxlength="20" class="form-control validar-obrigatorio " value="<?=$linha['cor'];?>"/>
                    <div class="text-muted"> Preencha o campo  Cor </div> </div>
            </div>
            <!--/span-->
        </div>
</form>
