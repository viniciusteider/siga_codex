<form action="#" name="frm_equipes" id="frm_equipes" method="post">
    <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
    <div class="form-body">
        <div class="row p-t-20">
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="nome">*Nome</label>
                    <input type="text" name="nome"  id="nome" maxlength="100" class="form-control validar-obrigatorio " value="<?=$linha['nome'];?>"/>
                    <div class="text-muted"> Preencha o campo  Nome </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_coordenador">* Coordenador</label>
                    <?php
                        $objUsuarios  = new Usuario();
                        $registros = ($linha['id_coordenador'] != "") ? $objUsuarios->ListarCombo($linha['id_coordenador']) :[];
                        echo Componente::GerarSelectPDO("id_coordenador", "id_coordenador", "", $registros, array($linha['id_coordenador']), array('','Selecione um Coodenador'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','data-validar="select2"');

                ?>
<!--                    <input type="text" name="id_coordenador"  id="id_coordenador" maxlength="" class="form-control validar-obrigatorio mask-numero" value="--><?//=$linha['id_coordenador'];?><!--"/>-->
                    <div class="text-muted"> Selecione um coordenador </div> </div>
            </div>
            <!--/span-->
            <div class="col-md-4 mb-2">
                <div class="form-group">
                    <label class="form-label" for="id_escala_tipo">* Tipo de Escala</label>
                    <?php
                        $objTipoEscala  = new EscalaTipo();
                        $registros = $objTipoEscala->ListarCombo($linha['id_escala_tipo']);
                        echo Componente::GerarSelectPDO("id_escala_tipo", "id_escala_tipo", "", $registros, array($linha['id_escala_tipo']), array('','Selecione um Tipo'), array("id", "nome"), false, 'form-select  m-b-20 m-r-10','data-validar="select2"');

                   ?>
<!--                    <input type="text" name="id_escala_tipo"  id="id_escala_tipo" maxlength="" class="form-control validar-obrigatorio mask-numero" value="--><?//=$linha['id_escala_tipo'];?><!--"/>-->
                    <div class="text-muted">Selecione um tipo de Escala </div> </div>
            </div>
            <!--/span-->

        </div>
        <div class="row">
            <table id="tb_equipe" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th width="100">ORDEM</th>
                    <th>NOME</th>
                    <th width="30">REMOVER</th>
                </tr>
                </thead>
                <tbody data-repeater-list="equipe_lista">
                <?php
                $objEquipeEfetivo = new EquipesEfetivo();
                $lista_efetivo = $objEquipeEfetivo->ListarEditar($linha['id']);
                if(is_array($lista_efetivo) && count($lista_efetivo))
                {
                $x = 1;
                foreach ($lista_efetivo as $item) {
                ?>
                    <tr data-repeater-item>
                    <td>
                        <input type="hidden" name="id_equipe_efetivo" data-kt-repeater="id_equipe_efetivo" value="<?=$item['id']?>">
                        <input type="text" class="form-control" data-kt-repeater="ordem"  name="ordem[]" id="ordem_1" value="<?=$item['ordem']?>">
                    </td>
                    <td>

                        <select name="id_efetivo" class=" form-select " data-kt-repeater="id_efetivo" data-placeholder="Selecione Membro da Equipe"  >
                            <?php
                            $objUsuarios  = new Usuario();
                            $registros = ($item['id_efetivo'] != "") ? $objUsuarios->ListarCombo($item['id_efetivo']) :[];
                            foreach ($registros as $row)
                            {
                                $selected = ($item['id_efetivo'] == $row['id']) ? 'selected="selected"' : '';
                                echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nome'].'</option>';
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <a href="javascript:;" data-repeater-delete class="btn btn-icon btn-light-danger "  style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .40rem;">
                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                        </a>
                    </td>
                </tr>
                <?php
                }
                }
                else
                {
                ?>
                    <tr data-repeater-item>
                    <td><input type="text" class="form-control" data-kt-repeater="ordem"  name="ordem[]" id="ordem_1" value="1"></td>
                    <td>

                        <select name="id_efetivo" class=" form-select " data-kt-repeater="id_efetivo" data-placeholder="Selecione Membro da Equipe"  >
                        </select>
                    </td>
                    <td>
                        <a href="javascript:;" data-repeater-delete class="btn btn-icon btn-light-danger "  style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .40rem;">
                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                        </a>
                    </td>
                </tr>
                <?php
                }
                ?>

                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3">    <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                            <i class="ki-duotone ki-plus fs-3"></i>
                            Adicinar
                        </a></td>
                </tr>
                </tfoot>
            </table>
        </div>
</form>
