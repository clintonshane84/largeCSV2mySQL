<?php
/*
 * @author Clinton Shane Wright <clintonshanewright@gmail.com>
 * @package \LargeCSVMySQL\App\FormDatabaseConnectTemplate
 * 
 */
namespace LargeCSVMySQL\App;

use LargeCSVMySQL\App\Interfaces\IFormTemplate;

class FormDatabaseConnectTemplate implements IDatabaseFormTemplate
{
    private static $TEMPLATE_FILE;
    protected $username;
    protected $host;
    protected $port;
    protected $offset;
    protected $tablename;

    public function validate(IFormTemplate $template) : bool
    {
        if ($template !== null) {
            return (empty($template->host) === false && empty($template->db) === false && empty($template->tablename) === false);
        }
        return false;
    }

    public function parseForm(array $post_data) : IFormTemplate
    {
        if (empty($post_data) === false) {
            $reflect = new ReflectionClass($this);
            $props = $reflect->getProperties(ReflectionProperty::IS_PROTECTED);
            $post_data = array_filter($post_data, function($v, $k) use ($props) {
                return (bool) ((mb_eregi("^$k$", $props->getName() !== false)) ? false : true);
            });
            $data = serialize($post_data);
            return unserialize($data, "FormDatabaseConnectTemplate");
        }
        return new self();
    }

    public function parseSettings($settings_str) : array
    {
        $result = [];
        if (empty($settings_str) === false) {
            $data = unserialize($settings_str);
            foreach($data as $k => $v) {
                $result[$k] = unserialize($v, self);
            }
        }
        return $result;
    }
}