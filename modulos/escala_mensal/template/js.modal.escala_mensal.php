<script type="text/javascript">

    /*
     * Executa o post do formulário
     * */
    $(document).ready(function () {
        Mascaras();
    });
    function ExecutarAcaoReplicarEscala()
    {
        if (Squall.ValidateForm($("#frm_replicar_escala"))) {
            $("#bt_replicar_salvar_escala_mensal").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            var data_copia = $('#data_copia').val();
            var data_para = $('#data_para').val();
            $('#modal_modulo_escala_mensal').modal('hide');
            window.location.href='#index_xml.php?app_modulo=escala_mensal&app_comando=replicar_escala_mensal&data_copia='+data_copia+'&data_para='+data_para;

        }
    }
</script>
