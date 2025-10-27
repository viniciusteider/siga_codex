<script type="text/javascript">
    $(document).ready(function(){
        KTMenu.createInstances();
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
    function ExcluirRegistrosUltimas(dados)
    {
        $.post("index_xml.php?app_modulo=ultimas&app_comando=deletar_ultimas",
            {
                registros:dados
            },
            function(response)
            {
                if(response["codigo"] == 0)
                {
                    Squall.ToastMsg('success','Sucesso ao Remover registro(s)');}
                else
                {
                    Squall.ToastMsg('warning','Erro ao Remover registro(s)');
                }
            }, "json"
        );
    }
</script>
