<?php
namespace Application;

trait KernelDirectoryStructureTrait
{
    public function getRootDir()
    {
        return $this->rootDir === null
            ? realpath(dirname((new \ReflectionClass($this))->getFileName()) . '/..')
            : $this->rootDir;
    }

    public function getCacheDir()
    {
        return $this->getRootDir() . '/var/cache';
    }

    public function getLogDir()
    {
        return $this->getRootDir() . '/var/logs';
    }
}
