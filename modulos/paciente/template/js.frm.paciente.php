<script type="text/javascript">

    /*
     * Executa o post do formulário
     * */
    $(document).ready(function () {
        $("#bt_modal_salvar_paciente").click(function () {
            var id = $('#id').val();
            var tipo = 1;

            if(id != "")
            {
                url = "index_xml.php?app_modulo=paciente&app_comando=atualizar_paciente&app_codigo";
            }
            else
            {
                url = "index_xml.php?app_modulo=paciente&app_comando=adicionar_paciente&app_codigo";
            }

            ExecutarAcao(url);
        });
        Mascaras();
        Squall.autoComplete('#id_tipo_obstetricia', 'index_xml.php?app_modulo=tipo_obstetricia&app_comando=listar_tipo_obstetricia_autocomplete');
        Squall.autoComplete('#id_respiracao', 'index_xml.php?app_modulo=respiracao&app_comando=listar_respiracao_autocomplete');
        Squall.autoComplete('#id_vias_aereas', 'index_xml.php?app_modulo=vias_aereas&app_comando=listar_vias_aereas_autocomplete');
        Squall.autoComplete('#id_hospital', 'index_xml.php?app_modulo=hospital&app_comando=listar_hospital_autocomplete');
        Squall.autoComplete('#id_etnia', 'index_xml.php?app_modulo=pessoal_etnia&app_comando=listar_pessoal_etnia_autocomplete');
        Squall.autoComplete('#id_pupilas', 'index_xml.php?app_modulo=pupilas_sintomas&app_comando=listar_pupilas_sintomas_autocomplete');

        $('#sexo,#id_estado ,#id_cidade,#id_situacao,#tipo_encaminhamento').select2({language: "pt-BR"});
        const input = document.getElementById("logradouro");
        const options = {
            fields: ["address_components", "geometry"],
            types: ["address"]
        };
        autocomplete = new google.maps.places.Autocomplete(input, options);
        autocomplete.addListener("place_changed",ManipularResultado);

        $("#telefone, #celular, #comercial").keydown(function ()
        {
            //Recebe o elemento ativo
            var focus = $(document.activeElement);

            //Timeout para pegar o valor do campo depois do evento, sem ele, o valor é testado antes do evento ser finalizado
            setTimeout(function ()
            {
                //Se o campo focado é algum dos 3 campos de telefone, aplica a máscara de acordo
                if (focus.attr('id') == "telefone" || focus.attr('id') == "celular" || focus.attr('id') == "comercial") {
                    if (focus.val().length <= 14) {
                        focus.unmask();
                        focus.mask("(00) 0000-00009");
                    }
                    else {
                        focus.unmask();
                        focus.mask("(00) 00000-0000");
                    }
                }
            }, 10);
        });

        var campos_datas = $("#data_recebimento");
        campos_datas.daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: false,
            minYear: 1900,
            autoApply:true,
            maxYear: parseInt(moment().format("YYYY"),12),
            locale: {
                "format": 'DD/MM/YYYY',
                "separator": ' - ',
                "applyLabel": 'Confirmar',
                "cancelLabel": 'Cancelar',
                "daysOfWeek": [
                    "Dom",
                    "Seg",
                    "Ter",
                    "Qua",
                    "Qui",
                    "Sex",
                    "Sab"
                ],
                "monthNames": [
                    "Jan",
                    "Fev",
                    "Mar",
                    "Abr",
                    "Mai",
                    "Jun",
                    "Jul",
                    "Ago",
                    "Set",
                    "Out",
                    "Nov",
                    "Dez"
                ],
                "firstDay" : 0
            }
        });
        campos_datas.on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY'));
        });

        campos_datas.on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });

    function ManipularResultado()
    {
        //Limpando as variáveis, por segurança
        $("#bairro").val("");
        $("#id_estado").val("").trigger('change');
        $("#id_estado").val("").trigger('change');
        $("#numero").val("");
        $("#numero_predial").val("");
        $('#logradouro').val("");
        $("#latitude").val("");
        $("#longitude").val("");



        // Get the place details from the autocomplete object.
        const place = autocomplete.getPlace();
        let address1 = "";
        let postcode = "";
        let latitude = place.geometry.location.lat();
        let longitude = place.geometry.location.lng();

        $("#latitude").val(latitude);
        $("#longitude").val(longitude);

        $rs = place.address_components;

        console.log($rs);
        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        // place.address_components are google.maps.GeocoderAddressComponent objects
        // which are documented at http://goo.gle/3l5i5Mr
        for (const component of place.address_components) {
            // @ts-ignore remove once typings fixed
            const componentType = component.types[0];

            switch (componentType) {
                case "street_number": {
                    address1 = `${component.long_name} ${address1}`;
                    $("#numero").val(component.long_name);
                    $("#numero_predial").val(component.long_name);
                    break;
                }

                case "route": {
                    $('#logradouro').val(component.short_name);
                    address1 += component.short_name;
                    break;
                }

                case "postal_code": {
                    postcode = `${component.long_name}${postcode}`;
                    break;
                }

                case "postal_code_suffix": {
                    postcode = `${postcode}-${component.long_name}`;
                    break;
                }
                case "locality":
                case "sublocality_level_1":
                case "sublocality":
                    $("#bairro").val(component.long_name);
                    // document.querySelector("#locality").value = component.long_name;
                    break;
                case "administrative_area_level_1":
                    $("#estado").val(component.short_name);
                    var id_estado = $(`#id_estado option[data-value ='${component.short_name}']`).val();
                    $("#id_estado").val(id_estado).trigger("change");
                    break;

            }
        }
        if($rs[3].types[0] == 'administrative_area_level_2')
        {
            setTimeout(function(){
                var id_cidade = $(`#id_cidade option:contains('${$rs[3].long_name}')`).val().trigger('change');
                // $('#id_cidade').val(id_cidade).trigger('change');
            }, 1500);
        }
        else if($rs[2].types[0] == 'administrative_area_level_2')
        {
            setTimeout(function(){
                var id_cidade = $(`#id_cidade option:contains('${$rs[2].long_name}')`).val().trigger('change');
                // $('#id_cidade').val(id_cidade)
            }, 1500);
        }
        else if($rs[4].types[0] == 'administrative_area_level_2')
        {
            setTimeout(function(){
                var id_cidade = $(`#id_cidade option:contains('${$rs[4].long_name}')`).val().trigger('change');
                // $('#id_cidade').val(id_cidade).trigger('change');
            }, 1500);
        }
        else
        {
            setTimeout(function(){
                var id_cidade = $(`#id_cidade option:contains('${$rs[1].long_name}')`).val().trigger('change');
            }, 1500);
        }
    }

    function ExecutarAcao(url)
    {
        if (Squall.ValidateForm($("#frm_paciente"))) {
            $("#bt_salvar").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post(url,
                $("#frm_paciente").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        Squall.ToastMsg('success',response["mensagem"],"#index_xml.php?app_modulo=paciente&app_comando=listar_paciente",'600');

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
