
<div class="modal fade" id="modal_modulo_escala_flex">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered mw-300px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Replicar Escala</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body" id="div_modal_escala_flex">

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" id="bt_replicar_salvar_escala_flex" onclick="ExecutarAcaoReplicarEscala()">Copiar</button>
            </div>
        </div>
    </div>
</div>
<?php
include_once("modulos/escala_flex/template/js.modal.escala_flex.php");
?>
