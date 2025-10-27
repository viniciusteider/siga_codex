<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroSinaisClinicos").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_sinais_clinicos&app_modulo=sinais_clinicos";
        //ModalSinaisClinicos();
	});
	$("#ExcluirRegistroSinaisClinicos").click(function()
	{
		var checked = $("input[name='lista_SinaisClinicos[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_SinaisClinicos[]']:checked"), function() {
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
                        ExcluirRegistrosSinaisClinicos(values);
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
            AtualizarGridSinaisClinicos(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarSinaisClinicos(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_sinais_clinicos&app_modulo=sinais_clinicos&app_codigo="+id;
        //ModalSinaisClinicos(id);
}
function ModalSinaisClinicos(id){
    $("#modal_modulo_sinais_clinicos").modal("show");
    $("#div_modal_sinais_clinicos").load("index_xml.php?app_comando=frm_modal_sinais_clinicos&app_modulo=sinais_clinicos&app_codigo="+id);
}

function ExcluirRegistrosSinaisClinicos(dados)
{
	$.post("index_xml.php?app_modulo=sinais_clinicos&app_comando=deletar_sinais_clinicos",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridSinaisClinicos({});			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
