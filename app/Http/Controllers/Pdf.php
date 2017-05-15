<?php

namespace ttu\Http\Controllers;

use Illuminate\Http\Request;


class Pdf extends Controller
{
    
  
    private function my_pdf($html,$name){
         //$dom=new Dompdf\Dompdf();
          // $don=new \Dompdf\Dompdf();
           $dom=new \Dompdf\Dompdf();
           $dom->loadHtml($html);
           $dom->setPaper('A4','landscape');
           $dom->render();
           $dom->stream($name.'_'.date('d-m-Y').'.pdf');
    }
    private function my_html($data,$name){
       //  $users= User::all()->where('level',$mentor);
    $array=[];
    foreach($data as $user){
        $course= \ttu\Course::all()->find($user->course)->course;
        array_push($array,'<tr style="margin: 0px;
	border: 1px solid #ccc;"><td>'.$user->id.'</td>'
                . '<td>'.$user->first_name.' '.$user->last_name.'</td>'
                . '<td>'.strtoupper($user->reg).'</td>'
                . '<td>'.$user->mobile.'</td>'
                . '<td>'.$user->course.'</td></tr>');
    }
               $html='<!DOCTYPE html>
<html >
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body style="font-family:"Arial", serif; background: rgb(204,204,204); ">
 <hr>
  <h1> Clearance '.$name.'\'s</h1>
  <hr>
  <h3 style="color: #12507b;">Taita Taveta University</h3>
		<h6>Voi,Kenya</h6>
		<h6 style="color: #12507b; text-decoration: underline;">clearance@ttu.ac.ke</h6>
<hr>
  <table style="width:1000px;">
	  <thead>
		<tr style="border-bottom: 2px solid #12507b;">
			<td style="font-size: 1.1em; font-weight: 600; color: #12507b;
	border: 1px solid #ccc;">
				#
			</td>
			<td style="font-size: 1.1em; font-weight: 600; color: #12507b;
	border: 1px solid #ccc;">
				Name
			</td>
			<td style="font-size: 1.1em; font-weight: 600; color: #12507b;
	border: 1px solid #ccc;">
				Registration no.
			</td>
			<td style="font-size: 1.1em; font-weight: 600; color: #12507b;
	border: 1px solid #ccc;">
				Mobile
			</td>
			<td style="font-size: 1.1em; font-weight: 600; color: #12507b;
	border: 1px solid #ccc;">
			Course
			</td>
		
			
		</tr>
	  </thead>
	  <tbody>
		'.implode($array).'
	  </tbody>
  </table>
 
</body>
</html>
';
    }
}
