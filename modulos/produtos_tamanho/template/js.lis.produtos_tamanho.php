<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroProdutosTamanho").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_produtos_tamanho&app_modulo=produtos_tamanho";
        //ModalProdutosTamanho();
	});
	$("#ExcluirRegistroProdutosTamanho").click(function()
	{
		var checked = $("input[name='lista_ProdutosTamanho[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_ProdutosTamanho[]']:checked"), function() {
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
                        ExcluirRegistrosProdutosTamanho(values);
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
            AtualizarGridProdutosTamanho(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarProdutosTamanho(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_produtos_tamanho&app_modulo=produtos_tamanho&app_codigo="+id;
        //ModalProdutosTamanho(id);
}
function ModalProdutosTamanho(id){
    $("#modal_modulo_produtos_tamanho").modal("show");
    $("#div_modal_produtos_tamanho").load("index_xml.php?app_comando=frm_modal_produtos_tamanho&app_modulo=produtos_tamanho&app_codigo="+id);
}

function ExcluirRegistrosProdutosTamanho(dados)
{
	$.post("index_xml.php?app_modulo=produtos_tamanho&app_comando=deletar_produtos_tamanho",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridProdutosTamanho({});			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
