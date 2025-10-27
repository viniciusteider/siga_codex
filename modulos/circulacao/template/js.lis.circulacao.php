<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroCirculacao").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_circulacao&app_modulo=circulacao";
        //ModalCirculacao();
	});
	$("#ExcluirRegistroCirculacao").click(function()
	{
		var checked = $("input[name='lista_Circulacao[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_Circulacao[]']:checked"), function() {
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
                        ExcluirRegistrosCirculacao(values);
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
            AtualizarGridCirculacao(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarCirculacao(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_circulacao&app_modulo=circulacao&app_codigo="+id;
        //ModalCirculacao(id);
}
function ModalCirculacao(id){
    $("#modal_modulo_circulacao").modal("show");
    $("#div_modal_circulacao").load("index_xml.php?app_comando=frm_modal_circulacao&app_modulo=circulacao&app_codigo="+id);
}

function ExcluirRegistrosCirculacao(dados)
{
	$.post("index_xml.php?app_modulo=circulacao&app_comando=deletar_circulacao",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridCirculacao();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
