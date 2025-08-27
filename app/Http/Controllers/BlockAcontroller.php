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
    // 1) Leer y normalizar los traits (puede venir como array o como JSON string)
    $input = $request->input('traits');
    $traits = $input;

    if (is_string($input)) {
        $decoded = json_decode($input, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            if (isset($decoded['traits']) && is_array($decoded['traits'])) {
                $traits = $decoded['traits'];
            } elseif (is_array($decoded)) {
                // Podría venir directo como array de rasgos
                $traits = $decoded;
            }
        }
    }

    if (!is_array($traits)) {
        return response()->json(['message' => 'Formato de traits inválido'], 422);
    }

    // 2) (Opcional) Ordenar por score desc para sacar Top 3
    usort($traits, function ($a, $b) {
        return ($b['score'] ?? 0) <=> ($a['score'] ?? 0);
    });

    // 3) Construir HTML dinámico de las tarjetas (Top 3)
    $badges  = ['badge-primary', 'badge-secondary', 'badge-tertiary'];
    $lugares = ['Primer Lugar', 'Segundo Lugar', 'Tercer Lugar'];

    $cardsHtml = '';
    foreach (array_slice($traits, 0, 3) as $i => $trait) {
        $title = e($trait['title'] ?? '—');
        $cardsHtml .= '
            <div class="result-card">
                <div class="badge '.$badges[$i].'">'.($i+1).'</div>
                <div class="card-body">
                    <div class="result-rank">'.$lugares[$i].'</div>
                    <div class="result-name">'.$title.'</div>
                </div>
            </div>';
    }

    // 4) Construir HTML de la lista completa de traits (descripción + características)
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
        $traitsHtml .= '   </ul>
                </div>
            </div>';
    }

    // 5) Tu HTML base EXACTO (inyectando $cardsHtml y $traitsHtml en los lugares marcados)
    $html = <<<HTML
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Informe Vocacional - Tu futuro comienza aquí</title>
        <style>
            /* Tipografía y contenedor principal */
            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial;
                color: #0f172a; /* darker slate */
                background: #ffffff;
                margin: 0;
                padding: 26px;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .container {
                max-width: 840px;
                margin: 0 auto;
            }

            header {
                text-align: center;
                margin-bottom: 22px;
            }

            h1 {
                font-size: 32px;
                margin: 0 0 6px 0;
                color: #0b5fff; /* vivid blue title */
                line-height: 1.05;
            }

            .lead {
                font-size: 15px;
                color: #ffffff; /* slate */
                line-height: 1.5;
                margin: 6px 0 0 0;
            }
            .lead-2{
                font-size: 15px;
                color: #070606;
                line-height: 1.5;
                margin: 6px 0 0 0;
            }

            /* Área de pantalla de resultados */
            .results-screen {
                background: #f8fafc;
                padding: 16px;
                margin: 16px 0;
                border-radius: 10px;
                box-shadow: 0 6px 18px rgba(15, 23, 42, 0.06);
                border: 1px solid #e6eef8;
            }

            .results-title {
                font-size: 16px;
                font-weight: 700;
                color: #0f172a;
                margin-bottom: 12px;
                text-align: center;
            }

            .results-list {
                white-space: normal;
            }

            .result-card {
                display: inline-block;
                vertical-align: top;
                width: 30%;
                box-sizing: border-box;
                padding: 12px;
                margin-right: 3.333%;
                background: #ffffff;
                border: 1px solid #eef6ff;
                border-radius: 8px;
                text-align: center;
                font-size: 14px;
                box-shadow: 0 6px 12px rgba(15, 23, 42, 0.04);
            }

            /* Ensure every third card doesn't keep a right margin so three cards fit on a row */
            .result-card:nth-child(3n) { margin-right: 0; }

            .card-body { text-align: center; }
            .result-rank, .result-name { text-align: center; }
            .card-body .result-rank { color: #475569; font-size: 13px; margin-bottom: 4px; }


            .result-card .badge {
                display: inline-block;
                width: 44px;
                height: 44px;
                line-height: 44px;
                border-radius: 50%;
                color: white;
                font-weight: 700;
                margin-bottom: 10px;
            }

            .badge-primary { background: #0b5fff; }
            .badge-secondary { background: #06b6d4; }
            .badge-tertiary { background: #64748b; }

            .result-rank {
                font-size: 13px;
                color: #475569;
                margin-bottom: 6px;
            }

            .result-name {
                font-size: 17px;
                font-weight: 800;
                margin-bottom: 6px;
                color: #0f172a;
                text-transform: capitalize;
            }

            .result-desc {
                font-size: 13px;
                color: #334155;
                line-height: 1.45;
            }

            /* Descripciones de cada trait */
            .traits {
                margin-top: 12px;
                margin-bottom: 18px;
            }

            .trait-box {
                border: 1px solid #eef2ff;
                padding: 14px;
                margin-bottom: 12px;
                border-radius: 8px;
                background: #ffffff;
                box-shadow: 0 6px 16px rgba(11, 92, 255, 0.03);
            }

            .trait-title {
                font-size: 16px;
                font-weight: 800;
                color: #0b5fff;
                margin-bottom: 6px;
            }

            .trait-desc {
                font-size: 14px;
                color: #334155;
                line-height: 1.5;
                margin-bottom: 8px;
            }

            .trait-list ul { margin: 6px 0 0 20px; }

            footer {
                margin-top: 22px;
                padding: 18px;
                background: #0b5fff; /* blue background for entire footer */
                color: #ffffff; /* white text */
                border-radius: 10px;
                text-align: center;
            }

            .cta {
                font-weight: 700;
                margin-top: 8px;
                color: #ffffff;
            }

            .contact {
                margin-top: 8px;
                font-size: 15px;
                color: #ffffff;
            }

            /* CTA contact block - full width appearance inside footer */
            .contact-cta {
                display: block;
                background: transparent; /* footer already blue */
                color: #ffffff;
                padding: 10px 6px;
                border-radius: 6px;
                margin: 10px auto 0 auto;
                
                max-width: 760px;
            }

            /* Print-focused styles: make everything larger and stack single-column for PDF */
            @media print {
                /* General readability */
                body { padding: 18px; font-size: 14px; }
                .container { max-width: 100% !important; }

                /* Stack result cards one per row and align badge + content horizontally */
                    .results-list { text-align: center !important; }
                    .result-card {
                        display: inline-block !important;
                        width: 30% !important;
                        box-sizing: border-box;
                        margin-right: 3.333% !important;
                        margin-bottom: 14px !important;
                        padding: 12px 16px !important;
                        box-shadow: none !important;
                        border: 1px solid #e6eef8 !important;
                        font-size: 16px !important;
                        vertical-align: top;
                        /* Avoid breaking a result card across pages */
                        break-inside: avoid;
                        page-break-inside: avoid;
                    }
                    .result-card:nth-child(3n) { margin-right: 0 !important; }

                    /* Badge centered above text in print */
                    .result-card .badge { display: block; margin: 0 auto 10px auto; width: 56px; height: 56px; line-height: 56px; font-size: 18px; }
                    .result-card .card-body { display: block; padding-left: 0; text-align: center; }
                    .result-name { font-size: 20px !important; }
                    .result-desc { font-size: 15px !important; }

                /* Traits and boxes more readable */
                .trait-box { break-inside: avoid; page-break-inside: avoid; padding: 16px !important; font-size: 15px !important; }
                .trait-title { font-size: 18px !important; }
                .trait-desc { font-size: 15px !important; }

                /* Avoid breaking inside headings and small elements */
                .result-name, .trait-title, .results-title, #traits-heading { break-after: avoid; page-break-after: avoid; }
                .result-name, .result-rank, .result-desc { break-inside: avoid; page-break-inside: avoid; }

                /* Ensure the results list behaves as a block in print so cards flow vertically */
                .results-list { display: block !important; }

                /* Footer adjustments for print */
                footer { page-break-inside: avoid; break-inside: avoid; border-radius: 6px; padding: 18px !important; }
            }

            /* Mobile small-screen: stack cards vertically on small screens for readability */
            @media (max-width: 640px) {
                .result-card { width: 100%; margin-right: 0; margin-bottom: 10px; }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <header>
                <h1>Tu futuro comienza aquí.</h1>
                <p class="lead-2">Este informe refleja tus intereses y fortalezas, ayudándote a descubrir las carreras que mejor se alinean con tu propósito y tu potencial.</p>
            </header>

            <!-- Aquí se coloca la pantalla de los resultados -->
            <section class="results-screen" aria-labelledby="results-heading">
                <div class="results-title" id="results-heading">Resultados principales</div>
                <div class="results-list">
                    {$cardsHtml}
                </div>
            </section>

            <!-- Descripciones detalladas -->
            <section class="traits" aria-labelledby="traits-heading">
                {$traitsHtml}
            </section>

            <p style="font-size:15px; margin-top:6px;">Elegir tu carrera es descubrir la mejor versión de ti.</p>

            <footer>
                <p class="lead">En USAP creemos en tu talento y estamos listos para acompañarte en este viaje hacia el éxito.</p>
                <div class="contact contact-cta">📞 Contáctanos al <strong>9434-1344</strong> y agenda una cita con tu Asesor de Admisiones para explorar tus opciones y dar el siguiente paso hacia tu futuro.</div>
            </footer>
        </div>
    </body>
</html>
HTML;

    // 6) Generar y devolver el PDF
    // (Ajusta el tamaño de papel a tu preferencia; A4 suele ir mejor con este layout)
    $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');

    return $pdf->download('informe_vocacional.pdf');
}
}