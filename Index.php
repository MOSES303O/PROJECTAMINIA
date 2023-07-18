<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
        <section class="form signup">
            <header>OCHIENG'S ENTERPRISE </header>
            <form action="LISTOO.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>
                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" name="fname" placeholder="First name" required>
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" name="lname" placeholder="Last name" required>
                    </div>                    
                </div>
                <div class="field input">
                    <label>ID number</label>
                    <input type="namba" name="id" placeholder="Enter your ID" length=8 required>
                </div>
                <div class="field input">
                    <label>Account number</label>
                    <input type="text" name="acc" placeholder="Enter your account no" required>
                </div>
                <div class="field input">
                    <label>phone number</label>
                    <input type="number" name="phone" placeholder="Enter your phone no" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter new password" required>
                    <i class="fas fa-eye"></i>
                </div>                                
                <div class="field image">
                    <label>Passport Image</label>
                    <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
                </div>
                <div class="field button" id="success">
                    <input id="success" type="submit" name="submit" value="REGISTER">
                </div>
            </form>
            <div class="link">Already signed up? <a href="LOGIN.php">Login now</a></div>
        </section>
    </div>
</body>
</html>