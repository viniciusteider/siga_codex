<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroFipeMarcas").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_fipe_marcas&app_modulo=fipe_marcas";
        //ModalFipeMarcas();
	});
	$("#ExcluirRegistroFipeMarcas").click(function()
	{
		var checked = $("input[name='lista_FipeMarcas[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_FipeMarcas[]']:checked"), function() {
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
                        ExcluirRegistrosFipeMarcas(values);
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
            AtualizarGridFipeMarcas(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarFipeMarcas(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_fipe_marcas&app_modulo=fipe_marcas&app_codigo="+id;
        //ModalFipeMarcas(id);
}
function ModalFipeMarcas(id){
    $("#modal_modulo_fipe_marcas").modal("show");
    $("#div_modal_fipe_marcas").load("index_xml.php?app_comando=frm_modal_fipe_marcas&app_modulo=fipe_marcas&app_codigo="+id);
}

function ExcluirRegistrosFipeMarcas(dados)
{
	$.post("index_xml.php?app_modulo=fipe_marcas&app_comando=deletar_fipe_marcas",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridFipeMarcas();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
