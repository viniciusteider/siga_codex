<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroEquipes").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_equipes&app_modulo=equipes";
        //ModalEquipes();
	});
	$("#ExcluirRegistroEquipes").click(function()
	{
		var checked = $("input[name='lista_Equipes[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_Equipes[]']:checked"), function() {
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
                        ExcluirRegistrosEquipes(values);
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
            AtualizarGridEquipes(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarEquipes(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_equipes&app_modulo=equipes&app_codigo="+id;
        //ModalEquipes(id);
}
function ModalEquipes(id){
    $("#modal_modulo_equipes").modal("show");
    $("#div_modal_equipes").load("index_xml.php?app_comando=frm_modal_equipes&app_modulo=equipes&app_codigo="+id);
}

function ExcluirRegistrosEquipes(dados)
{
	$.post("index_xml.php?app_modulo=equipes&app_comando=deletar_equipes",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridEquipes();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
