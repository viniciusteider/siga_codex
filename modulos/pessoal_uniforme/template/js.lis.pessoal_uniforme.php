<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroPessoalUniforme").click(function()
	{
        // window.location = "#index_xml.php?app_comando=frm_adicionar_pessoal_uniforme&app_modulo=pessoal_uniforme";
        ModalPessoalUniforme();
	});
	$("#ExcluirRegistroPessoalUniforme").click(function()
	{
		var checked = $("input[name='lista_PessoalUniforme[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_PessoalUniforme[]']:checked"), function() {
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
                        ExcluirRegistrosPessoalUniforme(values);
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
            AtualizarGridPessoalUniforme(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarPessoalUniforme(id){
    // window.location = "#index_xml.php?app_comando=frm_atualizar_pessoal_uniforme&app_modulo=pessoal_uniforme&app_codigo="+id;
        ModalPessoalUniforme(id);
}
function ModalPessoalUniforme(id){
    $("#modal_modulo_pessoal_uniforme").modal("show");
    $("#div_modal_pessoal_uniforme").load("index_xml.php?app_comando=frm_modal_pessoal_uniforme&app_modulo=pessoal_uniforme&app_codigo="+id);
}

function ExcluirRegistrosPessoalUniforme(dados)
{
	$.post("index_xml.php?app_modulo=pessoal_uniforme&app_comando=deletar_pessoal_uniforme",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridPessoalUniforme();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
