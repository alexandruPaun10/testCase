<?php
        require '../model/customer.php';
        session_start();
        $customerTbl=isset($_SESSION['customertbl0'])?unserialize($_SESSION['customertbl0']):new customer();
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
                        <h2>Add Customer</h2>
                    </div>
                    <p>Please fill this form and submit to add customer record in the database.</p>
                    <form action="../index.php?act=add" method="post" >
                        <div class="form-group <?php echo (!empty($customerTbl->firstName_msg)) ? 'has-error' : ''; ?>">
                            <label>Customer First Name</label>
                            <input type="text" name="firstName" class="form-control" value="<?php echo $customerTbl->firstName; ?>">
                            <span class="help-block"><?php echo $customerTbl->firstName_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($customerTbl->lastName_msg)) ? 'has-error' : ''; ?>">
                            <label>Customer Last Name</label>
                            <input name="lastName" class="form-control" value="<?php echo $customerTbl->lastName; ?>">
                            <span class="help-block"><?php echo $customerTbl->lastName_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($customerTbl->email_msg)) ? 'has-error' : ''; ?>">
                            <label>Customer email</label>
                            <input name="email" class="form-control" value="<?php echo $customerTbl->email; ?>">
                            <span class="help-block"><?php echo $customerTbl->email_msg;?></span>
                        </div>
                        <input type="submit" name="addbtn" class="btn btn-primary" value="Submit">
                        <a href="../index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>