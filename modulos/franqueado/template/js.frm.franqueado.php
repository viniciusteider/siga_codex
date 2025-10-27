<script type="text/javascript">

    /*
     * Executa o post do formulário
     * */
    $(document).ready(function () {
        $("#bt_salvar").click(function () {
            var id = "<?=$app_codigo?>";
            var tipo = 1;

            if(id != "")
            {
                url = "index_xml.php?app_modulo=franqueado&app_comando=atualizar_franqueado&app_codigo";
                tipo = 2;
            }
            else
            {
                url = "index_xml.php?app_modulo=franqueado&app_comando=adicionar_franqueado&app_codigo";
            }

            ExecutarAcao(url);
        });
        Mascaras();
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
        $('#id_estado,#id_cidade').select2();

        const input = document.getElementById("logradouro");
        const options = {
            fields: ["address_components", "geometry"],
            types: ["address"]
        };
        autocomplete = new google.maps.places.Autocomplete(input, options);
        autocomplete.addListener("place_changed",ManipularResultado);

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
                case "administrative_area_level_1": {
                    $("#estado").val(component.short_name);
                    id_uf = Squall.PegarUf(component.short_name);;
                    $("#id_estado").val(id_uf).trigger("change");
                    break;
                }
                // case "administrative_area_level_2": {
                //     sigla = Squall.PegarUf(component.short_name);
                //     console.log(sigla);
                //     setTimeout(function(){Squall.PegarCidadeSelect(sigla,component.long_name,'#id_cidade')}, 1500);
                //     $("#cidade").val(component.short_name);
                //     // document.querySelector("#state").value = component.short_name;
                //     break;
                // }
            }
        }
        if($rs[3].types[0] == 'administrative_area_level_2')
            // setTimeout(function(){
                Squall.PegarCidadeSelect(Squall.PegarUf($rs[4].short_name),$rs[3].long_name,'#id_cidade');
            // }, 2000);
        else if($rs[2].types[0] == 'administrative_area_level_2')
            // setTimeout(function(){
                Squall.PegarCidadeSelect(Squall.PegarUf($rs[3].short_name),$rs[2].long_name,'#id_cidade')
    // }, 2000);
        else if($rs[4].types[0] == 'administrative_area_level_2')
            // setTimeout(function(){
                Squall.PegarCidadeSelect(Squall.PegarUf($rs[5].short_name),$rs[4].long_name,'#id_cidade')
            // }, 2000);
        else
            // setTimeout(function(){
                Squall.PegarCidadeSelect(Squall.PegarUf($rs[2].short_name),$rs[1].long_name,'#id_cidade')
            // }, 2000);
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
                    Squall.PegarCidadeSelect(id_uf,result.localidade,'#id_cidade');
                }, 2000);
            }
            if (("erro" in result)) {
                Squall.ToastMsg('warning','CEP não encontrado!');
            }
        });
    }

    function ExecutarAcao(url)
    {
        if (Squall.ValidateForm($("#frm_franqueado"))) {
            $("#bt_salvar").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> AGUARDE...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post(url,
                $("#frm_franqueado").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        Squall.ToastMsg('success',response["mensagem"],"#index_xml.php?app_modulo=franqueado&app_comando=listar_franqueado&pagina=<?=$_REQUEST['pagina']?>&filtro=<?=$_REQUEST['filtro']?>&busca=<?=$_REQUEST['busca']?>&ordem=<?=$_REQUEST['ordem']?>",'600');
                    } else {
                        Squall.ToastMsg('warning',response["mensagem"]);
                    }
                    $("#bt_salvar").prop("disabled",false).html("<i class=\"fa fa-check\"></i> SALVAR").removeClass("btn-warning");
                }
                , "json" // definindo retorno para o formato json
            );
        }
    }
</script>
