<script type="text/javascript">
    var id_ocorrencia = $('#id_ocorrencia').val();
$(document).ready(function(){
	$("#AdicionarRegistroPaciente").click(function()
	{
        // window.location = "#index_xml.php?app_comando=frm_adicionar_paciente&app_modulo=paciente";

        ModalPaciente('',id_ocorrencia);
	});
	$("#ExcluirRegistroPaciente").click(function()
	{
		var checked = $("input[name='lista_Paciente[]']:checked").length;
		if(checked > 0)
		{
			var values = new Array();
			$.each($("input[name='lista_Paciente[]']:checked"), function() {
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
                        ExcluirRegistrosPaciente(values);
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
            AtualizarGridPaciente(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});


});

function AbrirMateriais(id)
{
    Modal = new SquallModal();
    Modal.titulo_modal = "Materiais";
    Modal.id_modal = 'modal_materiais';
    Modal.id_conteudo_modal = 'div_materiais';
    Modal.url = "index_xml.php?app_modulo=ocorrencias_materiais&app_comando=listar_ocorrencias_materiais&id_paciente="+id+"&id_ocorrencia="+id_ocorrencia;
    Modal.botao_salvar = '';
    Modal.tamanho_modal = 'mw-80vw';
    Modal.Gerar();
}
function ModificarPaciente(id){
    // window.location = "#index_xml.php?app_comando=frm_atualizar_paciente&app_modulo=paciente&app_codigo="+id;
        ModalPaciente(id,id_ocorrencia);
}
function ModalPaciente(id,id_ocorrencia){
    $("#modal_modulo_paciente").modal("show");
    $("#div_modal_paciente").load("index_xml.php?app_comando=frm_modal_paciente&app_modulo=paciente&app_codigo="+id+"&id_ocorrencia="+id_ocorrencia);
}

function ExcluirRegistrosPaciente(dados)
{
	$.post("index_xml.php?app_modulo=paciente&app_comando=deletar_paciente",
		{
			registros:dados
		},
		function(response)
		{
			if(response["codigo"] == 0)
			{
                Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                AtualizarGridPaciente();			}
			else
			{
                Squall.ToastMsg('warning','Erro ao Remover registro(s)');
			}
		}, "json"
	);
}
</script>
