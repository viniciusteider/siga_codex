<script type="text/javascript">
    var budgetSlider = document.querySelector("#kt_modal_create_campaign_budget_slider");
    var budgetValue = document.querySelector("#kt_modal_create_campaign_budget_label");
    var activeMap = null,
        activeCircle = null,    //Círculo ativo desenhado no mapa
        circleExists = false,   //Flag sinalizando se o primeiro círculo foi criado
        activeMarker = null,
        markerExists = false,
        value = $('.range-slider-value'), // variaveis do slider do raio
        range = $('.slider-input'),
        slider = $('.slider');

    //Gera o logradouro e o círculo do raio para chamadas externas com lat/lng já preenchidas
    $(document).one("ajaxStop", function(){
        if ($("#latitude").val() != "" && $("#longitude").val() != "") {
            CentralizarLatLng();
        }
    });
    /*
     * Executa o post do formulário
     * */
    $(document).ready(function () {
        
        var raio_padrao = "<?=$linha['raio']?>";
        Mascaras();
        FuncoesFormularioPontoInteresse();
        // noUiSlider.create(budgetSlider, {
        //     start: [raio_padrao],
        //     connect: true,
        //     step: 50,
        //     range: {
        //         "min": 0,
        //         "max": 20000
        //     }
        // });

        // budgetSlider.noUiSlider.on("update", function (values, handle) {
        //     budgetValue.innerHTML = Math.round(values[handle]);
        //     $('#raio').val( Math.round(values[handle])).trigger('change');;
        //     if (handle) {
        //         budgetValue.innerHTML = Math.round(values[handle]);
        //     }
        // });
        $('#raio').change(function() {
            if (circleExists) {
                activeCircle.setOptions({radius: Number($("#raio").val())});
                activeMap.fitBounds(activeCircle.getBounds());
            }
        });

        

        var campos_datas = $("#data_hora");
        campos_datas.daterangepicker({
            singleDatePicker: true,
            "timePicker": true,
            "timePicker24Hour": true,
            showDropdowns: true,
            autoUpdateInput: false,
            minYear: 1900,
            autoApply:true,
            maxYear: parseInt(moment().format("YYYY"),12),
            locale: {
                "format": 'DD/MM/YYYY HH:mm:ss',
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
            $(this).val(picker.startDate.format('DD/MM/YYYY HH:mm:ss'));
        });

        campos_datas.on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
        startTimer(0);

    });

    function startTimer(start) {
        
        var timer = start, minutes, seconds;
        if(tempo_ligacao) {
            clearInterval(tempo_ligacao);
        }
        tempo_ligacao =  setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
            ++timer;

            $('#tempo').val(minutes + ":" + seconds);
            if(minutes <= 1)
                $('#tempo').css("color","green");
            else if(minutes <= 2)
                $('#tempo').css("color","orange");
            else
                $('#tempo').css("color","red");

        }, 1000);
    }

    function FuncoesFormularioPontoInteresse()
    {
        //Verifica se existe latitude/longitude, caso o usuário esteja modificando um registro, para inicializar o mapa com as informações do registro
        var latitude, longitude, zoom = 15, markerOptions;
        if ($("#latitude").val() != "" && $("#longitude").val() != "") {
            var flagModificar = true;
            latitude          = Number($("#latitude").val());
            longitude         = Number($("#longitude").val());
            markerOptions     = {
                draggable: true,
                visible:   true,
                position:  new google.maps.LatLng(latitude, longitude)
            };
        }
        //Opções padrão para mostrar o Brasil
        else {
            latitude      = -15.44051;
            longitude     = -53.23656;
            zoom          = 3;
            markerOptions = null;
        }

        //Instancia o autocomplete de endereço com mapa
        var addressPicker = new AddressPicker({
            map:              {
                id:            '#map',
                zoom:          zoom,
                center:        new google.maps.LatLng(latitude, longitude),
                displayMarker: true
            },
            marker:           markerOptions,
            zoomForLocation:  15,
            draggable:        true,
            reverseGeocoding: true
        });

        activeMap = addressPicker.map;

        //Workaround de um bug do GoogleMaps com o Dialog do bootstrap, onde o mapa não é mostrado corretamente dentro do dialog do bootstrap
        setTimeout(function ()
        {
            google.maps.event.trigger(activeMap, "resize");
            activeMap.setCenter(new google.maps.LatLng(latitude, longitude));
            activeMap.setZoom(zoom);
            if (circleExists) {
                activeMap.fitBounds(activeCircle.getBounds());
            }
        }, 1);

        //Caso o usuário esteja modificando o registro, cria o círculo de acordo com as informações gravadas do registro
        if (flagModificar) {
            circleExists = true;
            activeCircle = new google.maps.Circle({
                strokeColor:   '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight:  2,
                fillColor:     '#FF0000',
                fillOpacity:   0.35,
                map:           activeMap,
                center:        new google.maps.LatLng(latitude, longitude),
                radius:        Number($("#raio").val())
            });
            //Ajusta o zoom para o tamanho do círculo desenhado
            activeMap.fitBounds(activeCircle.getBounds());
        }

        //Ativa o autocomplete no campo de logradouro
        $('#logradouro').typeahead(null, {
            displayKey: 'description',
            source:     addressPicker.ttAdapter()
        });

        //Chama a função sempre que o resultado mudar (opção selecionada no autocomplete ou arrastar a marker)
        addressPicker.bindDefaultTypeaheadEvent($('#logradouro'));
        $(addressPicker).bind('addresspicker:selected', function (event, result)
        {
            CriarMarker(addressPicker.marker.position);
            ManipularResultado(result, addressPicker.marker.position);
        });
        //Adaptação para telefones com 9 dígitos
        //Binda qualquer evento de teclado aos campos de telefone
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
        $('#id_evento,#id_subevento,#id_tipo_solicitante,#id_classificacao,#ligacao_anterior,#id_solicitante').select2({dropdownParent: $('#modal_abertura_atendimento')});
        $("#raio").mask("9999");
        $("#cep").mask("00000-000");
        $("#numero").mask("099999");
        $("#uf").mask("AA");
        $("#latitude, #longitude").mask("-09.0999999", {
            translation: {
                '-': {
                    pattern:  /-/,
                    optional: true
                }
            }
        });

        //altera numero do raio conforme arrasta o slider
        slider.each(function(){
            value.each(function(){
                var value = $(this).prev().attr('value');
                $(this).html(value);
            });
            range.on('input', function(){
                $(this).next(value).html(this.value);
            });
        });

        //depois de 1500ms do última tecla digitada...
        $("#latitude, #longitude").keyup(function () {
            setTimeout(function () {
                CentralizarLatLng();
            }, 1500);
        });

        $('.js-switch').each(function ()
        {
            new Switchery(this, {
                size: 'small'
            });
        });

    }
    function VerifcarTelefone(telefone)
    {
        if(telefone != "")
        {
            var options = [];
            $.getJSON("index_xml.php?app_modulo=ligacoes&app_comando=listar_ligacoes_existentes&telefone="+telefone, function(result) {
                if(result.length > 0)
                {
                    $('#contador').show();
                    $('#contador_numero').html(result.length);
                }
                else
                    $('#contador').hide();
            });
        }

    }

    function my_prettify(n)
    {
        var num = Math.log2(n);
        return n + " m";
    }
    /**
     * Faz o geocode reverso da latlng, desenha o círculo com uma marker no meio e atualiza o logradouro
     * */
    function CentralizarLatLng()
    {
        if ($("#latitude").val() != "" && $("#longitude").val() != "") {
            try {
                var latLng   = new google.maps.LatLng(Number($("#latitude").val()), Number($("#longitude").val()));
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    "latLng": latLng
                }, function (results, status)
                {
                    if (status == google.maps.GeocoderStatus.OK) {
                        CriarMarker(latLng);

                        //popula os campos do Informações Adicionais de acordo com o primeiro resultado (mais relevante)
                        //futuro mantenedor: dê console.log(results) para entender o que está acontecendo aqui embaixo
                        for (var x = 0; x < results[0].address_components.length; x++) {
                            switch (results[0].address_components[x].types[0]) {
                                case 'neighborhood':
                                    $("#bairro").val(results[0].address_components[x].long_name);
                                    break;

                                case 'postal_code':
                                    $("#cep").val(results[0].address_components[x].long_name);
                                    break;

                                case 'locality':
                                case 'administrative_area_level_2':
                                    $("#cidade").val(results[0].address_components[x].long_name);
                                    break;

                                case 'administrative_area_level_1':
                                    $("#uf").val(results[0].address_components[x].short_name);
                                    break;

                                case 'street_number':
                                    $("#numero").val(results[0].address_components[x].long_name);
                                    break;

                                case 'route':
                                    $('#logradouro').val(results[0].address_components[x].long_name);
                                    $('#logradouro_hidden').val(results[0].address_components[x].long_name);
                                    break;
                            }
                        }
                    }
                });
            }
            catch (e) {
                ToastMsg("info","Infelizmente ocorreu um erro inesperado no mapa.<br/>Verifique a sintaxe da latitude e da longitude digitada, respeitando a máscara.");
                console.log(e);
            }

        }
    }

    /**
     * @param LatLng  --> OBJETO INSTANCIADO DE LATITUDE LONGITUDE DO GOOGLE
     * */
    function CriarMarker(LatLng)
    {
        //Checa se existe um círculo desenhado. Se sim, o círculo é apagado
        if (circleExists) {
            activeCircle.setMap(null);
        }
        else {
            circleExists = true;
        }

        //Deleta a marker adicionada via latlng
        if (markerExists) {
            activeMarker.setMap(null);
        }

        //Recebe o raio digitado pelo usuário, 50 metros por padrão
        var raio = 0;
        if ($("#raio").val() > 0) {
            raio = Number($("#raio").val());
        }
        else {
            raio = 50;
        }

        //Desenhando o círculo e guardando sua referência
        activeCircle = new google.maps.Circle({
            strokeColor:   '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight:  2,
            fillColor:     '#FF0000',
            fillOpacity:   0.35,
            map:           activeMap,
            center:        LatLng,
            radius:        raio
        });

        activeMap.fitBounds(activeCircle.getBounds());
    }

    /**
     * Preenche os campos de endereço e desenha o círculo no mapa
     * */
    function ManipularResultado(result, posMarker)
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

        var $rs = result.placeResult.address_components;

        console.log(result);
        let address1 = "";
        let postcode = "";
        let latitude = result.placeResult.geometry.location.lat();
        let longitude = result.placeResult.geometry.location.lng();

        $("#latitude").val(latitude);
        $("#longitude").val(longitude);


        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        // place.address_components are google.maps.GeocoderAddressComponent objects
        // which are documented at http://goo.gle/3l5i5Mr
        for (const component of result.placeResult.address_components) {
            // @ts-ignore remove once typings fixed
            const componentType = component.types[0];
            console.log(component);
            switch (componentType) {
                case "street_number": {
                    address1 = `${component.long_name} ${address1}`;
                    $("#numero").val(component.long_name);
                    $("#numero_predial").val(component.long_name);
                    break;
                }

                case "route": {
                    $('#endereco').val(component.short_name);
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
                case "political":
                case "sublocality_level_1":
                case "sublocality":
                    $("#bairro").val(component.long_name);
                    // document.querySelector("#locality").value = component.long_name;
                    break;
                case "administrative_area_level_1": {
                    $("#estado").val(component.short_name);
                    id_uf = Squall.PegarUf(component.short_name);;
                    $("#id_estado").val(id_uf);
                    break;
                }
                // case "administrative_area_level_2": {
                //     $.get("index_xml.php?app_modulo=cidades&app_comando=filtrar_cidade_id&app_codigo="+id_uf+'&cidade='+component.long_name, function(result) {
                //         $("#cidade").val(result.id);
                //     }, "json" );
                //     $("#cidade").val(component.short_name);
                //     break;
                // }
            }
        }

        $nome_cidade = "";
        if($rs[3].types[0] == 'administrative_area_level_2')
        {
            $nome_cidade = $rs[3].long_name;
            $nome_estado = $rs[4].short_name;

            $.get("index_xml.php?app_modulo=cidades&app_comando=filtrar_cidade_id&app_codigo="+Squall.PegarUf($nome_estado)+'&cidade='+$nome_cidade, function(result) {
                $("#id_cidade").val(result.id);
            }, "json" );
        }
        else if($rs[2].types[0] == 'administrative_area_level_2')
        {
            $nome_cidade = $rs[2].long_name;
            $nome_estado = $rs[3].short_name;
            $.get("index_xml.php?app_modulo=cidades&app_comando=filtrar_cidade_id&app_codigo="+Squall.PegarUf($nome_estado)+'&cidade='+$nome_cidade, function(result) {
                $("#id_cidade").val(result.id);
            }, "json" );
        }
        else if($rs[4].types[0] == 'administrative_area_level_2')
        {
            $nome_cidade = $rs[4].long_name;
            $nome_estado = $rs[5].short_name;
            $.get("index_xml.php?app_modulo=cidades&app_comando=filtrar_cidade_id&app_codigo="+Squall.PegarUf($nome_estado)+'&cidade='+$nome_cidade, function(result) {
                $("#id_cidade").val(result.id);
            }, "json" );
        }
        else
        {
            $nome_cidade = $rs[1].long_name;
            $nome_estado = $rs[2].short_name;
            $.get("index_xml.php?app_modulo=cidades&app_comando=filtrar_cidade_id&app_codigo="+Squall.PegarUf($nome_estado)+'&cidade='+$nome_cidade, function(result) {
                $("#id_cidade").val(result.id);
            }, "json" );
        }

        $("#logradouro").val(result.placeResult.formatted_address);
        $("#latitude").val(posMarker.lat());
        $("#longitude").val(posMarker.lng());
        $("#cidade").val($nome_cidade);
        $("#estado").val($nome_estado);
    }
    function ExecutarAcaoAbertura()
    {
        if (Squall.ValidateForm($("#frm_abertura_ocorrencia"))) {
            // $("#bt_abertura_ocorrencia").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> AGUARDE...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post("index_xml.php?app_modulo=ocorrencias&app_comando=abertura_atendimento&app_codigo",
                $("#frm_abertura_ocorrencia").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        Squall.ToastMsg('success',response["mensagem"]);
                        $('#modal_abertura_atendimento').modal('hide');
                    } else {
                        Squall.ToastMsg('warning',response["mensagem"]);
                    }
                    // $("#bt_abertura_ocorrencia").prop("disabled",false).html("<i class=\"fa fa-check\"></i> SALVAR").removeClass("btn-warning");
                }
                , "json" // definindo retorno para o formato json
            );
        }
    }
</script>
