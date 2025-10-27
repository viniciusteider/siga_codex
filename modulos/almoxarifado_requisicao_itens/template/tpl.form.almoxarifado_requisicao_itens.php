<form action="#" name="frm_almoxarifado_requisicao_itens" id="frm_almoxarifado_requisicao_itens" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_requisicao">Id Requisicao:</label>
                    <input type="text" name="id_requisicao"  id="id_requisicao" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_requisicao'];?>"/>
                    <div class="text-muted"> Preencha o campo  Id Requisicao </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_produto">Id Produto:</label>
                    <input type="text" name="id_produto"  id="id_produto" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_produto'];?>"/>
                    <div class="text-muted"> Preencha o campo  Id Produto </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="quantidade">Quantidade:</label>
                    <input type="text" name="quantidade"  id="quantidade" maxlength="" class="form-control  mask-numero" value="<?=$linha['quantidade'];?>"/>
                    <div class="text-muted"> Preencha o campo  Quantidade </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="descricao">Descricao:</label>
                    <input type="text" name="descricao"  id="descricao" maxlength="100" class="form-control  " value="<?=$linha['descricao'];?>"/>
                    <div class="text-muted"> Preencha o campo  Descricao </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="cautela">Cautela:</label>
                    <input type="text" name="cautela"  id="cautela" maxlength="1" class="form-control  mask-numero" value="<?=$linha['cautela'];?>"/>
                    <div class="text-muted"> Preencha o campo  Cautela </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_usuario_baixa">Id Usuario Baixa:</label>
                    <input type="text" name="id_usuario_baixa"  id="id_usuario_baixa" maxlength="" class="form-control  mask-numero" value="<?=$linha['id_usuario_baixa'];?>"/>
                    <div class="text-muted"> Preencha o campo  Id Usuario Baixa </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_hora_retorno">Data Hora Retorno:</label>
                    <input type="text" name="data_hora_retorno"  id="data_hora_retorno"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['data_hora_retorno'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Hora Retorno </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_hora_entrega">Data Hora Entrega:</label>
                    <input type="text" name="data_hora_entrega"  id="data_hora_entrega"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['data_hora_entrega'],$_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Data Hora Entrega </div>
                </div>
            </div>
            <!--/span-->
        </div>
</form>
