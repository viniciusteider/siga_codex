<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroProdutosMarca").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_produtos_marca&app_modulo=produtos_marca";
        //ModalProdutosMarca();
	});
	$("#ExcluirRegistroProdutosMarca").click(function()
	{
		var checked = $("input[name='lista_ProdutosMarca[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_ProdutosMarca[]']:checked"), function() {
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
                        ExcluirRegistrosProdutosMarca(values);
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
            AtualizarGridProdutosMarca(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarProdutosMarca(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_produtos_marca&app_modulo=produtos_marca&app_codigo="+id;
        //ModalProdutosMarca(id);
}
function ModalProdutosMarca(id){
    $("#modal_modulo_produtos_marca").modal("show");
    $("#div_modal_produtos_marca").load("index_xml.php?app_comando=frm_modal_produtos_marca&app_modulo=produtos_marca&app_codigo="+id);
}

function ExcluirRegistrosProdutosMarca(dados)
{
	$.post("index_xml.php?app_modulo=produtos_marca&app_comando=deletar_produtos_marca",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridProdutosMarca({});			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
