<script>
    objSquallGoogle = new SquallGoogle();
    var request = <?=json_encode($_REQUEST);?>;
    var dados = {"id_veiculo":request.id_veiculo,"periodo":request['periodo']};
    var pontosVetor = [];
    var poliLinha = [];
    $(document).ready(function ()
    {
        IniciarMapa();
       AjaxPontos(dados);
    });

    function IniciarMapa()
    {
        objSquallGoogle.lat_zoom = -25.44051;
        objSquallGoogle.lng_zoom = -49.23656;
        objSquallGoogle.inicialize('div_mapa');

        setTimeout('CarregarPontos();', 2000);

    }
    function AjaxPontos(dados)
    {
        $.ajax({
            url : "index_xml.php?app_modulo=posicao&app_comando=listar_pontos_mapa",
            data:dados,
            dataType: 'json',
            beforeSend : function(){
                KTApp.hidePageLoading();
            },
            complete: function(result){
                pontosVetor =  result.responseJSON.data
                poliLinha =  result.responseJSON.linha
            }
        });
    }
    function CarregarPontos()
    {
        if(pontosVetor.length > 0) {
           objSquallGoogle.adicionarPontoVeiculo(pontosVetor);
           objSquallGoogle.EnquadrarPontos();
        }
        if(poliLinha.length > 0) {
            objSquallGoogle.criarLinha(poliLinha,"midline",KTUtil.getCssVariableValue("--theme-primary-900"));
        }

    }
</script>