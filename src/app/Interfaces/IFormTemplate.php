<?php
namespace LargeCSVMySQL\App\Interfaces;

interface IFormTemplate extends IFormTemplate
{
    public function validate(IFormTemplate $template) : bool;
    public function parseForm(array $post_data) : IFormTemplate;
    public function parseSettings($settings_str) : array;
}