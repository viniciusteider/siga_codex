<script type="text/javascript">

/*
 * Executa o post do formulário
 * */

var app_modulo = "<?=$modulo_retorno?>";
var app_comando = "<?=$comando_retorno?>";

$(document).ready(function () {
    //
    $("#bt_salvar").click(function () {
        var id = "<?=$app_codigo?>";
        var comando = "<?=$app_comando?>";
        var tipo = 1;
        validar_senha = false;

        if(id != "")
        {
            url = "index_xml.php?app_modulo=usuario&app_comando=atualizar_usuario&app_codigo";
            tipo = 2;
        }
        else
        {
            url = "index_xml.php?app_modulo=usuario&app_comando=adicionar_usuario&app_codigo";
        }
        if(comando == "frm_atualizar_meus_dados")
        {
            url = "index_xml.php?app_modulo=usuario&app_comando=atualizar_usuario_meus_dados&app_codigo";
        }

        ExecutarAcao(url,validar_senha);
    });
    $('.select2').select2({language: "pt-BR"});



    const input = document.getElementById("logradouro");
    const options = {
        fields: ["address_components", "geometry"],
        types: ["address"]
    };
    autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener("place_changed",ManipularResultado);

     FuncoesFormulario();

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
    for (const component of place.address_components) {
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
            var id_cidade = $(`#id_cidade option:contains('${$rs[3].long_name}')`).val();
            $('#id_cidade').val(id_cidade).trigger('change');
        }, 1500);
    }
    else if($rs[2].types[0] == 'administrative_area_level_2')
    {
        setTimeout(function(){
            var id_cidade = $(`#id_cidade option:contains('${$rs[2].long_name}')`).val();
            $('#id_cidade').val(id_cidade).trigger('change');
        }, 1500);
    }
    else if($rs[4].types[0] == 'administrative_area_level_2')
    {
        setTimeout(function(){
            var id_cidade = $(`#id_cidade option:contains('${$rs[4].long_name}')`).val();
            $('#id_cidade').val(id_cidade).trigger('change');
        }, 1500);
    }
    else
    {
        setTimeout(function(){
            var id_cidade = $(`#id_cidade option:contains('${$rs[1].long_name}')`).val();
            $('#id_cidade').val(id_cidade).trigger('change');
        }, 1500);
    }
}
function BuscarCep(cep){
    var cep_final = cep.replace("-","");
    var url = 'https://viacep.com.br/ws/'+ cep_final +'/json/';

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
                var id_cidade = $(`#id_cidade option:contains('${result.localidade}')`).val();
                $('#id_cidade').val(id_cidade).trigger('change');
            }, 2000);
        }
        if (("erro" in result)) {
            Squall.ToastMsg('warning','CEP não encontrado!');
        }
    });
}

function FuncoesFormulario()
{
    KTImageInput.createInstances();
    Squall.autoComplete('#id_grupo', 'index_xml.php?app_modulo=grupo&app_comando=popup_localizar_grupo');
    Squall.autoComplete('#id_base', 'index_xml.php?app_modulo=base&app_comando=listar_bases_auto_complete');

    $('#id_estado,#id_cidade,#genero,#tipo_sangue').select2();
    $('.js-switch').each(function() {
        new Switchery($(this)[0], $(this).data());
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

    //Mesmo campo pode ter cpf e cnpj
    var maskBehavior = function (val)
        {
            return val.replace(/\D/g, '').length <= 11 ? '000.000.000-009' : '00.000.000/0000-00';
        },
        options      = {
            onKeyPress: function (val, e, field, options)
            {
                field.mask(maskBehavior.apply({}, arguments), options);
            }
        };
    $('#cpf_cnpj').mask(maskBehavior, options);

    //Na máscara, 9 representa número opcional, e 0 número obrigatório
    $('#data_hora_expirado').mask("00/00/2000 00:00:00");
    $("#cep").mask("00000-000");
    $('#id_nextel').mask("00*0999999*00999");

    $('#calendario_expirado').click(function(event){
        event.preventDefault();
        $('#data_hora_expirado').focus();
    });
    Mascaras();

    $('#id_usuario_tipo,#id_funcao,#categoria_cnh,#id_etnia').select2({language: "pt-BR"});
    var campos_datas = $("#data_nascimento, #validade_cnh, #data_inclusao, #validade_cve");
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
}

/**
 * @return {boolean}
 */

function ExecutarAcao(url,validar_senha)
{
    // var imageInputElement = document.querySelector("#kt_image_input_control");
    // var imageInput = KTImageInput.getInstance(imageInputElement);


    if (Squall.ValidateForm($("#frm_usuario"))) {
            // $('#foto').val(imageInput);
            $('#frm_usuario').ajaxSubmit
            (
                {
                    target:       '_blank',
                    beforeSubmit: function (formData)
                    {
                        var queryString = $.param(formData);
                        //$('.preloader').show();
                        return true;
                    },
                    success:   function (msg)
                    {
                        if (msg["codigo"] == 0) {
                            Squall.ToastMsg('success',msg["mensagem"],"#index_xml.php?app_modulo="+app_modulo+"&app_comando="+app_comando,'1500');
                            // window.location ='#index_xml.php?app_modulo=usuario&app_comando=listar_usuario';

                        } else {
                            Squall.ToastMsg('warning',msg["mensagem"]);
                        }
                    },
                    url:          url,
                    resetForm:    false,
                    type:         'post',
                    dataType:     'json'
                }
            );
        }

}
</script>
