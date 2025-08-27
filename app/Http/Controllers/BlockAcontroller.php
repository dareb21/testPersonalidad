<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BlockAcontroller extends Controller
{
    public function blockA(Request $request)
    {
     
    //Bloque A TODO EESTE BLOQUE ESTA BUENO.
        $optionsA = $request->idsA;
        $dimA1 = [3,11,18,21,24,27,35,44];
        $dimA2 = [8,19,29,31,33,36,37,43];
        $dimA3 = [4,14,15,16,17,22];
        $dimA4 = [5,6,7,9,10,26,28,42];
        $dimA5 = [2,12,23,32,38,39,40,41];
        $dimA6 = [1,13,20,25,30,34,45];
        
        $intersectDimA1 = array_intersect($dimA1, $optionsA);
        $totA1 = array_sum($intersectDimA1);
        
        $intersectDimA2 = array_intersect($dimA2, $optionsA);
        $totA2 = array_sum($intersectDimA2);
        
        $intersectDimA3 = array_intersect($dimA3, $optionsA);
        $totA3 = array_sum($intersectDimA3);
        
        $intersectDimA4 = array_intersect($dimA4, $optionsA);
        $totA4 = array_sum($intersectDimA4);
        
        $intersectDimA5 = array_intersect($dimA5, $optionsA);
        $totA5 = array_sum($intersectDimA5);
        
        $intersectDimA6 = array_intersect($dimA6, $optionsA);
        $totA6 = array_sum($intersectDimA6);
   
//Bloque B
        $b_onlyA = array_filter($request->idsB, fn($value) => $value === "A");       
        $optionsB = array_keys($b_onlyA);
        $dimB1 = [1,10,16];
        $dimB2 = [9,13,14];
        $dimB3 = [5,8,17];
        $dimB4 = [3,4,18];
        $dimB5 = [7,12,15];
        $dimB6 = [2,6,11]; 
        $intersectB1 = array_intersect($dimB1, $optionsB);
        $totB1 = array_sum($intersectB1);

        $intersectB2 = array_intersect($dimB2, $optionsB);
        $totB2 = array_sum($intersectB2);
        
        $intersectB3 = array_intersect($dimB3, $optionsB);
        $totB3 = array_sum($intersectB3);
           
   $intersectB4 = array_intersect($dimB4, $optionsB);
        $totB4 = array_sum($intersectB4);
  
        $intersectB5 = array_intersect($dimB5, $optionsB);
        $totB5 = array_sum($intersectB5);
        
        $intersectB6 = array_intersect($dimB6, $optionsB);
        $totB6 = array_sum($intersectB6);
  

//Bloque C
    $c_onlyA = array_filter($request->idsC, fn($value) => $value === "A");
    $optionsC = array_keys($c_onlyA);   
       
        $dimC1 = [2,5,12];
        $dimC2 = [4,9,10];
        $dimC3 = [3,14,18];
        $dimC4 = [1,8,13];
        $dimC5 = [6,7,17];
        $dimC6 = [11,15,16];
        
  $intersectC1 = array_intersect($dimC1, $optionsC);
        $totC1 = array_sum($intersectC1);

        $intersectC2 = array_intersect($dimC2, $optionsC);
        $totC2 = array_sum($intersectC2);
        
        $intersectC3 = array_intersect($dimC3, $optionsC);
        $totC3 = array_sum($intersectC3);
        
        $intersectC4 = array_intersect($dimC4, $optionsC);
        $totC4 = array_sum($intersectC4);
        
        $intersectC5 = array_intersect($dimC5, $optionsC);
        $totC5 = array_sum($intersectC5);
        
        $intersectC6 = array_intersect($dimC6, $optionsC);
        $totC6 = array_sum($intersectC6);


//BLOQUE D
 $dimensionArray = [];
    $arrayResults= [];
    $totD = [];

    $dimensionArray[1] = ["E","A","D","B","C","F"];
    $dimensionArray[2] = ["F","C","E","A","D","B"];
    $dimensionArray[3] = ["C","E","A","F","B","D"];
    $dimensionArray[4] = ["B","F","E","D","A","C"];
    $dimensionArray[5] = ["D","C","F","B","E","A"];
  
for ($i=1;$i<=5;$i++)
{
 $arrayPosition= array_search($request->idsD[$i],$dimensionArray[$i]);
   if (!isset($arrayResults[$arrayPosition+1]))
   {
     $arrayResults[$arrayPosition+1] = 1;
}   else {
    $arrayResults[$arrayPosition+1] +=1;
   }
}

for ($i=1;$i<=6;$i++)
{
  if (!isset($arrayResults[$i]))
   {
     $totD[$i] = 0;
}   else {
    $totD[$i] = $arrayResults[$i];
   }
}



$tot1= $totA1 + $totB1 + $totC1 + $totD[1];
$tot2= $totA2 + $totB2 + $totC2 + $totD[2];
$tot3= $totA3 + $totB3 + $totC3 + $totD[3];
$tot4= $totA4 + $totB4 + $totC4 + $totD[4];
$tot5= $totA5 + $totB5 + $totC5 + $totD[5];
$tot6= $totA6 + $totB6 + $totC6 + $totD[6];
 
$finalArray = [
"REALISTA" => $tot1,
"INVESTIGADOR" => $tot2,
"SOCIAL" => $tot3,
"CONVENCIONAL" => $tot4,
"EMPRENDEDOR" => $tot5,
"ARTISTICO" => $tot6
];
arsort($finalArray);
$top3 = array_slice($finalArray, 0, 3, true);

return response()->json($top3);
}

public function report(Request $request)
{
    // 1) Normalizar "traits" (puede venir como array o string JSON)
    $input  = $request->input('traits');
    $traits = $input;

    if (is_string($input)) {
        $decoded = json_decode($input, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            if (isset($decoded['traits']) && is_array($decoded['traits'])) {
                $traits = $decoded['traits'];
            } elseif (is_array($decoded)) {
                $traits = $decoded; // podría venir como array directo
            }
        }
    }

    if (!is_array($traits)) {
        return response()->json(['message' => 'Formato de traits inválido'], 422);
    }

    // 2) Ordenar por score desc y tomar Top 3 para las tarjetas
    usort($traits, fn($a, $b) => ($b['score'] ?? 0) <=> ($a['score'] ?? 0));

    $badges  = ['badge-primary', 'badge-secondary', 'badge-tertiary'];
    $lugares = ['Primer Lugar', 'Segundo Lugar', 'Tercer Lugar'];

    // 3) Tarjetas en UNA FILA usando TABLE (DomPDF lo respeta mejor que inline-block)
    $cardsHtml = '<table class="cards"><tr>';
    $top = array_slice($traits, 0, 3);
    foreach ($top as $i => $trait) {
        $title = e($trait['title'] ?? '—');
        $cardsHtml .= '
            <td>
                <div class="result-card">
                    <div class="badge '.$badges[$i].'">'.($i+1).'</div>
                    <div class="card-body">
                        <div class="result-rank">'.$lugares[$i].'</div>
                        <div class="result-name">'.$title.'</div>
                    </div>
                </div>
            </td>';
    }
    // Rellenar celdas si hay menos de 3 (para mantener la fila)
    for ($i = count($top); $i < 3; $i++) {
        $cardsHtml .= '<td></td>';
    }
    $cardsHtml .= '</tr></table>';

    // 4) Lista completa de traits (descripción + características)
    $traitsHtml = '';
    foreach ($traits as $trait) {
        $title = e($trait['title'] ?? '—');
        $desc  = e($trait['description'] ?? '');
        $traitsHtml .= '
            <div class="trait-box">
                <div class="trait-title">'.$title.'</div>
                <div class="trait-desc">'.$desc.'</div>
                <div class="trait-list">Características:
                    <ul>';
        if (!empty($trait['characteristics']) && is_array($trait['characteristics'])) {
            foreach ($trait['characteristics'] as $char) {
                $traitsHtml .= '<li>'.e($char).'</li>';
            }
        }
        $traitsHtml .= '</ul>
                </div>
            </div>';
    }

    // 5) HTML base optimizado para A5 (3 tarjetas en fila + tipografías compactas)
    $html = <<<HTML
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Informe Vocacional - Tu futuro comienza aquí</title>
<style>
    /* Dimensiones y ajustes para A5 */
    @page { margin: 10mm 8mm; }

    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        color: #0f172a;
        background: #ffffff;
        margin: 0;
        padding: 8px 6px; /* más compacto para A5 */
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
        font-size: 12px; /* base un poco más pequeña */
        line-height: 1.35;
    }

    .container {
        width: 100%;
        max-width: 100%;
        margin: 0 auto;
    }

    header { text-align: center; margin-bottom: 12px; }
    h1 { font-size: 22px; margin: 0 0 6px 0; color: #0b5fff; line-height: 1.1; }

    .lead { font-size: 12px; color: #ffffff; line-height: 1.45; margin: 4px 0 0 0; }
    .lead-2 { font-size: 12px; color: #070606; line-height: 1.45; margin: 4px 0 0 0; }

    /* Resultados principales */
    .results-screen {
        background: #f8fafc;
        padding: 10px;
        margin: 10px 0;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(15, 23, 42, 0.06);
        border: 1px solid #e6eef8;
        break-inside: avoid;
        page-break-inside: avoid;
    }

    .results-title {
        font-size: 13px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 8px;
        text-align: center;
    }

    /* Tabla para asegurar 3 columnas */
    .cards {
        width: 100%;
        table-layout: fixed;
        border-collapse: separate;
        border-spacing: 6px; /* separación entre tarjetas */
        margin: 0 auto;
    }
    .cards td {
        width: 33.33%;
        padding: 0;
        vertical-align: top;
    }

    .result-card {
        width: 100%;
        background: #ffffff;
        padding: 10px;
        border: 1px solid #eef6ff;
        border-radius: 8px;
        text-align: center;
        font-size: 12px;
        box-shadow: 0 4px 8px rgba(15, 23, 42, 0.04);
        break-inside: avoid;
        page-break-inside: avoid;
        min-height: 90px;
    }

    .result-card .badge {
        display: inline-block;
        width: 34px;
        height: 34px;
        line-height: 34px;
        border-radius: 50%;
        color: white;
        font-weight: 700;
        margin-bottom: 6px;
        font-size: 14px;
    }
    .badge-primary { background: #0b5fff; }
    .badge-secondary { background: #06b6d4; }
    .badge-tertiary { background: #64748b; }

    .result-rank { font-size: 11px; color: #475569; margin-bottom: 4px; }
    .result-name { font-size: 13px; font-weight: 800; margin-bottom: 4px; color: #0f172a; text-transform: capitalize; }

    /* Traits */
    .traits { margin-top: 10px; margin-bottom: 12px; }
    .trait-box {
        border: 1px solid #eef2ff;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 8px;
        background: #ffffff;
        box-shadow: 0 4px 10px rgba(11, 92, 255, 0.03);
        break-inside: avoid;
        page-break-inside: avoid;
    }
    .trait-title { font-size: 13px; font-weight: 800; color: #0b5fff; margin-bottom: 4px; }
    .trait-desc  { font-size: 12px; color: #334155; line-height: 1.45; margin-bottom: 6px; word-wrap: break-word; }
    .trait-list ul { margin: 6px 0 0 18px; font-size: 12px; }

    footer {
        margin-top: 14px;
        padding: 12px;
        background: #0b5fff;
        color: #ffffff;
        border-radius: 8px;
        text-align: center;
        break-inside: avoid;
        page-break-inside: avoid;
    }
    .contact-cta { display: block; background: transparent; color: #ffffff; padding: 8px 6px; border-radius: 6px; margin: 8px auto 0; max-width: 100%; font-size: 12px; }
</style>
</head>
<body>
<div class="container">
    <header>
        <h1>Tu futuro comienza aquí.</h1>
        <p class="lead-2">Este informe refleja tus intereses y fortalezas, ayudándote a descubrir las carreras que mejor se alinean con tu propósito y tu potencial.</p>
    </header>

    <section class="results-screen" aria-labelledby="results-heading">
        <div class="results-title" id="results-heading">Resultados principales</div>
        {$cardsHtml}
    </section>

    <section class="traits" aria-labelledby="traits-heading">
        {$traitsHtml}
    </section>

    <p style="font-size:12px; margin-top:6px;">Elegir tu carrera es descubrir la mejor versión de ti.</p>

    <footer>
        <p class="lead" style="color:#fff; margin:0;">En USAP creemos en tu talento y estamos listos para acompañarte en este viaje hacia el éxito.</p>
        <div class="contact-cta">📞 Contáctanos al <strong>9434-1344</strong> y agenda una cita con tu Asesor de Admisiones para explorar tus opciones y dar el siguiente paso hacia tu futuro.</div>
    </footer>
</div>
</body>
</html>
HTML;

    // 6) Generar PDF en A5 (portrait)
    $pdf = Pdf::loadHTML($html)->setPaper('a5', 'portrait');

    return $pdf->download('informe_vocacional.pdf');
}
}