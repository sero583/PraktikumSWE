<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lesson;

class LessonSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lesson::truncate();
        Lesson::create([
            "course_id"=>1,
            "position"=>1,
            "title"=>"Hello World in Java",
            "description"=>"Write a \"Hello World\" program in Java. In the Editor you can see all the Code necessary for doing that. The class is called Main because the program is written to the file \"Main.java\". All you have to do now is add the String you want to print into the print() statement.",
            "predefined_code"=>"<usercode>",
            "predefined_code_visible"=>"public class Main {\n\tpublic static void main(String[] args) {\n\t\tSystem.out.print();\n\t}\n}",
            "expected_output"=>"Hello World",
            "xp"=>20,
            "language"=>"java"
        ]);
        Lesson::create([
            "course_id"=>1,
            "position"=>2,
            "title"=>"More sophisticated example",
            "description"=>"This is a more complicated example, where the user is supposed to implement a function, but this could also be a class etc. In this example the user is supposed to implement the function greet() that returns \"Hello World\" and all the stuff with the Main class and main Method is hidden from the user.",
            "predefined_code"=>"public class Main {\n\tpublic static void main(String[] args) {\n\t\tSystem.out.println(greet());\n\t}\n\t<usercode>\n}",
            "predefined_code_visible"=>"public static String greet(){\n\t\n}",
            "expected_output"=>"Hello World\n",
            "xp"=>20,
            "language"=>"java"
        ]);
        Lesson::create([
            "course_id"=>2,
            "position"=>1,
            "title"=>"Hello World in Python",
            "description"=>"Write a \"Hello World\" program in Python. In the Editor you can see all the Code necessary for doing that. All you have to do now is add the String you want to print into the print() statement.",
            "predefined_code"=>"<usercode>",
            "predefined_code_visible"=>"print()",
            "expected_output"=>"Hello World\n",
            "xp"=>15,
            "language"=>"python"
        ]);
        Lesson::create([
            "course_id"=>3,
            "position"=>1,
            "title"=>"Hello World in Javascript",
            "description"=>"Write a \"Hello World\" program in Javascript. In the Editor you can see all the Code necessary for doing that. In Javascript you print using \"console.log\".",
            "predefined_code"=>"<usercode>",
            "predefined_code_visible"=>"console.log()",
            "expected_output"=>"Hello World\n",
            "xp"=>15,
            "language"=>"javascript"
        ]);
    }
}
?>