<?php
$sinais_clinicos = new SinaisClinicos();
$registros = $sinais_clinicos->PacienteSinais($_REQUEST["app_codigo"]);

if(count($registros ?? []) > 0 )
{
    echo '<ul class="d-flex flex-wrap ">';
    foreach ($registros as $sn)
    {
        $checked = ($sn['checked'] != "") ? 'checked="checked"' : '';
        echo '<li class="p-1 m-2 w-250px list-unstyled" >
             <input class="form-check-input " type="checkbox" value="'.$sn['id'].'" '.$checked.' id="sinais_clinicos_'.$sn['id'].'" name="sinais_clinicos[]"> 
            <label for="sinais_clinicos_'.$sn['id'].'">'.$sn['sinais'].'</label></li>';
    }
    echo '</ul>';
}
