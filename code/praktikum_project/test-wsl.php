<?php
// load symfony
require "vendor/autoload.php";

// use PHP vanilla -> works
/*
echo "Testing command \"docker version\" on your machine by using exec()...\n";
exec("docker version", $output, $returnValue);
echo "--- Result ---\nReturn value: $returnValue\nOutput: \"" . print_r($output, true) . "\"";
echo "Now running \"docker version\" by using shell_exec()";
echo "Output: " . shell_exec("docker version");
*/

// use symfony process -> tested -> can only run vanilla windows commands such as "dir", but not for WSL commands like ls, docker.
// using wsl and then running linux commands, still does not seem to work
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

$process = new Process(["wsl", "docker version"]);
$process->run();

// executes after the command finishes
if(!$process->isSuccessful()) {
    echo "Unsucessful process, output: " . $process->getOutput();
    echo "print_r process...";
    print_r($process);
} else echo "Successful, output: " . $process->getOutput();