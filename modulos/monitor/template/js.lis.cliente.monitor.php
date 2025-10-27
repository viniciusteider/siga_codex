<script type="text/javascript">
    $(document).ready(function(){
        $('[data-bs-toggle="tooltip"]').tooltip();

    });
   function FiltrarCliente()
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
                text: "Você deseja adicioanr os veículos destes clientes ao Grid?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim, continue!",
                cancelButtonText: "Não, cancelar!",
                closeOnConfirm: false,
                closeOnCancel: false
            }).then((isConfirm) =>{
                if (isConfirm.value) {
                    FiltrarVeiculosClientes(values);
                } else {
                    swal.fire("Cancelado", "Operação cancelada pelo usuário", "error");
                }
            });

        }
        else
        {
            Squall.ToastMsg('warning','Selecione pelo menos 1 registro');
        }
    };
    function FiltrarVeiculosClientes(dados)
    {
        $.post("index_xml.php?app_modulo=monitor&app_comando=filtrar_veiculos_clientes",
            {
                registros:dados
            },
            function(response)
            {
                if(response["codigo"] == 0)
                {
                    Squall.ToastMsg('success','Sucesso ao Remover registro(s)');
                    $('#div_clientes_monitor').modal('hide');
                    AtualizarGridUltimas();
                    AjaxPontos();
     			}
                else
                {
                    Squall.ToastMsg('warning','Erro ao Remover registro(s)');
                }
            }, "json"
        );
    }

</script>
