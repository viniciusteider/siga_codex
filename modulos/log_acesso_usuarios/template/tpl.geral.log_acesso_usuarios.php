<?php
include("modulos/log_acesso_usuarios/template/js.log_acesso_usuarios.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Log Acesso Usuarios";
echo $objApp->GerarBreadCrumb($configTitulo);
?>
<div id="kt_app_content_container" class="app-container  p-0">
    <form action="#" method="post" id="frm_log" name="frm_log">
        <input type="hidden" name="pagina" id="pagina" value="<?=$_SESSION['FILTRO_LOG']['pagina']?>">
        <input type="hidden" name="ordem" id="ordem" value="<?=$_SESSION['FILTRO_LOG']['ordem']?>">
        <input type="hidden" name="filtro" id="filtro" value="<?=$_SESSION['FILTRO_LOG']['filtro']?>">
        <input type="hidden" name="retomar_filtro" id="retomar_filtro" value="<?=$_SESSION['FILTRO_LOG']['retomar_filtro']?>">
        <input type="hidden" name="numero_registro_hidden" id="numero_registro_hidden" value="<?=$_SESSION['FILTRO_LOG']['numero_registro_hidden']?>">
        <div class="card shadow-sm">
            <div class="card-body" id="filtro">
                <div class="row">

                    <?php

                    if($_SESSION['usuario']['id_usuario_tipo'] != 2)
                    {
                        echo '     <div class="col-md-4  ">
                            <div class="form-group">
                                <label class="form-label" for="usuario_filtro">Usuários</label>
                                <select name="usuario_filtro" id="usuario_filtro"  class=" form-select" data-placeholder="Selecione o Fotógrafo" data-validar="select2"  >
                                ';
                        if($_SESSION['FILTRO_MOBILE']['usuario_filtro'] != "")
                        {
                            $objuser =  new Usuario();
                            $user = $objuser->ListarUsuarioSelecionado($_SESSION['FILTRO_LOG']['usuario_filtro']);
                            echo Componente::GerarCombo($user,'id','nome',$_SESSION['FILTRO_LOG']['usuario_filtro'],'','');
                        }

                        echo '</select>
                            </div>
                        </div>';
                    }
                    ?>

                    <div class="col-md-4  ">
                        <div class="form-group">
                            <label class="form-label" for="periodo">Período</label>
                            <div class="input-group mb-5">
                                <input type="text" class="form-control mask-data  validar-obrigatorio" placeholder="selecione um data" name="periodo"  value="<?=$_SESSION['FILTRO_LOG']['periodo']?>"  id="periodo" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">
                                <i class="fas fa-calendar fs-4"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-search col-md-4" >
                        <label class="form-label" for="nome">Buscar por:</label>
                        <div class="input-group ">
                            <input type="text" value="<?=$_SESSION['FILTRO_LOG']['busca']?>" class="form-control" id="busca" name="busca" placeholder="Busca por: Nome, grupo ou usuário">
                            <button type="button" class="btn  btn-success"  id="bt_filtrar" onclick="AtualizarGridLogAcessoUsuarios(0,'');"> <i class="fas fa-filter"></i> Filtrar</button>
                        </div><!-- .form-group -->
                    </div>
                    <div class="col-md-3  pt-8 ">

                    </div>

                </div>
            </div>
        </div>
    </form>
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title"> Log Acesso Usuarios</h3>
        </div>
        <div class="card-body" id="conteudo_log_acesso_usuarios">
        </div>
    </div>
</div>


<div class="modal fade" id="modal-log-acesso">
    <div class="modal-dialog mw-750px">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Dados do Acesso</h3>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body" id="conteudo_log">

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
