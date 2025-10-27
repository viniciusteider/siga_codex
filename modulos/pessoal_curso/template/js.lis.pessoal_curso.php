<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroPessoalCurso").click(function()
	{
        // window.location = "#index_xml.php?app_comando=frm_adicionar_pessoal_curso&app_modulo=pessoal_curso";
        ModalPessoalCurso();
	});
	$("#ExcluirRegistroPessoalCurso").click(function()
	{
		var checked = $("input[name='lista_PessoalCurso[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_PessoalCurso[]']:checked"), function() {
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
                        ExcluirRegistrosPessoalCurso(values);
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
            AtualizarGridPessoalCurso(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarPessoalCurso(id){
    // window.location = "#index_xml.php?app_comando=frm_atualizar_pessoal_curso&app_modulo=pessoal_curso&app_codigo="+id;
        ModalPessoalCurso(id);
}
function ModalPessoalCurso(id){
    $("#modal_modulo_pessoal_curso").modal("show");
    $("#div_modal_pessoal_curso").load("index_xml.php?app_comando=frm_modal_pessoal_curso&app_modulo=pessoal_curso&app_codigo="+id);
}

function ExcluirRegistrosPessoalCurso(dados)
{
	$.post("index_xml.php?app_modulo=pessoal_curso&app_comando=deletar_pessoal_curso",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridPessoalCurso();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
