<?php

namespace App\Livewire;

use Livewire\Component;

class FormStepTwo extends Component
{
    public $areYouMarried;
    public $currentStep = 2;
    // Add other form fields as necessary

    public function render()
    {
        return view('livewire.form-step-two');
    }

    public function previousStep()
    {
        $this->emit('previousStep');
    }

    public function submitForm()
    {
        $this->validate([
            // Add validation rules for form fields
        ]);

        // Handle form submission
    }
}
