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
            "description"=>"Write a \"Hello World\" program in Java. In the Editor you can see all the Code necessary for doing that. The class is called Main because the program is written to the file \"Main.java\". All you have to do now is add the String \"Hello World\" into the print() statement. Make sure you always surround your String with double quotes.",
            "predefined_code"=>"<usercode>",
            "predefined_code_visible"=>"public class Main {\n\tpublic static void main(String[] args) {\n\t\tSystem.out.print();\n\t}\n}",
            "expected_output"=>"Hello World",
            "xp"=>10,
            "language"=>"java"
        ]);
        Lesson::create([
            "course_id" => 1,
            "position" => 2,
            "title" => "Variables and Data Types 1",
            "description"=>"In this lesson you will learn how to declare and initialize variables. Variables are containers for storing data values. The data types are used to differentiate the kind of data that will be stored. In this example you are going to initialize the variable \"num\". Initializing means that you assign the variable a certain value (in this case it is a whole number). However declaring a variable means to only specify the data type and the name (for example = int num;). Now for this exercise print out the variable by adding the variable name into the print() statement.",
            "predefined_code"=>"<usercode>",
            "predefined_code_visible"=>"public class Main {\n\tpublic static void main(String[] args) {\n\t\tint num = 10;\n\t\tSystem.out.print();\n\t}\n}",
            "expected_output"=>"10",
            "xp"=>20,
            "language"=>"java"
        ]);

        Lesson::create([
            "course_id" => 1,
            "position" => 3,
            "title" => "Variables and Data Types 2",
            "description"=>"Now you are going to learn how to change the value of a already initialized variable. After you initialized a variable with a certain data value, you can later on change that value by assigning a different value to that variable. For this example you are going to change the initialized value of num from 10 to 20. Additionally you have to add the variable name into both print() statement but this time after the \"+\" operator.",
            "predefined_code"=>"<usercode>",
            "predefined_code_visible"=>"public class Main {\n\tpublic static void main(String[] args) {\n\t\tint num = 10;\n\t\tSystem.out.println(\"Before: \" + );\n\n\t\tnum = 20;\n\t\tSystem.out.print(\"After: \" + );\n\t}\n}",
            "expected_output"=>"Before: 10\nAfter: 20",
            "xp"=>20,
            "language"=>"java"
        ]);

        Lesson::create([
            "course_id" => 1,
            "position" => 4,
            "title" => "Arithmetic Operations",
            "description"=>"This lesson will feature arithmetic operations. There are a total of 5 arithmetic operations in java (addition, subtraction, multiplication, division and modulo operation) however we will be focusing on the addition and subtraction operations. You are going to add the correct operation (+ and -) to sum and diff and then  add the variable names of sum and diff to the print() statements after the \"+\" operator. Make sure you add the correct variable to the correct print statement.",
            "predefined_code"=>"<usercode>",
            "predefined_code_visible"=>"public class Main {\n\tpublic static void main(String[] args) {\n\t\tint a = 50;\n\t\tint b = 70;\n\n\t\tint sum = a  b;\n\t\tint diff = a  b;\n\n\t\tSystem.out.println(\"Sum of a and b: \" + );\n\t\tSystem.out.print(\"Difference of a and b: \" + );\n\t}\n}",
            "expected_output"=>"Sum of a and b: 120\nDifference of a and b: -20",
            "xp"=>20,
            "language"=>"java"

        ]);

        Lesson::create([
            "course_id" => 1,
            "position" => 5,
            "title" => "Comparison Operators 1",
            "description"=>"In this lesson we will be talking about comparison operators. By using the comparison operators we can compare two variables with each other. We will be comparing two values with each other and see whether or not they are equal and also if one of them is greater than the other. The programm will return true if the value is equal and fals if the value is not equal. These true/false outputs are represented by the boolean data type and are used to differentiate whether a condition is true or false. For this lesson you are going to add the comparison operators (== and >) at the right print() statement between the a and b in the brackets.",
            "predefined_code"=>"<usercode>",
            "predefined_code_visible"=>"public class Main {\n\tpublic static void main(String[] args) {\n\t\tint a = 10;\n\t\tint b = 7;\n\n\t\tSystem.out.println(\"a equals b : \" + (a  b));\n\t\tSystem.out.print(\"a is greater than b : \" + (a  b));\n\t}\n}",
            "expected_output"=>"a equals b : false\n a is greater than b : true",
            "xp"=>20,
            "language"=>"java"

        ]);

        Lesson::create([
            "course_id" => 1,
            "position" => 6,
            "title" => "Comparison Operators 2",
            "description"=>"In the last lesson you learned how to compare variables of the data type int with each other. However the same does not apply to comparing Strings with each other. So therefore this lesson will cover how to compare the value of Strings with each other. It is possible o compare two Strings with each other by using the comparison operator (==) but this way you dont actually compare the value of the two Strings but rather the reference. So in order to compare the value of Strings, you are going to use the .equals() method. Enter one String behind the .equals and the other inside the brackets of the .equals() method.",
            "predefined_code"=>"<usercode>",
            "predefined_code_visible"=>"public class Main {\n\tpublic static void main(String[] args) {\n\t\tString a = \"Hello\";\n\t\tString b = \"hello\";\n\n\t\tSystem.out.println(\"a equals b : \" + .equals());\n\t}\n}",
            "expected_output"=>"a equals b : false",
            "xp"=>20,
            "language"=>"java"

        ]);

        Lesson::create([
            "course_id" => 1,
            "position" => 7,
            "title" => "Methods",
            "description"=>"Now you will be learning about methods. A method is a block of code which only runs when it is called. You can pass data, known as parameters, into a method. Why use methods? To reuse code: define the code once, and use it many times. When declaring a method you specify the access of it (public), the return type (int), the name (multiplyNumbers) and the parameter list ((int a, int b)). You will be writing the body of the method called \"multiplyNumbers\". The method is supposed to return the multiplication (operator = *) of the variables a and b. The main method will run in the background and use the method with the values 10 and 15.",
            "predefined_code"=>"public class Main {\n\tpublic static void main(String[] args) {\nint d = multiplyNumbers(10, 15);\n\t\tSystem.out.print(\"10 times 15 is : \" + d);\n\t}\n\n<usercode>\n}",
            "predefined_code_visible"=>"public static int multiplyNumbers(int a, int b){\n\t\treturn ;\n\t}",
            "expected_output"=>"10 times 15 is : 150",
            "xp"=>20,
            "language"=>"java"

        ]);

        Lesson::create([
            "course_id" => 1,
            "position" => 8,
            "title" => "If-Statements",
            "description"=>"In this lesson we will cover if-statements. If-statements are used to specify whether or not a block of code should be executed or not. You will be writing a programm that checks if a number is higher than 10. All you need to do is add a greater than operator in the brackets after the \"if\" and add a 10 after that.",
            "predefined_code"=>"<usercode>",
            "predefined_code_visible"=>"public class Main {\n\tpublic static void main(String[] args) {\n\t\tint num = 35;\n\n\t\tif(num    ){\n\t\t\tSystem.out.print(\"Number is higher than 10\");\n\t\t}\n\t}\n}",
            "expected_output"=>"Number is higher than 10",
            "xp"=>20,
            "language"=>"java"

        ]);

        Lesson::create([
            "course_id" => 1,
            "position" => 9,
            "title" => "Classes",
            "description"=>"Java is a so called object-oriented programming language. This means that in Java everything is connected with classes and objects, including their attributes (variables) and methods. Classes can be seen as a \"blueprint\" that defines how to create an object. To put this in a more real life oriented perspective: A car is an object, that has attributes like color or horsepower, and methods like drive, reverse or brake. In this lesson you will be creating a class called car class Car like this : class Car{<YourCode>} and assign it with the following 2 attributes: String color =\"blue\"; and int horsePower=300; . The main method will run in the background and return the attributes of your car class if you assigned them correctly.",
            "predefined_code"=>"public class Main {\n\tpublic static void main(String[] args) {\n\t\tCar car = new Car();\n\t\tSystem.out.println(\"Car color : \" + car.color);\n\t\tSystem.out.print(\"Car horsepower : \" + car.horsePower);\n\t}\n}\n\n<usercode>",
            "predefined_code_visible"=>"Enter Code",
            "expected_output"=>"Car color : blue\nCar horsepower : 300",
            "xp"=>20,
            "language"=>"java"

        ]);

        Lesson::create([
            "course_id" => 1,
            "position" => 10,
            "title" => "Objects",
            "description"=>"This lesson will focus on Objects in java. In order for one to create an object, it is necessary to have a class that defines the attributes and methods of that object. For this lesson a class Person has already been created, that has the following 3 attributes: String name; int age; String bornIn; . You are going to create an instance of a person object and print out their attributes. To create a new Object do the following = Object object = new Object(); . All you need to do is fill out the missing parts and add the age and the bornIn attribute of the Person to the print statement just like how it is done in the first print statement",
            "predefined_code"=>"class Person{\n\tString name = \"Harry\";\n\tint age = 23;\n\tString bornIn = \"Germany\";\n}",
            "predefined_code_visible"=>"public class Main {\n\tpublic static void main(String[] args) {Person person =        ;\n\n\t\tSystem.out.println(\"Name : \" + person.Name);\n\t\tSystem.out.println(\"Age : \" + );\n\t\tSystem.out.print(\"Born in : \" + );\n\t}\n}",
            "expected_output"=>"Name : Harry\nAge : 23\nBorn in : Germany",
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