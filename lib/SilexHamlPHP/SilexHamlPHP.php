<?php

namespace SilexHamlPHP;

require_once __DIR__ . '/../../vendor/HamlPHP/src/HamlPHP/HamlPHP.php';

class SilexHamlPHP extends \HamlPHP
{
    private $viewPath;
    private $globals = array();

    public function addGlobal($name, $variable)
    {
        $this->globals[$name] = $variable;
    }

    public function setViewPath($path)
    {
        $this->viewPath = $path;

        if ($this->viewPath !== null
                && substr($this->viewPath, -strlen($this->viewPath)) !== '/') {
            $this->viewPath .= '/';
        }
    }

    public function getViewPath()
    {
        return $this->viewPath;
    }

    public function parseFile($fileName, array $variables = array())
    {
        $mergedVariables = array_merge($this->globals, $variables);
        return parent::parseFile($this->viewPath . $fileName, $mergedVariables);
    }

    public function render($fileName, array $variables = array())
    {
        return $this->parseFile($fileName, $variables);
    }
}