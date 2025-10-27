<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroAlmoxarifadoSetor").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_almoxarifado_setor&app_modulo=almoxarifado_setor";
        //ModalAlmoxarifadoSetor();
	});
	$("#ExcluirRegistroAlmoxarifadoSetor").click(function()
	{
		var checked = $("input[name='lista_AlmoxarifadoSetor[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_AlmoxarifadoSetor[]']:checked"), function() {
				values.push($(this).val());
			});
            //Parameter
                swal.fire({
                    title: "Confirme Por favor",
                    text: "Você realmente gostaria de Remover estes registros ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Sim, continue!",
                    cancelButtonText: "Não, cancelar!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }).then((isConfirm) =>{
                    if (isConfirm.value) {
                        ExcluirRegistrosAlmoxarifadoSetor(values);
                         swal.fire("Removido!", "O(s) Registro(s) Foram removidos com sucesso.", "success");
                    } else {
                        swal.fire("Cancelado", "Remoção cancelada pelo usuário", "error");
                    }
                });

		}
		else
		{
            Squall.ToastMsg('warning','Selecione pelo menos 1 registro');
		}
	});
	$('[data-bs-toggle="tooltip"]').tooltip();
});


function ModificarAlmoxarifadoSetor(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_almoxarifado_setor&app_modulo=almoxarifado_setor&app_codigo="+id;
        //ModalAlmoxarifadoSetor(id);
}
function ModalAlmoxarifadoSetor(id){
    $("#modal_modulo_almoxarifado_setor").modal("show");
    $("#div_modal_almoxarifado_setor").load("index_xml.php?app_comando=frm_modal_almoxarifado_setor&app_modulo=almoxarifado_setor&app_codigo="+id);
}

function ExcluirRegistrosAlmoxarifadoSetor(dados)
{
	$.post("index_xml.php?app_modulo=almoxarifado_setor&app_comando=deletar_almoxarifado_setor",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridAlmoxarifadoSetor();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
