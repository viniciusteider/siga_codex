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
            url = "index_xml.php?app_modulo=escala_flex&app_comando=atualizar_escala_flex&app_codigo";
        }
        else
        {
            url = "index_xml.php?app_modulo=escala_flex&app_comando=adicionar_escala_flex&app_codigo";
        }

        ExecutarAcao(url);
    });
       Mascaras();

    new tempusDominus.TempusDominus(document.getElementById("data_hora_entrada"), {
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
    // Squall.autoComplete('#id_equipe', 'index_xml.php?app_modulo=equipes&app_comando=listar_equipes_autocomplete');
    Squall.autoComplete('#id_usuario', 'index_xml.php?app_modulo=usuario&app_comando=popup_localizar_usuarios');
    Squall.autoComplete($('[data-kt-repeater="id_efetivo"]'), 'index_xml.php?app_modulo=usuario&app_comando=popup_localizar_usuarios');

        $('#kt_docs_repeater_basic').repeater({
            initEmpty: false,
            ready: function ()
            {
                Squall.autoComplete($('[data-kt-repeater="id_equipe"]'), 'index_xml.php?app_modulo=equipes&app_comando=listar_equipes_autocomplete',null,null);
                $('[data-kt-repeater="id_local"]').select2();
                $('[data-kt-repeater="data_hora_entrada"]').tempusDominus({
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
                $('[data-kt-repeater="data_hora_saida"]').tempusDominus({
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

            },
            show: function () {
                $(this).slideDown();
                Squall.autoComplete($(this).find('[data-kt-repeater="id_equipe"]'), 'index_xml.php?app_modulo=equipes&app_comando=listar_equipes_autocomplete',null,null);
                $(this).find('[data-kt-repeater="id_local"]').select2();
                $(this).find('[data-kt-repeater="data_hora_entrada"]').tempusDominus({
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
                $(this).find('[data-kt-repeater="data_hora_saida"]').tempusDominus({
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

            },
            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },
            isFirstItemUndeletable: true
        });



});
function ExecutarAcao(url)
{
	    if (Squall.ValidateForm($("#frm_escala_flex"))) {
    $("#bt_salvar").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
		// ao clicar em salvar enviando dados por post via AJAX
		$.post(url,
			$("#frm_escala_flex").serialize(),
			// pegando resposta do retorno do post
			function (response)
			{
				if (response["codigo"] == 0) {
                    Squall.ToastMsg('success',response["mensagem"],"#index_xml.php?app_modulo=escala_flex&app_comando=listar_escala_flex",'600');

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
