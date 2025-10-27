<?php
include_once("classes/Thumbs.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="content-language" content="pt-br" />
    <meta name="Author" content="Squall" />
    <title><?=TITULO_GERAL?></title>
    <style>
        <? include("assets/css/print.css");?>
    </style>
    <script>
        function Imprimir()
        {
            var css = '@page { size: landscape; }',
                head = document.head || document.getElementsByTagName('head')[0],
                style = document.createElement('style');

            style.type = 'text/css';
            style.media = 'print';

            if (style.styleSheet){
                style.styleSheet.cssText = css;
            } else {
                style.appendChild(document.createTextNode(css));
            }

            head.appendChild(style);

            window.print();
        }

    </script>
</head>
<body onLoad="Imprimir();">
<div id="geral_sistema">

    <div id="logo_sistema">
        <?php
        $thumbs = new Thumbs();
        $thumbs->caminho = "img/logomarcas/";
        $thumbs->largura_max = 90;
        $thumbs->arquivo = $_SESSION['usuario']['configuracoes']['arquivo_logomarca'];
        $imagem = $thumbs->Prepare();
        ?>
        <table width="100%" border="0" cellspacing="4" cellpadding="6">
            <thead>
            <tr>
                <th width="350" rowspan="7" height="50" align="left">
                    <img width="90" src="<?="assets/logo_full.png"?>" align="middle"/>
                    <!-- Se o usuário tiver logomarca aqui ela é definida do lado da logo da link-->
                    <? if ($imagem) echo '<img src="'.$imagem.'"  align="middle" style="margin-left: 20px"/>'; ?>
                </th >
                <th align="left" valign="middle" >
                    <span class="titulo_top">&nbsp;</span>
                    <br />
                    <span class="titulo_top2">&nbsp;</span>
                </th>
            </tr>
            </thead>
        </table>
    </div>

    <div id="conteudo_sistema">
