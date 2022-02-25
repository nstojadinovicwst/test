<?php

namespace Nemke\Framework;


class Config
{
    /**
     * @var string
     */
    private static $CONFIG_PATH = __DIR__ . '/../../config/config.txt';

    /**
     * @var array
     */
    private $config = [];


    public function __construct()
    {
        $this->loadConfigFile();
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function loadConfigFile()
    {

        $configFile = @file_get_contents(self::$CONFIG_PATH);
        if ($configFile === false) {
            throw new \Exception("Config File was not found, be sure there is config.txt file in config folder");
        }

        $this->parseConfigFile($configFile);

    }

    /**
     * @param string $configFile
     * @return void
     */
    private function parseConfigFile(string $configFile)
    {
        $configLines = explode("\n", $configFile);
        if (is_array($configLines)) {
            foreach ($configLines as $line) {
                $line = $this->cleanLine($line);

                if (strpos($line, "#") !== false) {
                    continue;
                }

                $this->parseLine($line);

            }
        }
    }

    /**
     * @param string $line
     * @return array|string|string[]
     */
    private function cleanLine(string $line)
    {
        $line = str_replace('"', '', $line);

        return $line;
    }

    /**
     * @param string $line
     * @return false|void
     */
    private function parseLine(string $line)
    {
        $line = explode('=', $line);

        if ((count($line) < 2)) {
            return false;
        }
        $line[1] = trim($line[1]);
        //there is = in the string
        if (count($line) > 2) {
            $configValue = $line;
            unset($configValue[0]);
            $line[1] = trim(implode('', $configValue));
        }

        $configPath = explode('.', trim($line[0]));

        foreach ($configPath as $k => $path) {

            //I spent too much time overthinking something smart, so I will just do something stupid
            switch ($k) {
                case 0:
                    if (!isset($this->config[$path])) {
                        $this->config[$path] = [];
                    }

                    break;

                case 1:
                    if ((count($configPath) > 2) && !isset($this->config[$configPath[0]][$path])) {
                        $this->config[$configPath[0]][$path] = [];
                    } else if (!isset($this->config[$configPath[0]][$path])) {
                        $this->config[$configPath[0]][$path] = $line[1];
                    }

                    break;

                case 2:
                    if (!isset($this->config[$configPath[0]][$configPath[1]][$path])) {
                        $this->config[$configPath[0]][$configPath[1]][$path] = $line[1];
                    }

                    break;
            }

        }

    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }
}