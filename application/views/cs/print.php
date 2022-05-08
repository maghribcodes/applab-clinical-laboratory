<?php
//============================================================+
// File name   : example_048.php
// Begin       : 2009-03-20
// Last Update : 2013-05-14
//
// Description : Example 048 for TCPDF class
//               HTML tables and table headers
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: HTML tables and table headers
 * @author Nicola Asuni
 * @since 2009-03-20
 */

// Include the main TCPDF library (search for installation path).
//require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Labkes');
$pdf->SetTitle('Nota');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(10, 10, 10);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
//$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage('P', 'A5');

//$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('times', '', 8);

// -----------------------------------------------------------------------------

$samples=array();
$parameters=array();
    
foreach($printNota as $pn)
{
    $samples[] = $pn->noSample;
    $parameters[] = $pn->parameterId;
    $samp = array_unique($samples);
    $param = array_unique($parameters);
}

$nom = $pn->orderId;
if(strlen($nom) == 1)
{
	$nom = "00000".$nom;
}
else if(strlen($nom) == 2)
{
	$nom = "0000".$nom;
}
else if(strlen($nom) == 3)
{
	$nom = "000".$nom;   
}
else if(strlen($nom) == 4)
{
    $nom = "00".$nom;   
}
else if(strlen($nom) == 5)
{
    $nom = "0".$nom;
}
else
{
    $nom;
}

$birth = new DateTime($pn->birthDate);
$now = new DateTime();
$age = $now->diff($birth);
$a = $age->y;

$date = new DateTime($pn->birthDate);
$date = $date->format('d F Y');

$s= implode(', ', $samp);

$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td align="center" vertical-align="middle">PEMERINTAH PROVINSI<br />SUMATERA BARAT<br /><br />UPTD LAB. KES PADANG</td>
        <td align="center" vertical-align="middle">SURAT KETETAPAN RETRIBUSI DAERAH (SKRD)<br />PELAYANAN KESEHATAN (YANKES)</td>
        <td align="center" vertical-align="middle"><br /><br />No. {$nom}</td>
    </tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="2"> A. IDENTITAS WAJIB RETRIBUSI / PASIEN</td>
        <td> PENGIRIM: {$pn->sender}</td>
    </tr>
</table>
<br />
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td><div> - Nama</div>
            <div> - Jenis Kelamin</div>
            <div> - Umur / Tgl. Lahir</div>
            <div> - Alamat</div>
            <div> - No. Sampel</div>
        </td>
        <td colspan="2"><div>: {$pn->custName}</div>
            <div>: {$pn->gender}</div>
            <div>: {$a} th / {$date}</div>
            <div>: {$pn->address}</div>
            <div>: {$s}</div>
        </td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------

$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="3"> B. NOTA PERHITUNGAN</td>
    </tr>
    <tr>
        <td width="20" align="center">No.</td>
        <td width="330" align="center">Jenis Pemeriksaan</td>
        <td width="103" align="center">Tarif (Rp.)</td>
    </tr>
</table>
EOD;

$no=1;
$cost = array();
foreach($printCost as $pc)
{ 
    if(in_array($pc->parameterId, $param))
    {
        $cost[] = $pc->parameterCost;
        $total = array_sum($cost);
        $format1 = number_format($pc->parameterCost, 2, ',', '.');
        $nomor = $no++;
$tbl .= <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td width="20" align="center">{$nomor}</td>
        <td width="330"> {$pc->parameterName}</td>
        <td width="103" align="center">{$format1}</td>
    </tr>
</table>
EOD;
    }
}

$format2 = number_format($total, 2, ',', '.');
$tbl.=<<<EOD
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td width="350" align="center" colspan="2">JUMLAH YANG DIBAYAR</td>
        <td width="103" align="center">{$format2}</td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
// -----------------------------------------------------------------------------

$date2 = new DateTime($pn->orderTime);
$date2 = $date2->format('d F Y');

$tbl = <<<EOD
<table>
    <tr>
        <td align="right">PADANG, {$date2}</td>
    </tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="2"> C. LEGALISASI PEMBAYARAN</td>
    </tr>
    <tr>
        <td align="center">Yang menerima<br />BENDAHARA KHUSUS PENERIMA<br /><br /><br /><br /></td>
        <td align="center">Yang membayar<br />WAJIB RETRIBUSI / KUASA<br /><br /><br /><br /></td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('nota.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
