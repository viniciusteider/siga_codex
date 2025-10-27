<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroOrgaoApoio").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_orgao_apoio&app_modulo=orgao_apoio";
        //ModalOrgaoApoio();
	});
	$("#ExcluirRegistroOrgaoApoio").click(function()
	{
		var checked = $("input[name='lista_OrgaoApoio[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_OrgaoApoio[]']:checked"), function() {
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
                        ExcluirRegistrosOrgaoApoio(values);
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
            AtualizarGridOrgaoApoio(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarOrgaoApoio(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_orgao_apoio&app_modulo=orgao_apoio&app_codigo="+id;
        //ModalOrgaoApoio(id);
}
function ModalOrgaoApoio(id){
    $("#modal_modulo_orgao_apoio").modal("show");
    $("#div_modal_orgao_apoio").load("index_xml.php?app_comando=frm_modal_orgao_apoio&app_modulo=orgao_apoio&app_codigo="+id);
}

function ExcluirRegistrosOrgaoApoio(dados)
{
	$.post("index_xml.php?app_modulo=orgao_apoio&app_comando=deletar_orgao_apoio",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridOrgaoApoio();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
