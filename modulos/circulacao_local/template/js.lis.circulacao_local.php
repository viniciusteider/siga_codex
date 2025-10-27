<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroCirculacaoLocal").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_circulacao_local&app_modulo=circulacao_local";
        //ModalCirculacaoLocal();
	});
	$("#ExcluirRegistroCirculacaoLocal").click(function()
	{
		var checked = $("input[name='lista_CirculacaoLocal[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_CirculacaoLocal[]']:checked"), function() {
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
                        ExcluirRegistrosCirculacaoLocal(values);
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
            AtualizarGridCirculacaoLocal(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarCirculacaoLocal(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_circulacao_local&app_modulo=circulacao_local&app_codigo="+id;
        //ModalCirculacaoLocal(id);
}
function ModalCirculacaoLocal(id){
    $("#modal_modulo_circulacao_local").modal("show");
    $("#div_modal_circulacao_local").load("index_xml.php?app_comando=frm_modal_circulacao_local&app_modulo=circulacao_local&app_codigo="+id);
}

function ExcluirRegistrosCirculacaoLocal(dados)
{
	$.post("index_xml.php?app_modulo=circulacao_local&app_comando=deletar_circulacao_local",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridCirculacaoLocal();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
