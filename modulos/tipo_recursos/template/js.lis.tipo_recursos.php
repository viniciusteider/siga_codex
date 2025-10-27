<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistro").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_tipo_recursos&app_modulo=tipo_recursos";
        //ModalTipoRecursos();
	});
	$("#ExcluirRegistro").click(function()
	{
		var checked = $("input[name='lista[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista[]']:checked"), function() {
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
                        ExcluirRegistros(values);
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
            AtualizarGridTipoRecursos(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarTipoRecursos(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_tipo_recursos&app_modulo=tipo_recursos&app_codigo="+id;
        //ModalTipoRecursos(id);
}
function ModalTipoRecursos(id){
    $("#modal_modulo_tipo_recursos").modal("show");
    $("#div_modal_tipo_recursos").load("index_xml.php?app_comando=frm_modal_tipo_recursos&app_modulo=tipo_recursos&app_codigo="+id);
}

function ExcluirRegistros(dados)
{
	$.post("index_xml.php?app_modulo=tipo_recursos&app_comando=deletar_tipo_recursos",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridTipoRecursos();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
