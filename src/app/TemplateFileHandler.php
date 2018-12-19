<?php
/*
 * @author Clinton Shane Wright <clintonshanewright@gmail.com>
 * @package \LargeCSVMySQL\App\TemplateFileHandler
 * 
 */
namespace LargeCSVMySQL\App;

use LargeCSVMySQL\App\Interfaces\ITemplateFileHandler;

class TemplateFileHandler implements ITemplateFileHandler
{

    public function __construct()
    {
        $this->getTemplateFileName();
    }

    public function getTemplateFileName() : string
    {
        if (self::$TEMPLATE_FILE === null) {
            self::$TEMPLATE_FILE = dirname(__FILE__) . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPERATOR . "templates.json";
        }
        return self::$TEMPLATE_FILE;
    }

    public function loadTemplates() : string
    {
        $data = '';

        $template_file = $this->getTemplateFileName();

        if (file_exists($template_file) === false) {
            file_put_contents($template_file, "{}");
        }
    
        if (is_writable($template_file) === true) {
            $data = file_get_contents($template_file);
        }

        return $data;
    }
    
    public function saveTemplate(array $post_data, IFormTemplate $template)
    {
        if (empty($post_data) === false) {

            $form = $template->parseForm($post_data);

            $template_file = $this->getTemplateFileName();
            $templates = $this->loadTemplates();
            $templates = $template->parseSettings($templates);
            $templates[$form->getName()] = $form;

            $data = serialize($templates);
            file_put_contents($template_file);
            return true;
        }
        return false;
    }
}