<div class="row p-t-20">
    <?php
        $objProcedimentoTipo = new ProcedimentosTipo();
        $tipos = $objProcedimentoTipo->ListarCombo();

        $objPacienteProcedimentos = new PacienteProcedimentos();
        $procedimentos_selcionados = $objPacienteProcedimentos->ListarCombo($linha['id']);
        $selecionados = array();
        if(is_array($procedimentos_selcionados) && count($procedimentos_selcionados) > 0)
        {
            foreach ($procedimentos_selcionados as $procedimentos_selcionado) {
                $selecionados[] = $procedimentos_selcionado['id_procedimento'];
            }
        }
//        Conexao::pr($selecionados);
        if(is_array($tipos) && count($tipos) > 0)
        {
            foreach ($tipos as $tipo) {
                echo '    <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label class="form-label" for="id_procedimento">'.$tipo['nome'].':</label>
                                ';
                    $objProcedimentos = new Procedimentos();
                    $procedimentos = $objProcedimentos->ListarComboTipo($tipo['id']);
                     echo Componente::GerarSelectPDO("id_procedimentos[]", "id_procedimentos_".$tipo['id'], "", $procedimentos, $selecionados, array('','Selecione Procedimento'), array("id", "procedimento"), true, 'form-select  m-b-20 m-r-10 select-procedimentos','');

                echo'       
                            </div>
                        </div>';
            }
        }

    ?>

    <!--/span-->
</div>