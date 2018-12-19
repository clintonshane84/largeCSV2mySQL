<?php
namespace LargeCSVMySQL\App\Interfaces;

interface IDatabaseFormTemplate
{
    public function getCharset();
    public function getDatabaseName();
    public function getHost();
    public function getPort();
    public function getTableName();
    public function getUsername();
}