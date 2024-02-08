<?php

namespace App\Livewire;

use Livewire\Component;

class FormStepOne extends Component
{
    public $firstName;
    public $lastName;
    public $currentStep = 1;
    // Add other form fields as necessary
    protected $rules = [
        'firstName' => 'required',
        'lastName' => 'required',
    ];

    public function render()
    {
        return view('livewire.form-step-one');
    }

    public function nextStep()
    {
        $this->validate();

        $this->currentStep = 2;
    }

    public function back()
    {
        $this->currentStep = 1;
    }
}
