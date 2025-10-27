<script type="text/javascript">

    /*
     * Executa o post do formulário
     * */
    $(document).ready(function () {
        $("#bt_salvar").click(function () {
            var id = $('#id').val();
            var tipo = 1;

            if(id != "")
            {
                url = "index_xml.php?app_modulo=hospital_disponibilidade&app_comando=atualizar_hospital_disponibilidade&app_codigo";
            }
            else
            {
                url = "index_xml.php?app_modulo=hospital_disponibilidade&app_comando=adicionar_hospital_disponibilidade&app_codigo";
            }

            ExecutarAcao(url);
        });
        Squall.GerarMascaras();
        Squall.autoComplete('#id_hospital', 'index_xml.php?app_modulo=hospital&app_comando=listar_hospital_autocomplete',null,'TratarDadosHospital');
    });
    function TratarDadosHospital(dados)
    {
        console.log(dados);
        $('#vagas_uti').val(dados.vagas_uti);
        $('#total_leitos').val(dados.vagas_leitos);
        $('#complexidade').val(dados.complexidade);
    }
    function ExecutarAcao(url)
    {
        if (Squall.ValidateForm($("#frm_hospital_disponibilidade"))) {
            $("#bt_salvar").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post(url,
                $("#frm_hospital_disponibilidade").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        Squall.ToastMsg('success',response["mensagem"],"#index_xml.php?app_modulo=hospital_disponibilidade&app_comando=listar_hospital_disponibilidade",'600');

                    } else {
                        Squall.ToastMsg('warning',response["mensagem"]);
                    }
                    $("#bt_salvar").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
                }
                , "json" // definindo retorno para o formato json
            );
        }
    }
</script>
