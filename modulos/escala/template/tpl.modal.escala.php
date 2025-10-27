
            <div class="modal fade" tabindex="-1" id="modal_copiar_escala">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Copiar Escala</h5>
            
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                            <!--end::Close-->
                        </div>
            
                        <div class="modal-body" id="div_copiar_escala">
                        
                        </div>
            
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary" id="bt_modal_copiar_escala" onclick="ExecutarAcaoCopiarEscala()">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" id="modal_modulo_escala">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered mw-900px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Escala</h5>

                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                            <!--end::Close-->
                        </div>

                        <div class="modal-body" id="div_modal_escala">

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary" id="bt_modal_salvar_escala">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
    <?php
include_once("modulos/escala/template/js.modal.escala.php");
?>
