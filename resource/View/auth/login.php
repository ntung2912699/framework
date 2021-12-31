<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
<div class="container">
    <div class="col-md-12 text-center">
        <h1>Login Users</h1>
    </div>
    <div class="col-md-6 offset-md-3">
        <form method="post" action="/checklogin">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="email">Email</label>
                    <?php if ($_COOKIE != null){?>
                    <input type="email" name="email" class="form-control" value="<?php echo $_COOKIE['email'] ?>" id="email" placeholder="Email">
                    <?php }else{ ?>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                    <?php } ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="password">Password</label>
                    <?php if ($_COOKIE != null){?>
                        <input type="password" name="password" class="form-control" value="<?php echo $_COOKIE['password'] ?>" id="password" placeholder="Password">
                    <?php }else{ ?>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    <?php } ?>
                </div>
            </div>
            <div class="form-row form-check">
                <?php if ($_COOKIE != null) {?>
                    <input type="checkbox" name="checksave" checked class="form-check-input" id="checksave">
                <?php }else{ ?>
                    <input type="checkbox" name="checksave" class="form-check-input" id="checksave">
                <?php } ?>
                <label class="form-check-label" for="checksave">Save infomation</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
