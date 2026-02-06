<?php

namespace App\Patterns\Structural\Decorator;

// Component Interface
interface BillComponent
{
    public function getCost(): float;
    public function getDescription(): string;
}

// Concrete Component
class BasicBill implements BillComponent
{
    public function getCost(): float
    {
        return 10000; // Base administrative fee
    }

    public function getDescription(): string
    {
        return "Biaya Administrasi";
    }
}

// Base Decorator
abstract class BillDecorator implements BillComponent
{
    protected $bill;

    public function __construct(BillComponent $bill)
    {
        $this->bill = $bill;
    }

    public function getCost(): float
    {
        return $this->bill->getCost();
    }

    public function getDescription(): string
    {
        return $this->bill->getDescription();
    }
}

// Concrete Decorators
class RoomCharge extends BillDecorator
{
    private $roomPrice;

    public function __construct(BillComponent $bill, float $roomPrice)
    {
        parent::__construct($bill);
        $this->roomPrice = $roomPrice;
    }

    public function getCost(): float
    {
        return parent::getCost() + $this->roomPrice;
    }

    public function getDescription(): string
    {
        return parent::getDescription() . ", Biaya Kamar";
    }
}

class MedicationCharge extends BillDecorator
{
    private $medPrice;

    public function __construct(BillComponent $bill, float $medPrice)
    {
        parent::__construct($bill);
        $this->medPrice = $medPrice;
    }

    public function getCost(): float
    {
        return parent::getCost() + $this->medPrice;
    }

    public function getDescription(): string
    {
        return parent::getDescription() . ", Biaya Obat";
    }
}
