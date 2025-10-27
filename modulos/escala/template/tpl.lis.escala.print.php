<div id="kt_app_content_container" class="app-container  p-0" style="margin-bottom: 10px">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title"> Escala Mensal</h3>
        </div>
        <div class="card-body" id="formulario_escala">
            <form action="#" name="frm_escala" id="frm_escala" method="post">
                <input type="hidden" name="id"  id="id"   value="<?=$linha['id'];?>"/>
                <div class="d-flex align-items-center mb-12">
                    <div class="d-flex flex-column">
                        <!--begin::Title-->
                        <h3 class="text-gray-800 fw-semibold">Escala</h3>
                        <!--end::Title-->
                        <!--begin::Info-->
                        <div class="">
                            <!--begin::Label-->
                            <span class="fw-semibold text-muted me-6">Coordenador:
                            <strong><?=$linha['nome_coordenador']?></strong></span>
                            <!--end::Label-->
                            <!--begin::Label-->
                            <span class="fw-semibold text-muted me-6">Início:
			                <strong><?=$linha['data_inicio']?></strong></span>
                            <!--end::Label-->
                            <!--begin::Label-->
                            <span class="fw-semibold text-muted">Fim :
							<span class="fw-bold text-gray-600 me-1"><strong><?=$linha['data_fim']?></strong></span>
                        </span>
                            <!--end::Label-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Content-->
                </div>

                <div style=" margin: 10px">
                    <h5>Legenda:</h5>

                    <?php
                    $objEscalaHorarios = new EscalaHorarios();
                    $rs = $objEscalaHorarios->ListarCombo('',$_SESSION['usuario']['id_grupo']);
                    if(is_array($rs) && count($rs) > 0)
                    {
                        foreach ($rs as $ro) {
                            $cortexto = ( Utils::LiminosidadeCor($ro['cor']) > 128 ) ? '#000' : '#000';
                            echo '<span class="badge " style="padding:5px; color: '.$cortexto.' ;background-color: #f5f5f5">'.$ro['nome'].' ( '.$ro['hora_inicio'].' - '.$ro['hora_fim'].'  )</span> &nbsp;';
                        }
                    }
                    ?>
                </div>


                <!--        --><?php //include_once("modulos/escala/template/tpl.form.escala.php");?>
                <div class="table-responsive">
                    <table class="table dataTable table-striped table-bordered" border="1" cellpadding="4" cellspacing="0" width="100%" id="tb_escala">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <?php
                            $firstday = date('Y-m-d', strtotime($linha['data_inicio']));
                            $startDate = new \DateTime($firstday);
                            $endDate = new \DateTime(date('Y-m-d', strtotime($linha['data_fim'])));
                            $y =0;
                            for($date = $startDate; $date <= $endDate; $date->modify('+1 day')){

                                $semana= $date->format('w');
                                $cor = ($semana == 6 || $semana == 0) ? 'style="background-color: #FFCCBC"' : '' ;
                                $y++;
                                echo ' <th '.$cor.'>'.Utils::NomeDiaSemana($semana).'</th>';
                            }
                            ?>

                        </tr>
                        <tr>
                            <th>NOME</th>
                            <th>FUNÇÃO</th>
                            <th>LOCAL</th>
                            <?php
                            $firstday = date('Y-m-d', strtotime($linha['data_inicio']));
                            $startDate = new \DateTime($firstday);
                            $endDate = new \DateTime(date('Y-m-d', strtotime($linha['data_fim'])));
                            $y =0;
                            for($date = $startDate; $date <= $endDate; $date->modify('+1 day')){
                                $dia= $date->format('d');
                                $y++;
                                echo ' <th>'.$dia.'</th>';
                            }
                            ?>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $objEquipesEfetivo = new EquipesEfetivo();
                        $efetivos = $objEquipesEfetivo->ListarEscalaEquipe($linha['id']);

//                                                Conexao::pr($efetivos);
                        if(is_array($efetivos) && count($efetivos) > 0)
                        {
                            foreach ($efetivos as $efetivo) {

                                $objEscalaEquipeHorarios = new EscalaEquipeHorarios();
                                $horarios = $objEscalaEquipeHorarios->ListarEscalaHorarios($linha['id'],$efetivo['id_usuario']);
//                                Conexao::pr($horarios);
                                ?>
                                <tr>
                                    <td><?=$efetivo['nome_usuario']?></td>
                                    <td><?=$efetivo['nome_cargo']?></td>
                                    <td><?=$efetivo['nome_local']?></td>
<!--                                    <td></td>-->
                                    <?php
                                    $firstday = date('Y-m-d', strtotime($linha['data_inicio']));
                                    $startDate = new \DateTime($firstday);
                                    $endDate = new \DateTime(date('Y-m-d', strtotime($linha['data_fim'])));
                                    $y =0;
                                    for($date = $startDate; $date <= $endDate; $date->modify('+1 day')){
                                        $data= $date->format('Y-m-d');
                                        $cor = ($horarios[$data]['cor'] != "") ? 'style="background-color: #ccc"' : '' ;

//                                        $dia= $date->format('d');
//                                        $data= $date->format('d/m/Y');
                                        $y++;
                                        echo ' <td '.$cor.' align="center">'.substr($horarios[$data]['hora_inicio'],0,5).' <br> '.substr($horarios[$data]['hora_fim'],0,5).'</td>';
                                    }
                                    ?>

                                </tr>
                                <?
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div >