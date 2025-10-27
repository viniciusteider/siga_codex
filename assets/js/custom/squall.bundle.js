var config_squall = {
    id: '#squall',
    conteudo:'#conteudo',
    class: 'squallClass',
    isMobile: ((/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) || window.innerWidth < 767),
    ajax: {
        attr: 'data-toggle="ajax"',
        clearOption: '',
        error: {
            html: '<div class="px-3 text-center fs-20px"><i class="fa fa-warning fa-lg text-muted me-1"></i> <span class="fw-600 text-inverse">Error 404! Page not found.</span></div>'
        }
    },
    menu:
        {
            id: "#kt_app_sidebar_menu_wrapper",
            classAtivo: "active",
            itemClass: "menu-link"
        }
};

var getParents = function(el, parentSelector) {
    if (parentSelector === undefined) {
        parentSelector = document;
    }
    var parents = [];
    var p = el.parentNode;

    while (p !== parentSelector) {
        var o = p;
        parents.push(o);
        p = o.parentNode;
    }
    parents.push(parentSelector);
    return parents;
};

const loadingEl = document.createElement("div");
var Squall = function (){
    var setting;
    return {
        emptyHtml: '',
        init: function(option) {
            if (option) {
                setting = option;
            }
            this.initHashChange();
            this.initToggler();
            this.initDefaultUrl();
            this.LoadingAjax();
            this.ClickScrollMouse();
        },
        ClickScrollMouse : function ()
        {
            $(document).mouseup(function(event) {
                event.preventDefault();
                // console.log(event.target);
                switch (event.which) {
                    case 2:
                        if(event.target.parentNode.href != undefined)
                        {
                            window.open('index.php#'+event.target.parentNode.href);
                        }
                        break;
                }
            });
        },
        GerarLogradouro: function (vetor,index,ultimas)
        {
            var loading = "<i class=\"fa fa-spin fa-spinner\"></i>";
            $(vetor[index].id).html(loading);
            $.ajax({
                url : "index_xml.php?app_modulo=logradouro&app_comando=gerar_logradouro&ultimas="+ultimas,
                data: { latitude: vetor[index].lat, longitude : vetor[index].lon, id_posicao: vetor[index].id_posicao},
                dataType: 'json',
                beforeSend : function(){
                    KTApp.hidePageLoading();
                },
                complete: function(result){
                    $(vetor[index].id).html(result.responseJSON.logradouro);
                    index = index + 1;
                    if(index < vetor.length)
                        Squall.GerarLogradouro(vetor,index,ultimas);
                }
            });


        },
        BuscarCep: function(cep)
        {
            var cep_final = cep.replace("-","");
            var url = 'https://viacep.com.br/ws/'+ cep_final +'/json/';
            if($('#logradouro').val() == "")
            {
                $.getJSON(url, function(result) {
                    if(result.uf != ""){
                        console.log(result);
                        $('#logradouro').val(result.logradouro);
                        $('#bairro').val(result.bairro);
                        $('#numero').val(result.numero);
                        $('#cidade').val(result.localidade);
                        $('#estado').val(result.uf);
                        id_uf = Squall.PegarUf(result.uf);
                        $("#id_estado").val(id_uf).trigger("change");
                        setTimeout(function(){
                            Squall.PegarCidadeSelect(id_uf,result.localidade,'#id_cidade');
                        }, 2000);
                    }
                    if (("erro" in result)) {
                        Squall.ToastMsg('warning','CEP não encontrado!');
                    }
                });
            }
        },
        initDefaultUrl: function() {
            this.emptyHtml = (setting && setting.emptyHtml) ?  setting.emptyHtml : config_squall.ajax.error.html;
            this.defaultUrl = (setting && setting.ajaxDefaultUrl) ? setting.ajaxDefaultUrl : 'index_xml.php?app_modulo=home&app_comando=home';
            this.defaultUrl = (window.location.hash) ? window.location.hash : this.defaultUrl;

            if (this.defaultUrl === '') {
                var elm = document.querySelector(config_squall.conteudo);
                if (elm) {
                    elm.innerHTML = this.emptyHtml;
                }
            } else {
                this.renderAjax(this.defaultUrl, '', true);
            }
        },
        maskMercosul: function (selector) {
            var MercoSulMaskBehavior = function (val) {
                    var myMask = 'AAA0A00';
                    var mercosul = /([A-Za-z]{3}[0-9]{1}[A-Za-z]{1})/;
                    var normal = /([A-Za-z]{3}[0-9]{2})/;
                    var replaced = val.replace(/[^\w]/g, '');
                    if (normal.exec(replaced)) {
                        myMask = 'AAA-0000';
                    } else if (mercosul.exec(replaced)) {
                        myMask = 'AAA-0A00';
                    }
                    return myMask;
                },
                mercoSulOptions = {
                    onKeyPress: function (val, e, field, options) {
                        field.mask(MercoSulMaskBehavior.apply({}, arguments), options);
                    }
                };
            $(function () {
                $(selector).bind('paste', function (e) {
                    $(this).unmask();
                });
                $(selector).bind('input', function (e) {
                    $(selector).mask(MercoSulMaskBehavior, mercoSulOptions);
                });
            });
        },
        PegarCidade : function(id_uf,cidade,campo)
        {
            $.get("index_xml.php?app_modulo=cidades&app_comando=filtrar_cidade_id&app_codigo="+id_uf+'&cidade='+cidade, function(result) {
                $(campo).val(result.id);
            }, "json" );
        },
        PegarCidadeSelect : function(id_uf,cidade,campo)
        {
            $.get("index_xml.php?app_modulo=cidades&app_comando=filtrar_cidade_id&app_codigo="+id_uf+'&cidade='+cidade, function(result) {
                // $(campo).val(result.id).trigger('change');
                setTimeout(function(){$(campo).val(result.id).trigger('change'); }, 1000);
            }, "json" );
        },
        FiltrarCidades : function(id)
        {
            var options = [];
            $.getJSON("index_xml.php?app_modulo=cidades&app_comando=filtrar_cidade&app_codigo="+id, function(result) {
                options.push('<option value="">-- Selecione uma Cidade --</option>');
                for (var i = 0; i < result.length; i++)
                {
                    options.push('<option value="',
                        result[i].id, '">',
                        result[i].nome, '</option>');
                }
                $("#id_cidade").html(options.join(''));
            });
        },
        PegarUf : function(uf)
        {
            var id_estado = 0;
            switch (uf)
            {
                case "AM": id_estado = 13;   break;
                case "RR": id_estado = 14;   break;
                case "RO": id_estado = 11;   break;
                case "AC": id_estado = 12;   break;
                case "MT": id_estado = 51;   break;
                case "GO": id_estado = 52;   break;
                case "MS": id_estado = 50;  break;
                case "PI": id_estado = 22;  break;
                case "CE": id_estado = 23;  break;
                case "RN": id_estado = 24;  break;
                case "PE": id_estado = 26;  break;
                case "PB": id_estado = 25;  break;
                case "AL": id_estado = 27;  break;
                case "SE": id_estado = 28;  break;
                case "PR": id_estado = 41;  break;
                case "SC": id_estado = 42;  break;
                case "RS": id_estado = 42;  break;
                case "MG": id_estado = 31;  break;
                case "SP": id_estado = 35;  break;
                case "RJ": id_estado = 33;  break;
                case "ES": id_estado = 32;  break;
                case "PA": id_estado = 15; break;
                case "TO": id_estado = 17; break;
                case "MA": id_estado = 21; break;
                case "BA": id_estado = 29; break;
                case "DF": id_estado = 53; break;
                case "AP": id_estado = 16; break;
                // case "  ": id_estado = 0;   break;
            }
            return id_estado;
        },
        GerarMascaras: function()
        {
            // Máscara para 4 dígitos
            $(".mask-ano").mask("9999");
            // Máscara para CEP
            $('.mask-cep').mask('99999-999');
            // Máscara para CNPJ
            $('.mask-cnpj').mask('99.999.999/9999-99');
            // Máscara para CPF
            $('.mask-cpf').mask('000.000.000-00');
            // Máscara para o datepicker
            $('.mask-data').mask("99/99/9999");
            $('.mask-data-time').mask("99/99/9999 99:99:99");
            $('.mask-periodo').mask("99/99/9999 - 99/99/9999");
            // Máscara para dia
            $(".mask-dia").mask("?99");
            // Máscara para DDD
            $(".mask-ddd").mask("99");
            // Máscara Telefone sem ddd
            $('.mask-tel').mask("0000-0000");
            $(".mask-dinheiro").maskMoney({showSymbol:false, decimal:",", thousands:"."});
            $(".mask-number-float").maskMoney({showSymbol:false, decimal:".", thousands:""});
            $(".mask-number-float-negative").mask("Z0999999.00", {
                translation: {
                    '0': {pattern: /\d/},
                    '9': {pattern: /\d/, optional: true},
                    'Z': {pattern: /[\-\+]/, optional: true}
                }
            });
            $(".mask-teperatura").mask("Z09.000", {
                translation: {
                    '0': {pattern: /\d/},
                    '9': {pattern: /\d/, optional: true},
                    'Z': {pattern: /[\-\+]/, optional: true}
                }
            });
            // Máscara para horário
            $('.mask-horario').mask("99:99");
            //Máscara ip
            $('.ip_address').mask("099.099.099.099");
            //numeros negativos
            $(".negative").mask("S#############", {
                translation: {
                    'S': {
                        pattern: /-/,
                        optional: true
                    }
                }
            });
            // Máscara para letras sem limite de tamanho
            $(".mask-letras").bind("input", function (event) {
                var out = "";
                var str = this.value;
                for (var i = 0; i < str.length; i++) {
                    if (/[A-Za-z]/.test(str.charAt(i))) {
                        out = out.concat(str.charAt(i));
                    }
                }
                this.value = out;
            });
            // Máscara para números sem limite de tamanho
            $(".mask-numeros").bind("input", function (event) {
                var out = "";
                var str = this.value;
                for (var i = 0; i < str.length; i++) {
                    if (/[0-9]/.test(str.charAt(i))) {
                        out = out.concat(str.charAt(i));
                    }
                }
                this.value = out;
            });
            // Máscara para números de até 11 casas
            $(".mask-numeros-11").mask("99999999999");

            // Máscara para parcelas
            $('.mask-parcelas').mask('9?9');

            // Máscara para Placas
            Squall.maskMercosul('.mask-placa');
            // Máscara de celular para troca do hífen em caso de 9 dígitos
            $('.mask-celular').focus(function()
            {
                var phone, element;
                element = $(this);
                phone = element.val();

                if(phone.length <= 9)
                {
                    element.unmask();
                    element.mask("(00) 0000-00009");
                }
                else if(phone.length >= 10)
                {
                    element.unmask();
                    element.mask("(00) 00000-0000");
                }

            }).trigger('focus');
            $('.mask-telefone').mask("(00) 0000-0000");

            // Máscara para UF
            $(".mask-uf").mask("SS");
            $(".mask-uf").mask("xx", {
                translation: {
                    'x': {
                        pattern:  /[A-Za-z]/
                    }
                }
            });
            // Máscara para 0800
            $(".mask-zero800").mask("0800-9999999");
            //Máscara apenas números
            $(".mask-numero").mask("0#");
            (function ($) {
                $.fn.cpfcnpj = function (options) {
                    // Default settings
                    var settings = $.extend({
                        mask: false,
                        validate: 'cpfcnpj',
                        event: 'focusout',
                        handler: $(this),
                        validateOnlyFocus: false,
                        ifValid: null,
                        ifInvalid: null,
                        returnType: null
                    }, options);

                    if (settings.mask) {
                        if (jQuery().mask == null) {
                            settings.mask = false;
                            console.log("jQuery mask not found.");
                        }
                        else {
                            var masks = ['000.000.000-009', '00.000.000/0000-00'];
                            var ctrl = $(this);
                            if (settings.validate == 'cpf') {
                                ctrl.mask(masks[0]);
                            }
                            else if (settings.validate == 'cnpj') {
                                ctrl.mask(masks[1]);
                            }
                            else {
                                var cpfCnpjMsk = function (val) {
                                    return val.length === 0 || val.length >= 12 ? masks[1] : masks[0];
                                }

                                var opt = {
                                    onChange: function (val, e, currentField) {
                                        var field = $(currentField);
                                        var value = field.cleanVal();
                                        field.mask(cpfCnpjMsk(value), opt);
                                    }
                                };
                                ctrl.mask(cpfCnpjMsk, opt);
                            }
                        }
                    }

                    return this.each(function () {
                        var valid = null;
                        var control = $(this);

                        $(document).unbind(settings.event).on(settings.event, settings.handler,
                            function () {
                                if (!settings.validateOnlyFocus || settings.validateOnlyFocus && control.is(':focus')) {
                                    var value = control.val();
                                    var lgt = value.length;
                                    returnType = null;

                                    valid = false;

                                    if (lgt == 11 || lgt == 14 || lgt == 18) {
                                        if (settings.validate == 'cpf') {
                                            valid = validate_cpf(value, settings.mask);
                                        }
                                        else if (settings.validate == 'cnpj') {
                                            valid = validate_cnpj(value, settings.mask)
                                        }
                                        else if (settings.validate == 'cpfcnpj') {
                                            if (validate_cpf(value, settings.mask)) {
                                                valid = true;
                                                returnType = 'cpf';
                                            }
                                            else if (validate_cnpj(value, settings.mask)) {
                                                valid = true;
                                                returnType = 'cnpj';
                                            }
                                        }
                                    }

                                    if ($.isFunction(settings.ifValid)) {
                                        if (valid != null && valid) {
                                            if ($.isFunction(settings.ifValid)) {
                                                var callbacks = $.Callbacks();
                                                callbacks.add(settings.ifValid);
                                                callbacks.fire(control);
                                            }
                                        }
                                        else if ($.isFunction(settings.ifInvalid)) {
                                            settings.ifInvalid(control);
                                        }
                                    }
                                }
                            });
                    });
                }

                function validate_cnpj(val, msk) {
                    val = val.replace(/[^\d]+/g, '');

                    // Elimina CNPJs inválidos conhecidos
                    if (val == '' || val.length != 14 || /^(.)\1+$/.test(val))
                        return false;

                    // Valida DVs
                    tamanho = val.length - 2
                    numeros = val.substring(0, tamanho);
                    digitos = val.substring(tamanho);
                    soma = 0;
                    pos = tamanho - 7;
                    for (i = tamanho; i >= 1; i--) {
                        soma += numeros.charAt(tamanho - i) * pos--;
                        if (pos < 2)
                            pos = 9;
                    }
                    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                    if (resultado != digitos.charAt(0))
                        return false;

                    tamanho = tamanho + 1;
                    numeros = val.substring(0, tamanho);
                    soma = 0;
                    pos = tamanho - 7;
                    for (i = tamanho; i >= 1; i--) {
                        soma += numeros.charAt(tamanho - i) * pos--;
                        if (pos < 2)
                            pos = 9;
                    }
                    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                    if (resultado != digitos.charAt(1))
                        return false;

                    return true;
                }

                function validate_cpf(val, msk) {
                    var regex = msk != undefined && msk ? /^\d{3}\.\d{3}\.\d{3}\-\d{2}$/ : /^[0-9]{11}$/;

                    if (val.match(regex) != null) {
                        //check all same numbers
                        if (val.match(/\b(.+).*(\1.*){10,}\b/g) != null)
                            return false;

                        var strCPF = val.replace(/\D/g, '');
                        var sum;
                        var rest;
                        sum = 0;

                        for (i = 1; i <= 9; i++)
                            sum = sum + parseInt(strCPF.substring(i - 1, i)) * (11 - i);

                        rest = (sum * 10) % 11;

                        if ((rest == 10) || (rest == 11))
                            rest = 0;

                        if (rest != parseInt(strCPF.substring(9, 10)))
                            return false;

                        sum = 0;
                        for (i = 1; i <= 10; i++)
                            sum = sum + parseInt(strCPF.substring(i - 1, i)) * (12 - i);

                        rest = (sum * 10) % 11;

                        if ((rest == 10) || (rest == 11))
                            rest = 0;
                        if (rest != parseInt(strCPF.substring(10, 11)))
                            return false;

                        return true;
                    }

                    return false;
                }
            }(jQuery));
        },
        ManipularResultado : function (result, posMarker)
        {
            $rs = result.placeResult.address_components;
            //Limpando as variáveis, por segurança
            $("#latitude").val("");
            $("#longitude").val("")

            var cidade,id_uf;

            //Busca os tipos de retorno do google e aplica aos campos de acordo com o tipo do retorno
            //nameForType retorna o valor para o tipo do retorno. Parametro "true" para short_name (Paraná se torna PR, por exemplo)
            $rs.forEach(function (type)
            {

                switch (type.types[0]) {
                    case 'sublocality_level_1':
                        $("#bairro").val(type.long_name);
                        break;
                    case 'administrative_area_level_2':
                        $("#cidade").val(type.long_name);
                        break;
                    case 'postal_code':
                        $("#cep").val(type.short_name);
                        break;
                    case 'administrative_area_level_2':
                        cidade = type.short_name;
                        break;
                    case 'administrative_area_level_1':
                        id_uf = Squall.PegarUf(type.short_name);
                        // var id_uf = $(`#id_uf option[data-value='${type.short_name}']`).val();
                        $("#id_uf").val(id_uf).trigger("change");

                        // $("#id_uf").val(PegarUf(type.short_name)).trigger('change');
                        //ListarSelect('index_xml.php?app_modulo=cidade&app_comando=filtrar_cidade&app_codigo=','#id_cidade',PegarUf(type.short_name));
                        break;
                    case 'street_number':
                        $("#numero").val(type.long_name);
                        break;
                    case 'route':
                        $('#logradouro_hidden').val(type.long_name);
                        setTimeout(function(){$('#logradouro').val(type.long_name)}, 100);
                        break;
                }
            });
            if($rs[3].types[0] == 'administrative_area_level_2')
                setTimeout(function(){Squall.PegarCidadeSelect(Squall.PegarUf($rs[4].short_name),$rs[3].long_name,'#id_cidade')}, 1500);
            else if($rs[2].types[0] == 'administrative_area_level_2')
                setTimeout(function(){Squall.PegarCidadeSelect(Squall.PegarUf($rs[3].short_name),$rs[2].long_name,'#id_cidade')}, 1500);
            else if($rs[4].types[0] == 'administrative_area_level_2')
                setTimeout(function(){Squall.PegarCidadeSelect(Squall.PegarUf($rs[5].short_name),$rs[4].long_name,'#id_cidade')}, 1500);
            else
                setTimeout(function(){Squall.PegarCidadeSelect(Squall.PegarUf($rs[2].short_name),$rs[1].long_name,'#id_cidade')}, 1500);

            $("#logradouro").val(result.placeResult.formatted_address);
            $("#latitude").val(posMarker.lat());
            $("#longitude").val(posMarker.lng());
        },
        ListarSelect : function(url,campo_destino,valor,primeiro,outro) {
            if(valor === "") return false;
            if(primeiro === '' || primeiro ===  undefined) primeiro = 'Selecione';
            var options = [];

            $.getJSON(url+valor, function(result) {
                if(result == null){
                    $(campo_destino).html(primeiro);
                }else{
                    options.push('<option value="">'+primeiro+'</option>');
                    for (var i = 0; i < result.length; i++){
                        options.push('<option value="',
                            result[i].id, '">',
                            result[i].nome, '</option>');
                    }
                    $(campo_destino).html(options.join(''));
                    if(outro != '' || primeiro !=  undefined){
                        var options2 = [];
                        options2.push('<option value="">Selecione</option>');
                        $(outro).html(options2.join(''));
                    }
                }
            });
        },
        ListarSelect2 : function(url,campo_destino,valor,primeiro,outro) {
            if(valor === "") return false;
            if(primeiro === '' || primeiro ===  undefined) primeiro = 'Selecione';
            var options = [];

            $.getJSON(url+valor, function(result) {
                if(result == null){
                    $(campo_destino).html(primeiro);
                }else{
                    options.push('<option value="">'+primeiro+'</option>');
                    for (var i = 0; i < result.length; i++){
                        options.push('<option value="',
                            result[i].id, '">',
                            result[i].nome, '</option>');
                    }
                    $(campo_destino).html(options.join(''));
                    if(outro !== '' || primeiro !==  undefined){
                        var options2 = [];
                        options2.push('<option value="">Selecione</option>');
                        $(outro).html(options2.join(''));
                    }
                }
            });
        },
        LoadingAjax : function (){
            $(document).ajaxStart(function () {
                KTApp.showPageLoading();
            });
            $(document).ajaxStop(function () {
                KTApp.hidePageLoading();
            });
        },
        Descadastro : function (){
            swal.fire({
                title: "Confirme Por favor",
                text: "Você realmente gostaria de Remover sua conta definitivamente da Siga ?",
                type: "danger",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim, continue!",
                cancelButtonText: "Não, cancelar!",
                closeOnConfirm: false,
                closeOnCancel: false
            }).then((isConfirm) =>{
                if (isConfirm.value) {
                    window.location.href = '#index_xml.php?app_modulo=home&app_comando=excluir_conta';
                } else {
                    swal.fire("Cancelado", "Remoção cancelada pelo usuário", "error");
                }
            });
        },
        AtualizarSaldo : function (){
            $.ajax({
                url: 'index_xml.php?app_modulo=cliente&app_comando=verificar_saldo',  beforeSend: function( xhr ) {
                    KTApp.hidePageLoading();
                },
                dataType:'json'
            }).done(function(response) {
                console.log(response);
                KTApp.hidePageLoading();
                $('#saldo_topo').html(response.saldo);
            });
        },
        /**
         *    Parâmetros:
         *        campoOrigem = id do campo html que deve ser usada para o autocomplete
         *        campoDestino = campo html que armazenará o id do item selecionado no resultado do autocomplete
         *        url = url chamada para obter os resultados
         *        filtro = valor do parametro (a url receberá como $_REQUEST['param'])
         *        callback = função disparada ao se selecionar uma opção
         *
         *    Exemplo de uso:
         *        AutoSelect('nome_grupo', 'id_grupo', 'index_xml.php?app_modulo=erp_grupo&app_comando=popup_localizar_erp_grupo', 1, 'nomeFuncaoTeste');
         */
        autoComplete : function (campoOrigem, url,filtro,callback){
            if(filtro == undefined || filtro == '') filtro = '';
            $(campoOrigem).select2(
                {
                    "language": "pt-br",
                    allowClear: true,
                    ajax:
                        {
                            url: url,
                            dataType: 'json',
                            delay: 250,
                            beforeSend: function( xhr ) {
                                KTApp.hidePageLoading();
                            },
                            data: function(params)
                            {
                                return {
                                    term: params.term, // search term
                                    page: params.page,
                                    filtro: $(filtro).val()
                                };
                            },
                            processResults: function(data) {
                                return {
                                    results: data
                                };
                            },
                            cache: true
                        },
                    placeholder: 'Digite algo para iniciar a busca'
                });
            // após selecionar pega o tronco do vetor e manda para afunção callback
            if (callback !== "" && callback !== undefined) {
                $(campoOrigem).on('select2:select', function (e) {
                    var data = e.params.data;
                    eval(callback)(data);
                });
            }
        },
        /**
         *    Parâmetros:
         *        campoOrigem = id do campo html que deve ser usada para o autocomplete
         *        campoDestino = campo html que armazenará o id do item selecionado no resultado do autocomplete
         *        url = url chamada para obter os resultados
         *        filtro = valor do parametro (a url receberá como $_REQUEST['param'])
         *        callback = função disparada ao se selecionar uma opção
         *
         *    Exemplo de uso:
         *        AutoSelect('nome_grupo', 'id_grupo', 'index_xml.php?app_modulo=erp_grupo&app_comando=popup_localizar_erp_grupo', 1, 'nomeFuncaoTeste');
         */
        autoCompleteModal : function (campoOrigem, url,filtro,callback,mymodal){
            if(filtro == undefined || filtro == '') filtro = '';
            if(mymodal == undefined || mymodal == '') mymodal = '';
            $(campoOrigem).select2(
                {
                    dropdownParent: mymodal,
                    "language": "pt-br",
                    allowClear: true,
                    ajax:
                        {
                            url: url,
                            dataType: 'json',
                            delay: 250,
                            beforeSend: function( xhr ) {
                                KTApp.hidePageLoading();
                            },
                            data: function(params)
                            {
                                return {
                                    term: params.term, // search term
                                    page: params.page,
                                    filtro: $(filtro).val()
                                };
                            },
                            processResults: function(data) {
                                return {
                                    results: data
                                };
                            },
                            cache: true
                        },
                    placeholder: 'Digite algo para iniciar a busca'
                });
            // após selecionar pega o tronco do vetor e manda para afunção callback
            if (callback !== "" && callback !== undefined) {
                $(campoOrigem).on('`[data-validar="select2"]`:select', function (e) {
                    var data = e.params.data;
                    eval(callback)(data);
                });
            }
        },
        checkSidebarActive: function(url) {
            var elm = document.querySelector(config_squall.menu.id +' ['+ config_squall.ajax.attr +'][href="'+ url +'"]');

            if (elm) {
                var targetElms = [].slice.call(document.querySelectorAll(config_squall.menu.id + ' .' + config_squall.menu.classAtivo));
                if (targetElms) {
                    targetElms.map(function(targetElm) {
                        targetElm.classList.remove(config_squall.menu.classAtivo);
                    });
                }

                var targetElm = elm.closest('.' + config_squall.menu.itemClass);

                if (targetElm) {
                    targetElm.classList.add(config_squall.menu.classAtivo);
                }

                var targetElms = getParents(elm);
                if (targetElms) {
                    targetElms.map(function(targetElm) {
                        if (targetElm.classList && targetElm.classList.contains(config_squall.menu.itemClass)) {
                            targetElm.classList.add(config_squall.menu.classAtivo);
                        }
                    });
                }
            }
        },
        getParams : function ()
        {
            var urlParams;
            (window.onpopstate = function () {
                var match,
                    pl     = /\+/g,  // Regex for replacing addition symbol with a space
                    search = /([^&=]+)=?([^&]*)/g,
                    decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); },
                    query  = window.location.search.substring(1);

                urlParams = {};
                while (match = search.exec(query))
                    urlParams[decode(match[1])] = decode(match[2]);
            })();
            return urlParams;
        },
        initToggler: function () {
            var elms = [].slice.call(document.querySelectorAll('['+config_squall.ajax.attr+']'));
            //console.log(elms);
            if (elms) {
                elms.map(function (elm) {
                    elm.onclick = function (e) {
                        e.preventDefault();
                        Squall.renderAjax(this.getAttribute('href'), this);
                    };
                });
            }
        },
        onDOMContentLoaded: function(callback) {
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', callback);
            } else {
                callback();
            }
        },
        GridListaCheckbox : function (master, todos)
        {
            for (cont = 0; cont < todos.length; cont++) {
                if (!todos[cont].disabled && $(todos[cont]).is(":visible")) {
                    todos[cont].checked = master.checked
                }
            }
        },
        loadPage : function (){
            // Populate the page loading element dynamically.
            // Optionally you can skipt this part and place the HTML
            // code in the body element by refer to the above HTML code tab.
            document.body.prepend(loadingEl);
            loadingEl.classList.add("page-loader");
            loadingEl.classList.add("flex-column");
            loadingEl.classList.add("bg-dark");
            loadingEl.classList.add("bg-opacity-25");
            loadingEl.innerHTML = `
        <span class="spinner-border text-primary" role="status"></span>
        <span class="text-gray-800 fs-6 fw-semibold mt-5">Carregando...</span>
        `;

            // Show page loading
            KTApp.showPageLoading();
        },
        removeLoad : function ()
        {
            KTApp.hidePageLoading();
            loadingEl.remove();
        },
        initHashChange: function() {
            window.addEventListener('hashchange', function() {
                if (window.location.hash) {
                    Squall.loadPage();
                    Squall.renderAjax(window.location.hash, '', true);
                } else {
                    Squall.renderAjax('index_xml.php?app_modulo=home&app_comando=home', '', true);
                }
            });
        },
        checkPushState: function(url) {
            var targetUrl = url.replace('#','');
            var targetUserAgent = window.navigator.userAgent;
            var isIE = targetUserAgent.indexOf('MSIE ');

            if (isIE && (isIE > 0 && isIE < 9)) {
                window.location.href = targetUrl;
            } else {
                history.pushState('', '', '#' + targetUrl);
            }
        },
        ToastMsg: function(tipo,mensagem,url,timeout) {

            if(timeout === '' && timeout === undefined) timeout = '5000';
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toastr-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": timeout,
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            if(url !== '' && url !== undefined){
                toastr.options.onHidden = function() {  window.location = url; };
            }
            toastr[tipo](mensagem);
        },
        ValidateForm : function ($form)
        {

            var result         = true,
                currentDiv,
                $this,
                contadorSelect = 0,
                classes        = [],
                idTab          = '',
                nodeName = '',
                validados      = [];

            $(".invalid-feedback").remove();

            //Validação de campos obrigatórios com a classe .validar-obrigatorio
            $form.find(".validar-obrigatorio").each(function ()
            {
                $this      = $(this);
                //console.log($this[0].id);
                currentDiv = $this.parent();
                if (currentDiv.hasClass("input-group")) {
                    currentDiv = currentDiv.parent().first();
                }
                if ($this.prop("disabled") !== true ) {
                    if ($this.val() == "" ) {

                        $this.addClass('is-invalid');
                        currentDiv.append("<div class='invalid-feedback' style=\"display:initial !important; \">Obrigatório.</div>");
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                        $this.focus();
                    } else {
                        $this.removeClass("is-invalid");
                        // $this.addClass('is-valid');
                    }
                } else {
                    $this.removeClass("is-invalid");
                    // $this.addClass('is-valid');
                }
            });
            //Validação de campos obrigatórios com a classe .validar-obrigatorio
            $form.find(`[data-validar="tagit"]`).each(function ()
            {
                $this      = $(this);
                // console.log($this.val()); console.log($this);
                currentDiv = $this.parent();
                if (currentDiv.hasClass("input-group")) {
                    currentDiv = currentDiv.parent().first();
                }
                if ($this.prop("disabled") !== true ) {
                    if ($this.val() == "" ) {

                        $this.addClass('is-invalid');
                        currentDiv.append("<div class='invalid-feedback' style=\"display:initial !important; \">Pelo menos um item deve ser adicionado.</div>");
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                        $this.focus();
                    } else {
                        $this.removeClass("is-invalid");
                        // $this.addClass('is-valid');
                    }
                } else {
                    $this.removeClass("is-invalid");
                    // $this.addClass('is-valid');
                }
            });

            $form.find(".validar-obrigatorio-0").each(function ()
            {
                $this      = $(this);
                // console.log($this.val()); console.log($this);
                currentDiv = $this.parent();
                if (currentDiv.hasClass("input-group")) {
                    currentDiv = currentDiv.parent().first();
                }
                if ($this.prop("disabled") !== true ) {
                    if ($this.val() == "" || $this.val() == "0") {

                        if ($this.val() == ""){
                            $this.addClass('is-invalid');
                            currentDiv.append("<div class='invalid-feedback' style=\"display:initial !important; \">Obrigatório.</div>");
                            result = false;
                        }

                        if ($this.val() == "0"){
                            $this.addClass('is-invalid');
                            currentDiv.append("<div class='invalid-feedback' style=\"display:initial !important; \">Não pode ser igual a 0.</div>");
                            result = false;
                        }

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                        $this.focus();
                    } else {
                        $this.removeClass("is-invalid");
                        // $this.addClass('is-valid');
                    }
                } else {
                    $this.removeClass("is-invalid");
                    // $this.addClass('is-valid');
                }
            });

            $form.find(".validar-obrigatorio-nove-digitos").each(function ()
            {
                $this      = $(this);
                // console.log($this.val()); console.log($this);
                currentDiv = $this.parent();
                if (currentDiv.hasClass("input-group")) {
                    currentDiv = currentDiv.parent().first();
                }
                if ($this.prop("disabled") !== true ) {
                    var onlyNumber = $this.val().replace(/\D+/g, '');
                    if (($this.val().length < 15) && (onlyNumber.length < 11)) {

                        $this.addClass('is-invalid');
                        currentDiv.append("<div class='invalid-feedback nove_digitos' style=\"display:initial !important; \">Celular precisa de 9 Digitos.</div>");
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                        $this.focus();
                    } else {
                        $this.removeClass("is-invalid");
                        // $this.addClass('is-valid');
                    }
                } else {
                    $this.removeClass("is-invalid");
                    // $this.addClass('is-valid');
                }

            });
            $form.find(".validar-obrigatorio-group").each(function ()
            {
                $this      = $(this);
                // console.log($this.val()); console.log($this);
                currentDiv = $this.parent();
                if (currentDiv.hasClass("input-group")) {
                    currentDiv = currentDiv.parent().first();
                }
                if ($this.prop("disabled") !== true ) {
                    if ($this.val() == "" ) {

                        $this.addClass('is-invalid');
                        $this.parent().append("<div class='invalid-feedback' style=\"display:initial !important; \">Obrigatório.</div>");
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                        $this.focus();
                    } else {
                        $this.removeClass("is-invalid");
                        // $this.addClass('is-valid');
                    }
                } else {
                    $this.removeClass("is-invalid");
                    // $this.addClass('is-valid');
                }
            });

            //Validação de campos obrigatórios com a classe .validar-obrigatorio
            $form.find(".validar-obrigatorio-m").each(function ()
            {
                $this      = $(this);
                // console.log($this.val()); console.log($this);
                currentDiv = $this.parent();
                if (currentDiv.hasClass("input-group")) {
                    currentDiv = currentDiv.parent().first();
                }
                if ($this.prop("disabled") !== true ) {
                    if ($this.val() == "" ) {
                        $this.addClass('is-invalid');
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                        $this.focus();
                    } else {
                        $this.removeClass("is-invalid");
                        $this.addClass('is-valid');
                    }
                } else {
                    $this.removeClass("is-invalid");
                    $this.addClass('is-valid');
                }
            });
            $form.find(".validar-cpf").each(function ()
            {
                $this = $(this);
                // console.log($this.val()); console.log($this);
                currentDiv = $this.parent();
                if (currentDiv.hasClass("input-group")) {
                    currentDiv = currentDiv.parent().first();
                }
                if ($this.prop("disabled") !== true) {
                    if ($this.val() == "" || !validarCPF($this.val())) {
                        result = false;
                        $this.addClass('is-invalid');
                        currentDiv.append("<div class='invalid-feedback' style=\"display:initial !important; \">Formato inválido</div>");
                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                        $this.focus();
                    } else {
                        $this.removeClass("is-invalid");
                        $this.addClass('is-valid');
                    }
                } else {
                    $this.removeClass("is-invalid");
                    $this.addClass('is-valid');
                }
            });
            $form.find(".validar-obrigatorio-select-picker").each(function ()
            {
                $this      = $(this);
                // console.log($this.val()); console.log($this);
                nodeName = $this[0].nodeName;
                currentDiv = $this.parent().parent();
                // console.log(currentDiv);
                if (currentDiv.hasClass("form-group")) {
                    currentDiv = currentDiv.parent().first();
                }
                // console.log(currentDiv);
                if(nodeName != 'DIV') {
                    if ($this.prop("disabled") !== true) {
                        if ($this.val() == "") {
                            // currentDiv.addClass('has-error');
                            currentDiv.append("<div class='invalid-feedback' style=\"display:initial !important; \">Obrigatório selecionar uma opção.</div>");
                            currentDiv.addClass('is-invalid');
                            $this.selectpicker('setStyle', 'btn-danger', 'add');
                            result = false;

                            if (idTab == "") {
                                idTab = currentDiv.closest(".tab-pane").attr("id");
                            }
                            $this.focus();
                        } else {
                            $this.selectpicker('setStyle', 'btn-danger', 'remove');
                            $this.removeClass("is-invalid");
                            $this.addClass('is-valid');
                            $this.selectpicker('refresh');
                        }
                    } else {
                        $this.selectpicker('setStyle', 'btn-danger', 'remove');
                        $this.removeClass("is-invalid");
                        $this.addClass('is-valid');
                        $this.selectpicker('refresh');
                    }
                }
            });
            $form.find(`[data-validar="select2-input-group"]`).each(function ()
            {
                $this      = $(this);
                //console.log($this[0].id);
                nodeName = $this[0].nodeName;
                currentDiv = $this.parent().parent().parent();
                if (currentDiv.hasClass("form-group")) {
                    currentDiv = currentDiv.parent().first();
                }
                if(nodeName != 'DIV') {
                    if ($this.prop("disabled") !== true) {

                        if ($this.val() == "" || $this.val() == null) {
                            $this.addClass('is-invalid');
                            currentDiv.children().append("<div class='invalid-feedback' style=\"display:initial !important; \">Obrigatório selecionar uma opção.</div>");
                            result = false;

                            if (idTab == "") {
                                idTab = currentDiv.closest(".tab-pane").attr("id");
                            }
                            $this.focus();

                        } else {
                            $this.removeClass("is-invalid");
                            // $this.addClass('is-valid');   Removido a pedido da Kaline

                        }
                    } else {
                        $this.removeClass("is-invalid");
                        // $this.addClass('is-valid');   Removido a pedido da Kaline
                    }
                }

            });
            $form.find(`[data-validar="select2"]`).each(function ()
            {
                $this      = $(this);
                //console.log($this[0].id);
                nodeName = $this[0].nodeName;
                currentDiv = $this.parent();
                if (currentDiv.hasClass("form-group")) {
                    currentDiv = currentDiv.parent().first();
                }
                if(nodeName != 'DIV') {
                    if ($this.prop("disabled") !== true) {

                        if ($this.val() == "" || $this.val() == null) {
                            $this.addClass('is-invalid');
                            currentDiv.children().append("<div class='invalid-feedback' style=\"display:initial !important; \">Obrigatório selecionar uma opção.</div>");
                            result = false;

                            if (idTab == "") {
                                idTab = currentDiv.closest(".tab-pane").attr("id");
                            }
                            $this.focus();
                        } else {
                            $this.removeClass("is-invalid");
                            // $this.addClass('is-valid');   Removido a pedido da Kaline

                        }
                    } else {
                        $this.removeClass("is-invalid");
                        // $this.addClass('is-valid');   Removido a pedido da Kaline
                    }
                }

            });
            /*
             ESSA FUNÇÃO VALIDA OS "AUTOCOMPLETES" OBRIGATÓRIOS,
             ELA IRA PROCURAR O INPUT HIDDEN DO CAMPO TXT.
             O CAMPO HIDDEN DEVE TER NO MESMO ID DO CAMPO TXT PRECEDIDO PELO PREFIXO "id_"
             EX:
             CAMPO TXT    = franquia
             CAMPO HIDDEN = id_franquia
             */
            $form.find(".validar-text-hidden-obrigatorio").each(function(){

                $idHidden  = $("#id_" + $(this).attr("name"));
                $this      = $(this);
                // console.log($this.val()); console.log($this);
                currentDiv = $this.parent();
                if (currentDiv.hasClass("input-group")) {
                    currentDiv = currentDiv.parent().first();
                }
                if ($this.prop("disabled") !== true) {
                    if ( $idHidden.val() == "") {
                        $this.addClass('is-invalid');

                        currentDiv.append("<div class='invalid-feedback' style=\"display:initial !important; \">Obrigatório.</div>");
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }

                    } else {
                        currentDiv.removeClass("has-danger");
                        $this.removeClass("is-invalid");
                        $this.addClass('is-valid');
                    }
                } else {
                    currentDiv.removeClass("has-danger");
                    $this.removeClass("is-invalid");
                }
            });

            $form.find(".validar-select-plugin").each(function ()
            {
                contadorSelect++;
                if (contadorSelect % 2 != 0) {
                    $this      = $(this);
                    currentDiv = $this.parent();

                    if (currentDiv.hasClass("input-group"))
                        currentDiv = currentDiv.parent().first();

                    if ($this.val() == null || typeof $this.val() === "undefined" || $this.val() == " ") {
                        $this.addClass('is-invalid');
                        currentDiv.append('<div class="invalid-feedback" style=\"display:initial !important; \">Obrigatório.</div>');
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                    } else {
                        $this.removeClass("is-invalid");
                        $this.addClass('is-valid');
                    }
                }
            });

            $form.find(".validar-duallist").each(function ()
            {
                $this      = $("#ms-" + $(this).attr("id"));
                currentDiv = $this.parent();

                if ($this.find(".ms-selection").first().find(".ms-selected").length <= 0) {

                    currentDiv.append('<div class="invalid-feedback" style=\"display:initial !important; \">Selecione algum registro</div>');
                    result = false;
                    if (idTab == "") {
                        idTab = currentDiv.closest(".tab-pane").attr("id");
                    }
                } else {
                    currentDiv.removeClass("has-danger");
                }
            });

            /*Validação de mínimo e máximo, usar as classes: valididar-min-max, min_VALORMINIMO, max_VALORMAXIMO*/
            var valMin = null,
                valMax = null;

            $form.find(".validar-min-max").each(function ()
            {
                $this      = $(this);
                classes    = $this.attr("class").split(" ");
                currentDiv = $this.parent();
                valMin     = null;
                valMax     = null;

                for (var x = 0; x < classes.length; x++) {
                    if (classes[x].indexOf("min_") >= 0) {
                        valMin = classes[x].substring(classes[x].indexOf("min_") + 4);
                    } else if (classes[x].indexOf("max_") >= 0) {
                        valMax = classes[x].substring(classes[x].indexOf("max_") + 4);
                    }
                }

                if ($this.val() != "") {
                    if (currentDiv.hasClass("input-group")) {
                        currentDiv = currentDiv.parent();
                    }
                }
                if ((!isNaN(valMin) && Number($this.val()) < Number(valMin)) || (!isNaN(valMax) && Number($this.val()) > Number(valMax))) {

                    currentDiv.append('<div class="invalid-feedback" style=\"display:initial !important; \">Valor maior ou menor do que o permitido</div>');
                    result = false;

                    if (idTab == "") {
                        idTab = currentDiv.closest(".tab-pane").attr("id");
                    }
                } else {
                    currentDiv.removeClass("has-danger");
                }
            });

            $form.find(".validar-tamanho").each(function ()
            {
                $this      = $(this);
                classes    = $this.attr("class").split(" ");
                currentDiv = $this.parent();
                valMin     = null;
                valMax     = null;

                for (var x = 0; x < classes.length; x++) {
                    if (classes[x].indexOf("min_") >= 0) {
                        valMin = classes[x].substring(classes[x].indexOf("min_") + 4);
                    } else if (classes[x].indexOf("max_") >= 0) {
                        valMax = classes[x].substring(classes[x].indexOf("max_") + 4);
                    }
                }

                if ($this.val() != "") {
                    if (currentDiv.is(":visible") || $this.attr("type") == "hidden") {
                        if (currentDiv.hasClass("input-group")) {
                            currentDiv = currentDiv.parent();
                        }
                        if ((!isNaN(valMin) && $this.val().length < Number(valMin)) || (!isNaN(valMax) && $this.val().length > Number(valMax))) {
                            $this.addClass('is-invalid');
                            currentDiv.append('<div class="invalid-feedback" style=\"display:initial !important; \">Texto muito longo ou muito curto</div>');
                            result = false;

                            if (idTab == "") {
                                idTab = currentDiv.closest(".tab-pane").attr("id");
                            }
                        } else {
                            $this.removeClass("is-invalid");
                            $this.addClass('is-valid');
                        }
                    }
                }
            });

            var namesValidados = [],
                currentName    = '',
                qtdSelecionado = 0;

            $form.find(".validar-radio").each(function ()
            {
                $this       = $(this);
                currentDiv  = $this.parent().parent().parent();
                currentName = $this.attr("name");
                if (namesValidados.indexOf(currentName) < 0) {
                    $form.find("[name='" + currentName + "']").each(function ()
                    {
                        if ($(this).is(":checked")) {
                            qtdSelecionado++;
                        }
                    });

                    namesValidados.push(currentName);

                    //if (currentDiv.is(":visible") || $this.attr("type") == "hidden") {
                    if (currentDiv.hasClass("input-group")) {
                        currentDiv = currentDiv.parent();
                    }
                    if (qtdSelecionado == 0) {
                        $this.addClass('is-invalid');
                        currentDiv.append('<div class="invalid-feedback" style=\"display:initial !important; \">Selecione uma opção</div>');
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                    } else {
                        $this.removeClass("is-invalid");
                        $this.addClass('is-valid');
                    }
                    //}

                    qtdSelecionado = 0;
                }
            });
            $form.find(".validar-email").each(function ()
            {
                $this      = $(this);
                currentDiv = $this.parent();

                if (currentDiv.hasClass("input-group")) {
                    currentDiv = currentDiv.parent().first();
                }
                if ($this.prop("disabled") !== true) {
                    if (!/^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2,3}/.exec($this.val()) || $this.val() == "") {

                        $this.addClass('is-invalid');
                        currentDiv.append("<div class='invalid-feedback' style=\"display:initial !important; \">Obrigatório.</div>");
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                    }
                    else {
                        $this.removeClass("is-invalid");
                        $this.addClass('is-valid');
                    }

                }

            });
            $form.find(".validar-email-cliente").each(function ()
            {
                $this      = $(this);
                currentDiv = $this.parent();

                if (currentDiv.hasClass("input-group")) {
                    currentDiv = currentDiv.parent().first();
                }
                if ($this.prop("disabled") !== true) {
                    if ($this.val() == "") {

                        currentDiv.append('<div class="invalid-feedback" style=\"display:initial !important; \">Obrigatório</div>');
                        result = false;
                        //
                    } else if (!/^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2,3}/.exec($this.val())) {

                        currentDiv.append('<div class="invalid-feedback">Email em formato inválido</div>');
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                    }
                    else {
                        currentDiv.removeClass("has-danger");
                    }
                }

            });

            $form.find(".validar-cnpj").each(function ()
            {
                $this = $(this);

                currentDiv = $this.parent();
                if (currentDiv.hasClass("input-group")) {
                    currentDiv = currentDiv.parent().first();
                }
                if ($this.prop("disabled") !== true) {
                    if ($this.val() == "" || !validaCnpj($this.val())) {
                        $this.addClass('is-invalid');
                        result = false;
                        currentDiv.append("<div class='invalid-feedback' style=\"display:initial !important; \">Formato inválido</div>");
                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                    } else {
                        $this.removeClass("is-invalid");
                        $this.addClass('is-valid');
                    }
                } else {
                    $this.removeClass("is-invalid");
                    $this.addClass('is-valid');
                }
            });

            $form.find('.valida-ip').each(function ()
            {
                var a = (/^((25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])\.){3}(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])$/);

                $this = $(this);

                $this.focusout(function ()
                {
                    result = (!a.test($this.val()) || $this.val() == '0.0.0.0' || $this.val() == '255.255.255.255');

                    var currentDiv = $this.parent();
                    if (currentDiv.hasClass("input-group")) {
                        currentDiv = currentDiv.parent().first();
                    }
                    if ($this.prop("disabled") !== true) {
                        if (!result) {

                            currentDiv.append("<div class='invalid-feedback' style=\"display:initial !important; \">Ip inválido</div>");
                            if (idTab == "") {
                                idTab = currentDiv.closest(".tab-pane").attr("id");
                            }
                        } else {
                            currentDiv.removeClass("has-danger");
                        }
                    } else {
                        currentDiv.removeClass("has-danger");
                    }
                });
            });
            $form.find(".validar-email-usuario").each(function ()
            {
                $this      = $(this);
                currentDiv = $this.parent();

                if (currentDiv.hasClass("input-group")) {
                    currentDiv = currentDiv.parent().first();
                }
                if ($this.prop("disabled") !== true) {
                    if ($this.val() == ""){
                        $this.addClass('is-invalid');
                        currentDiv.append("<div class='invalid-feedback' style=\"display:initial !important; \"><i class=\"fa fa-times text-danger\"></i> Obrigatório.</div>");
                        result = false;
                    }else if (!/^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2,3}/.exec($this.val())) {
                        $this.addClass('is-invalid');
                        currentDiv.append("<div class='invalid-feedback' style=\"display:initial !important; \"><i class=\"fa fa-times text-danger\"></i> E-mail no formato inválido.</div>");
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                    }
                    else {
                        $this.removeClass("is-invalid");
                        $this.addClass('is-valid');
                    }

                }

            });
            $form.find(".validar-confirma-senha").each(function ()
            {
                $this      = $(this);
                currentDiv = $this.parent();
                if (currentDiv.hasClass("input-group")) {
                    currentDiv = currentDiv.parent().first();
                }
                if ($this.prop("disabled") !== true ) {
                    if ($this.val() == ""  && $('#senha').val() != '') {

                        $this.addClass('is-invalid');
                        $this.focus();
                        currentDiv.append("<div class='invalid-feedback' style=\"display:initial !important; \"><i class=\"fa fa-times text-danger\"></i> Obrigatório.</div>");
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }

                    } else {
                        if ($this.val() != $('#senha').val())
                        {
                            $this.addClass('is-invalid');
                            $this.focus();
                            currentDiv.append("<div class='invalid-feedback' style=\"display:initial !important; \"><i class=\"fa fa-times text-danger\"></i> Confirmação de senha não é igual a senha.</div>");
                            result = false;
                        }
                        else
                        {
                            $this.addClass('is-valid');
                            $this.removeClass("is-invalid");
                        }
                    }
                } else {
                    $this.removeClass("is-invalid");
                    $this.addClass('is-valid');
                }
            });
            $form.find(".validar-confirma-senha-mudar").each(function ()
            {
                $this      = $(this);
                currentDiv = $this.parent();
                if (currentDiv.hasClass("input-group")) {
                    currentDiv = currentDiv.parent().first();
                }
                if ($this.prop("disabled") !== true ) {
                    if ($this.val() == "" ) {

                        $this.addClass('is-invalid');
                        $this.focus();
                        currentDiv.append("<div class='invalid-feedback' style=\"display:initial !important; \"><i class=\"fa fa-times text-danger\"></i> Obrigatório.</div>");
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }

                    } else {
                        if ($this.val() != $('#mudar_senha').val())
                        {
                            $this.addClass('is-invalid');
                            $this.focus();
                            currentDiv.append("<div class='invalid-feedback' style=\"display:initial !important; \"><i class=\"fa fa-times text-danger\"></i> Confirmação de senha não é igual a senha.</div>");
                            result = false;
                        }
                        else
                        {
                            $this.addClass('is-valid');
                            $this.removeClass("is-invalid");
                        }
                    }
                } else {
                    $this.removeClass("is-invalid");
                    $this.addClass('is-valid');
                }
            });
            $form.find(".validar-senha").each(function ()
            {
                var ucase = new RegExp("[A-Z]+");
                var lcase = new RegExp("[a-z]+");
                var num = new RegExp("[0-9]+");
                var senha_sucesso = true;

                $this      = $(this);
                currentDiv = $this.parent();
                if (currentDiv.hasClass("input-group")) {
                    currentDiv = currentDiv.parent().first();
                }
                if ($this.prop("disabled") !== true ) {

                    if ($this.val().length < 8 ) {

                        $this.addClass('is-invalid');
                        $this.focus();
                        currentDiv.append("<div class='invalid-feedback' style=\"display:block !important; \"><i class=\"fa fa-times text-danger\"></i> Senha tem que ser maior ou igual 8 caracteres.</div>");
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                        senha_sucesso = false;
                    }

                    if (! ucase.test($this.val()) ) {
                        $this.addClass('is-invalid');
                        $this.focus();
                        currentDiv.append("<div class='invalid-feedback' style=\"display:block !important; \"><i class=\"fa fa-times text-danger\"></i> Deve-se conter pelo menos 1 maiúscula.</div>");
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                        senha_sucesso = false;
                    }
                    if (!lcase.test($this.val()) ) {
                        $this.addClass('is-invalid');
                        $this.focus();
                        currentDiv.append("<div class='invalid-feedback' style=\"display:block !important; \"><i class=\"fa fa-times text-danger\"></i> Deve-se conter pelo menos 1 minúscula.</div>");
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                        senha_sucesso = false;
                    }
                    if (!num.test($this.val()) ) {
                        $this.addClass('is-invalid');
                        $this.focus();
                        currentDiv.append("<div class='invalid-feedback' style=\"display:block !important; \"><i class=\"fa fa-times text-danger\"></i> Deve-se conter pelo menos 1 número.</div>");
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                        senha_sucesso = false;
                    }
                    if(senha_sucesso){
                        $this.removeClass("is-invalid");
                        $this.addClass('is-valid');
                    }
                } else {

                    $this.removeClass("is-invalid");
                    $this.addClass('is-valid');
                }
            });
            $form.find(".validar-senha2").each(function ()
            {
                var ucase = new RegExp("[A-Z]+");
                var lcase = new RegExp("[a-z]+");
                var num = new RegExp("[0-9]+");
                var senha_sucesso = true;

                $this      = $(this);
                currentDiv = $this.parent();
                if (currentDiv.hasClass("input-group")) {
                    currentDiv = currentDiv.parent().first();
                }
                if ($this.prop("disabled") !== true ) {

                    if ($this.val().length < 8  && $this.val().length > 0) {

                        $this.addClass('is-invalid');
                        $this.focus();
                        currentDiv.append("<div class='invalid-feedback' style=\"display:block !important; \"><i class=\"fa fa-times text-danger\"></i> Senha tem que ser maior ou igual 8 Caracteres.</div>");
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                        senha_sucesso = false;
                    }

                    if (! ucase.test($this.val()) && $this.val().length > 0) {
                        $this.addClass('is-invalid');
                        $this.focus();
                        currentDiv.append("<div class='invalid-feedback' style=\"display:block !important; \"><i class=\"fa fa-times text-danger\"></i> Deve-se conter pelo menos 1 Maiscula.</div>");
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                        senha_sucesso = false;
                    }
                    if (!lcase.test($this.val()) && $this.val().length > 0) {
                        $this.addClass('is-invalid');
                        $this.focus();
                        currentDiv.append("<div class='invalid-feedback' style=\"display:block !important; \"><i class=\"fa fa-times text-danger\"></i> Deve-se conter pelo menos 1 Minuscula.</div>");
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                        senha_sucesso = false;
                    }
                    if (!num.test($this.val()) && $this.val().length > 0) {
                        $this.addClass('is-invalid');
                        $this.focus();
                        currentDiv.append("<div class='invalid-feedback' style=\"display:block !important; \"><i class=\"fa fa-times text-danger\"></i> Deve-se conter pelo menos 1 Número.</div>");
                        result = false;

                        if (idTab == "") {
                            idTab = currentDiv.closest(".tab-pane").attr("id");
                        }
                        senha_sucesso = false;
                    }
                    if(senha_sucesso){
                        $this.removeClass("is-invalid");
                        $this.addClass('is-valid');
                    }
                } else {

                    $this.removeClass("is-invalid");
                    $this.addClass('is-valid');
                }
            });
            // console.log('este e id da tab = ' + idTab);
            if(idTab != '')
                $form.find("a[href='#" + idTab + "']").tab('show');
            // $('#'+idTab).get(0).click();
            // $('.nav-tabs a[href="'+ idTab +'"]').tab('show');
            return result;
        },
        renderAjax: function(url, elm, disablePushState) {
            // if (window.location.search) {
            //     window.location.href =
            //         window.location.href.replace(window.location.search, '')
            //             .replace(window.location.hash, '') + '#' + url;
            // } else {
            //     window.location.hash = url;
            // }
            $('[data-bs-toggle="tooltip"]').tooltip('hide');
            Squall.checkSidebarActive(url);
            if (!disablePushState) {
                Squall.checkPushState(url);
            }
            var targetContainer= document.querySelector(config_squall.conteudo);
            if (!targetContainer) {
                return;
            }
            var targetUrl 	   = url.replace('#','');
            var targetType 	   = (setting && setting.ajaxType) ? setting.ajaxType : 'GET';
            var targetDataType = (setting && setting.ajaxDataType) ? setting.ajaxDataType : 'html';
            if (elm) {
                targetDataType = (elm.getAttribute('data-type')) ? elm.getAttribute('data-type') : targetDataType;
                targetDataDataType = (elm.getAttribute('data-data-type')) ? elm.getAttribute('data-data-type') : targetDataType;
            }
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == XMLHttpRequest.DONE) {
                    if (xmlhttp.status == 200) {
                        setInnerHTML(targetContainer, xmlhttp.responseText);

                    } else if (xmlhttp.status == 400) {
                        console.log('There was an error 400');
                        setInnerHTML(targetContainer, emptyHtml);
                    } else {
                        console.log('something else other than 200 was returned');
                    }
                    // Squall.checkLoading(true);
                    document.body.scrollTop = 0;
                    //App.initComponent();
                }
            };

            xmlhttp.open(targetType, targetUrl, true);
            xmlhttp.send();

        }
    }
}();
var setInnerHTML = function(elm, html) {
    elm.innerHTML = html;
    Array.from(elm.querySelectorAll('script')).forEach( oldScript => {
        const newScript = document.createElement('script');
        Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
        newScript.appendChild(document.createTextNode(oldScript.innerHTML));
        oldScript.parentNode.replaceChild(newScript, oldScript);
    });
    Squall.removeLoad();
};
window.addEventListener('DOMContentLoaded', (event) => {
    Squall.init();
});


function validarCPF(cpf)
{
    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf == '') {
        return false;
    }
    // Elimina CPFs invalidos conhecidos
    if (cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999") {
        return false;
    }
    // Valida 1o digito
    add = 0;
    for (i = 0; i < 9; i++)
        add += parseInt(cpf.charAt(i)) * (10 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11) {
        rev = 0;
    }
    if (rev != parseInt(cpf.charAt(9))) {
        return false;
    }
    // Valida 2o digito
    add = 0;
    for (i = 0; i < 10; i++)
        add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11) {
        rev = 0;
    }
    if (rev != parseInt(cpf.charAt(10))) {
        return false;
    }
    return true;
}

function validaCnpj(str)
{
    str            = str.replace('.', '');
    str            = str.replace('.', '');
    str            = str.replace('.', '');
    str            = str.replace('-', '');
    str            = str.replace('/', '');
    cnpj           = str;
    var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
    digitos_iguais = 1;
    if (cnpj.length < 14 && cnpj.length < 15) {
        return false;
    }
    for (i = 0; i < cnpj.length - 1; i++)
        if (cnpj.charAt(i) != cnpj.charAt(i + 1)) {
            digitos_iguais = 0;
            break;
        }
    if (!digitos_iguais) {
        tamanho = cnpj.length - 2;
        numeros = cnpj.substring(0, tamanho);
        digitos = cnpj.substring(tamanho);
        soma    = 0;
        pos     = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2) {
                pos = 9;
            }
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0)) {
            return false;
        }
        tamanho = tamanho + 1;
        numeros = cnpj.substring(0, tamanho);
        soma    = 0;
        pos     = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2) {
                pos = 9;
            }
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1)) {
            return false;
        }
        return true;
    }
    else {
        return false;
    }
}