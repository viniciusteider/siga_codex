<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroPessoalPunicao").click(function()
	{
        // window.location = "#index_xml.php?app_comando=frm_adicionar_pessoal_punicao&app_modulo=pessoal_punicao";
        ModalPessoalPunicao();
	});
	$("#ExcluirRegistroPessoalPunicao").click(function()
	{
		var checked = $("input[name='lista_PessoalPunicao[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_PessoalPunicao[]']:checked"), function() {
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
                        ExcluirRegistrosPessoalPunicao(values);
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
            AtualizarGridPessoalPunicao(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarPessoalPunicao(id){
    // window.location = "#index_xml.php?app_comando=frm_atualizar_pessoal_punicao&app_modulo=pessoal_punicao&app_codigo="+id;
        ModalPessoalPunicao(id);
}
function ModalPessoalPunicao(id){
    $("#modal_modulo_pessoal_punicao").modal("show");
    $("#div_modal_pessoal_punicao").load("index_xml.php?app_comando=frm_modal_pessoal_punicao&app_modulo=pessoal_punicao&app_codigo="+id);
}

function ExcluirRegistrosPessoalPunicao(dados)
{
	$.post("index_xml.php?app_modulo=pessoal_punicao&app_comando=deletar_pessoal_punicao",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridPessoalPunicao();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
