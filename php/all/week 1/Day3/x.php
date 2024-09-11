

-----------------
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form </title>


    <script>
        function validation()
        {
            var name = document.getElementById("name").value;

            var gender_male = document.getElementById("male").value;
            var gender_female = document.getElementById("female").value;

            var int_game = document.getElementById("game").value;
            var int_music = document.getElementById('music').value;

            var language = document.getElementById("language").value;

            var submit = document.getElementsByNameId("submit");

            if(name == '' && (gender_male || gender_female)&&(int_game || int_music) && language !== '')
            {
                submit.disabled == true ;
            }
            else
            {
                submit.disabled == false ;
            }

        }

        function submitform()
        {
            var name = document.getElementById("name").value;
            var gender = document.querySelector('input[name="gender"]:checked').value;

            var interest = [];
            if(document.getElementById['game'].checked)
            {
                interest.push('game');
            }
            if(document.getElementById['music'].checked)
            {
                interest.push('music');
            }
            
            var language = document.getElementById("language").value;

            alert("form submit");

            document.getElementById('form').reset();
            // Reset form after submission
            validateForm(); 
            // Re-validate form after reset
        }

        // Function to handle textbox button click
        function showTextboxValue() {
            var textboxValue = document.getElementById('name').value;
            alert("Textbox value: " + textboxValue);
        }

        // Function to handle radio button button click
        function showGenderValue() {
            var gender = document.querySelector('input[name="gender"]:checked').value;
            alert("Gender: " + gender);
        }

        // Function to handle checkbox button click
        function showCheckboxValue() {
            var interest = [];
            if (document.getElementById('game').checked) {
                interest.push('game');
            }
            if (document.getElementById('music').checked) {
                interest.push('music');
            }
            alert("interest: " + interest.join(", "));
        }

        // Function to handle dropdown button click
        function showdropdownValue() {
            var language = document.getElementById('language').value;
            alert("language: " + language);
        }

    </script>

</head>
<body>

    <div class="container">
        <center>
        <fieldset>
            <legend></legend><br>
        <form action="confi.php" method="POST">

            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter your name" oninput="validation()" ><br><br>

            <label for="gender">Gender:</label>
            <input type="radio" name="gender" value="male" oninput="validation()">
            <label for="male">Male</label>
            <input type="radio" name="gender" value="female" oninput="validation()">
            <label for="female">Female</label>
            <br><br>

            <label for="interest">Interest:</label>
            <input type="checkbox" id="game" value="game" oninput="validation()">
            <label for="game">Game</label>
            <input type="checkbox" id="music" value="music" oninput="validation()">
            <label for="music">Music</label>
            <br><br>

            <label for="language">Language:</label>
            <select name="language" id="language" oninput="validation()">
                <option value="html" id="html">Html</option>
                <option value="css" id="css">Css</option>
            </select><br><br>

            <button type="submit" id="submit" onclick="submitform()" disabled>submit</button>
        </form>
        <br><br>
        <button type="button" onclick="showTextboxValue()">name</button>
        <button type="button"onclick="showGenderValue()">gender</button>
        <button type="button"onclick="showdropdownValue()">checkbox</button>
        <button type="button"onclick="showCheckboxValue()">drop-down</button>

        <br><br><br><br>

    </center>
    </fieldset>
</div>
</body>
</html>

  ----------------$_COOKIE

  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form </title>


    <script>
        function validation() {
            var name = document.getElementById("name").value;
            var gender_male = document.getElementById("male").checked;
            var gender_female = document.getElementById("female").checked;
            var int_game = document.getElementById("game").checked;
            var int_music = document.getElementById('music').checked;
            var language = document.getElementById("language").value;
            var submit = document.getElementById("submit");

            if(name == '' && (gender_male || gender_female)&&(int_game || int_music) && language !== '')
            {
                submit.disabled == true ;
            }
            else
            {
                submit.disabled == false ;
            }
        }

        function submitform()
        {
            var name = document.getElementById("name").value;
            var gender = document.querySelector('input[name="gender"]:checked').value;

            var interest = [];
            if(document.getElementById['game'].checked)
            {
                interest.push('game');
            }
            if(document.getElementById['music'].checked)
            {
                interest.push('music');
            }
            
            var language = document.getElementById("language").value;

            alert("form submit");

            document.getElementById('form').reset();
            // Reset form after submission
            validateForm(); 
            // Re-validate form after reset
        }

        // Function to handle textbox button click
        function showTextboxValue() {
            var textboxValue = document.getElementById('name').value;
            alert("Textbox value: " + textboxValue);
        }

        // Function to handle radio button button click
        function showGenderValue() {
            var gender = document.querySelector('input[name="gender"]:checked').value;
            alert("Gender: " + gender);
        }

        // Function to handle checkbox button click
        function showCheckboxValue() {
            var interest = [];
            if (document.getElementById('game').checked) {
                interest.push('game');
            }
            if (document.getElementById('music').checked) {
                interest.push('music');
            }
            alert("interest: " + interest.join(", "));
        }

        // Function to handle dropdown button click
        function showdropdownValue() {
            var language = document.getElementById('language').value;
            alert("language: " + language);
        }

    </script>

</head>
<body>

<div class="container">
    <center>
        <fieldset>
            <legend></legend><br>
            <form id="form" action="confi.php" method="POST">

                <label for="name">Name:</label>
                <input type="text" name="name" id="name" placeholder="Enter your name" oninput="validation()"><br><br>

                <label for="gender">Gender:</label>
                <input type="radio" name="gender" id="male" value="male" oninput="validation()">
                <label for="male">Male</label>
                <input type="radio" name="gender" id="female" value="female" oninput="validation()">
                <label for="female">Female</label>
                <br><br>

                <label for="interest">Interest:</label>
                <input type="checkbox" id="game" value="game" oninput="validation()">
                <label for="game">Game</label>
                <input type="checkbox" id="music" value="music" oninput="validation()">
                <label for="music">Music</label>
                <br><br>

                <label for="language">Language:</label>
                <select name="language" id="language" oninput="validation()">
                    <option value="">Select Language</option>
                    <option value="html">Html</option>
                    <option value="css">Css</option>
                </select><br><br>

                <button type="submit" id="submit" onclick="submitform()" disabled>Submit</button>
            </form>
            <br><br>
            <button type="button" onclick="showTextboxValue()">Name</button>
            <button type="button" onclick="showGenderValue()">Gender</button>
            <button type="button" onclick="showCheckboxValue()">Interest</button>
            <button type="button" onclick="showdropdownValue()">Language</button>

            <br><br><br><br>

        </fieldset>
    </center>
</div>
</body>
</html>


 -------------$_COOKIE


 <script>
    function submitform() {
        var name = document.getElementById("name").value;
        var gender = document.querySelector('input[name="gender"]:checked').value;

        var interest = [];
        if (document.getElementById('game').checked) {
            interest.push('game');
        }
        if (document.getElementById('music').checked) {
            interest.push('music');
        }

        var language = document.getElementById("language").value;

        alert("Form submitted:\nName: " + name + "\nGender: " + gender + "\nInterest: " + interest.join(", ") + "\nLanguage: " + language);

        document.getElementById('form').reset();
        // Reset form after submission
        validation();
        // Re-validate form after reset
    }
</script>


class data extends config
{
    function insert()
    {
        if(isset($_POST['submit']))
        {
            $conn = $this->conn(); // Corrected typo here

            $name = $_POST["name"];
            $gender = $_POST["gender"];
            $interest = isset($_POST["game"]) ? $_POST["game"] : '';
            $interest .= isset($_POST["music"]) ? ', ' . $_POST["music"] : '';
            $language = $_POST["language"];

            $sql = "INSERT INTO students (s_name , s_gender , s_interest , s_language) VALUES ('$name', '$gender', '$interest', '$language')";

            $result = mysqli_query($conn, $sql);

            if($result)
            {
                echo "Record added successfully";
            }
            else
            {
                echo "Error adding record: " . mysqli_error($conn);
            }

            return $result;
        }
    }
} 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form </title>

    <script>
        function validation() {
            var name = document.getElementById('name').value;
            var gender_male = document.getElementById('male').checked;
            var gender_female = document.getElementById('female').checked;
            var int_game = document.getElementById('game').checked;
            var int_music = document.getElementById('music').checked;
            var language = document.getElementById('language').value;
            var submit = document.getElementById('submit');

            if (name !== '' && (gender_male || gender_female) && (int_game || int_music) && language !== '') {
                submit.disabled = false;
            } else {
                submit.disabled = true;
            }
        }

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
            var language = document.getElementById("language").value;

            // Submit the form
            // You need to give your form an ID, let's assume it's "Myform"
            document.getElementById('Myform').submit();
            
            // Reset form after submission
            document.getElementById('Myform').reset(); 
            
            // Re-validate form after reset
            validation();
        }
    </script>
</head>
<body>

<div class="container">
    <fieldset>
        <legend></legend><br>
        <form id="Myform" action="confi.php" method="POST">

            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter your name" oninput="validation()"><br><br>

            <label for="gender">Gender:</label>
            <input type="radio" name="gender" id="male" value="male" oninput="validation()">
            <label for="male">Male</label>
            <input type="radio" name="gender" id="female" value="female" oninput="validation()">
            <label for="female">Female</label>
            <br><br>

            <label for="interest">Interest:</label>
            <input type="checkbox" id="game" value="game" oninput="validation()">
            <label for="game">Game</label>
            <input type="checkbox" id="music" value="music" oninput="validation()">
            <label for="music">Music</label>
            <br><br>

            <label for="language">Language:</label>
            <select name="language" id="language" oninput="validation()">
                <option value="html" id="html">Html</option>
                <option value="css" id="css">Css</option>
            </select><br><br>

            <button type="button" id="submit" onclick="submitform()" disabled>Submit</button>
        </form>
        <br><br>
        <button type="button" onclick="showTextboxValue()">name-Text</button>
        <button type="button" onclick="showGenderValue()">gender</button>
        <button type="button" onclick="showdropdownValue()">drop-down</button>
        <button type="button" onclick="showCheckboxValue()">checkbox</button>

        <br><br><br><br>

    </fieldset>
</div>
</body>
</html>'














'

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form </title>


    <script>
        function validation() {
            var name = document.getElementById('name').value;
            var gender_male = document.getElementById('male').checked;
            var gender_female = document.getElementById('female').checked;
            var int_game = document.getElementById('game').checked;
            var int_music = document.getElementById('music').checked;
            var language = document.getElementById('language').value;
            var submit = document.getElementById('submit');

            if (name !== '' && (gender_male || gender_female) && (int_game || int_music) && language !== '') {
                submit.disabled = false;
            } else {
                submit.disabled = true;
            }
        }

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
            var language = document.getElementById("language").value;

            // Submit the form
            // You need to give your form an ID, let's assume it's "Myform"
            document.getElementById('Myform').submit();
            
            // Reset form after submission
            document.getElementById('Myform').reset(); 
            
            // Re-validate form after reset
            validation();
        }

        // Function to handle textbox button click
        function showTextboxValue() {
            var textboxValue = document.getElementById('name').value;
            alert("Textbox value: " + textboxValue);
        }

        // Function to handle radio button button click
        function showGenderValue() {
            var gender = document.querySelector('input[name="gender"]:checked').value;
            alert("Gender: " + gender);
        }

        // Function to handle checkbox button click
        function showCheckboxValue() {
            var interest = [];
            if (document.getElementById('game').checked) {
                interest.push('game');
            }
            if (document.getElementById('music').checked) {
                interest.push('music');
            }
            alert("interest: " + interest.join(", "));
        }

        // Function to handle dropdown button click
        function showdropdownValue() {
            var language = document.getElementById('language').value;
            alert("language: " + language);
        }

    </script>

</head>
<body>

    <div class="container">
<center>        
    <fieldset>
            <legend></legend><br>
            <form id="Myform" action="confi.php" method="POST">

                <label for="name">Name:</label>
                <input type="text" name="name" id="name" placeholder="Enter your name" oninput="validation()"><br><br>

                <label for="gender">Gender:</label>
                <input type="radio" name="gender" id="male" value="male" oninput="validation()">
                <label for="male">Male</label>
                <input type="radio" name="gender" id="female" value="female" oninput="validation()">
                <label for="female">Female</label>
                <br><br>

                <label for="interest">Interest:</label>
                <input type="checkbox" id="game" value="game" oninput="validation()">
                <label for="game">Game</label>
                <input type="checkbox" id="music" value="music" oninput="validation()">
                <label for="music">Music</label>
                <br><br>

                <label for="language">Language:</label>
                <select name="language" id="language" oninput="validation()">
                    <option value="html" id="html">Html</option>
                    <option value="css" id="css">Css</option>
                </select><br><br>

                <button type="button" id="submit" onclick="submitform()" disabled>Submit</button>
</form>
        <br><br>
        <button type="button" onclick="showTextboxValue()">name-Text</button>
        <button type="button" onclick="showGenderValue()">gender</button>
        <button type="button" onclick="showdropdownValue()">drop-down</button>
        <button type="button" onclick="showCheckboxValue()">checkbox</button>

        <br><br><br><br>
    </fieldset></center>

</div>
</body>
</html>

  

function insert()
{
    if(isset($_POST['submit']))
    {
        $conn = $this->conn(); 

        $name = $_POST["name"];
        $gender = $_POST["gender"];
        $interest = '';
        if(isset($_POST["game"])) {
            $interest .= 'game';
        }
        if(isset($_POST["music"])) {
            if($interest != '') {
                $interest .= ', ';
            }
            $interest .= 'music';
        }
        $language = $_POST["language"];

        $sql = "INSERT INTO student (s_name , s_gender , s_interest , s_language) VALUES ('$name', '$gender', '$interest', '$language')";

        $result = mysqli_query($conn, $sql);

        if($result)
        {
            echo "Record added successfully";
            // Redirect to the form page after successful insertion
            header('location: form.php');
            exit(); // Ensure script execution stops after redirection
        }
        else
        {
            echo "Error adding record: " . mysqli_error($conn);
        }
    
        return $result;
    }
}






<?php

class config
{
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "toor1";
    protected $db = "task";
    protected $conn;

    function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        echo "Connection successful.";
    }

    function conn()
    {
        return $this->conn;
    }
}

class data extends config
{
    function insertData()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $gender = $_POST["gender"];
            $interest = isset($_POST["interest"]) ? implode(",", $_POST["interest"]) : '';
            $language = $_POST["language"];

            $sql = "INSERT INTO student (s_name , s_gender , s_interest , s_language) VALUES ('$name', '$gender', '$interest', '$language')";
            if ($this->conn()->query($sql) === TRUE) {
                echo "Record added successfully";
            } else {
                echo "Error adding record: " . $this->conn()->error;
            }
        }
    }
}

$data = new data();
$data->insertData();

?>




