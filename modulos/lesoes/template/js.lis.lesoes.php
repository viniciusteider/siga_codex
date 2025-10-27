<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroLesoes").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_lesoes&app_modulo=lesoes";
        //ModalLesoes();
	});
	$("#ExcluirRegistroLesoes").click(function()
	{
		var checked = $("input[name='lista_Lesoes[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_Lesoes[]']:checked"), function() {
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
                        ExcluirRegistrosLesoes(values);
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
            AtualizarGridLesoes(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarLesoes(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_lesoes&app_modulo=lesoes&app_codigo="+id;
        //ModalLesoes(id);
}
function ModalLesoes(id){
    $("#modal_modulo_lesoes").modal("show");
    $("#div_modal_lesoes").load("index_xml.php?app_comando=frm_modal_lesoes&app_modulo=lesoes&app_codigo="+id);
}

function ExcluirRegistrosLesoes(dados)
{
	$.post("index_xml.php?app_modulo=lesoes&app_comando=deletar_lesoes",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridLesoes();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
