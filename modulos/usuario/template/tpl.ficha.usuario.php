<?php
ob_start();
?>
<style>
    td{
        font-family: "Helvetica Neue", Arial, Helvetica, sans-serif;
        font-size: 12px;

    }
</style>
<table width="100%" border="0" cellpadding="2" cellspacing="1" style="width:100%">
    <tr>
        <td width="40%">
            <a href="#">
                <img alt="Logo" src="assets/media/logos/default-dark.svg" width="250"/>
            </a>
        </td>
        <td>    <h2 style="text-align:center">
                <strong>ESTADO DO PARAN&Aacute;<br />
                    CONS&Oacute;RCIO DO SAMU<br />
                    MUNICÍPIO SEDE SAMU</strong></h2></td>
    </tr>
</table>
    <h2>FICHA PESSOAL</h2>
<div dir="ltr" align="left">
    <table width="100%" border="1" cellpadding="0" cellpadding="2">
        <colgroup>
            <col width="155" />
            <col width="89" />
            <col width="452" />
        </colgroup>
        <tbody>
        <tr>
            <td colspan="3"><strong>IDENTIFICAÇÃO</strong></td>
        </tr>
        <tr>
            <td rowspan="4"><img src="<?=$linha['foto']?>" width="89" height="118" /></td>
            <td><strong>NOME:&nbsp;</strong></td>
            <td><?=$linha['nome']?></td>
        </tr>
        <tr>
            <td><strong>APELIDO:&nbsp;</strong></td>
            <td><?=$linha['apelido']?></td>
        </tr>
        <tr>
            <td><strong>FUNÇÃO</strong></td>
            <td><?=$linha['nome_funcao']?></td>
        </tr>
        <tr>
            <td><strong>RG:&nbsp;</strong></td>
            <td><?=$linha['rg']?></td>
        </tr>
        </tbody>
    </table>
</div>
<br />
<div dir="ltr" align="left">
    <table width="100%" border="1" cellpadding="0" cellpadding="2">
        <colgroup>
            <col width="130" />
            <col width="7" />
            <col width="111" />
            <col width="96" />
            <col width="7" />
            <col width="137" />
            <col width="18" />
            <col width="85" />
            <col width="57" />
            <col width="50" />
        </colgroup>
        <tbody>
        <tr>
            <td colspan="10"><strong>INFORMAÇÕES DE LOTAÇÃO</strong></td>
        </tr>
        <tr>
            <td colspan="2"><strong>CONSÓRCIO:&nbsp;</strong></td>
            <td><?=$linha['nome_grupo']?></td>
            <td colspan="2"><strong>CIDADE</strong></td>
            <td><?=$linha['nome_cidade']?></td>
            <td colspan="2"><strong>BASE:</strong>&nbsp;</td>
            <td colspan="2"><?=$linha['nome_base']?></td>
        </tr>
        <tr>
            <td colspan="2"><strong>DATA DE INCLUSÃO:&nbsp;</strong></td>
            <td><?=$linha['nome']?></td>
            <td colspan="2"><strong>MATRÍCULA</strong></td>
            <td colspan="5"><?=$linha['matricula']?></td>
        </tr>
        <tr>
            <td colspan="10"><strong>INFORMAÇÕES PESSOAIS</strong></td>
        </tr>
        <tr>
            <td colspan="10"><strong>FILIAÇÃO: </strong><?=$linha['nome_mae']?>&nbsp; e&nbsp; <?=$linha['nome_pai']?>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="10"><strong>DATA DE NASCIMENTO :&nbsp; </strong>&nbsp; <?=$linha['data_nascimento']?>&nbsp; <strong>NATURALIDADE:</strong> <?=$linha['naturalidade']?>&nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td colspan="10"><strong>GENERO:</strong> <?=$linha['nome_genero']?> &nbsp; <strong>ETNIA:</strong> <?=$linha['nome_etinia']?> &nbsp; &nbsp; <strong>SANGUE:</strong> <?=$linha['nome_tipo_sanguineo']?> &nbsp; &nbsp; <strong>ESTADO CIVIL:</strong> <?=$linha['nome_estado_civil']?>&nbsp; &nbsp; <strong>ALTURA:</strong> <?=$linha['altura']?> &nbsp; &nbsp;<strong> PESO:</strong> <?=$linha['peso']?></td>
        </tr>
        <tr>
            <td colspan="10"><strong>RG:</strong> <?=$linha['rg']?> <strong>CPF:</strong> <?=$linha['cpf']?> <strong>PASEP:</strong> <?=$linha['pis']?> <strong>ELEITOR:</strong> <?=$linha['titulo_eleitor']?> <strong>ZONA:</strong> <?=$linha['zona']?> <strong>SEÇÃO:</strong> <?=$linha['secao']?> <strong>CIDADE:</strong> <?=$linha['cidade_titulo']?></td>
        </tr>
        <tr>
            <td colspan="10"><strong>CNH:</strong> <?=$linha['cnh']?> &nbsp; <strong>CATEGORIA:</strong> <?=$linha['categoria_cnh']?> &nbsp; <strong>VALIDADE:</strong> <?=$linha['validade_cnh']?>&nbsp; &nbsp; <strong>VALIDADE CVE:</strong> <?=$linha['validade_cve']?> &nbsp; <strong>VALIDADE TOX:</strong> <?=$linha['validade_toxicologico']?></td>
        </tr>
        <tr>
            <td colspan="10"><strong>FORMAÇÃO:</strong> <?=$linha['nome_formacao']?>&nbsp;</td>
        </tr>
        </tbody>
    </table>
</div>
<br />
<div dir="ltr" align="left">
    <table width="100%" border="1" cellpadding="0" cellpadding="2">
        <colgroup>
            <col width="198" />
            <col width="180" />
            <col width="188" />
            <col width="129" />
        </colgroup>
        <tbody>
        <tr>
            <td colspan="4"><strong>INFORMAÇÕES REFERENTES A ENDEREÇO</strong></td>
        </tr>
        <tr>
            <td><strong>LOGRADOURO:&nbsp;</strong></td>
            <td><?=$linha['endereco']?>&nbsp;</td>
            <td><strong>NUMERO:&nbsp;</strong></td>
            <td><?=$linha['numero']?></td>
        </tr>
        <tr>
            <td><strong>BAIRRO:&nbsp;</strong></td>
            <td><?=$linha['bairro']?>&nbsp;</td>
            <td><strong>ESTADO:&nbsp;</strong></td>
            <td><?=$linha['nome_estado']?></td>
        </tr>
        <tr>
            <td><strong>CIDADE:&nbsp;</strong></td>
            <td><?=$linha['nome_cidade']?>&nbsp;</td>
            <td><strong>CEP:&nbsp;</strong></td>
            <td><?=$linha['cep']?></td>
        </tr>
        <tr>
            <td><strong>TELEFONE:&nbsp;</strong></td>
            <td><?=$linha['telefone']?>&nbsp;</td>
            <td><strong>CELULAR:&nbsp;</strong></td>
            <td><?=$linha['celular']?></td>
        </tr>
        <tr>
            <td><strong>EMAIL</strong></td>
            <td colspan="3"><?=$linha['email']?></td>
        </tr>
        </tbody>
    </table>
</div>
<br />
<br />
<div dir="ltr" align="left">
    <table width="100%" border="1" cellpadding="0" cellpadding="2">
        <colgroup>
            <col width="198" />
            <col width="180" />
            <col width="188" />
            <col width="129" />
        </colgroup>
        <tbody>
        <tr>
            <td colspan="4"><strong>INFORMAÇÕES DE UNIFORME</strong></td>
        </tr>
        <tr>
            <td><strong>CAMISETA:&nbsp;</strong></td>
            <td>G</td>
            <td><strong>MACACÃO</strong></td>
            <td>G</td>
        </tr>
        <tr>
            <td><strong>BOTINA:&nbsp;</strong></td>
            <td>40</td>
            <td><strong>TÊNIS</strong></td>
            <td>40</td>
        </tr>
        <tr>
            <td><strong>CAPA DE CHUVA</strong></td>
            <td>ÚNICO</td>
            <td><strong>BONÉ</strong></td>
            <td>ÚNICO</td>
        </tr>
        </tbody>
    </table>
</div>
<br />
<br />
Gerado em 03/01/2024 por Amarildo / 57774746 
<?php
$html = ob_get_contents();
include_once("MPDF6/mpdf.php");
//pra gerar em paisagem
$mpdf = new mPDF("utf-8", "A4-P");
$mpdf->WriteHTML($html);
$mpdf->Output();
