<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroPessoalFerias").click(function()
	{
        // window.location = "#index_xml.php?app_comando=frm_adicionar_pessoal_ferias&app_modulo=pessoal_ferias";
        ModalPessoalFerias();
	});
	$("#ExcluirRegistroPessoalFerias").click(function()
	{
		var checked = $("input[name='lista_PessoalFerias[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_PessoalFerias[]']:checked"), function() {
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
                        ExcluirRegistrosPessoalFerias(values);
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
            AtualizarGridPessoalFerias(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarPessoalFerias(id){
    // window.location = "#index_xml.php?app_comando=frm_atualizar_pessoal_ferias&app_modulo=pessoal_ferias&app_codigo="+id;
        ModalPessoalFerias(id);
}
function ModalPessoalFerias(id){
    $("#modal_modulo_pessoal_ferias").modal("show");
    $("#div_modal_pessoal_ferias").load("index_xml.php?app_comando=frm_modal_pessoal_ferias&app_modulo=pessoal_ferias&app_codigo="+id);
}

function ExcluirRegistrosPessoalFerias(dados)
{
	$.post("index_xml.php?app_modulo=pessoal_ferias&app_comando=deletar_pessoal_ferias",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridPessoalFerias();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
