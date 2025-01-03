<?php
declare(strict_types=1);

namespace Core;

class ErrorHandler
{
    public static function handleException(\Throwable $exception)
    {
        static::logError($exception);
        if (php_sapi_name() === 'cli') {
            static::renderCliError($exception);
        } else {
            static::renderErrorPage($exception);
        }
    }

    private static function renderCliError(\Throwable $exception):void {
        $isDebug = App::get('config')['app']['debug'] ?? false;
        if ($isDebug) {
            $errorMessage = self::formatErrorMessage(
            $exception,
            "\033[31m An unexpected error occured. Please check error log for details. \033[0m \n"
            );
            $trace = $exception->getTraceAsString();
        } else {
            $errorMessage = "\033[31m An unexpected error occured. Please check errol log for details. \033[0m \n";
            $trace = "";
        }

        fwrite(STDERR, $errorMessage);
        if ($trace) {
            fwrite(STDERR, "\n Stack trace: \n $trace \n");
        }
        exit(1);
    }

    private static function renderErrorPage(\Throwable $exception): void {
        $isDebug = App::get('config')['app']['debug'] ?? false;

        if ($isDebug) {
            $errorMessage = static::formatErrorMessage(
              $exception,
              "[%s] Error: %s: %s in %s on line %d\n"  
            );
            $trace = $exception->getTraceAsString();
        } else {
            $errorMessage = "An unexpected error occurred. Please check error log for details.";
            $trace = "";
        }
        http_response_code(500);
        echo View::render('errors/500', [
            'errorMessage' => $errorMessage,
            'trace'=>$trace,
            'isDebug'=> $isDebug
        ], 'layouts/main');
        exit();
    }

    public static function handleError($level, $message, $file, $line)
    {
        $exception = new \ErrorException($message, 0, $level, $file, $line);

        self::handleException($exception);
    }

    private static function formatErrorMessage(\Throwable $exception, string $format):string {
        return sprintf(
            $format,
            date('Y-m-d H:i:s'),
            get_class($exception),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine()
        );
    }

    private static function logError(\Throwable $exception): void{
        $logMessage = static::formatErrorMessage(
          $exception,
          "[%%] Error: %s: %s in %s on line %d \n",  
        );
        error_log($logMessage, 3, __DIR__ . '/../logs/error.log');
    }

}

?>