<?php
/**
 * Loader
 *
 * @author Piotrooo
 */
namespace Psf;

class Loader
{
    /**
     * @var array
     */
    private $_includePath = array();
    /**
     * @var array
     */
    private $_classPath = array();

    /**
     * @return array
     */
    public function getIncludePath()
    {
        return $this->_includePath;
    }

    /**
     * @param string $path
     * @return Loader
     */
    public function setIncludePath($path)
    {
        $this->_includePath[] = $path;
        return $this;
    }

    /**
     * @return Loader
     */
    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
        return $this;
    }

    /**
     * @param string $className
     * @return bool|Loader
     */
    public function loadClass($className)
    {
        $filePath = '';

        if (empty($this->_classPath[$className])) {
            $class = $className;
            $lastPosition = strripos($className, '\\');

            if ($lastPosition != null) {
                $namespace = substr($class, 0, $lastPosition);
                $class = substr($class, $lastPosition + 1);

                $filePath = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
            }

            $filePath .= str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
        }

        foreach ($this->_includePath as $key) {
            if (file_exists(ROOT_PATH . $key . $filePath)) {
                /** @noinspection PhpIncludeInspection */
                require_once(ROOT_PATH . $key . $filePath);
                return true;
            }
        }

        return $this;
    }
}