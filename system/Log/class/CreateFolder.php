<?php

namespace System\Log;

class CreateFolder
{
    const DEFAULT_REFERENCE = "NO_REFERENCE";
    const LOG_DIRECTORY = "storage/logs/";

    public function fileLog($reference = self::DEFAULT_REFERENCE, $level)
    {
        $date = $this->getCurrentDate();
        $name = $reference;
        $type = $this->getCurrentTimestamp() . '.log';
        $logFile = self::LOG_DIRECTORY . $date . "/" . $name . "/" . $level . "/" . $type;
        return $logFile;
    }

    private function getCurrentDate()
    {
        return date('Y-m-d');
    }

    private function getCurrentTimestamp()
    {
        return time();
    }
}
