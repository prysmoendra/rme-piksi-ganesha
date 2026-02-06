<?php

namespace App\Patterns\Creational\Prototype;

class ClinicalPathwayPrototype
{
    public $diseaseName;
    public $standardActions = [];
    public $standardMedications = [];
    public $estimatedDays;

    public function __construct($name, array $actions, array $medications, $days)
    {
        $this->diseaseName = $name;
        $this->standardActions = $actions;
        $this->standardMedications = $medications;
        $this->estimatedDays = $days;
    }

    // deep clone method
    public function clone()
    {
        // In PHP, objects are passed by reference, so we need to ensure arrays/objects inside are cloned if mutable.
        // For arrays of strings/primitives, simple default clone (shallow) is often enough for top level properties,
        // but here we might want to reset potential IDs if this was a model.
        // Since this is a data object, default clone is mainly fine, but let's be explicit.

        $cloned = clone $this;
        // If standardActions were objects, we would need to clone them individually here.
        // Assuming they are simple arrays for this demo.
        return $cloned;
    }

    public function getDetails()
    {
        return [
            'disease' => $this->diseaseName,
            'actions' => $this->standardActions,
            'medications' => $this->standardMedications,
            'length_of_stay' => $this->estimatedDays
        ];
    }
}
