<?php
        require '../model/customer.php';
        session_start();             
        $customertbl=isset($_SESSION['customertbl0'])?unserialize($_SESSION['customertbl0']):new customer();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="../libs/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Customer</h2>
                    </div>
                    <p>Please fill this form and submit to add a new customer record in the database.</p>
                    <form action="../index.php?act=update" method="post" >
                        <div class="form-group <?php echo (!empty($customertbl->firstName_msg)) ? 'has-error' : ''; ?>">
                            <label>Customer First Name</label>
                            <input type="text" name="firstName" class="form-control" value="<?php echo $customertbl->firstName; ?>">
                            <span class="help-block"><?php echo $customertbl->firstName_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($customertbl->lastName_msg)) ? 'has-error' : ''; ?>">
                            <label>Customer Last Name</label>
                            <input type="text" name="lastName" class="form-control" value="<?php echo $customertbl->lastName; ?>">
                            <span class="help-block"><?php echo $customertbl->lastName_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($customertbl->email_msg)) ? 'has-error' : ''; ?>">
                            <label>Customer Email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $customertbl->email; ?>">
                            <span class="help-block"><?php echo $customertbl->email_msg;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $customertbl->id; ?>"/>
                        <input type="submit" name="updatebtn" class="btn btn-primary" value="Submit">
                        <a href="../index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>