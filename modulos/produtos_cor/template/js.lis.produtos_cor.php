<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroProdutosCor").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_produtos_cor&app_modulo=produtos_cor";
        //ModalProdutosCor();
	});
	$("#ExcluirRegistroProdutosCor").click(function()
	{
		var checked = $("input[name='lista_ProdutosCor[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_ProdutosCor[]']:checked"), function() {
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
                        ExcluirRegistrosProdutosCor(values);
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
            AtualizarGridProdutosCor(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarProdutosCor(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_produtos_cor&app_modulo=produtos_cor&app_codigo="+id;
        //ModalProdutosCor(id);
}
function ModalProdutosCor(id){
    $("#modal_modulo_produtos_cor").modal("show");
    $("#div_modal_produtos_cor").load("index_xml.php?app_comando=frm_modal_produtos_cor&app_modulo=produtos_cor&app_codigo="+id);
}

function ExcluirRegistrosProdutosCor(dados)
{
	$.post("index_xml.php?app_modulo=produtos_cor&app_comando=deletar_produtos_cor",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridProdutosCor({});			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
