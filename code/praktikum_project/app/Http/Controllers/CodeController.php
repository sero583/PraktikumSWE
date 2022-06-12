<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Course;
use App\Models\FinishedLesson;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Docker\DockerContainer;

class CodeController extends Controller {
    const JAVA = "java";
    const PYTHON = "python";
    const JAVASCRIPT = "javascript";
    const SUPPORTED_LANGUAGES = [self::JAVA, self::JAVASCRIPT, self::PYTHON];

    public static function supportsLanguage(string $language) : bool {
        return in_array($language, self::SUPPORTED_LANGUAGES);
    }

    // status types
    const RUN_SUCCESSFUL = 0;
    const ERROR = 1;
    const TIME_LIMIT_REACHED = 2;
    const MEM_LIMIT_REACHED = 3;
    const OUTPUT_INCORRECT = 4;

    const DEFAULT_KILL_TIME = 30; // in seconds

    public function run(Request $request) {
        $codeFromRequest = $request->code;
        $lesson_id = $request->lesson_id;
        $user_id = Auth::user()->id;

        if($codeFromRequest===null||is_string($codeFromRequest)===false) {
            return response()->json([
                "text" => "No code given in request.",
                "status" => 1
            ], 400);
        }

        if($lesson_id===null||is_string($lesson_id)===false) {
            return response()->json([
                "text" => "No lessson ID given.",
                "status" => self::ERROR
            ], 400);
        }

        $lesson = Lesson::find($lesson_id);
        // check code CAN be null
        $checkCode = $lesson->testerCode;        
        $expected_output = $lesson->expected_output;

        $returnValue = null;

        switch($lesson->language) {
            case self::JAVA: 
                $returnValue = $this->java_run($codeFromRequest, $expected_output, $checkCode);
            break;
            case self::PYTHON:
                $returnValue = $this->python_run($codeFromRequest, $expected_output, $checkCode);
            break;
            case self::JAVASCRIPT:
                $returnValue = $this->javascript_run($codeFromRequest, $expected_output, $checkCode);
            break;
            default: return response()->json([
                "text" => "Language {$lesson->language} is not supported.",
                "status" => 0
            ], 400);
        }

        $text = $returnValue["text"];
        $status = $returnValue["status"];
        $hasCheck = $returnValue["hasCheck"];

        $success = false;
        $courseCompleted = false;

        if($status===0) {
            if(FinishedLesson::where("lesson_id",  $lesson_id)->where("user_id", $user_id)->exists()===false) {
                $finished_lesson = new FinishedLesson;
                $finished_lesson->lesson_id = $lesson_id;
                $finished_lesson->user_id = $user_id;
                $finished_lesson->save();
                $success = true;
            }
        }

        return response()->json([
            "success" => $success, // controlls success popup for lesson successfully completed
            "text" => $text, // output text
            "status" => $status, // returns status code of execution
            "hasCheck" => $hasCheck, // returns if the lesson had a check (Test.java/js/py file)
            "courseCompleted" => $courseCompleted // responds if the course has been completed (shows success popup for course complete)
        ], 200);
    }

    private function java_run(string $code, ?string $expected_output = null, ?string $checkCode = null) : array {
        $container = DockerContainer::create("java_run")->start();

        error_log("Java running!");

        //create a file with the code in it
        $createFileProcess = $container->execute("echo \"$code\" > /usr/src/myapp/Main.java");
        $file = "Main";
        if($checkCode!==null) {
            $createTestFileProcess = $container->execute("echo \"$checkCode\" > /usr/src/myapp/Test.java");
            $file = "Test";

            error_log("With tester!");
        }


        if($createFileProcess->isSuccessful()){
            //compile the program
            $compileProcess = $container->execute("javac /usr/src/myapp/Main.java");
            if($checkCode!==null) {
                $compileProcess = $container->execute("javac /usr/src/myapp/Test.java");
            }

            if($compileProcess->isSuccessful()){
                //run the program
                $runProcess = $container->execute("cd /usr/src/myapp && java $file");
                if($runProcess->isSuccessful()){
                    $text = $runProcess->getOutput();
                    
                    // when there is an expected output, check it
                    if($expected_output!==null) {  
                        if($text===$expected_output){
                            $status = self::RUN_SUCCESSFUL;
                        }
                        else{
                            //incorrrect output
                            $status = self::OUTPUT_INCORRECT;
                        }
                    } else { // otherwise check for exit code. here it is already 0 -> so successful run
                        $status = self::RUN_SUCCESSFUL;
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
        return ["text" => $text, "status" => $status, "hasCheck" => $checkCode !== null];
    }

    private function python_run(string $code, ?string $expected_output = null, ?string $checkCode = null) : array {
        $container = DockerContainer::create("python_run")->start();

        //create a file with the code in it
        $createFileProcess = $container->execute("echo \"$code\" > /usr/src/myapp/Main.py");
        $file = "Main";
        if($checkCode!==null) {
            $createTestFileProcess = $container->execute("echo \"$checkCode\" > /usr/src/myapp/Test.py");
            $file = "Test";
        }


        if($createFileProcess->isSuccessful()){
            //run the program
            $runProcess = $container->execute("cd /usr/src/myapp && python3 $file.py");
            if($runProcess->isSuccessful()){
                $text = $runProcess->getOutput();
                
                 // when there is an expected output, check it
                if($expected_output!==null) {  
                    if($text===$expected_output){
                        $status = self::RUN_SUCCESSFUL;
                    }
                    else{
                        //incorrrect output
                        $status = self::OUTPUT_INCORRECT;
                    }
                } else { // otherwise check for exit code. here it is already 0 -> so successful run
                    $status = self::RUN_SUCCESSFUL;
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
            $status = self::ERROR;
            $text = $createFileProcess->getErrorOutput();
        }
        //replace newline charcters
        $text = str_replace( ["\r\n", "\n", "\r"], "\\n", $text);
        return ["text" => $text, "status" => $status, "hasCheck" => $checkCode !== null];
    }

    private function javascript_run(string $code, ?string $expected_output = null, ?string $checkCode = null) : array {
        $container = DockerContainer::create("javascript_run")->start();

        //create a file with the code in it
        $createFileProcess = $container->execute("echo \"$code\" > /usr/src/myapp/Main.js");        
        if($checkCode!==null) {
            $createTestFileProcess = $container->execute("echo \"$checkCode\" > /usr/src/myapp/Test.js");
            $file = "Test";
        }


        if($createFileProcess->isSuccessful()){
            //run the program
            $runProcess = $container->execute("cd /usr/src/myapp && node $file.js");
            if($runProcess->isSuccessful()){
                $text = $runProcess->getOutput();
                
                 // when there is an expected output, check it
                if($expected_output!==null) {  
                    if($text===$expected_output){
                        $status = self::RUN_SUCCESSFUL;
                    }
                    else{
                        //incorrrect output
                        $status = self::OUTPUT_INCORRECT;
                    }
                } else { // otherwise check for exit code. here it is already 0 -> so successful run
                    $status = self::RUN_SUCCESSFUL;
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
            $status = self::ERROR;
            $text = $createFileProcess->getErrorOutput();
        }
        //replace newline charcters
        $text = str_replace( ["\r\n", "\n", "\r"], "\\n", $text);
        return ["text" => $text, "status" => $status, "hasCheck" => $checkCode !== null];
    }
}
?>
