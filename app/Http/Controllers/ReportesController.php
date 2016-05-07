<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use JasperPHP\JasperPHP as JasperPHP;
use Maatwebsite\Excel\Facades\Excel;


class ReportesController extends Controller
{
    public function index()
    {

        $products=Product::search( 'PROCESADO')->orderBy('created_at')->paginate(10);
        return view('reportes.index',compact('products'));



    }
    public function toExcel(){

        $excel = App::make('excel');
        Excel::create('Productos', function($excel) {

            $excel->sheet('Productos', function($sheet) {
                $products=Product::where ('status','PROCESADO')->get();
                //Product:: search( 'PROCESADO')->orderBy('created_at');


              //  dd($products);
                $sheet->fromArray($products);

            });

        })->export('xls');
      //  return redirect('reportes.index');
    }
    public function post()
    {

        $jasper = new JasperPHP;
       // $output = public_path() . '\reports\\'.time().'_pruebaProducto';


        // Compile a JRXML to Jasper


        $database = \Config::get('database.connections.mysql');
        $ext="pdf";

        $input =  public_path().'\reports\pruebaProductos.jasper';
        $input2 =  public_path().'\reports\item.jasper';

       $output =  public_path().'\reports\\'.time().'_pruebaProductos';
        //$data_file = public_path() . '/reports/CancelAck.xml';
        //$driver = 'xml';
        //$xml_xpath = '/CancelResponse/CancelResult/ID';
        //$jasper = new JasperPHP;

       // $jasper->compile( public_path() . '/reports/pruebaProductos.jrxml')->execute();
       //dd($jasper);
       // $jasper->list_parameters(public_path().'\reports\item.jasper');

       // $x=
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
       //  ->output();

        //dd($x);
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
        header('Content-Disposition: attachment; filename='.time().'_productos.'.$ext);
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
