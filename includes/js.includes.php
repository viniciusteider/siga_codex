<!--begin::Javascript-->
<script>
    var hostUrl = "assets/";        </script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<script src="assets/js/custom/squall.bundle.js?v=1"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<!--<script src="https://cdn.amcharts.com/lib/5/index.js"></script>-->
<!--<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>-->
<!--<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>-->
<!--<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>-->
<!--<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>-->
<!--<script src="https://cdn.amcharts.com/lib/5/map.js"></script>-->
<!--<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>-->
<!--<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>-->
<!--<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>-->
<!--<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>-->
<!--<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>-->
<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="assets/js/widgets.bundle.js"></script>
<script src="assets/js/custom/widgets.js"></script>
<!--<script src="assets/js/custom/apps/chat/chat.js"></script>-->
<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
<script src="assets/js/custom/utilities/modals/create-app.js"></script>
<script src="assets/js/custom/utilities/modals/new-target.js"></script>
<script src="assets/js/custom/utilities/modals/users-search.js"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->

<script src="assets/plugins/custom/jstree/jstree.bundle.js"></script>
<script src="assets/js/makedMoney.js"></script>
<script src="assets/js/MascarasGeral.js"></script>
<script src="assets/js/mask.js"></script>
<script src="assets/js/jquery.mask.min.js"></script>
<script src="assets/js/jquery.form.js"></script>

<script src="assets/js/bootstrap-show-modal.js"></script>

<script src="assets/js/bloodhound.js"></script>
<script src="assets/js/addresspicker.js"></script>
<script src="assets/js/addresspicker-typeahead.jquery.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?=GOOGLEKEYMAP?>&language=pt-BR&channel=1&libraries=geometry,drawing,places" type="text/javascript"></script>

<script src="assets/plugins/custom/formrepeater/formrepeater.bundle.js"></script>
<script src="assets/js/flappicker-pt-br.js"></script>
<script src="assets/js/jquery-ui-1.13.2/jquery-ui.js"></script>
<script src="assets/js/jQuery-provider.js"></script>
<script src="assets/js/squallModal.js"></script>
<script src="assets/js/SquallGoogle.js"></script>
<script src="assets/js/markerclusterer.js"></script>

<script src="assets/js/dropify/js/dropify.js"></script>



<!--<script src="assets/plugins/custom/dual-listbox-master/dist/dual-listbox.js"></script>-->




<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->


<script>
    tempo_ligacao = null;
    var AberturaAtendimento = function (){
        return{
            ModalAbertura : function (){
                $('#div_abertura_atendimento').html('');
                $('#modal_abertura_atendimento').modal('show');
                $('#div_abertura_atendimento').load('index_xml.php?app_comando=frm_adicionar_abertura&app_modulo=ocorrencias');
            },
            ViewEcaminhamentos : function (){
                Modal1 = new SquallModal();
                Modal1.titulo_modal = "Encaminhamento X Hora";
                Modal1.id_modal = 'modal_ecaminhamento';
                Modal1.id_conteudo_modal = 'div_encaminhamento';
                Modal1.url = "index_xml.php?app_comando=view_encaminhamento&app_modulo=paciente";
                Modal1.botao_salvar = '';
                Modal1.tamanho_modal = 'mw-80vw';
                Modal1.Gerar();

            }
        }
    }();
</script>