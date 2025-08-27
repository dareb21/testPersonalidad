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
    $traits = $request->traits;

       $badges = ['badge-primary', 'badge-secondary', 'badge-tertiary'];
    $lugares = ['Primer Lugar', 'Segundo Lugar', 'Tercer Lugar'];
    $cardsHtml = '';

    foreach (array_slice($traits, 0, 3) as $i => $trait) {
        $cardsHtml .= '
        <div class="result-card">
            <div class="badge '.$badges[$i].'">'.($i+1).'</div>
            <div class="result-rank">'.$lugares[$i].'</div>
            <div class="result-name">'.e($trait['title']).'</div>
        </div>';
    }

    // 🔹 Generar las descripciones detalladas de cada trait
    $traitsHtml = '';
    foreach ($traits as $trait) {
        $traitsHtml .= '
        <div class="trait-box">
            <div class="trait-title">'.e($trait['title']).'</div>
            <div class="trait-desc">'.e($trait['description']).'</div>
            <div class="trait-list">Características:
                <ul>';
        foreach ($trait['characteristics'] as $char) {
            $traitsHtml .= '<li>'.e($char).'</li>';
        }
        $traitsHtml .= '</ul>
            </div>
        </div>';
    }

    // 🔹 Tu HTML base con los estilos (los pegas tal cual)
    $html = <<<HTML
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Informe Vocacional - Tu futuro comienza aquí</title>
<style>
/* Aquí pegues todos tus estilos del HTML que compartiste */
body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial; color:#0f172a; background:#fff; margin:0; padding:26px; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
.container { max-width: 840px; margin: 0 auto; }
header { text-align: center; margin-bottom: 22px; }
h1 { font-size: 32px; margin:0 0 6px 0; color:#0b5fff; line-height:1.05; }
.lead-2 { font-size:15px; color:#070606; line-height:1.5; margin:6px 0 0 0; }
.results-screen { background:#f8fafc; padding:16px; margin:16px 0; border-radius:10px; box-shadow:0 6px 18px rgba(15,23,42,0.06); border:1px solid #e6eef8; }
.results-title { font-size:16px; font-weight:700; color:#0f172a; margin-bottom:12px; text-align:center; }
.results-list { white-space: normal; }
.result-card { display:inline-block; vertical-align:top; width:30%; box-sizing:border-box; padding:12px; margin-right:3.333%; background:#fff; border:1px solid #eef6ff; border-radius:8px; text-align:center; font-size:14px; box-shadow:0 6px 12px rgba(15,23,42,0.04); }
.result-card .badge { display:inline-block; width:44px; height:44px; line-height:44px; border-radius:50%; color:white; font-weight:700; margin-bottom:10px; }
.badge-primary { background: #0b5fff; }
.badge-secondary { background: #06b6d4; }
.badge-tertiary { background: #64748b; }
.result-rank { font-size:13px; color:#475569; margin-bottom:6px; }
.result-name { font-size:17px; font-weight:800; margin-bottom:6px; color:#0f172a; text-transform:capitalize; }
.traits { margin-top:12px; margin-bottom:18px; }
.trait-box { border:1px solid #eef2ff; padding:14px; margin-bottom:12px; border-radius:8px; background:#fff; box-shadow:0 6px 16px rgba(11,92,255,0.03); }
.trait-title { font-size:16px; font-weight:800; color:#0b5fff; margin-bottom:6px; }
.trait-desc { font-size:14px; color:#334155; line-height:1.5; margin-bottom:8px; }
.trait-list ul { margin:6px 0 0 20px; }
footer { margin-top:22px; padding:18px; background:#0b5fff; color:#fff; border-radius:10px; text-align:center; }
.contact-cta { display:block; background:transparent; color:#fff; padding:10px 6px; border-radius:6px; margin:10px auto 0 auto; max-width:760px; }
</style>
</head>
<body>
<div class="container">
<header>
<h1>Tu futuro comienza aquí.</h1>
<p class="lead-2">Este informe refleja tus intereses y fortalezas, ayudándote a descubrir las carreras que mejor se alinean con tu propósito y tu potencial.</p>
</header>

<section class="results-screen">
<div class="results-title">Resultados principales</div>
<div class="results-list">
$cardsHtml
</div>
</section>

<section class="traits">
$traitsHtml
</section>

<p style="font-size:15px; margin-top:6px;">Elegir tu carrera es descubrir la mejor versión de ti.</p>

<footer>
<p>En USAP creemos en tu talento y estamos listos para acompañarte en este viaje hacia el éxito.</p>
<div class="contact-cta">📞 Contáctanos al <strong>9434-1344</strong> y agenda una cita con tu Asesor de Admisiones para explorar tus opciones y dar el siguiente paso hacia tu futuro.</div>
</footer>
</div>
</body>
</html>
HTML;

    // Generar PDF
    $pdf = Pdf::loadHTML($html)->setPaper('a5', 'portrait');
    return $pdf->download('informe_vocacional.pdf');
}
}