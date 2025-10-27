<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroLigacoes").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_ligacoes&app_modulo=ligacoes";
        //ModalLigacoes();
	});
	$("#ExcluirRegistroLigacoes").click(function()
	{
		var checked = $("input[name='lista_Ligacoes[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_Ligacoes[]']:checked"), function() {
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
                        ExcluirRegistrosLigacoes(values);
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
            AtualizarGridLigacoes(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarLigacoes(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_ligacoes&app_modulo=ligacoes&app_codigo="+id;
        //ModalLigacoes(id);
}
function ModalLigacoes(id){
    $("#modal_modulo_ligacoes").modal("show");
    $("#div_modal_ligacoes").load("index_xml.php?app_comando=frm_modal_ligacoes&app_modulo=ligacoes&app_codigo="+id);
}

function ExcluirRegistrosLigacoes(dados)
{
	$.post("index_xml.php?app_modulo=ligacoes&app_comando=deletar_ligacoes",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridLigacoes();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
