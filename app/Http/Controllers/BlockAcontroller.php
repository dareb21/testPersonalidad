<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlockAcontroller extends Controller
{
    public function blockA(Request $request)
    {
     
    //Bloque A
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
    $dimensionArray[3] = ["C","E","A","F","D","B"];
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
    $totD[$i] = $arrayResults[$i]*$i;
   }
}
//Sumo todas las dimensiones 1 de la parte a hasta la D

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
}
