
<form action="#" name="frm_abertura_ocorrencia" id="frm_abertura_ocorrencia" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <input type="hidden" name="raio"  id="raio"   value="<?=$linha['raio'];?>"/>
    <input type="hidden" value="<?=$linha['id_endereco'];?>" name="id_endereco" id="id_endereco"/>
    <input type="hidden" name="endereco"  id="endereco" maxlength="10" class="form-control  " value="<?=$linha['endereco'];?>"/>
    <input type="hidden" name="numero"  id="numero" maxlength="10" class="form-control  " value="<?=$linha['numero'];?>"/>
    <input type="hidden" name="complemento"  id="complemento" maxlength="50" class="form-control  " value="<?=$linha['complemento'];?>"/>
    <input type="hidden" name="bairro"  id="bairro" maxlength="255" class="form-control  " value="<?=$linha['bairro'];?>"/>
    <input type="hidden" name="id_cidade"  id="id_cidade" maxlength="255" class="form-control  " value="<?=$linha['id_cidade'];?>"/>
    <input type="hidden" name="cidade"  id="cidade" maxlength="255" class="form-control  " value="<?=$linha['cidade'];?>"/>
    <input type="hidden" name="id_estado"  id="id_estado" maxlength="255" class="form-control  " value="<?=$linha['id_estado'];?>"/>
    <input type="hidden" name="estado"  id="estado" maxlength="255" class="form-control  " value="<?=$linha['estado'];?>"/>
    <div class="row">
        <div class="col-md-1 mb-2">
            <div class="form-group">
                <label class="form-label" for="data_hora">Tempo:</label>
                <input type="text" name="tempo"  readonly="readonly" id="tempo"  class="form-control " />
            </div>
        </div>
        <div class="col-md-2 mb-2">
            <div class="form-group">
                <label class="form-label" for="data_hora">Data Hora:</label>
                <input type="text" name="data_hora"  id="data_hora"  class="form-control  mask-datetime" value="<?=Conexao::PrepararDataPHP($linha['data_hora'],$_SESSION['usuario']['timezone']);?>"/>
                </div>
        </div>
        <!--/span-->
        <div class="col-md-2 mb-2">
            <div class="form-group">
                <label class="form-label" for="data_hora">Telefone</label>
                <input type="text" name="telefone"  id="telefone" onblur="VerifcarTelefone(this.value)"  class="form-control validar-obrigatorio" />
                <div class="text-danger" id="contador" style="display: none"> Ligações encontradas <i id="contador_numero"></i> </div>
            </div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="form-group">
                <label class="form-label" for="id_regulador">Tipo Solicitante</label>
                <select name="id_solicitante"  id="id_solicitante" class=" form-select "  data-placeholder="Selecione Solicitante"   >
                    <?php
                    $objsolicitante =  new TipoSolicitante();
                    $user = $objsolicitante->ListarCombo();
                    foreach ($user as $row)
                    {
                        $selected = ($linha['id_classificacao'] == $row['id']) ? 'selected="selected"' : '';
                        echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nome'].'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-2 mb-2">
            <div class="form-group">
                <label class="form-label" for="data_hora">Latitude</label>
                <input type="text" name="latitude" readonly="readonly"  id="latitude"  class="form-control " />
            </div>
        </div>
        <div class="col-md-2 mb-2">
            <div class="form-group">
                <label class="form-label" for="data_hora">Longitude</label>
                <input type="text" name="longitude" readonly="readonly"  id="longitude"  class="form-control " />
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-8 ">
            <div class="row p-t-20">

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="form-label" for="nome">Nome</label>
                        <input type="text" name="nome"  id="nome" maxlength="255" class="form-control  " value="<?=$linha['nome'];?>"/>
                        </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="form-group">
                        <label class="form-label" for="logradouro">Logradouro</label>
                        <input type="text" name="logradouro"  id="logradouro" maxlength="255" class="form-control  " value="<?=$linha['logradouro'];?>"/>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label class="form-label" for="id_evento">Evento</label>
                        <?php
                        $objEvento     = new Evento();
                        $registros = $objEvento->ComboEventos($linha['id_evento']);
                        $onchange = ' onchange="Squall.ListarSelect2(\'index_xml.php?app_modulo=subevento&app_comando=filtrar_sub_eventos&app_codigo=\',\'#id_subevento\',this.value)"';
                        echo Componente::GerarSelectPDO("id_evento", "id_evento", "", $registros, array($linha['id_evento']), array('','Selecione um Evento'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10',' data-validar="select2" '.$onchange);
                        ?>
                    </div>
                </div>
                <!--/span-->
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label class="form-label" for="id_subevento">Sub-Evento</label>
                        <?php
                        $objSubEvento     = new Subevento();
                        $registros = $objSubEvento->ListarComboSubEventos($linha['id_subevento']);
                        $lista = (is_array($registros) && count($registros) > 0) ? $registros : [['id' => '', 'nome' => "Nenhum Registro Econtrado"]] ;
                        echo Componente::GerarSelectPDO("id_subevento", "id_subevento", "", $lista, array($linha['id_subevento']), array(), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','');
                        ?>
                        <!--                                            <input type="text" name="id_subevento"  id="id_subevento"  class="form-control  " value="--><?//=$linha['id_subevento'];?><!--"/>-->
                        <div class="text-muted"> Preencha o campo   Subevento </div> </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label class="form-label" for="id_classificacao">Classificação Ligação</label>
                        <select name="id_classificacao"  id="id_classificacao" class=" form-select "  data-placeholder="Selecione a Classificação"   >
                            <?php
                            $objClassificacao=  new ClassificacaoLigacao();
                            $lis = $objClassificacao->ListarCombo();
                            foreach ($lis as $row)
                            {
                                $selected = ($linha['id_classificacao'] == $row['id']) ? 'selected="selected"' : '';
                                echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nome'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!--/span-->
                <div class="col-md-12 mb-4">
                    <div class="form-group">
                        <label class="form-label" for="observacao">Descritivo</label>
                        <textarea class="form-control  " name="descritivo" rows="4"  id="descritivo" placeholder="Insira o texto" ><?=$linha['descritivo'];?></textarea>

                    </div>
                </div>
                
                <!--/span-->
            </div>
        </div>
        <div class="col-md-4 mh-600px " id="map" >
        </div>

    </div>
</form>

<?php
include_once("modulos/ocorrencias/template/js.frm.abertura.php");
?>
