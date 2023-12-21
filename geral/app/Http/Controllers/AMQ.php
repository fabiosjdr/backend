<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Fabio\Bibliotecas\Util\SendMessage;

class AMQ extends Controller
{

   
    public function send(Request $request)
    {
        
        if($request->has('msg')){
            $value = $request->query('msg');
        }else{
            $value = '1';
        }

        $file_name = "progressBar";
        
        $file = $file_name.'.txt';
        file_put_contents($file, $value);

        //$cookie_value = $value;
        //setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

        
        return response($value,200);
        //$msg = new SendMessage();
        //echo $msg->call($text);
        //echo $msg->send($text);
        
    }

    public function receive(Request $request)
    {
        
        $msg = new SendMessage();
        $msg->receive();
        
    }


    public function listen(Request $request)
    {
       
        return response()->stream(function () {
            
            $file_name = "progressBar";
        
            $file = $file_name.'.txt';

            //$i= 0;
            while (true) {
                
                $progress = ( file_get_contents($file) ) ? file_get_contents($file) : 10;
                echo 'data: {"progress":' .$progress. '}' . "\n\n";

                ob_flush();
                flush();

                // Break the loop if the client aborted the connection (closed the page)
                if (connection_aborted() ) {break;}
                
                sleep(3); // 50ms
            }
        }, 200, [
            'Cache-Control' => 'no-cache',
            'Content-Type' => 'text/event-stream',
        ]);
       

        
    }


}
