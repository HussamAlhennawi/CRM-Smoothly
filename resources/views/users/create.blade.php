<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <br>

    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <br>
            <form id="signUpUserForm" action="{{ route('users.store') }}" method="POST">
                @csrf
                <!-- start step indicators -->
                <div class="form-header flex gap-3 mb-4 text-xs text-center">
                    <span class="stepIndicator flex-1 pb-8 relative">Account Setup</span>
                    @if($permissions->isNotEmpty())
                    <span class="stepIndicator flex-1 pb-8 relative">Role & Permissions</span>
                    @endif
                    @if($projects->isNotEmpty())
                        <span class="stepIndicator flex-1 pb-8 relative">Assign Projects</span>
                    @endif

                </div>
                <!-- end step indicators -->

                <!-- step one -->

                <div class="step">

                    <br>
                    <!-- Name -->
                    <div>
                        <x-input-label for="input-name" :value="__('Name')" />
                        <x-text-input id="input-name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 space-y-1" id="input-name-error"></p>

                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="input-email" :value="__('Email')" />
                        <x-text-input id="input-email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 space-y-1" id="input-email-error"></p>
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="input-password" :value="__('Password')" />

                        <x-text-input id="input-password" class="block mt-1 w-full"
                                      type="password"
                                      name="password"
                                      required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 space-y-1" id="input-password-error"></p>

                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="input-password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input id="input-password_confirmation" class="block mt-1 w-full"
                                      type="password"
                                      name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 space-y-1" id="input-password_confirmation-error"></p>

                    </div>
                </div>

                <!-- step two -->
                @if($roles->isNotEmpty() || $permissions->isNotEmpty())
                <div class="step">
                    <br>
                    @if($roles->isNotEmpty())
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select role</label>
                    <select
                        id="roles" name="role"
                        data-te-select-init
                        >
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        @endif
                    <br>
                    @if($permissions->isNotEmpty())
                        <label for="permissions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select permissions</label>
                        <select
                            id="permissions" name="permissions[]"
                            data-te-select-init
                            data-te-select-placeholder="Permissions"
                            multiple>
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('permissions')" class="mt-2" />
                    @endif
                </div>
                @endif

                <!-- step three -->
                @if($projects->isNotEmpty())
                <div class="step">
                    <br>
                    <label for="projects" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select projects</label>
                    <select
                        id="projects" name="projects[]"
                        data-te-select-init
                        data-te-select-placeholder="Projects"
                        multiple>
                        @forelse($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->title }}</option>
                        @empty
                            <option value="0">No Active Projects Found</option>
                        @endforelse
                    </select>
                    <x-input-error :messages="$errors->get('projects')" class="mt-2" />
                </div>
                @endif

                <!-- start previous / next buttons -->
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button type="button" id="prevBtn" class="mx-2 flex-1 py-3.5 justify-center" onclick="nextPrev(-1)">
                        Prev
                    </x-primary-button>

                    <x-primary-button type="button" id="nextBtn" class="mx-2 flex-1 py-3.5 justify-center">
                        Next
                    </x-primary-button>
                </div>
                <!-- end previous / next buttons -->
            </form>
        </div>
    </div>



</x-app-layout>

<style>
    #signUpUserForm {
        max-width: 500px;
    }
    #signUpUserForm .form-header .stepIndicator.active {
        font-weight: 600;
    }
    #signUpUserForm .form-header .stepIndicator.finish {
        font-weight: 600;
        color: #5a67d8;
    }
    #signUpUserForm .form-header .stepIndicator::before {
        content: "";
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
        z-index: 9;
        width: 20px;
        height: 20px;
        background-color: #c3dafe;
        border-radius: 50%;
        border: 3px solid #ebf4ff;
    }
    #signUpUserForm .form-header .stepIndicator.active::before {
        background-color: #a3bffa;
        border: 3px solid #c3dafe;
    }
    #signUpUserForm .form-header .stepIndicator.finish::before {
        background-color: #5a67d8;
        border: 3px solid #c3dafe;
    }
    #signUpUserForm .form-header .stepIndicator::after {
        content: "";
        position: absolute;
        left: 50%;
        bottom: 8px;
        width: 100%;
        height: 3px;
        background-color: #f3f3f3;
    }
    #signUpUserForm .form-header .stepIndicator.active::after {
        background-color: #a3bffa;
    }
    #signUpUserForm .form-header .stepIndicator.finish::after {
        background-color: #5a67d8;
    }
    #signUpUserForm .form-header .stepIndicator:last-child:after {
        display: none;
    }
    #signUpUserForm input.invalid {
        border: 2px solid #dc2626;
    }
    #signUpUserForm .step {
        display: none;
    }
</style>

<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("step");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n === 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n === (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("step");
        // Exit the function if any field in the current tab is invalid:
        // if (n === 1 && !validateForm()) return false;
        if (n === 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("signUpUserForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("step");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value === "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("stepIndicator")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("stepIndicator");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }


    let nextButton = document.querySelector('#nextBtn')
    nextButton.addEventListener('click', () => {

        document.querySelector('#input-name-error').textContent = ''
        document.querySelector('#input-email-error').textContent = ''
        document.querySelector('#input-password-error').textContent = ''
        document.querySelector('#input-password_confirmation-error').textContent = ''

        document.querySelector('#input-name').classList.remove('border-red-600')
        document.querySelector('#input-email').classList.remove('border-red-600')
        document.querySelector('#input-password').classList.remove('border-red-600')
        document.querySelector('#input-password_confirmation').classList.remove('border-red-600')

        if (currentTab === 0) {
            axios.post('/users/validateFirstStep', document.querySelector('#signUpUserForm'))
                .then((response) => {
                    if (response.status === 200) {
                        nextPrev(1)
                    }
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        let errors = error.response.data.errors
                        Object.keys(errors).forEach(error => {
                            document.querySelector(`#input-${error}-error`).textContent = errors[error]
                            document.querySelector(`#input-${error}`).classList.add('border-red-600')
                        })
                    }
                })
        } else {
            nextPrev(1);
        }
    })


</script>
