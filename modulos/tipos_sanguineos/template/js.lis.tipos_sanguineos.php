<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroTiposSanguineos").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_tipos_sanguineos&app_modulo=tipos_sanguineos";
        //ModalTiposSanguineos();
	});
	$("#ExcluirRegistroTiposSanguineos").click(function()
	{
		var checked = $("input[name='lista_TiposSanguineos[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_TiposSanguineos[]']:checked"), function() {
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
                        ExcluirRegistrosTiposSanguineos(values);
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
            AtualizarGridTiposSanguineos(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarTiposSanguineos(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_tipos_sanguineos&app_modulo=tipos_sanguineos&app_codigo="+id;
        //ModalTiposSanguineos(id);
}
function ModalTiposSanguineos(id){
    $("#modal_modulo_tipos_sanguineos").modal("show");
    $("#div_modal_tipos_sanguineos").load("index_xml.php?app_comando=frm_modal_tipos_sanguineos&app_modulo=tipos_sanguineos&app_codigo="+id);
}

function ExcluirRegistrosTiposSanguineos(dados)
{
	$.post("index_xml.php?app_modulo=tipos_sanguineos&app_comando=deletar_tipos_sanguineos",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridTiposSanguineos();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
