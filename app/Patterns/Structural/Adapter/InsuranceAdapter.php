<?php

namespace App\Patterns\Structural\Adapter;

// Target Interface
interface InsuranceProvider
{
    public function verifyStatus(string $cardNumber): bool;
    public function getCoverageLimit(string $cardNumber): float;
}

// Adaptee (3rd Party API Simulation)
class BPJSService
{
    public function checkPeserta($nomorKartu)
    {
        // Simulating API call
        return [
            'status' => 'AKTIF',
            'kelas' => '1',
            'saldo' => 10000000 // Limit simulation
        ];
    }
}

// Adapter
class BPJSAdapter implements InsuranceProvider
{
    private $bpjsService;

    public function __construct(BPJSService $service)
    {
        $this->bpjsService = $service;
    }

    public function verifyStatus(string $cardNumber): bool
    {
        $response = $this->bpjsService->checkPeserta($cardNumber);
        return $response['status'] === 'AKTIF';
    }

    public function getCoverageLimit(string $cardNumber): float
    {
        $response = $this->bpjsService->checkPeserta($cardNumber);
        // Assuming Logic: specific limit based on class or raw value
        return (float) $response['saldo'];
    }
}
