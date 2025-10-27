<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroProdutosSubGrupo").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_produtos_sub_grupo&app_modulo=produtos_sub_grupo";
        //ModalProdutosSubGrupo();
	});
	$("#ExcluirRegistroProdutosSubGrupo").click(function()
	{
		var checked = $("input[name='lista_ProdutosSubGrupo[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_ProdutosSubGrupo[]']:checked"), function() {
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
                        ExcluirRegistrosProdutosSubGrupo(values);
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
            AtualizarGridProdutosSubGrupo(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarProdutosSubGrupo(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_produtos_sub_grupo&app_modulo=produtos_sub_grupo&app_codigo="+id;
        //ModalProdutosSubGrupo(id);
}
function ModalProdutosSubGrupo(id){
    $("#modal_modulo_produtos_sub_grupo").modal("show");
    $("#div_modal_produtos_sub_grupo").load("index_xml.php?app_comando=frm_modal_produtos_sub_grupo&app_modulo=produtos_sub_grupo&app_codigo="+id);
}

function ExcluirRegistrosProdutosSubGrupo(dados)
{
	$.post("index_xml.php?app_modulo=produtos_sub_grupo&app_comando=deletar_produtos_sub_grupo",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridProdutosSubGrupo({});			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
