<?php
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Sub-Evento";
echo $objApp->GerarBreadCrumb($configTitulo);
?>
<div id="kt_app_content_container" class="app-container  p-0">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title"> Formulário Sub-Evento</h3>
            <div class="card-toolbar">
                <a href='javascript:;'  class="btn btn-sm btn-light " onclick="history.back()"> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</a>
            </div>
        </div>
        <div class="card-body" id="formulario_subevento">
            <form action="#" name="frm_subevento" id="frm_subevento" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                <div class="form-body">
                    <div class="row p-t-20">
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="id_evento">Evento</label>
                                <?php
                                $objEvento  = new Evento();
                                $registros = $objEvento->ComboEventos($linha['id_evento']);
                                echo Componente::GerarSelectPDO("id_evento", "id_evento", "", $registros, array($linha['id_evento']), array('','Selecione um Evento'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','data-validar="select2"');
                                ?>
                                <div class="text-muted"> Preencha o campo  Id Evento </div> </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-8 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="nome">Nome</label>
                                <input type="text" name="nome"  id="nome" maxlength="255" class="form-control  " value="<?=$linha['nome'];?>"/>
                                <div class="text-muted"> Preencha o campo  Nome </div> </div>
                        </div>
                        <!--/span-->
                    </div>
            </form>

        </div>
        <div class="card-footer d-flex flex-row-reverse">
            <button type="button" class="btn btn-success ms-3" id="bt_salvar"> <i class="fas fa-check"></i> Salvar</button>
            <button type="button" class="btn btn-light " id="bt_voltar" onclick="history.back()"> <i class="fas fa-arrow-circle-left"></i> Voltar para listagem</button>
        </div>
    </div>
</div>

<?php
include_once("modulos/subevento/template/js.frm.subevento.php");
?>
