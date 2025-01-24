<?php
namespace Peace\Libs;

class Config {
    private array $config = [];
    private array $paths = [];

    public function __construct(array $paths = [], array $config = []) {
        $this->paths = $paths;

        if (!empty($config)) {
            $this->config = $config;
        }
    }

    public function loadConfig(string $path): void {
        if(is_dir($path)) {
            $files = glob($path . '/.php');
            if (!empty($files)) {
                foreach ($files as $file) {
                    $config = require $file;

                    if (is_array($config)) {
                        $this->config = array_merge($this->config, $config);
                    }
                }
            }
        } else {
            if (file_exists($path)) {
                $config = require $path;
                if (is_array($config)) {
                    $this->config = array_merge($this->config, $config);
                }
            }
        }
    }

    public function load(): void {
        foreach ($this->paths as $path) {
            $this->loadConfig($path);
        }
    }

    public function addPath(string $path): void {
        if (!in_array($path, $this->paths, true)) {
            $this->paths[] = $path;
        }
    }

    public function get(string $key, $default = null): mixed {
        return array_key_exists($key, $this->config) ? $this->config[$key] : $default;
    }

    public function all(): array {
        return $this->config;
    }

}