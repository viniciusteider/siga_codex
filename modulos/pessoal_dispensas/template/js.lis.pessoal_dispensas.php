<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroPessoalDispensas").click(function()
	{
        // window.location = "#index_xml.php?app_comando=frm_adicionar_pessoal_dispensas&app_modulo=pessoal_dispensas";
        ModalPessoalDispensas();
	});
	$("#ExcluirRegistroPessoalDispensas").click(function()
	{
		var checked = $("input[name='lista_PessoalDispensas[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_PessoalDispensas[]']:checked"), function() {
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
                        ExcluirRegistrosPessoalDispensas(values);
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
            AtualizarGridPessoalDispensas(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarPessoalDispensas(id){
    // window.location = "#index_xml.php?app_comando=frm_atualizar_pessoal_dispensas&app_modulo=pessoal_dispensas&app_codigo="+id;
        ModalPessoalDispensas(id);
}
function ModalPessoalDispensas(id){
    $("#modal_modulo_pessoal_dispensas").modal("show");
    $("#div_modal_pessoal_dispensas").load("index_xml.php?app_comando=frm_modal_pessoal_dispensas&app_modulo=pessoal_dispensas&app_codigo="+id);
}

function ExcluirRegistrosPessoalDispensas(dados)
{
	$.post("index_xml.php?app_modulo=pessoal_dispensas&app_comando=deletar_pessoal_dispensas",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridPessoalDispensas();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
