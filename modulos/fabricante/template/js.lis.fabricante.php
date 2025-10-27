<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroFabricante").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_fabricante&app_modulo=fabricante";
        //ModalFabricante();
	});
	$("#ExcluirRegistroFabricante").click(function()
	{
		var checked = $("input[name='lista_Fabricante[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_Fabricante[]']:checked"), function() {
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
                        ExcluirRegistrosFabricante(values);
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
	$("#busca").keypress(function (e) {
		if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
            AtualizarGridFabricante(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarFabricante(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_fabricante&app_modulo=fabricante&app_codigo="+id;
        //ModalFabricante(id);
}
function ModalFabricante(id){
    $("#modal_modulo_fabricante").modal("show");
    $("#div_modal_fabricante").load("index_xml.php?app_comando=frm_modal_fabricante&app_modulo=fabricante&app_codigo="+id);
}

function ExcluirRegistrosFabricante(dados)
{
	$.post("index_xml.php?app_modulo=fabricante&app_comando=deletar_fabricante",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridFabricante({});			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
