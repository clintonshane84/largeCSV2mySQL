<?php
/*
 * @author Clinton Shane Wright <clintonshanewright@gmail.com>
 * @package \LargeCSVMySQL\App\MySQLConnector
 * 
 */
namespace LargeCSVMySQL\App;

use \LargeCSVMySQL\App\Interfaces\IDatabaseFormTemplate;

class MySQLConnector
{
    private $pdo;
    private $form;

    public function connect($pwd, IDatabaseFormTemplate $form = null) : bool
    {
        if ($this->form !== null) {

            if ($this->pdo !== null) {
                $this->disconnect();
            }

            $dsn = "mysql:host={${$form->getHost()}};dbname={${$form->getDatabaseName()}};port={${$form->getPort()}};charset={${$form->getCharset()}}";
            $opt = array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false
            );
            
            $fetchMode = \PDO::FETCH_ASSOC;
            
            try {
                $pdo = new PDO($dsn, $form->getUsername(), $pwd, $options);
                $this->pdo = $pdo;
                return true;
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
            }
        }
        return false;
    }

    public function disconnect()
    {
        if ($this->pdo !== null) {
            unset($this->pdo);
            return true;
        }
        return false;
    }

    public function __construct(IDatabaseFormTemplate $form = null)
    {
        
    }

    public function loadSettings(IDatabaseFormTemplate $form)
    {
        if ($form !== null) {
            
        }
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}