<form action="#" name="frm_escala" id="frm_escala" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_equipe">*Equipe</label>
                    <?php
                    $objEquipes = new Equipes();
                    $registros = ($linha['id_equipe'] != "") ? $objEquipes->ListarCombo($linha['id_equipe'],$_SESSION['usuario']['id_grupo']) :[];
                    echo Componente::GerarSelectPDO("id_equipe", "id_equipe", "", $registros, array($linha['id_equipe']), array('','Selecione uma Equipe'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','data-validar="select2"');

                    ?>
                    <!--                    <input type="text" name="id_equipe"  id="id_equipe" maxlength="" class="form-control validar-obrigatorio mask-numero" value="--><?//=$linha['id_equipe'];?><!--"/>-->
                    <div class="text-muted"> Preencha o campo  Id Equipe </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="nome">*Nome</label>
                    <input type="text" name="nome"  id="nome" maxlength="100" class="form-control validar-obrigatorio " value="<?=$linha['nome'];?>"/>
                    <div class="text-muted"> Preencha o campo  Nome </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_inicio">*Data Inicio</label>
                    <input type="text" name="data_inicio"  id="data_inicio"  class="form-control validar-obrigatorio mask-data" value="<?=Conexao::PrepararDataPHP($linha['data_inicio'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Inicio </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-2 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_fim">*Data Fim</label>
                    <input type="text" name="data_fim"  id="data_fim"  class="form-control validar-obrigatorio mask-data" value="<?=Conexao::PrepararDataPHP($linha['data_fim'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Fim </div> </div>
            </div>
            <!--/span-->
        </div>
</form>
