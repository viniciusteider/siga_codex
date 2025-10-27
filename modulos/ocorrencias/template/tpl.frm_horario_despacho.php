<form action="#" name="frm_horarios_despacho" id="frm_horarios_despacho" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$_REQUEST['id'];?>"/>
    <input type="hidden" name="pos"  id="pos"   value="<?=$_REQUEST['pos'];?>"/>
    <input type="hidden" name="id_despacho"  id="id_despacho"   value="<?=$_REQUEST['id_despacho'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label class="form-label" for="nome">Horário</label>
                    <input type="text" name="horario_despacho_alterecao"  id="horario_despacho_alterecao" maxlength="50" class="form-control  " value="<?=Conexao::PrepararDataPHP($horario, $_SESSION['usuario']['timezone']);?>"/>
                    <div class="text-muted"> Preencha o campo  Nome </div> </div>
            </div>
            <!--/span-->
        </div>
</form>
<script>
    $(function (){
        new tempusDominus.TempusDominus(document.getElementById("horario_despacho_alterecao"), {
            localization: {
                locale: "pt-br",
                startOfTheWeek: 1,
                format: "dd/MM/yyyy HH:mm:ss"
            },
            display: {
                icons: {
                    time: "ki-outline ki-time fs-1",
                    date: "ki-outline ki-calendar fs-1",
                    up: "ki-outline ki-up fs-1",
                    down: "ki-outline ki-down fs-1",
                    previous: "ki-outline ki-left fs-1",
                    next: "ki-outline ki-right fs-1",
                    today: "ki-outline ki-check fs-1",
                    clear: "ki-outline ki-trash fs-1",
                    close: "ki-outline ki-cross fs-1",
                },
                buttons: {
                    today: true,
                    clear: true,
                    close: true,
                },
            }
        });
    });

    function ExecutarHoraiosDespacho()
    {
        if (Squall.ValidateForm($("#frm_horarios_despacho"))) {
            $("#bt_horario_dispacho").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post("index_xml.php?app_modulo=ocorrencias&app_comando=alterar_horario_despacho&app_codigo",
                $("#frm_horarios_despacho").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        Squall.ToastMsg('success',response["mensagem"]);
                        $('#modal_horarios_despacho').modal('hide');
                        $('#div_atualizar_ocorrencia').load('index_xml.php?app_modulo=ocorrencias&app_comando=frm_atualizar_ocorrencia_modal&app_codigo='+response['id_despacho']);
                    } else {
                        Squall.ToastMsg('warning',response["mensagem"]);
                    }
                    $("#bt_horario_dispacho").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Alterar").removeClass("btn-warning");
                }
                , "json" // definindo retorno para o formato json
            );
        }
    }
</script>