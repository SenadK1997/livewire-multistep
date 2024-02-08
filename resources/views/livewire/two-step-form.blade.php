<div class="offset-3 col-6">
    <h1 class="d-flex justify-content-center">MultiStep Form</h1>
    <h6 class="d-flex justify-content-center"> step {{$currentStep}} out of {{$total_steps}}</h6>
    @if($currentStep===1)
        <h4 class="d-flex justify-content-center">Name</h4>
        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input wire:model="first_name" type="text" class="form-control">
            @error('first_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input wire:model="last_name" type="text" class="form-control">
            @error('last_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <input wire:model="address" type="text" class="form-control">
            @error('address')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">City</label>
            <input wire:model="city" type="text" class="form-control">
            @error('city')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Country</label>
            <input wire:model="country" type="text" class="form-control">
            @error('country')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Date of Birth</label>
            <div class="row">
                <div class="col">
                    <select wire:model="month" class="form-select">
                        {{-- <option value="">Select Month</option> --}}
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div class="col">
                    <select wire:model="day" class="form-select">
                        {{-- <option value="">Select Day</option> --}}
                        @for ($i = 1; $i <= 31; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col">
                    <select wire:model="year" class="form-select">
                        {{-- <option value="">Select Year</option> --}}
                        @for ($y = 2024; $y >= 1900; $y--)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            @error('dob')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        @elseif($currentStep === 2)
            <h4 class="d-flex justify-content-center">Marriage Details</h4>
            <div class="mb-3 flex flex-col">
                <label class="form-label">Are you married?</label>
                <select wire:model="married" class="form-select" wire:change="updateMarriage($event.target.value)">
                    <option value="">Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
                @error('married')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            @if($married === 'Yes')
                <div class="mb-3">
                    <div class="mb-3">
                        <label class="form-label">Date of Marriage</label>
                        <div class="row">
                            <div class="col">
                                <select wire:model="marriageMonth" class="form-select" required>
                                    {{-- <option value="">Select Month</option> --}}
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="col">
                                <select wire:model="marriageDay" class="form-select" required>
                                    {{-- <option value="">Select Day</option> --}}
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col">
                                <select wire:model="marriageYear" class="form-select" required>
                                    {{-- <option value="">Select Year</option> --}}
                                    @for ($y = 2024; $y >= 1900; $y--)
                                        <option value="{{ $y }}">{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        @error('dob')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @error('marriageDate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Country of Marriage</label>
                    <input wire:model="marriageCountry" type="text" class="form-control" required>
                    @error('marriageCountry')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            @endif
            @if ($married === 'No')
                <div class="mb-3 flex flex-col">
                    <label class="form-label">Are you widowed?</label>
                    <label>
                        <input type="radio" wire:model="widowed" value="Yes">
                        Yes
                    </label>
                    <label>
                        <input type="radio" wire:model="widowed" value="No">
                        No
                    </label>
                    @error('widowed')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="mb-3 flex flex-col">
                    <label class="form-label">Have you ever been married in the past?</label>
                    <label>
                        <input type="radio" wire:model="pastMarriage" value="Yes">
                        Yes
                    </label>
                    <label>
                        <input type="radio" wire:model="pastMarriage" value="No">
                        No
                    </label>
                    @error('pastMarriage')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            @endif
        @endif
        @if($currentStep>1)
        <button wire:click="decrementSteps" class="btn btn-primary">Previous</button>
        @endif
        @if($currentStep<$total_steps)
        <button wire:click="incrementSteps" class="btn btn-primary">Next</button>
        @endif
        @if($currentStep===$total_steps)
        <button wire:click="submit" class="btn btn-success">Submit</button>
        @endif
</div>