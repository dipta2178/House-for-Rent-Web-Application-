<?php
require_once "config.php";

$Name = $TenantID = $Address = $ContactNo = $Email = "";
$Name_err = $TenantID_err = $Address_err = $ContactNo_err = $Email_err = "";

 
if($_SERVER["REQUEST_METHOD"] == "POST")
{
       if(empty(trim($_POST["Name"])))
       {
        $Username_err = "Enter your name:";
       } 
       else
       {
        $sql = "SELECT ID FROM Tenant WHERE Name = ?";
        
        if($stmt = mysqli_prepare($link, $sql))
        {
            mysqli_stmt_bind_param($stmt, "s", $param_Name);
            $param_Name = trim($_POST["Name"]);
        
            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $Name_err = "Name already taken. Try a different one.";
                } 
                else
                {
                    $Name = trim($_POST["Name"]);
                }
            } 
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    if(empty(trim($_POST["TenantID"])))
    {
        $TenantID_err = "Enter a TenantID:";
    } 
    else
    {
        $sql = "SELECT ID FROM Tenant WHERE TenantID = ?";
        
        if($stmt = mysqli_prepare($link, $sql))
        {
            mysqli_stmt_bind_param($stmt, "s", $param_TenantID);
            $param_TenantID = trim($_POST["TenantID"]);
            
            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $TenantID_err = "ID already taken. Try a different ID.";
                } 
                else
                {
                    $TenantID = trim($_POST["TenantID"]);
                }
            } 
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    if(empty(trim($_POST["Address"])))
    {
        $Address_err = "Enter your address:";
    } 
    else
    {
        $sql = "SELECT ID FROM Tenant WHERE Address = ?";
        
        if($stmt = mysqli_prepare($link, $sql))
        {
            mysqli_stmt_bind_param($stmt, "s", $param_Address);
            $param_Address = trim($_POST["Address"]);
            
            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $Address_err = "Address matches. Try again.";
                } 
                else
                {
                    $Address = trim($_POST["Address"]);
                }
            } 
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

// Validate contact
    if(empty(trim($_POST["ContactNo"]))){
        $contact_err = "Please enter ContactNo  .";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM owner WHERE ContactNo    = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_contact);
            
            // Set parameters
            $param_contact = trim($_POST["ContactNo "]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $contact_err = "This ContactNo is already taken.";
                } else{
                    $ContactNo = trim($_POST["ContactNo   "]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
     if(empty(trim($_POST["Email"])))
    {
        $Email_err = "Enter your email:";
    } 
    else
    {
        $sql = "SELECT ID FROM Tenant WHERE Email = ?";
        
        if($stmt = mysqli_prepare($link, $sql))
        {
            mysqli_stmt_bind_param($stmt, "s", $param_Email);
            $param_Email = trim($_POST["Email"]);
            
            
            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $Email_err = "Email matches. Try a different one.";
                } 
                else
                {
                    $Email = trim($_POST["Email"]);
                }
            } 
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
        
    
    if(empty($Name_err) && empty($TenantID_err) &&  empty($Address_err) && empty($ContactNo_err) && empty($Email_err))
    {
        $sql = "INSERT INTO Tenant (Name, TenantID, Address, ContactNo, Email) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssss", $param_Name, $param_TenantID, $param_Address, $param_ContactNo, $param_Email);
            
            $param_Name = $Name;
            $param_TenantID = $TenantID;
            $param_Address = $Address;
            $param_ContactNo = $ContactNo;
            $param_Email = $Email;
            
            if(mysqli_stmt_execute($stmt))
            {
                header("location: welcome.php");
            } 
            else
            {
                echo "Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
     <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="UTF-8">

    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

           <link rel="stylesheet" type="text/css" href="tenant.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body style="background-color:black; color:white;">
    <div class="container">
    <div class="d-flex justify-content-center h-300">
                <div class="card">

            <div class="card-header">
    <div class="wrapper">
        <h2>Tenant Sign Up</h2>
        <p>Please Fill this form to be a Tenant.</p>
                            <div class="card-body">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group <?php echo (!empty($Name_err)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" minlength="1" maxlength="100" name="Name" class="form-control" value="<?php echo $Name; ?>"placeholder="Enter your name">
                <span class="help-block"><?php echo $Name_err; ?></span>
            </div> 

            <div class="form-group <?php echo (!empty($TenantID_err)) ? 'has-error' : ''; ?>">
                <label>TenantID</label>
                <input type="text" minlength="1" maxlength="10" name="TenantID" class="form-control" value="<?php echo $TenantID; ?>"placeholder="Enter Tenant ID">
                <span class="help-block"><?php echo $TenantID_err; ?></span>
            </div> 

            <div class="form-group <?php echo (!empty($Address_err)) ? 'has-error' : ''; ?>">
                <label>Address</label>
                <input type="text" minlength="1" maxlength="80" name="Address" class="form-control" value="<?php echo $Address; ?>"placeholder="Enter Your Address">
                <span class="help-block"><?php echo $Address_err; ?></span>
            </div>    

            <div class="form-group <?php echo (!empty($ContactNo_err)) ? 'has-error' : ''; ?>">
                <label>Contact(Optional)</label>
                <input type="text" minlength="11" maxlength="11" name="Contact" class="form-control" value="<?php echo $ContactNo; ?>"placeholder="Enter Your Mobile number">
                <span class="help-block"><?php echo $ContactNo_err; ?></span>
            </div> 

            <div class="form-group <?php echo (!empty($Email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" minlength="1" maxlength="90" name="Email" class="form-control" value="<?php echo $Email; ?>"placeholder="Enter Your valid Email">
                <span class="help-block"><?php echo $Email_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
                    <input type="button" class="btn btn-danger" value="Home" onclick="history.back()">
                 </div>

        </form>
    </div>    
</div>
</body>
</html>