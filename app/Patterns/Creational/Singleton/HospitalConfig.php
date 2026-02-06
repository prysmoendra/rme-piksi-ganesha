<?php

namespace App\Patterns\Creational\Singleton;

class HospitalConfig
{
    private static $instance = null;
    private $settings = [];

    private function __construct()
    {
        // Simulate loading from DB or Env
        $this->settings = [
            'name' => env('APP_NAME', 'PIKSI GANESHA HOSPITAL'),
            'address' => 'Jl. Jend. Gatot Subroto No. 301, Bandung',
            'default_fee' => 50000,
            'admin_email' => 'admin@piksi-ganesha-hospital.com'
        ];
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new HospitalConfig();
        }

        return self::$instance;
    }

    public function get($key)
    {
        return $this->settings[$key] ?? null;
    }

    public function set($key, $value)
    {
        $this->settings[$key] = $value;
    }
}
