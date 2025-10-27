<script type="text/javascript">
$(document).ready(function(){
	$("#AdicionarRegistroInstituicaoEnsino").click(function()
	{
        window.location = "#index_xml.php?app_comando=frm_adicionar_instituicao_ensino&app_modulo=instituicao_ensino";
        //ModalInstituicaoEnsino();
	});
	$("#ExcluirRegistroInstituicaoEnsino").click(function()
	{
		var checked = $("input[name='lista_InstituicaoEnsino[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_InstituicaoEnsino[]']:checked"), function() {
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
                        ExcluirRegistrosInstituicaoEnsino(values);
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
            AtualizarGridInstituicaoEnsino(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
});


function ModificarInstituicaoEnsino(id){
    window.location = "#index_xml.php?app_comando=frm_atualizar_instituicao_ensino&app_modulo=instituicao_ensino&app_codigo="+id;
        //ModalInstituicaoEnsino(id);
}
function ModalInstituicaoEnsino(id){
    $("#modal_modulo_instituicao_ensino").modal("show");
    $("#div_modal_instituicao_ensino").load("index_xml.php?app_comando=frm_modal_instituicao_ensino&app_modulo=instituicao_ensino&app_codigo="+id);
}

function ExcluirRegistrosInstituicaoEnsino(dados)
{
	$.post("index_xml.php?app_modulo=instituicao_ensino&app_comando=deletar_instituicao_ensino",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridInstituicaoEnsino();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
