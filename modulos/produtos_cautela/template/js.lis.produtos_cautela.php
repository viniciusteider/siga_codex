<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroProdutosCautela").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_produtos_cautela&app_modulo=produtos_cautela";
        //ModalProdutosCautela();
	});
	$("#ExcluirRegistroProdutosCautela").click(function()
	{
		var checked = $("input[name='lista_ProdutosCautela[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_ProdutosCautela[]']:checked"), function() {
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
                        ExcluirRegistrosProdutosCautela(values);
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
            AtualizarGridProdutosCautela(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarProdutosCautela(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_produtos_cautela&app_modulo=produtos_cautela&app_codigo="+id;
        //ModalProdutosCautela(id);
}
function ModalProdutosCautela(id){
    $("#modal_modulo_produtos_cautela").modal("show");
    $("#div_modal_produtos_cautela").load("index_xml.php?app_comando=frm_modal_produtos_cautela&app_modulo=produtos_cautela&app_codigo="+id);
}

function ExcluirRegistrosProdutosCautela(dados)
{
	$.post("index_xml.php?app_modulo=produtos_cautela&app_comando=deletar_produtos_cautela",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridProdutosCautela({});			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
