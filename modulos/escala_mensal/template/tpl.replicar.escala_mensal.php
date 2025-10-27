<form action="#" name="frm_replicar_escala" id="frm_replicar_escala" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_hora_entrada">Copiar de:</label>
                    <input type="text" name="data_copia"  id="data_copia"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['data_copia'],$_SESSION['usuario']['timezone']);?>"/>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="data_hora_saida">Para a Data:</label>
                    <input type="text" name="data_para"  id="data_para"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['data_para'],$_SESSION['usuario']['timezone']);?>"/>
                </div>
            </div>
            <!--/span-->
        </div>
</form>
<script>
    $(function (){
        $('#data_copia,#data_para').tempusDominus({
            localization: {
                locale: "pt-br",
                format: "dd/MM/yyyy"
            },
            display: {
                components: {
                    calendar: true,
                    date: true,
                    month: true,
                    year: true,
                    decades: false,
                    clock: false,
                    hours: false,
                    minutes: false,
                    seconds: false,
                    useTwentyfourHour: undefined
                }
            }
        });
    });
</script>
