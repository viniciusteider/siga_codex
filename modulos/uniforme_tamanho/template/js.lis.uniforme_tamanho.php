<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroUniformeTamanho").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_uniforme_tamanho&app_modulo=uniforme_tamanho";
        //ModalUniformeTamanho();
	});
	$("#ExcluirRegistroUniformeTamanho").click(function()
	{
		var checked = $("input[name='lista_UniformeTamanho[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_UniformeTamanho[]']:checked"), function() {
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
                        ExcluirRegistrosUniformeTamanho(values);
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
            AtualizarGridUniformeTamanho(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarUniformeTamanho(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_uniforme_tamanho&app_modulo=uniforme_tamanho&app_codigo="+id;
        //ModalUniformeTamanho(id);
}
function ModalUniformeTamanho(id){
    $("#modal_modulo_uniforme_tamanho").modal("show");
    $("#div_modal_uniforme_tamanho").load("index_xml.php?app_comando=frm_modal_uniforme_tamanho&app_modulo=uniforme_tamanho&app_codigo="+id);
}

function ExcluirRegistrosUniformeTamanho(dados)
{
	$.post("index_xml.php?app_modulo=uniforme_tamanho&app_comando=deletar_uniforme_tamanho",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridUniformeTamanho();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
