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
        $expected_output = $lesson->expected_output;

        //call the correct method for the language
        if($request->language == 'java'){
            $returnValue = $this->java_run($code_complete, $expected_output);
        }
        else if($request->language == 'python'){
            $returnValue = $this->python_run($code_complete, $expected_output);
        }
        else{
            $returnValue = '{"text":"no supported language","status":1}';
        }

        return $returnValue;
    }

    private function java_run($code, $expected_output){
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
                    $text = $runProcess->getOutput();
                    if($text == $expected_output){
                        $status = self::RUN_SUCCESSFUL;
                    }
                    else{
                        //incorrrect output
                        $status = self::OUTPUT_INCORRECT;
                    }
                }
                else{
                    //runtime error
                    $status = self::ERROR;
                    $text = $runProcess->getErrorOutput();
                }
            }
            else{
                //compiling failed
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

    private function python_run($code, $expected_output){
        $container = DockerContainer::create('python_run')->start();
        
        //create a file with the code in it
        $createFileProcess = $container->execute("echo '$code' > /usr/src/myapp/Main.py");
        if($createFileProcess->isSuccessful()){
            //run the program
            $runProcess = $container->execute('cd /usr/src/myapp && python3 Main.py');
            if($runProcess->isSuccessful()){
                $text = $runProcess->getOutput();
                if($text == $expected_output){
                    $status = self::RUN_SUCCESSFUL;
                }
                else{
                    //incorrrect output
                    $status = self::OUTPUT_INCORRECT;
                }
            }
            else{
                //runtime error
                $status = self::ERROR;
                $text = $runProcess->getErrorOutput();
            }
        }
        //file could not be created
        else{
            $status = $createFileProcess->self::ERROR;
            $text = $createFileProcess->getErrorOutput();
        }
        //replace newline charcters
        $text = str_replace( ["\r\n", "\n", "\r"], "\\n", $text);
        return '{"text":"'.$text.'","status":'.$status.'}';
    }
}
?>