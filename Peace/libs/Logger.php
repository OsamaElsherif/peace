<?php
namespace Peace\libs;

class Logger {
    private string $logPath;
    private array $logLevel = ['error', 'warning', 'notice'];

    public function __construct(string $logPath, array $logLevel = []) {
        $this->logPath = $logPath;
        
        if (!empty($logLevel)) {
            $this->logLevel = $logLevel;
        }
    }

    public function setLogPath(string $logPath) {
        $this->logPath = $logPath;
    }

    public function log(string $type, string $message) {
        if (!in_array($type, $this->logLevel, true)) {
            return;
        }

        $timestamp = date('Y-m-d H-i-s');
        $logMessage = sprintf("[%s] [%s] %s\n", $timestamp, $type, $message);
        error_log($logMessage, 3, $this->logPath);
    }
}