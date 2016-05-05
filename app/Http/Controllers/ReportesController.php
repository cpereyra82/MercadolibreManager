<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use JasperPHP\JasperPHP as JasperPHP;

class ReportesController extends Controller
{
    public function index()
    {

        $products=Product::search( 'PROCESADO')->orderBy('created_at')->paginate(10);
        return view('reportes.index',compact('products'));



    }

    public function post()
    {


       // $output = public_path() . '\reports\\'.time().'_pruebaProducto';


        // Compile a JRXML to Jasper
     //   $jasper->compile( public_path() . '/reports/pruebaProducto.jasper.jrxml')->execute();

        $database = \Config::get('database.connections.mysql');
        $ext="pdf";

        $input =  public_path().'\reports\pruebaProducto.jasper';

       $output =  public_path().'\reports\\'.time().'_pruebaProducto';
        //$data_file = public_path() . '/reports/CancelAck.xml';
        //$driver = 'xml';
        //$xml_xpath = '/CancelResponse/CancelResult/ID';
        //$jasper = new JasperPHP;


        $jasper = new JasperPHP;
          $jasper->process(
             $input,
             $output,
             array($ext),
           array(),// array('background'=>public_path().'\reports\flower1.png'),
             $database,
            false,
            false
         )

       /* //$x=
           $jasper->process(
            public_path() . '/reports/CancelAck.jrxml',
            $output,
            array($ext),
            array(),
            array('data_file' => $data_file, 'driver' => $driver, 'xml_xpath' => $xml_xpath),
            false,
            false)*/

               ->execute();
       //   ->output();
      //  dd($database);
     //   dd($x);
       /*  $ext = "pdf";
         $data_file =public_path() . '\reports\pruebaProducto.jasper';
         $driver = 'jasper';
         $path = public_path() . '\reports\\';

        $x= $jasper->process(
             public_path() . '\reports\pruebaProducto.jrxml',
             $output,
             array($ext),
             array(),
             array('data_file' => $data_file, 'driver' => $driver, 'path' => $path),
             false,
             false
         )->output();
         dd($x);*/

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.time().'_pruebaProducto.'.$ext);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Length: ' . filesize($output.'.'.$ext));
        flush();
        readfile($output.'.'.$ext);
        unlink($output.'.'.$ext);

       // return view('reportes.index');
        //Redirect::to('/reporting');
    }
}
