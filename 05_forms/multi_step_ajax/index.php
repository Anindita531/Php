<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Multi-Step Form AJAX</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f2f2f2; }
        .form-step { display: none; background: #fff; padding:20px; border-radius:10px; max-width:500px; margin:auto; }
        .form-step.active { display: block; }
        .progress-bar { width: 100%; background:#ddd; border-radius:10px; margin-bottom:20px; }
        .progress { height:20px; width:0%; background:#4CAF50; border-radius:10px; transition: width 0.3s; }
        input, select, textarea { width:100%; padding:8px; margin:5px 0; }
        input[type=submit], button { padding:10px 20px; background:#007BFF; color:white; border:none; cursor:pointer; }
        .error { color:red; font-size:14px; }
        img { max-width:100px; margin-top:5px; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Multi-Step AJAX Form</h2>
<div class="progress-bar"><div class="progress" id="progress"></div></div>

<form id="multiStepForm" enctype="multipart/form-data">
    <!-- Step 1 -->
    <div class="form-step step1 active">
        <h3>Step 1: Personal Info</h3>
        <label>Name:</label><input type="text" name="name" required>
        <label>Email:</label><input type="email" name="email" required>
        <span class="error" id="error1"></span><br>
        <button type="button" onclick="nextStep(1)">Next</button>
    </div>

    <!-- Step 2 -->
    <div class="form-step step2">
        <h3>Step 2: Additional Info</h3>
        <label>Age:</label><input type="number" name="age" required>
        <label>Gender:</label>
        <select name="gender" required>
            <option value="">Select</option>
            <option>Male</option>
            <option>Female</option>
            <option>Other</option>
        </select>
        <label>Hobbies:</label><br>
        <input type="checkbox" name="hobbies[]" value="Coding"> Coding
        <input type="checkbox" name="hobbies[]" value="Music"> Music
        <input type="checkbox" name="hobbies[]" value="Reading"> Reading
        <span class="error" id="error2"></span><br>
        <button type="button" onclick="prevStep(2)">Previous</button>
        <button type="button" onclick="nextStep(2)">Next</button>
    </div>

    <!-- Step 3 -->
    <div class="form-step step3">
        <h3>Step 3: Upload Profile Picture</h3>
        <input type="file" name="profile_pic" id="profile_pic" required><br>
        <span class="error" id="error3"></span><br>
        <button type="button" onclick="prevStep(3)">Previous</button>
        <button type="button" onclick="nextStep(3)">Next</button>
    </div>

    <!-- Step 4 -->
    <div class="form-step step4">
        <h3>Step 4: Review & Submit</h3>
        <div id="reviewData"></div>
        <button type="button" onclick="prevStep(4)">Previous</button>
        <input type="submit" value="Confirm & Submit">
    </div>
</form>

<script>
let currentStep = 1;
const totalSteps = 4;

function showStep(step){
    document.querySelectorAll('.form-step').forEach((el, i)=>{
        el.classList.remove('active');
    });
    document.querySelector('.step'+step).classList.add('active');
    document.getElementById('progress').style.width = ((step-1)/(totalSteps-1))*100 + '%';
}

function nextStep(step){
    const formData = new FormData(document.getElementById('multiStepForm'));
    formData.append('step', step);
    
    fetch('process.php', { method:'POST', body: formData })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'ok'){
            currentStep++;
            if(currentStep > totalSteps) currentStep = totalSteps;
            if(currentStep===4){
                document.getElementById('reviewData').innerHTML = data.review;
            }
            showStep(currentStep);
        } else {
            document.getElementById('error'+step).innerText = data.error;
        }
    });
}

function prevStep(step){
    currentStep--;
    if(currentStep<1) currentStep=1;
    showStep(currentStep);
}

document.getElementById('multiStepForm').addEventListener('submit', function(e){
    e.preventDefault();
    const formData = new FormData(this);
    formData.append('step','submit');

    fetch('process.php', { method:'POST', body: formData })
    .then(res=>res.json())
    .then(data=>{
        if(data.status==='ok'){
            alert('Form submitted successfully!');
            location.reload();
        }
    });
});
</script>

</body>
</html>
