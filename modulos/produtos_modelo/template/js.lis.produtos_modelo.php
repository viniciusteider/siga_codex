<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroProdutosModelo").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_produtos_modelo&app_modulo=produtos_modelo";
        //ModalProdutosModelo();
	});
	$("#ExcluirRegistroProdutosModelo").click(function()
	{
		var checked = $("input[name='lista_ProdutosModelo[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_ProdutosModelo[]']:checked"), function() {
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
                        ExcluirRegistrosProdutosModelo(values);
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
            AtualizarGridProdutosModelo(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarProdutosModelo(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_produtos_modelo&app_modulo=produtos_modelo&app_codigo="+id;
        //ModalProdutosModelo(id);
}
function ModalProdutosModelo(id){
    $("#modal_modulo_produtos_modelo").modal("show");
    $("#div_modal_produtos_modelo").load("index_xml.php?app_comando=frm_modal_produtos_modelo&app_modulo=produtos_modelo&app_codigo="+id);
}

function ExcluirRegistrosProdutosModelo(dados)
{
	$.post("index_xml.php?app_modulo=produtos_modelo&app_comando=deletar_produtos_modelo",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridProdutosModelo({});			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
