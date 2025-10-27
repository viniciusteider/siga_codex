<form action="#" name="frm_paciente" id="frm_paciente" method="post">
<!--    <input type="hidden" name="id"  id="id"   value="--><?//=$linha['id'];?><!--"/>-->
    <input type="hidden" name="id_paciente"  id="id_paciente"   value="<?=$linha['id'];?>"/>
    <input type="hidden" name="id_ocorrencia"  id="id_ocorrencia"   value="<?=$_REQUEST['id_ocorrencia'];?>"/>
    <input type="hidden" name="id_endereco"  id="id_endereco"   value="<?=$linha['id_endereco'];?>"/>
    <input type="hidden" name="latitude"  id="latitude"   value="<?=$linha['latitude'];?>"/>
    <input type="hidden" name="longitude"  id="longitude"   value="<?=$linha['longitude'];?>"/>
    <input type="hidden" name="cidade"  id="cidade"   value="<?=$linha['cidade'];?>"/>
    <input type="hidden" name="estado"  id="estado"   value="<?=$linha['estado'];?>"/>
    <input type="hidden" name="endereco_completo"  id="endereco_completo"   value="<?=$linha['endereco_completo'];?>"/>
    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x  mb-5 fs-6">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">
                <i class="fa fa-user"></i>
                Paciente</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_3"><i class="fa fa-heart-broken"></i> Sinais Vitais</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_7"><i class="fa fa-heart-broken"></i> Sinais Clínicos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_4"><i class="fa fa-user-doctor"></i> Lesões | Obstetrícia</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_5"><i class="fa fa-file-pdf"></i> Procedimentos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_6"><i class="fa fa-pills"></i> Medicamentos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2"><i class="fa fa-users-gear"></i> Atendimento</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
            <?php include_once("modulos/paciente/template/frm.paciente.php");?>
        </div>
        
        <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
            <?php include_once("modulos/paciente/template/frm.vias.php");?>
        </div>
        <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
                        <?php include_once("modulos/paciente/template/frm.lesoes.php");?>
        </div>
        <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
                        <?php include_once("modulos/paciente/template/frm.procedimentos.php");?>
        </div>
        <div class="tab-pane fade" id="kt_tab_pane_6" role="tabpanel">
            <?php include_once("modulos/paciente/template/frm.medicamentos.php");?>
        </div>
        <div class="tab-pane fade" id="kt_tab_pane_7" role="tabpanel">
            <?php include_once("modulos/paciente/template/frm.sinais_clinicos.php");?>
        </div>
        <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
            <?php include_once("modulos/paciente/template/frm.atendimento.php");?>
        </div>

    </div>
</form>
<?php
include_once("modulos/paciente/template/js.modal.paciente.php");
?>
