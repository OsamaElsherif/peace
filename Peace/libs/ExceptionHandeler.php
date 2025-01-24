<?php
namespace Peace\libs;

use Throwable;

/**
 * Class ExceptionHandeler
 * Handles exceptions by logging and rendering them.
 */
class ExceptionHandeler {
    /**
     * @var bool $debug Indicates if debug mode is enabled.
     */
    private bool $debug = false;

    /**
     * @var Logger $logger Logger instance for logging exceptions.
     */
    private Logger $logger;

    /**
     * ExceptionHandeler constructor.
     *
     * @param Logger $logger Logger instance.
     * @param bool $debug Indicates if debug mode is enabled.
     */
    public function __construct(Logger $logger, bool $debug = false) {
        $this->logger = $logger;
        $this->debug  = $debug;
    }

    /**
     * Handles the given exception by logging and rendering it.
     *
     * @param Throwable $exception The exception to handle.
     */
    public function handleException(Throwable $exception) {
        $this->logException($exception);
        $this->renderException($exception);
    }

    /**
     * Logs the given exception.
     *
     * @param Throwable $exception The exception to log.
     */
    private function logException(Throwable $exception) {
        $message = $this->formatExceptionMessage($exception);
        $this->logger->log('error', $message);
    }

    /**
     * Renders the given exception.
     *
     * @param Throwable $exception The exception to render.
     */
    private function renderException(Throwable $exception) {
        if ($this->debug) {
            $message = $this->formatExceptionMessage($exception, true);
            echo "<pre>".htmlspecialchars($message)."</pre>";
        } else {
            http_response_code(500);
            echo "<h1>Error!</h1> unexpected error occurs";
        }
    }

    /**
     * Formats the exception message.
     *
     * @param Throwable $exception The exception to format.
     * @param bool $debug Indicates if debug mode is enabled.
     * @return string The formatted exception message.
     */
    private function formatExceptionMessage(Throwable $exception, bool $debug = false): string {
        $message = sprintf(
            "[%s]: %s in %s at line %s\n",
            get_class($exception),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine()
        );

        if ($debug) {
            $message .= "\nStack Trace:\n" . $exception->getTraceAsString();
        }

        return $message;
    }
}