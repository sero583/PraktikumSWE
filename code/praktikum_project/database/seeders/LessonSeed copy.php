<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lesson;

use Database\Seeders\CourseSeed;

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
            "course_id" =>1,
            "position" =>1,
            "title" => "Hello World in Java",
            "description" => "Write a \"Hello World\" program in Java. In the Editor you can see all the Code necessary for doing that. The class is called Main because the program is written to the file \"Main.java\". All you have to do now is add the String you want to print into the print() statement.",
            "predefined_code" => "<usercode>",
            "predefined_code_visible" => "public class Main {\n\tpublic static void main(String[] args) {\n\t\tSystem.out.print();\n\t}\n}",
            "expected_output" => "Hello World",
            "xp" => 20,
            "language" => "java"
        ]);
        Lesson::create([
            "course_id" =>1,
            "position" =>2,
            "title" => "More sophisticated example",
            "description" => "This is a more complicated example, where the user is supposed to implement a function, but this could also be a class etc. In this example the user is supposed to implement the function greet() that returns \"Hello World\" and all the stuff with the Main class and main Method is hidden from the user.",
            "predefined_code" => "public class Main {\n\tpublic static void main(String[] args) {\n\t\tSystem.out.println(greet());\n\t}\n\t<usercode>\n}",
            "predefined_code_visible" => "public static String greet(){\n\t\n}",
            "expected_output" => "Hello World\n",
            "xp" => 20,
            "language" => "java"
        ]);
        Lesson::create([
            "course_id" =>3,
            "position" =>1,
            "title" => "Hello World in Javascript",
            "description" => "Write a \"Hello World\" program in Javascript. In the Editor you can see all the Code necessary for doing that. In Javascript you print using \"console.log\".",
            "predefined_code" => "<usercode>",
            "predefined_code_visible" => "console.log()",
            "expected_output" => "Hello World\n",
            "xp" => 15,
            "language" => "javascript"
        ]);

        $this->createPythonCourse();
    }

    /**
     * Creates all python lessons.
     */
    protected function createPythonCourse() : void {
        $position = 1;

        // 1: Little bit theory
        Lesson::create([
            "course_id" => CourseSeed::PYTHON_COURSE,
            "position" => $position++,
            "title" => "Short theoretical aspects about Python",
            "description" => "In this lesson you will learn more about what Python actually is and does.

Python is a programming language. However, in python your programs are so-called scripts. This means in theory you don't program, but write a script. What python makes so special is, it is not getting compiled. You might know compiling from languages like C/C++ or other ones.

What is compiling?

Computers are dumb, but also smart, strong and very efficient in their tasks at the same time. Imagine a computer like a child, which can run even faster than Usain Bolt.
The child doesn't understand, that it can win competitions. You're the trainer of that child, so it's your job to explain the child on how to proceed to win a competition.
After it understood on how to proceed, the child win's for sure. However, when the child only gets knowledge from you, it can only apply that knowledge.
So it means if you're not experinced or smart enough, the child might not win the compettion, even though it has the ability to do win. This means the child is only as smart as you are.

The same applies for computers. It is as smart as the programmer of the specific program is or was. Compiling turns the written source code of the program into machine code.
Machine code is basically a set of instructions on how to execute. A computer can execute the instructions in machine code really fast.

Compiling is great, isn't it?

Well, it is in terms of performance. The only issue is compatability. Different producers of processor (for e. g. AMD or Intel) use different instruction sets, which might do the same but have different instruction names.
The compiler needs to adjust the instructions to the specific processor, so it understands the machine code and can execute.

Below there is an example, of what's meant. It must be said that this is only a example, which might not be true in reality.

AMD uses the name \"add\" for their addition instruction in their processors.
Intel uses the name \"addition\" for their addition in their processors.

Now, when you take a program which was compiled for a AMD processor and use it on a Intel processor, it won't work, cause it wont understand what \"add\" means and vice versa.

Here comes Python's special side to shine: You don't need any compiler and Python can run anywhere, as long as the Python Interpreter is implemented for that system. It's much easier to provide compatability this way. The only flaw is, that interpreting and understanding takes a lot more execution time. Executing merely given instructions is a lot easier.",
            "predefined_code" => "<usercode>",
            "predefined_code_visible" => "print(\"I understood.\")",
            "expected_output" => "I understood.",
            "xp" => 30,
            "language" => "python"
        ]);

        // 2: Variables
        Lesson::create([
            "course_id" => CourseSeed::PYTHON_COURSE,
            "position" => $position++,
            "title" => "Assigning variables",
            "description" => "In this lesson you will learn something about variables in Python.

First of all, you will learn theoritical aspects about naming conventions (recommened way to name variables) in Python.
            
Here is a rule set about how to name variables:
            
&emsp;* The variable name should either begin with an Uppercase(A to Z) or Lowercase(a to z) character or an underscore(_).
&emsp;* One should always remember to use a meaningful name for variables in Python. For example – no_of_chocolates makes more sense than noc.
&emsp;* Which brings us to the next point. If a variable has multiple words, it is advised to separate them with an underscore.
&emsp;* One should ensure that a variable name should not be similar to keywords of the programming language.
&emsp;* One should also remember that even variable names are case-sensitive.
&emsp;* A variable should not begin with a digit or contain any white spaces or special characters such as #,@,&.
&emsp;* Example of good variable names – my_name, my_dob.
&emsp;* Example of bad variable names – #n, 22dob. (<a href=\"https://www.scaler.com/topics/python/variables-in-python/\">Source</a>)

It must be said though, that it's up to you how you name your variables in your scripts. As long as they have a correct syntax, it does not matters for the computer.
For the sake of readability you should follow these rules anyway, otherwise your code is not easily readable for a human being.

In Python variables are not typized, as you might now from other languages (for example from Java). A number variable can be later used to hold a string value. Python does not really care about this.
            
Your task in this lesson is to set the variables to the following values:
&emsp;* Set \"hello_world\" to the string value \"Hello World!\"
&emsp;* Set \"number\" to the integer value 10.
&emsp;* Set \"decimal\" to the float value 1.5",
            "predefined_code" => "<usercode>",
            "predefined_code_visible" => "string = \"Cool\"
# Set here the values for the variables
hello_world = 
number = 
# Don't forget variable decimal! :)

# Don't touch these lines
print(string)
print(hello_world)
print(number)
print(decimal)",
            "expected_output" => "Cool\n
Hello World!\n
10\n
1.5",
            "xp" => 20,
            "language" => "python"
        ]);

        // 3: Hello World lesson
        Lesson::create([
            "course_id" => CourseSeed::PYTHON_COURSE,
            "position" => $position++,
            "title" => "Learn how to write a Hello World program in Python",
            "description" => "After a lot of boring, but short kept theory you will learn in this lesson, how to write a simple Hello World program in Python.
In the editor the you have already given the foundation for the program. Your task is to print out \"Hello World\" by simply putting a string inside the method \"print\".",
            "predefined_code" => "<usercode>",
            "predefined_code_visible" => "print()",
            "expected_output" => "Hello World",
            "xp" => 10,
            "language" => "python"
        ]);

        // 4: Data Types
        Lesson::create([
            "course_id" => CourseSeed::PYTHON_COURSE,
            "position" => $position++,
            "title" => "Data Types",
            "description" => "Python has a set of data types to represent values.

Here is categorised list of data types which are available by default in python:

<strong>Textual Type</strong>:
&emsp;* str &rightarrow; str(\"string\")

<strong>Numeric Types</strong>:
&emsp;* int &rightarrow; x = int(1)
&emsp;* float &rightarrow; x = float(0.5)
&emsp;* complex &rightarrow; x = complex(1j)

<strong>Sequence Types</strong>:
&emsp;* list &rightarrow; x = list((\"apple\", \"banana\", \"cherry\"))
&emsp;* tuple &rightarrow; x = tuple((\"apple\", \"banana\", \"cherry\"))
&emsp;* range &rightarrow; x = range(5);

<strong>Mapping Type</strong>:
&emsp;* dict &rightarrow; x = dict(name=\"John\", age=18)

<strong>Set Types</strong>:
&emsp;* set &rightarrow; x = set((\"apple\", \"banana\", \"cherry\"))
&emsp;* frozenset &rightarrow; x = frozenset((\"apple\", \"banana\", \"cherry\"))

<strong>Boolean Type</strong>:
&emsp;* bool &rightarrow; x = True

<strong>Binary Types</strong>:
&emsp;* bytes &rightarrow; x = bytes(5)
&emsp;* bytearray &rightarrow; x = bytearray(5)
&emsp;* memoryview &rightarrow; x = memoryview(bytes(5))

<strong>None Type</strong>:
&emsp;* NoneType &rightarrow; x = None

<strong>To determine, which data-type a variable has call the \"type\"-function.</strong>
For e. g. like this:

x = str(\"This is a string!\")
# To determine which type the value has call the type method
print(type(x))

This will return 'string'

Beginning from the top of the list, the textual types, a str is a so-called string, which represents a set of characters. Usually we would just call it a \"text\". Viewing it technically, it's a sequence of different characters from a character-set (short-term: charset) such as the widely used UTF-8 (long-term: 8-Bit UCS Transformation Format, where UCS shortens Universal Coded Character Set).

The numeric types contain int, float and complex. Integer are non-decimal numbers such as 1, 2, 3 but not 1.5, 2.25 or 3.9. Floats are used to represent decimal numbers, such as 3.5 or 5. The 5 would be actually 5.0. You can also input values in the exponential form, by typing \"1e5\" for 100000 or \"1e-3\" 0.001.
The last data type is the so called complex, which is used for, who could have thought it, complex values... :) 
Since we won't find any usage for complex values, we'll just skip this one. If you want to know it anyway, you can inform yourself about it.

Now we're heading to the sequence types. The three sequential types, which are list, tuple and range have one thing in common - they hold a larger amount of data in a \"list\".
The key difference between a list and a tuple is (in other languages those are called), that a list is mutuable, means it can change it's data inside and a tuple is immutable, means it's data cannot be changed.
A range returns a sequence of numbers starting from zero and increment by 1 by default and stops before the given number.

The only mapping type, which is similar to the so-called \"array\", is a dict (long: dictionary). It has key-value pairs.

The set types can also hold like the sequence types many values, there is only a key difference: List's can have the same occurences of an item, while set's can't. A set is mutuable and a frozenset is immutable. What does that mean? Yes, you already know from before! A set can be changed and a frozenset can't.

The boolean type, which is called bool, is pretty easy to explain. A boolean can only have two-states: \"true\" and \"false\". You might know this concept from your home. The common light switches can either be only on (true) or off (false).

Binary types are bytes, a bytearray and the so-called memoryview. We won't work either with these.

Last, but not least, there is is only one type to represent nothing: None Type. Other languages use \"null\" to represent nothing.

Enough theory, now practice! Your task is to complete the missing code, by reading the comments and following them.",
            "predefined_code" => "<usercode>",
            "predefined_code_visible" => "str = # set this to \"ABC\"
print(str)
int = # set this to the value \"1\"
print(int)
float = # set this value to \"0.5\"
print(float)
list = # list with string \"apple\", \"cherry\" and \"banana\"
print(list)
bool = # set this to false
print(bool)
none = # set this to none
print(none)",
            "expected_output" => "ABC
1
0.5
['apple', 'cherry', 'banana']
False
None",
            "xp" => 30,
            "language" => "python"
        ]);

        // 5: Arithmetic operations
        Lesson::create([
            "course_id" => CourseSeed::PYTHON_COURSE,
            "position" => $position++,
            "title" => "Arithmetic operations",
            "description" => "In this lesson you will learn more about one of the most important things in any programming languages: Arithmetic operations.
Arithmetic operations are used to calculate information. For example you can calculate the braking distance by simply knowing one variable: The speed the car has. This is inaccurate due to the rule of thumb, because reaction time and weight of the vehicle isn't respected. It's just an example to show what you can do with calculations.

Now the basical operators, which you probably already know is addition (<strong>+</strong>), substraction (<strong>-</strong>), multiplication (<strong>*</strong>) and division (<strong>/</strong>).
On top of that there are many more methods, but we are just covering the basics.

Calculation example:
x = 10
y = 10
result = x + y
print(result)

This prints out 20, because 10+10 equals 20. You can apply the same for the other three operations by using the correct operators.

Your task in this lesson is to basically fullfil the results with respecting the given hints in the code.",
            "predefined_code" => "<usercode>",
            "predefined_code_visible" => "a = 10 # Dont change this
b = 10 # Dont change this

addition_result = # Apply addition on a and b
print(addition_result) # Dont change this

substraction_result = # Apply substraction on a and b
print(substraction_result) # Dont change this

multiplication_result = # Apply multiplication on a and b
print(multiplication_result) # Dont change this

division_result = # Apply division on a and b
print(division_result)",
            "expected_output" => "20
0
100
1.0",
            "xp" => 20,
            "language" => "python"
        ]);

        // 6: Comparision operators & if
        Lesson::create([
            "course_id" => CourseSeed::PYTHON_COURSE,
            "position" => $position++,
            "title" => "Comparision operators and if-clauses",
            "description" => "In this lesson you will also learn something you will need very often in programming. Comparision operators!
You probably saw atleast once if-clauses when you saw a source code of a program. They are used to diffentiate cases. A basical example:
If clauses are used by your bank to check if your balance is enough to pay the next incoming bill. It uses an arithmetic comparision operator.

<strong>Available basic operators</strong>:

<table class=\"defaultTable\"><tr class=\"defaultTr\"><th class=\"defaultTh\">Operator</th><th class=\"defaultTh\">Description</th><th class=\"defaultTh\">Example</th></tr><tr class=\"defaultTr\"><td class=\"defaultTd\">==</td><td class=\"defaultTd\">If the values of two operands are equal, then the condition becomes true.</td><td class=\"defaultTd\">(a == b) is not true.</td></tr><tr class=\"defaultTr\"><td class=\"defaultTd\">!=</td><td class=\"defaultTd\">If values of two operands are not equal, then condition becomes true.</td><td class=\"defaultTd\">(a != b) is true.</td></tr><tr class=\"defaultTr\"><td class=\"defaultTd\">&lt;&gt;</td><td class=\"defaultTd\">If values of two operands are not equal, then condition becomes true.</td><td class=\"defaultTd\">(a <> b) is true. This is similar to != operator.</td></tr><tr class=\"defaultTr\"><td class=\"defaultTd\">&gt;</td><td class=\"defaultTd\">If the value of left operand is greater than the value of right operand, then condition becomes true.</td><td class=\"defaultTd\">(a > b) is not true.</td></tr><tr class=\"defaultTr\"><td class=\"defaultTd\">&lt;</td><td class=\"defaultTd\">If the value of left operand is less than the value of right operand, then condition becomes true.</td><td class=\"defaultTd\">(a < b) is true.</td></tr><tr class=\"defaultTr\"><td class=\"defaultTd\">&gt;=</td><td class=\"defaultTd\">If the value of left operand is greater than or equal to the value of right operand, then condition becomes true.</td><td class=\"defaultTd\">(a >= b) is not true.</td></tr><tr class=\"defaultTr\"><td class=\"defaultTd\">&lt;=</td><td class=\"defaultTd\">If the value of left operand is less than or equal to the value of right operand, then condition becomes true.</td><td class=\"defaultTd\">(a <= b) is true.</td></tr></table>

<a href=\"https://www.tutorialspoint.com/python/python_basic_operators.htm\">Source</a> of table.

For example if you want to check something, you do this

x = 10
y = 20
result = x == y # Will be boolean and false, because 10 and 20 are not the same.

Your task in this lesson will be to check if a users bank balance is enough to pay the incoming bill.",
            "predefined_code" => "<usercode>",
            "predefined_code_visible" => "balance = 40 # Euro/USD/whatever you like it to be
incoming_bill = 30

if() { # here the condition, where the user has enough money to pay
    print(\"User can pay the bill.\")
} else {
    print(\"User can't pay the bill.\")   
}",
            "expected_output" => "User can pay the bill.",
            "xp" => 40,
            "language" => "python"
        ]);

        // 7: Loops (for, while)
        Lesson::create([
            "course_id" => CourseSeed::PYTHON_COURSE,
            "position" => $position++,
            "title" => "Loops (for and while)",
            "description" => "In this lesson you will learn how to create a loop in the code.

We start by the basic concept of a loop: Why is it so helping?

Imagine we have 100 players in a server of your desire. If you want to send them a broadcast message and we don't have a built-in function to send a broadcast message, we should use a loop.

Technically it's also possible to type each players variable by hand 100 times, but this would make it difficult to read the code, change it and fix stuff inside. However, you should not do it all by hand, because that's only time waste.
Rather than doing it by hand, you simply loop through an array/list/tuple (which you should know) and loop through it and send everyone the same message you want to broadcast.

Python also has so called for-each loops, so you don't need to work with indexes. This makes code readability better and youre able to create in faster time a simple loop.

Usually a loop would be like this:

tuple = (\"apple\", \"banana\", \"cherry\")
for i in range(len(tuple)):
  print(tuple[i]) # Would print out apple, banana and cherry

You can see, for a simple loop this seems a litte bit complex with the variable i, which gets incremented by one until the length of the tuple is reached.

Instead we just use for this simple-case the more suitable for-each way:

tuple = (\"apple\", \"banana\", \"cherry\")
for fruit in tuple:
  print(fruit) # Seems easier to read and does the same: It prints out apple, banana and cherry

Last for-loop example: Loop numbers, e. g. 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10
for x in range(10)
    print(x)

Next to for-loops there are so called while-loops. They execute, as the name already hints, while the condition is true. Back to the server example, just imagine we are a game server waiting for players.

When the server started, a boolean will be set to true, which is often called isRunning. Then 'while' we run, we accept incoming connections from players.

This would look like this:

isRunning = True;

while isRunning: # this means actually while isRunning == True {
    acceptPlayerConnections(); # Pseudo code, just used for illustration

This is how servers listen for incoming requests and handle them.

So now enough talking, let's get to your task. Your task is to write a loop and print out the given elements in the tuple.
",
            "predefined_code" => "<usercode>",
            "predefined_code_visible" => "tuple = (\"item1\", \"item2\", \"item3\")
# Write below here your loop and use print() to print out the elements.
",
            "expected_output" => "item1
item2
item3",
            "xp" => 30,
            "language" => "python"
        ]);

        // 8: Classes
        Lesson::create([
            "course_id" => CourseSeed::PYTHON_COURSE,
            "position" => $position++,
            "title" => "Classes",
            "description" => "Python is an object-oriented programming language. Object-orientation means that everything is held and or wrapped by an object. Objects can have classes. Classes are like a blueprint/building plan of an object. They define what a object can contain.

After you have a class, you can create as many instances as you wish. There is only one limit: Your computers performance and memory. Languages do not usually limit it, but you can reach the limit when youre above 64-bit or on a 32-bit machine when you reach more than 32-bit.
Creating a object of a class is often called \"constructing an object\" or \"initializing an object\". 


Since everything already has been told, let's create a class!

We are creating now a class with the name \"NewClass\" and the property \"x\", which has the default value 0 at construction.
            
class NewClass:
    x = 0

That's it! A class with the required name and given default value has been created. Simple, right?

Now let's create an instance/object of the class, by doing this:

instance = NewClass()

Now let's print out from the class the property x:

print(instance.x)

That's it. Very basic.

Now classes can also have so-called arguments, which you can pass. We modify the so called constructor method by adding more arguments it can take, by default it's empty.
To illustrate for what arguments are good for, we are going to create a Person class:

class Person
    def __init__(self, name, age): # this is the constructor, it has self (the object self), a name and a age
    self.name = name # let's set object property name to the passed argument name
    self.age = age # Same as above but for property age

Let's construct this class:

person = Person(\"John Doe\", 30)

and now let's print out the data of the person:

print(person.name + \" is \" + person.age + \" years old.\");

That's it for the basics of classes.

Your task in this lesson is to create the class \"Car\", which has the string-properties \"manufacturer\", \"model\" and int property \"yearOfBuild\". Also create a constructor, which takes sequentially manufacturer, model and yearOfBuild property.",
            "predefined_code" => "<usercode>
car = Car(\"Ford\", \"Mustang\", 1980)
print(\"The car is a \" + car.manufacturer + \" \" + car.model + \" built in \" + car.yearOfBuild + \".\")",
            "predefined_code_visible" => "",
            "expected_output" => "The car is a Ford Mustang built in 1980.",
            "xp" => 50,
            "language" => "python"
        ]);
    }
}
?>