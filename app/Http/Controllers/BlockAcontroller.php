<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlockAcontroller extends Controller
{
    public function blockA(Request $request)
    {

    $dimensionArray = [];
    $arrayResults= [];
    $arrayMultp = [];

    $dimensionArray[1] = ["E","A","D","B","C","F"];
    $dimensionArray[2] = ["F","C","E","A","D","B"];
    $dimensionArray[3] = ["C","E","A","F","D","B"];
    $dimensionArray[4] = ["B","F","E","D","A","C"];
    $dimensionArray[5] = ["D","C","F","B","E","A"];
  
for ($i=0;$i<5;$i++)
{
 $arrayPosition= array_search($request->idsD[$i+1],$dimensionArray[$i+1]);
   if (!isset($arrayResults[$arrayPosition]))
   {
     $arrayResults[$arrayPosition] = 1;
}   else {
    $arrayResults[$arrayPosition] +=1;
   }
}

for ($i=1;$i<=5;$i++)
{

}
   return response()->json([
        'arrayResults' => $arrayResults,
    ]);
    
        $r1 = $request->idsR[1];
        $r2 = $request->idsR[2];
        $r3 = $request->idsR[3];
        $r4 = $request->idsR[4];
        $r5 = $request->idsR[5];

        $arrayP = [];

    $arrayX = [];
    



        $d_dim1=["E","A","D","B","C","F"];
        $d_dim2=["F","C","E","A","D","B"];
        $d_dim3=["C","E","A","F","D","B"];
        $d_dim4=["B","F","F","D","B"];
        $d_dim5=["C","D","B","A","E"];
        $d_dim6=["F","B","D","C","A"];
     

        $r1Posicion = array_search($r1, $d_dim1);
        
        $r2Posicion = array_search($r2, $d_dim2);
        
        $r3Posicion = array_search($r3, $d_dim3);
        
        $r4Posicion = array_search($r4, $d_dim4); 
        
        $r5Posicion = array_search($r5, $d_dim5);
        



return response()->json([
            'arrayP' => $arrayP,
        ]);


        $optionsA = $request->idsA;
        $dimA1 = [3,11,18,21,24,27,35,44];
        $dimA2 = [8,19,29,31,33,36,37,43];
        $dimA3 = [4,14,15,16,17,22];
        $dimA4 = [5,6,7,9,10,26,28,42];
        $dimA5 = [2,12,23,32,38,39,40,41];
        $dimA6 = [1,13,20,25,30,34,45];
        
        $intersectDimA1 = array_intersect($dimA1, $optionsA);
        $sumDimA1 = array_sum($intersectDimA1);
        
        $intersectDimA2 = array_intersect($dimA2, $optionsA);
        $sumDimA2 = array_sum($intersectDimA2);
        
        $intersectDimA3 = array_intersect($dimA3, $optionsA);
        $sumDimA3 = array_sum($intersectDimA3);
        
        $intersectDimA4 = array_intersect($dimA4, $optionsA);
        $sumDimA4 = array_sum($intersectDimA4);
        
        $intersectDimA5 = array_intersect($dimA5, $optionsA);
        $sumDimA5 = array_sum($intersectDimA5);
        
        $intersectDimA6 = array_intersect($dimA6, $optionsA);
        $sumDimA6 = array_sum($intersectDimA6);



        $b_onlyA = array_filter($request->idsB, fn($value) => $value === "A");       
        $optionsB = array_keys($b_onlyA);
        $dimB1 = [1,10,16];
        $dimB2 = [9,13,14];
        $dimB3 = [5,8,17];
        $dimB4 = [3,4,18];
        $dimB5 = [7,12,15];
        $dimB6 = [2,6,11]; 
        $intersectB1 = array_intersect($dimB1, $optionsB);
        $sumB1 = array_sum($intersectB1);

        $intersectB2 = array_intersect($dimB2, $optionsB);
        $sumB2 = array_sum($intersectB2);
        
        $intersectB3 = array_intersect($dimB3, $optionsB);
        $sumB3 = array_sum($intersectB3);
        
        $intersectB4 = array_intersect($dimB4, $optionsB);
        $sumB4 = array_sum($intersectB4);
        
        $intersectB5 = array_intersect($dimB5, $optionsB);
        $sumB5 = array_sum($intersectB5);
        
        $intersectB6 = array_intersect($dimB6, $optionsB);
        $sumB6 = array_sum($intersectB6);
  
    $c_onlyA = array_filter($request->idsC, fn($value) => $value === "A");
    $optionsC = array_keys($c_onlyA);   
       
        $dimC1 = [2,5,12];
        $dimC2 = [4,9,10];
        $dimC3 = [3,14,18];
        $dimC4 = [1,8,13];
        $dimC5 = [6,7,17];
        $dimC6 = [11,15,16];
        
  $intersectC1 = array_intersect($dimC1, $optionsC);
        $sumC1 = array_sum($intersectC1);

        $intersectC2 = array_intersect($dimC2, $optionsC);
        $sumC2 = array_sum($intersectC2);
        
        $intersectC3 = array_intersect($dimC3, $optionsC);
        $sumC3 = array_sum($intersectC3);
        
        $intersectC4 = array_intersect($dimC4, $optionsC);
        $sumC4 = array_sum($intersectC4);
        
        $intersectC5 = array_intersect($dimC5, $optionsC);
        $sumC5 = array_sum($intersectC5);
        
        $intersectC6 = array_intersect($dimC6, $optionsC);
        $sumC6 = array_sum($intersectC6);








    }
}
