<?php

namespace System\Log;

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/class/CreateFolder.php";

use Monolog\Logger;
use System\Log\CreateFolder;
use Monolog\Handler\StreamHandler;
use Logtail\Monolog\LogtailHandler;
use Monolog\Handler\SlackWebhookHandler;
class Logs extends CreateFolder
{
    private Logger $log;
    private string $directory;
    public const DEFAULT_REFERENCE = "NO_REFERENCE";
    public const DEFAULT_MESSAGE = "NO_MESSAGE";

    private function initLog(string|int $reference, string $level)
    {
        $this->log = new Logger($reference);
        $this->directory = $this->fileLog($reference, $level);
    }

    public function debug(string|int $reference, string $message, array $context = [])
    {
        $this->initLog(empty($reference) ? self::DEFAULT_REFERENCE : $reference, Logger::DEBUG);
        $this->pushLog(Logger::DEBUG);
        $this->log->debug(empty($message) ? self::DEFAULT_MESSAGE : $message, $context);
    }

    public function info(string|int $reference, string $message, array $context = [])
    {
        $this->initLog(empty($reference) ? self::DEFAULT_REFERENCE : $reference, Logger::INFO);
        $this->pushLog(Logger::INFO);
        $this->log->info(empty($message) ? self::DEFAULT_MESSAGE : $message, $context);
    }

    public function notice(string|int $reference, string $message, array $context = [])
    {
        $this->initLog(empty($reference) ? self::DEFAULT_REFERENCE : $reference, Logger::NOTICE);
        $this->pushLog(Logger::NOTICE);
        $this->log->notice(empty($message) ? self::DEFAULT_MESSAGE : $message, $context);
    }

    public function warning(string|int $reference, string $message, array $context = [])
    {
        $this->initLog(empty($reference) ? self::DEFAULT_REFERENCE : $reference, Logger::WARNING);
        $this->pushLog(Logger::WARNING);
        $this->log->warning(empty($message) ? self::DEFAULT_MESSAGE : $message, $context);
    }

    public function error(string|int $reference, string $message, array $context = [])
    {
        $this->initLog(empty($reference) ? self::DEFAULT_REFERENCE : $reference, Logger::ERROR);
        $this->pushLog(Logger::ERROR);
        $this->log->error(empty($message) ? self::DEFAULT_MESSAGE : $message, $context);
    }

    public function critical(string|int $reference, string $message, array $context = [])
    {
        $this->initLog(empty($reference) ? self::DEFAULT_REFERENCE : $reference, Logger::CRITICAL);
        $this->pushLog(Logger::CRITICAL);
        $this->log->critical(empty($message) ? self::DEFAULT_MESSAGE : $message, $context);
    }

    public function alert(string|int $reference, string $message, array $context = [])
    {
        $this->initLog(empty($reference) ? self::DEFAULT_REFERENCE : $reference, Logger::ALERT);
        $this->pushLog(Logger::ALERT);
        $this->log->alert(empty($message) ? self::DEFAULT_MESSAGE : $message, $context);
    }

    public function emergency(string|int $reference, string $message, array $context = [])
    {
        $this->initLog(empty($reference) ? self::DEFAULT_REFERENCE : $reference, Logger::EMERGENCY);
        $this->pushLog(Logger::EMERGENCY);
        $this->log->emergency(empty($message) ? self::DEFAULT_MESSAGE : $message, $context);
    }

    private function pushLog($level)
    {
        try {
            if ($_ENV['LOG_ACTIVE']) {
                $this->log->pushHandler(new StreamHandler($this->directory, $level));
            } else {
                throw new \Exception("LOG_ACTIVE is not set");
            }

            if ($_ENV['BETTER_LOG_ACTIVE'] && $_ENV['BETTER_TOKEN'] != "") {
                $this->log->pushHandler(new LogtailHandler($_ENV['BETTER_TOKEN']));
            } else {
                throw new \Exception("BETTER_TOKEN is not set");
            }

            if ($_ENV['SLACK_LOG_ACTIVE'] && $_ENV['SLACK_CHANNEL'] != "" && $_ENV['SLACK_BOT_NAME'] != "") {
                $this->log->pushHandler(new SlackWebhookHandler(
                    webhookUrl: $_ENV['SLACK_WEBHOOK'],
                    channel: $_ENV['SLACK_CHANNEL'],
                    username: $_ENV['SLACK_BOT_NAME'],
                    useAttachment: true,
                    iconEmoji: null,
                    useShortAttachment: true,
                    includeContextAndExtra: true,
                    level: $level
                ));
            } else {
                throw new \Exception("SLACK_WEBHOOK is not set");
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
