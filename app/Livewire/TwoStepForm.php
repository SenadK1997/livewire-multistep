<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
class TwoStepForm extends Component
{
    public $currentStep = 1;
    public $total_steps=2;
    public $first_name;
    public $last_name;
    public $address;
    public $city;
    public $country;
    public $month;
    public $day;
    public $year;
    public $married;
    public $marriageDate;
    public $marriageCountry;
    public $widowed;
    public $pastMarriage;
    public $marriageMonth;
    public $marriageDay;
    public $marriageYear;


    public function render()
    {
        return view('livewire.two-step-form');
    }
    public function incrementSteps()
    {
        $this->validateForm();
        $this->currentStep = 2;
    }
    public function decrementSteps()
    {
        $this->currentStep = 1;
    }
    public function submit(){
        $dob = Carbon::create($this->year, $this->month, $this->day);
        $marriageDate = Carbon::create($this->marriageYear, $this->marriageMonth, $this->marriageDay);
        if($this->married == null) {
            $this->addError('married', 'You must choose one option');
            return;
        }
        if ($this->married === 'Yes') {
            if ($marriageDate->lt($dob)) {
                $this->addError('marriageDate', 'The marriage date cannot be before the date of birth.');
                return;
            }
            $ageAtMarriage = $marriageDate->diffInYears($dob);
            // dd($marriageDate->diffInYears($dob));
            if ($ageAtMarriage < 18 || $dob->diffInYears(Carbon::now()) < 18) {
                $this->addError('marriageDate', 'You are not eligible to apply because your marriage occurred before your 18th birthday.');
                return;
            }
            $validated=$this->validate([
                'marriageMonth' => 'required',
                'marriageDay' => 'required',
                'marriageYear' => 'required',
                'marriageCountry' => 'required',
            ]);
        } elseif ($this->married === 'No') {
            $validated=$this->validate([
                'widowed' => 'required',
                'pastMarriage' => 'required',
            ]);
        }
        $formData = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'city' => $this->city,
            'country' => $this->country,
            'dob' => $dob,
            'marriageDate' => $marriageDate ?? null,
            'marriageCountry' => $this->marriageCountry,
            'widowed' => $this->widowed ?? null,
            'pastMarriage' => $this->pastMarriage ?? null,
        ];
        // dd($formData);
        return redirect()->route('blank')->with([
            'formData' => $formData,
            'success' => 'Form submitted successfully.'
        ]);
    }

    public function validateForm()
    {
        if($this->currentStep===1){
            $validated=$this->validate([
                'first_name'=>'required',
                'last_name'=>'required',
                'address' => 'required',
                'city' => 'required',
                'country' => 'required',
                'month' => 'required',
                'day' => 'required',
                'year'=> 'required',
            ]);
            $dob = Carbon::createFromFormat('m-d-Y', $this->month . '-' . $this->day . '-' . $this->year);
        }elseif($this->currentStep===2){
            $validated=$this->validate([
                'widowed' => 'required',
                'pastMarriage' => 'required',
            ]);
        }
    }
    public function updateMarriage($value)
    {
        $this->married = $value;
    }
}
