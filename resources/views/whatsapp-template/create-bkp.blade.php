<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Validated Stepper Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <style>
    .step-digit .circle {
      width: 40px;
      height: 40px;
      line-height: 38px;
      border: 2px solid #dee2e6;
      font-weight: bold;
      text-align: center;
    }
    .step-digit.active .circle {
      background-color: #0d6efd !important;
      color: #fff !important;
      border-color: #0d6efd;
    }
    .step-indicator {
      flex-wrap: nowrap;
    }
    .step-digit small {
      display: block;
      margin-top: 4px;
    }
    .error{

        color: red;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Stepper Form</h2>

    <!-- Digit-style Stepper -->
    <div class="d-flex justify-content-center mb-4">
      <div class="step-indicator d-flex gap-4">
        <div class="step-digit text-center" id="indicator-1">
          <div class="circle bg-primary text-white rounded-circle">1</div>
          <small>General</small>
        </div>
        <div class="step-digit text-center" id="indicator-2">
          <div class="circle bg-secondary text-white rounded-circle">2</div>
          <small>Text</small>
        </div>
        <div class="step-digit text-center" id="indicator-3">
          <div class="circle bg-secondary text-white rounded-circle">3</div>
          <small>Header/Footer</small>
        </div>
        <div class="step-digit text-center" id="indicator-4">
          <div class="circle bg-secondary text-white rounded-circle">4</div>
          <small>Interaction</small>
        </div>
      </div>
    </div>

    <!-- Stepper Form -->
    <form id="stepper-form">
      <!-- Step 1 -->
      <div class="step" id="step-1">
        @include('whatsapp-template.step-1')
      </div>

      <!-- Step 2 -->
      <div class="step d-none" id="step-2">
        @include('whatsapp-template.step-2')
      </div>

      <!-- Step 3 -->
      <div class="step d-none" id="step-3">
        @include('whatsapp-template.step-3')
      </div>

      <!-- Step 4 -->
      <div class="step d-none" id="step-4">
        @include('whatsapp-template.step-4')
      </div>

      <!-- Navigation Buttons -->
      <div class="d-flex justify-content-between mt-4">
        <button type="button" class="btn btn-secondary" id="prev-btn" disabled>Back</button>
        <button type="button" class="btn btn-primary" id="next-btn">Next</button>
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script>

    const steps = document.querySelectorAll('.step');
    const indicators = document.querySelectorAll('.step-digit');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const form = document.getElementById('stepper-form');
    let currentStep = 0;

    function updateStepper() {
      steps.forEach((step, index) => {
        step.classList.toggle('d-none', index !== currentStep);
        indicators[index].classList.toggle('active', index === currentStep);
      });

      prevBtn.disabled = currentStep === 0;
      nextBtn.textContent = currentStep === steps.length - 1 ? 'Finish' : 'Next';
    }

    function validateCurrentStep() {
      const currentFields = steps[currentStep].querySelectorAll('input, select, textarea');
      let isValid = true;

      currentFields.forEach(field => {
        field.classList.remove('is-invalid');
        if (!field.checkValidity()) {
          field.classList.add('is-invalid');
          isValid = false;
        }
      });

      return isValid;
    }

    nextBtn.addEventListener('click', () => {
      if (currentStep < steps.length - 1) {
        if (validateCurrentStep()) {
          currentStep++;
          updateStepper();
        }
      } else {
        if (form.checkValidity()) {
          alert('Form submitted!');
          form.submit(); // Optional actual form submission
        } else {
          validateCurrentStep(); // Show errors if on last step and not valid
        }
      }
    });

    prevBtn.addEventListener('click', () => {
      if (currentStep > 0) {
        currentStep--;
        updateStepper();
      }
    });

    updateStepper();
    $(document).ready(function(){

        $.validator.addMethod("validInput", value =>
        /^[a-z0-9_]+$/.test(value),
        "Only lowercase letters, digits, and underscore are allowed. No spaces."
        );

        $("#stepper-form").validate({
        rules: {
            templateName: {
            validInput: true
            }
        }
        });
    })
  </script>
</body>
</html>
