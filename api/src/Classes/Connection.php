<?php

namespace App\Classes;

use PDO;
use PDOException;
use DateTime;
use DateTimeZone;

class Connection extends PDO
{
    private $dbUser = USERDB;
    private $dbPassword = PASSDB;
    private $dbHost = HOSTDB;
    private $dbName = DATABASE;
    private $dbPort = PORTDB;

    public $error;
    public $stmt;

    public function __construct()
    {
        try {
            parent::__construct(
                "mysql:host={$this->dbHost};port={$this->dbPort};dbname={$this->dbName}", 
                $this->dbUser, 
                $this->dbPassword
            );
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
            $this->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
            $this->setAttribute(PDO::ATTR_TIMEOUT, 10);
            $this->exec("SET CHARACTER SET utf8");
            $this->stmt = $this;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            $this->error = $e->getMessage();
            return false;
        }
    }

    public function __destruct()
    {
        $this->stmt = null;
    }

    public static function formatDateTimeForDB($dateTime, $timeZone = "UTC", $outputFormat = "Y-m-d H:i:s")
    {
        if (empty($dateTime)) {
            return "";
        }

        if (strpos($dateTime, "-") !== false) {
            return $dateTime;
        }

        list($date, $time) = explode(" ", $dateTime);
        $dateParts = explode("/", $date);
        $formattedDate = "{$dateParts[2]}-{$dateParts[1]}-{$dateParts[0]} $time";

        $datetime = new DateTime($formattedDate, new DateTimeZone($timeZone));
        $datetime->setTimezone(new DateTimeZone("UTC"));
        return $datetime->format($outputFormat);
    }

    public static function formatDateTimeForPHP($dateTime, $timeZone = "America/Bahia", $outputFormat = "d/m/Y H:i:s")
    {
        if (empty($dateTime)) {
            return "";
        }

        if (strpos($dateTime, "/") !== false) {
            return $dateTime;
        }

        list($date, $time) = explode(" ", $dateTime);
        $dateParts = explode("-", $date);
        $formattedDate = "{$dateParts[2]}/{$dateParts[1]}/{$dateParts[0]} $time";

        $datetime = new DateTime($dateTime, new DateTimeZone("UTC"));
        $datetime->setTimezone(new DateTimeZone($timeZone));
        return $datetime->format($outputFormat);
    }

    public function listTables($pattern)
    {
        $sql = "SHOW TABLES LIKE '$pattern'";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function determineTables($startDateTime, $endDateTime, $timezone = null)
    {
        $startDateTime = $this->formatDateTimeForDB($startDateTime, $timezone);
        $endDateTime = $this->formatDateTimeForDB($endDateTime, $timezone);

        $startTimestamp = strtotime($startDateTime);
        $endTimestamp = strtotime($endDateTime);

        $existingTables = $this->listTables('posicao_%');
        $tableNames = array_column($existingTables, 'tables_in_webcop (posicao_%)');

        $dates = [];
        for ($timestamp = $startTimestamp; $timestamp <= $endTimestamp; $timestamp += 86400) {
            $tableName = 'posicao_' . date("Ymd", $timestamp);
            if (in_array($tableName, $tableNames)) {
                $dates[$tableName] = $tableName;
            }
        }
        return $dates;
    }

    public function determineTemperatureTables($startDateTime, $endDateTime, $timezone = null)
    {
        $startDateTime = $this->formatDateTimeForDB($startDateTime, $timezone);
        $endDateTime = $this->formatDateTimeForDB($endDateTime, $timezone);

        $startTimestamp = strtotime($startDateTime);
        $endTimestamp = strtotime($endDateTime);

        $existingTables = $this->listTables('telemetria_temperatura_%');
        $tableNames = array_column($existingTables, 'tables_in_webcop (telemetria_temperatura_%)');

        $dates = [];
        for ($timestamp = $startTimestamp; $timestamp <= $endTimestamp; $timestamp += 86400) {
            $tableName = 'telemetria_temperatura_' . date("Ymd", $timestamp);
            if (in_array($tableName, $tableNames)) {
                $dates[$tableName] = $tableName;
            }
        }
        return $dates;
    }

    public function determineTelemetryTables($startDateTime, $endDateTime, $timezone = null)
    {
        $startDateTime = $this->formatDateTimeForDB($startDateTime, $timezone);
        $endDateTime = $this->formatDateTimeForDB($endDateTime, $timezone);

        $startTimestamp = strtotime($startDateTime);
        $endTimestamp = strtotime($endDateTime);

        $existingTables = $this->listTables('telemetria_2%');
        $tableNames = array_column($existingTables, 'tables_in_webcop (telemetria_2%)');

        $dates = [];
        for ($timestamp = $startTimestamp; $timestamp <= $endTimestamp; $timestamp += 86400) {
            $tableName = 'telemetria_' . date("Ymd", $timestamp);
            if (in_array($tableName, $tableNames)) {
                $dates[$tableName] = $tableName;
            }
        }
        return $dates;
    }

    public static function printFormatted($data, $return = false)
    {
        $output = "<pre>" . print_r($data, true) . "</pre>";
        if ($return) {
            return $output;
        }
        echo $output;
    }

    public static function formatText($text)
    {
        return preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', $text));
    }

    public function removeAccents($text)
    {
        return strtr($text, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ", "aaaaeeiooouucAAAAEEIOOOUUCC");
    }
}
