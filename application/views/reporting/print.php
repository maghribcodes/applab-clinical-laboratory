<?php
//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
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
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
		$image_file = K_PATH_IMAGES.'sumbar.png';
		$this->Image($image_file, 15, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('times', 'B', 11);
		// Title
		$this->Cell(150, 15, 'DINAS KESEHATAN PROVINSI SUMATRA BARAT', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(5);
        $this->SetFont('times', 'B', 12);
        $this->Cell(0, 15, 'UPTD LABORATORIUM KESEHATAN', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(5);
        $this->Cell(0, 15, 'PROVINSI SUMATRA BARAT', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(7);
        $this->SetFont('times', 'B', 9);
        $this->Cell(0, 15, 'Jl. Gajah Mada (Gunung Pangilun) Padang. Telp.:0751-7054023. Fax.:0751-41927', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(6);
        $this->writeHTML("<hr>", true, false, false, false, '');
        $this->Line(15,32,195,32);
    }

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('times', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('LABKES');
$pdf->SetTitle('LHU');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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
$pdf->SetFont('times', 'B', 12);

// add a page
$pdf->AddPage();
$pdf->Ln(15);
// set some text to print
$txt = <<<EOD
LAPORAN HASIL UJI
EOD;

$pdf->Write(0, $txt, '', 0, 'C', false, 0, false, false, 0);
// -----------------------------------------------------------------------------

$pdf->SetFont('times', '', 12);

$samples=array();
$parameters=array();
    
foreach($printResult as $pr)
{
    $samples[] = $pr->noSample;
    $samp = array_unique($samples);
    $sampleTypes[] = $pr->sampleType;
    $sampt = array_unique($sampleTypes);
    $parameters[] = $pr->parameterId;
    $param = array_unique($parameters);
}

$s= implode(', ', $samp);
$n = implode(' / ', $samp);
$t = implode(', ', $sampt);

$month = new DateTime($pr->orderTime);
$month = $month->format('m');

$year = new DateTime($pr->orderTime);
$year = $year->format('Y');

$birth = new DateTime($pr->birthDate);
$now = new DateTime();
$age = $now->diff($birth);
$a = $age->y;

$ot = new DateTime($pr->orderTime);
$ot = $ot->format('d F Y');

$st = new DateTime($pr->sampleTime);
$st = $st->format('d F Y');

$pdf->Ln(15);

$txt = <<<EOD
<br />
<table cellpadding="5">
    <tr>
        <td><label>Nomor LHU</label><br />
            <label>Nama</label><br />
            <label>Umur/Jenis Kelamin</label><br />
            <label>Alamat</label><br />
            <label>Kontak</label><br />
            <label>Pengirim</label><br />
            <label>Jenis Sampel</label><br />
            <label>Nomor Sampel</label><br />
            <label>Tanggal Penerimaan</label><br />
            <label>Tanggal Pengujian</label><br />
            <label>Keterangan Klinis</label><br />
        </td>
        <td colspan="2"><label>: {$n} / LHU / LK-SB / {$month} / {$year}</label><br />
            <label>: {$pr->custName}</label><br />
            <label>: {$a} th / {$pr->gender}</label><br />
            <label>: {$pr->address}</label><br />
            <label>: {$pr->contact}</label><br />
            <label>: {$pr->sender}</label><br />
            <label>: {$t}</label><br />
            <label>: {$s}</label><br />
            <label>: {$ot}</label><br />
            <label>: {$st}</label><br />
            <label>: {$pr->clinicalNotes}</label><br />
        </td>
    </tr>
</table>
EOD;

$pdf->writeHTML($txt, true, false, false, false, '');

// ---------------------------------------------------------

$pdf->SetFont('times', 'B', 12);
$txt = <<<EOD
HASIL PENGUJIAN
EOD;

$pdf->Write(0, $txt, '', 0, 'C', false, 0, false, false, 0);
// -----------------------------------------------------------------------------

$pdf->SetFont('times', '', 12);
$pdf->Ln(5);
$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <th width="30" align="center">No.</th>
        <th width="180" align="center">Parameter</th>
        <th width="60" align="center">Satuan</th>
        <th width="150" align="center">Nilai Rujukan</th>
        <th width="60" align="center">Hasil</th>
        <th width="150" align="center">Spesifikasi Metoda</th>
    </tr>
</table>
EOD;

$no=1;
foreach($param as $p)
{
    $nomor = $no++;
$tbl .= <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td width="30" align="center">{$nomor}</td>
        <td width="180" align="center"></td>
        <td width="60" align="center"></td>
        <td width="150" align="center"></td>
        <td width="60" align="center"></td>
        <td width="150" align="center"></td>
    </tr>
</table>
EOD;

}

$pdf->writeHTML($tbl, true, false, false, false, '');
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('LHU.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
