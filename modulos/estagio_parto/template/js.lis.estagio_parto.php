<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroEstagioParto").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_estagio_parto&app_modulo=estagio_parto";
        //ModalEstagioParto();
	});
	$("#ExcluirRegistroEstagioParto").click(function()
	{
		var checked = $("input[name='lista_EstagioParto[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_EstagioParto[]']:checked"), function() {
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
                        ExcluirRegistrosEstagioParto(values);
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
            AtualizarGridEstagioParto(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarEstagioParto(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_estagio_parto&app_modulo=estagio_parto&app_codigo="+id;
        //ModalEstagioParto(id);
}
function ModalEstagioParto(id){
    $("#modal_modulo_estagio_parto").modal("show");
    $("#div_modal_estagio_parto").load("index_xml.php?app_comando=frm_modal_estagio_parto&app_modulo=estagio_parto&app_codigo="+id);
}

function ExcluirRegistrosEstagioParto(dados)
{
	$.post("index_xml.php?app_modulo=estagio_parto&app_comando=deletar_estagio_parto",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridEstagioParto();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
