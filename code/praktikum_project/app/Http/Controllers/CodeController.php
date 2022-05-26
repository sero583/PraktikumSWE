<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Docker\DockerContainer as DockerContainer;

class CodeController extends Controller
{
    const RUN_SUCCESSFUL = 0;
    const ERROR = 1;
    const TIME_LIMIT_REACHED = 2;
    const MEM_LIMIT_REACHED = 3;
    const OUTPUT_INCORRECT = 4;

    public function run(Request $request){
        $code = $request->code;
        $lesson_id = $request->lesson_id;

        $lesson = DB::table('lessons')->find($lesson_id);
        //put the code into the template
        $code_complete = str_replace('<usercode>', $code, $lesson->predefined_code);

        //call the correct method for the language
        if($request->language == 'java'){
            $returnValue = $this->java_run($code_complete);
        }
        else{
            $returnValue = '{"text":"no supported language","status":1}';
        }

        return $returnValue;
    }

    private function java_run($code){
        $container = DockerContainer::create('java_run')->start();
        
        //create a file with the code in it
        $createFileProcess = $container->execute("echo '$code' > /usr/src/myapp/Main.java");
        if($createFileProcess->isSuccessful()){
            //compile the program
            $compileProcess = $container->execute('javac /usr/src/myapp/Main.java');
            if($compileProcess->isSuccessful()){
                //run the program
                $runProcess = $container->execute('cd /usr/src/myapp && java Main');
                if($runProcess->isSuccessful()){
                    //TODO check if the output is correct
                    $status = self::RUN_SUCCESSFUL;
                    $text = $runProcess->getOutput();
                }
                //runtime error
                else{
                    $status = self::ERROR;
                    $text = $runProcess->getErrorOutput();
                }
            }
            //compiling failed
            else{
                $status = self::ERROR;
                $text = $compileProcess->getErrorOutput();
            }
        }
        //file could not be created
        else{
            $status = self::ERROR;
            $text = $createFileProcess->getErrorOutput();
        }

        //replace newline charcters
        $text = str_replace( ["\r\n", "\n", "\r"], "\\n", $text);
        return '{"text":"'.$text.'","status":'.$status.'}';
    }
}
?>