<?php

namespace App\Patterns\Behavioral\Template;

abstract class MedicalReportGenerator
{
    // The Template Method
    public final function generatePDF($data)
    {
        $pdf = "";
        $pdf .= $this->addHeader();
        $pdf .= $this->addPatientInfo($data['patient']);
        $pdf .= $this->addBody($data);
        $pdf .= $this->addFooter();
        
        return $this->render($pdf);
    }

    protected function addHeader()
    {
        return "<h1>PIKSI GANESHA HOSPITAL</h1><hr>";
    }

    protected function addPatientInfo($patient)
    {
        return "<p>Patient: {$patient['name']} (RM: {$patient['rm']})</p>";
    }

    // Abstract methods to be implemented by subclasses
    abstract protected function addBody($data);

    protected function addFooter()
    {
        return "<footer>Generated at " . date('Y-m-d H:i:s') . "</footer>";
    }

    protected function render($content)
    {
        // Simulate PDF generation
        return "PDF Content: \n" . $content;
    }
}

// Concrete Class
class DischargeReport extends MedicalReportGenerator
{
    protected function addBody($data)
    {
        return "<h2>Discharge Resume</h2><p>Diagnosis: {$data['diagnosis']}</p>";
    }
}

class SurgeryReport extends MedicalReportGenerator
{
    protected function addBody($data)
    {
        return "<h2>Surgery Report</h2><p>Surgeon: {$data['doctor']}</p><p>Procedure: {$data['procedure']}</p>";
    }
}
