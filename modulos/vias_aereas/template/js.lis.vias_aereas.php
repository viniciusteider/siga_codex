<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroViasAereas").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_vias_aereas&app_modulo=vias_aereas";
        //ModalViasAereas();
	});
	$("#ExcluirRegistroViasAereas").click(function()
	{
		var checked = $("input[name='lista_ViasAereas[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_ViasAereas[]']:checked"), function() {
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
                        ExcluirRegistrosViasAereas(values);
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
            AtualizarGridViasAereas(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarViasAereas(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_vias_aereas&app_modulo=vias_aereas&app_codigo="+id;
        //ModalViasAereas(id);
}
function ModalViasAereas(id){
    $("#modal_modulo_vias_aereas").modal("show");
    $("#div_modal_vias_aereas").load("index_xml.php?app_comando=frm_modal_vias_aereas&app_modulo=vias_aereas&app_codigo="+id);
}

function ExcluirRegistrosViasAereas(dados)
{
	$.post("index_xml.php?app_modulo=vias_aereas&app_comando=deletar_vias_aereas",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridViasAereas();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
