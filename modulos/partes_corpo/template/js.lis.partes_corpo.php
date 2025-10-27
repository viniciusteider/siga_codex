<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroPartesCorpo").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_partes_corpo&app_modulo=partes_corpo";
        //ModalPartesCorpo();
	});
	$("#ExcluirRegistroPartesCorpo").click(function()
	{
		var checked = $("input[name='lista_PartesCorpo[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_PartesCorpo[]']:checked"), function() {
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
                        ExcluirRegistrosPartesCorpo(values);
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
	$('[data-toggle="tooltip"]').tooltip();
	$("#busca").keypress(function (e) {
		if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
            AtualizarGridPartesCorpo(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarPartesCorpo(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_partes_corpo&app_modulo=partes_corpo&app_codigo="+id;
        //ModalPartesCorpo(id);
}
function ModalPartesCorpo(id){
    $("#modal_modulo_partes_corpo").modal("show");
    $("#div_modal_partes_corpo").load("index_xml.php?app_comando=frm_modal_partes_corpo&app_modulo=partes_corpo&app_codigo="+id);
}

function ExcluirRegistrosPartesCorpo(dados)
{
	$.post("index_xml.php?app_modulo=partes_corpo&app_comando=deletar_partes_corpo",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridPartesCorpo();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
