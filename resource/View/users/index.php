<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>Mock Project</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 text-center">
            <h1>List User</h1>
        </div>
        <div class="col-md-6 text-right">
            <h5>
            <?php if(isset($_SESSION['id'])){ ?>
                <?php echo $_SESSION['email']." - ". $_SESSION['name']."<a href='/logout'>logout</a>";?>
            <?php }else{ ?>
                <?php echo "chua dang nhap <a href='/login'>login</a>";?>
            <?php } ?>
            </h5>
        </div>
    </div>
    <div class="col-12">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Roles</th>
                <th scope="col">
                    <a href="/users/create">
                        <button class="btn btn-success">Add new user</button>
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user){ ?>
                <tr>
                    <th scope="row"><?php echo $user['id']?></th>
                    <td><?php echo $user['name']?></td>
                    <td><?php echo $user['email']?></td>
                    <td><?php echo $user['roles']?></td>
                    <td>
                        <a href="/users/detail/<?php echo $user['id']?>">
                            <button type="button" class="btn btn-primary">Detail</button>
                        </a>
                        <a href="/users/edit/<?php echo $user['id'] ?>">
                            <button type="button" class="btn btn-waring">Edit</button>
                        </a>
                        <a href="/users/delete/<?php echo $user['id'] ?>">
                            <button type="button" class="btn btn-danger">Delete</button>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

<?php //$this->layout('template') ?>
<?php //$this->section('content'); ?>
<?php //$this->end(); ?>
