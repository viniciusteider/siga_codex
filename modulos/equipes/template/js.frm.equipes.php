<script type="text/javascript">


    var fixHelperModified = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        },
        updateIndex = function(e, ui) {

            $('td.index', ui.item.parent()).each(function (i) {
                $(this).html(i+1);
            });
            $('input[type=text]', ui.item.parent()).each(function (i) {
                $(this).val(i + 1);
            });
        };

    /*
     * Executa o post do formulário
     * */
    $(document).ready(function () {
        $("#bt_salvar").click(function () {
            var id = $('#id').val();
            var tipo = 1;

            if(id != "")
                url = "index_xml.php?app_modulo=equipes&app_comando=atualizar_equipes&app_codigo";
            else
                url = "index_xml.php?app_modulo=equipes&app_comando=adicionar_equipes&app_codigo";


            ExecutarAcao(url);
        });
        Mascaras();
        Squall.autoComplete('#id_coordenador', 'index_xml.php?app_modulo=usuario&app_comando=popup_localizar_usuarios');
        Squall.autoComplete('#id_escala_tipo', 'index_xml.php?app_modulo=escala_tipo&app_comando=listar_escala_tipo_autocomplete');
        $("#tb_equipe tbody").sortable({
            helper: fixHelperModified,
            stop: updateIndex
        }).disableSelection();

        $("tbody").sortable({
            distance: 5,
            delay: 100,
            opacity: 0.6,
            cursor: 'move',
            update: function() {}
        });


        $('#tb_equipe').repeater({
            initEmpty: false,
            ready: function ()
            {
                Squall.autoComplete($('[data-kt-repeater="id_efetivo"]'), 'index_xml.php?app_modulo=usuario&app_comando=popup_localizar_usuarios');
            },
            show: function () {
                $(this).slideDown();
                Squall.autoComplete($(this).find('[data-kt-repeater="id_efetivo"]'), 'index_xml.php?app_modulo=usuario&app_comando=popup_localizar_usuarios');
                var contador = $('[data-kt-repeater="ordem"]').length;
                $(this).find('[data-kt-repeater="ordem"]').val(contador);

            },
            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
                $("#tb_equipe tbody").sortable("refresh");
            },
            isFirstItemUndeletable: true
        });


    });
    function ExecutarAcao(url)
    {
        if (Squall.ValidateForm($("#frm_equipes"))) {
            $("#bt_salvar").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post(url,
                $("#frm_equipes").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        Squall.ToastMsg('success',response["mensagem"],"#index_xml.php?app_modulo=equipes&app_comando=listar_equipes",'600');

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
