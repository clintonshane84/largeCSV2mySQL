<?php
namespace LargeCSVMySQL\App\Interfaces;

interface ITemplateFileHandler
{
    public function getFileName() : string;
    public function loadTemplates() : string;
    public function saveTemplate(array $post_data);
}