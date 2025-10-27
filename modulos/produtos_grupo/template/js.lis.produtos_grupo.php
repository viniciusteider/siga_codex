<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroProdutosGrupo").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_produtos_grupo&app_modulo=produtos_grupo";
        //ModalProdutosGrupo();
	});
	$("#ExcluirRegistroProdutosGrupo").click(function()
	{
		var checked = $("input[name='lista_ProdutosGrupo[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_ProdutosGrupo[]']:checked"), function() {
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
                        ExcluirRegistrosProdutosGrupo(values);
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
            AtualizarGridProdutosGrupo(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarProdutosGrupo(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_produtos_grupo&app_modulo=produtos_grupo&app_codigo="+id;
        //ModalProdutosGrupo(id);
}
function ModalProdutosGrupo(id){
    $("#modal_modulo_produtos_grupo").modal("show");
    $("#div_modal_produtos_grupo").load("index_xml.php?app_comando=frm_modal_produtos_grupo&app_modulo=produtos_grupo&app_codigo="+id);
}

function ExcluirRegistrosProdutosGrupo(dados)
{
	$.post("index_xml.php?app_modulo=produtos_grupo&app_comando=deletar_produtos_grupo",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridProdutosGrupo({});			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
