<script>
    Modal = new SquallModal();
    objSquallGoogle = new SquallGoogle();
     var pontosVetor = [];
    var poliLinha = [];

    var drawerElement,drawer;
    var drawerElement2,drawer2;
    var drawerElement3,drawer3;
    var loading = '<div class="text-center"> <span class="spinner-border text-primary" role="status"></span><br><span class="text-gray-800 fs-6 fw-semibold mt-5">Carregando...</span> </div>';

    $(document).ready(function ()
    {
        Squall.autoComplete('#id_veiculo','index_xml.php?app_modulo=veiculo&app_comando=listar_veiculo_posicao_autocomplete');
        IniciarMapa();
        AtualizarGridUltimas();
        AjaxPontos();

        drawerElement = document.querySelector("#kt_drawer_example_permanent");
        drawer = KTDrawer.getInstance(drawerElement);

        criarTimeout();

    });

    function criarTimeout()
    {
        setTimeout(function() {
            AtualizarGridUltimas();
            criarTimeout();
        }, 15000);
    }
    function LimparGrid()
    {
        $.ajax({
            url : "index_xml.php?app_modulo=monitor&app_comando=limpar_grid&id_veiculo",
            data:'todos',
            dataType: 'json',
            beforeSend : function(){
                KTApp.hidePageLoading();
            },
            complete: function(result){
                AtualizarGridUltimas();
                objSquallGoogle.deletarPontos();
            }
        });
    }
    function AdicionarVeiculoGrid(id)
    {
        $.ajax({
            url : "index_xml.php?app_modulo=monitor&app_comando=adicionar_veiculo_montirorar&id_veiculo="+id,
            data:'todos',
            dataType: 'json',
            beforeSend : function(){
                KTApp.hidePageLoading();
            },
            complete: function(result){
                AtualizarGridUltimas();
                AjaxPontos();
            }
        });
    }
    function RemoverVeiculoGrid(id)
    {
        $('[data-bs-toggle="tooltip"]').tooltip('hide');
        $.ajax({
            url : "index_xml.php?app_modulo=monitor&app_comando=remover_veiculo_montirorar&id_veiculo="+id,
            data:'todos',
            dataType: 'json',
            beforeSend : function(){
                KTApp.hidePageLoading();
            },
            complete: function(result){
                objSquallGoogle.deletarPontos();
                AtualizarGridUltimas();
                AjaxPontos();
            }
        });
    }
    function AtualizarGridUltimas(pagina,busca,filtro,ordem)
    {
        var load = '<div class="d-flex justify-content-center">' +
            '     <div class="spinner-grow" style="width: 3rem; height: 3rem;"  role="status">' +
            '         <span class="sr-only">Carregando...</span>' +
            '     </div>' +
            ' </div>';
        if(filtro == "" || filtro === undefined)  filtro = "";
        if(ordem == "" || ordem  === undefined)  ordem = "";

        $('#div_grid').html(load);
        var toPost = {
            pagina: pagina,
            busca: busca,
            filtro: filtro,
            ordem: ordem
        };
        $("#div_grid").load("index_xml.php?app_modulo=monitor&app_comando=listar_grid",toPost);
    }
    function CentarlizarVeiculo(idVeiculo, latitude, longitude, zoom)
    {
        latLng = new google.maps.LatLng(latitude, longitude);
        objSquallGoogle.map.setZoom(zoom);
        objSquallGoogle.map.panTo(latLng);
    }
    function IniciarMapa()
    {
        objSquallGoogle.lat_zoom = -25.44051;
        objSquallGoogle.lng_zoom = -49.23656;
        objSquallGoogle.inicialize('mapa_monitor');

    }
    function AjaxPontos()
    {
        objSquallGoogle.limparPontos();
        $.ajax({
            url : "index_xml.php?app_modulo=monitor&app_comando=listar_pontos",
            data:'todos',
            dataType: 'json',
            beforeSend : function(){
                KTApp.hidePageLoading();
            },
            complete: function(result){
                CarregarPontos(result.responseJSON.data)
            }
        });
    }
    function CarregarPontos(pontosVetor)
    {
        if(pontosVetor && pontosVetor.length > 0) {
           objSquallGoogle.adicionarPontoVeiculo(pontosVetor);
           objSquallGoogle.EnquadrarPontos();
        }
        if(poliLinha.length > 0) {
            objSquallGoogle.criarLinha(poliLinha,"midline",KTUtil.getCssVariableValue("--theme-primary-900"));
        }

    }
</script>