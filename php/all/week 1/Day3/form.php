<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    </style>
    <script>
         function validation() {
        var name = document.getElementById('name').value;
        var genderMale = document.getElementById('male').checked;
        var genderFemale = document.getElementById('female').checked;
        var gameChecked = document.getElementById('game').checked;
        var musicChecked = document.getElementById('music').checked;
        var language = document.getElementById('language').value;
        
        var submitbtn = document.getElementById('submitbtn');
        if (name !== '' && (genderMale || genderFemale) && (gameChecked || musicChecked) && language !== '') {
            submitbtn.disabled = false;
        } else {
            submitbtn.disabled = true;
        }
    }
 
    // Function to handle form submission and save data to database
    function submitform() {
        var name = document.getElementById('name').value;
        var gender = document.querySelector('input[name="gender"]:checked').value;
        var interest = [];
        if (document.getElementById('game').checked) {
            interest.push('game');
        }
        if (document.getElementById('music').checked) {
            interest.push('music');
        }
        var language = document.getElementById('language').value;
        
        // Code to save form data to the database goes here
        
        alert("Form submitted successfully!");
        document.getElementById('myform').submit();
        document.getElementById('myform').reset();
         
        validateForm(); // Re-validate form after reset
    }
 
    // Function to handle textbox button click
    function showTextboxValue() {
        var textboxValue = document.getElementById('name').value;
        if(textboxValue == ''){
            alert("Please fill the form");
        } else {
 
            alert("Textbox value: " + textboxValue);
        }
    }
 
    // Function to handle radio button button click
    function showgenderValue() {
        var gender = document.querySelector('input[name="gender"]:checked').value;
        if(!gender){
            alert("Please select gender..");
        } else {
 
            alert("gender: " + gender);
        }
    }
 
    // Function to handle checkbox button click
    function showinterestValue() {
        var interest = [];
        if (document.getElementById('game').checked) {
            interest.push('game');
        }
        if (document.getElementById('music').checked) {
            interest.push('music');
        }
        if(interest.length == 0){
            alert("Please select the interest");
        } else {
 
            alert("interest: " + interest.join(", "));
        }
    }
 
    // Function to handle dropdown button click
    function showConValue() {
        var language = document.getElementById('language').value;
        if(language == ''){
            alert("Please select language");
        } else {
 
            alert("language: " + language);
        }
    }
</script>
</head>
<body>
   
    <div class="container">
        <center>
        <fieldset>
            <legend></legend><br>
        <form action="confi.php" method="POST" id="myform">
            
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter your name" oninput="validation()" ><br><br>
 
            <label for="gender">Gender:</label>
            <input type="radio" name="gender" id="male" name="male" value="male" onclick="validation()">
            <label for="male">Male</label>
            <input type="radio" id="female"id="female" name="gender" value="female" onclick="validation()">
            <label for="female">Female</label>
            <br><br>
 
            <label for="interest">interest:</label>
            <input type="checkbox" name="interest[]" id="game" value="game" onclick="validation()">
            <label for="game">game</label>
            <input type="checkbox" name="interest[]" id="music" value="music" onclick="validation()">
            <label for="music">music</label>
            <br><br>
 
            <label for="language">language:</label>
            <select name="language" id="language" onchange="validation()">
            <option value="html" >Html</option>
                <option value="css">Css</option>
            </select><br><br>
 
        <button type="submit" id="submitbtn" onclick="submitform()" disabled>Submit</button>    
        </form>
        <button type="button" onclick="showTextboxValue()">text</button>
        <button type="button" onclick="shogenderValue()">radio</button>
        <button type="button" onclick="showinterestValue()">check</button>
        <button type="button" onclick="showConValue()">dropdown</button>
    </center>
    </fieldset>
</div>
 
 
  
</body>
</html>