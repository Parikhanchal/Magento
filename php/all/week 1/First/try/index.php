<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crud</title>
</head>
<body>
    <center>
    <div class='container'>
        <form action="crud.php" method="post"> 
            <label for="first">First Name:</label>
            <input type="text" id="first" name="first" placeholder="Enter your first name" required>
            <br/><br/>
            <label for="last">Last Name:</label>
            <input type="text" id="last" name="last" placeholder="Enter your last name" required>
            <br/><br/>
            <label for="address">Address:</label>
            <input type="address" id="address" name="address" placeholder="Enter your address" required>
            <br/><br/>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            <br/><br/>
            <div class="wrap">
                <button type="submit" name="submit"> 
                    Submit
                </button>
            </div>
        </form>
        <br><br>

        
    </div>
</center>
</body>
</html>