<?php

require __DIR__.'/../vendor/autoload.php';

use LeadGenerator\Generator;
use LeadGenerator\Lead;
use Swoole\Process;

class GenerateLeads {
    function logSuccessfulLeadProcessing(Lead $lead)
    {
        $currentDatetime = date('Y-m-d H:i:s');
        $logMessage = "{$lead->id} | {$lead->categoryName} | {$currentDatetime}" . PHP_EOL;

        file_put_contents('log.txt', $logMessage, FILE_APPEND);

    }

    function genericAndSave(Lead $lead): bool
    {
        sleep(2);
        $this->logSuccessfulLeadProcessing($lead);
        return true;
    }

    function init() {

        echo "Start Generator" . PHP_EOL;

        $generator = new Generator();

        // Processes
        $processes = array();

        $count = 10000;
        $generator->generateLeads($count, function (Lead $lead) use ($processes) {

            echo "ADD category to processes: " . $lead->categoryName . PHP_EOL;

            $process = new Process(function () use ($lead,$processes) {
                $this->genericAndSave($lead);
            });

            // Start process
            $process->start();

            // Add to all processes
            $processes[] = $process;
        });

        //  Pending processes
        foreach ($processes as $process) {
            Process::wait();
        }


    }
}

# START PROCESS
$time_start = microtime(true);

$generateLeads = new GenerateLeads();
$generateLeads->init();

$time_end = microtime(true);
$time = $time_end - $time_start;
$time = round($time, 2);

$memory = memory_get_peak_usage(true);
$memory = $memory / 1024 / 1024;

// Results
echo "Execution time: " . $time . " sec" . PHP_EOL;
echo "Memory usage: " . $memory . " mb" . PHP_EOL;










