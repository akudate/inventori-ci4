<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penguin Logistics</title>
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="text-white" style="background-image: url('assets/bg.jpg'); background-size: 100%">
<br>
<div class="container" style="width: 35%;">
<form class="card bg-gradient-dark shadow-lg p-4 m-5" method="post" action="<?= base_url('proses_register') ?>">
    <div class="text-center">
        <h2>Register</h2><hr>
    </div>
    <div class="mb-2">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control bg-dark text-white" required>
    </div>
    <div class="mb-2">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control bg-dark text-white" required>
    </div>
    <div class="mb-2">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control bg-dark text-white" required>
    </div>
    <div class="mb-2">
        <label class="form-label">Role</label>
            <select class="form-select bg-dark text-white" name="role">
                    <option value="admin">Admin</option>
                    <option value="owner">Owner</option>
            </select>
    </div><br>
    <div class="mb-3 text-center">
        <button type="submit" class="btn btn-outline-light" style="width: 75%; border-radius: 25px;">Register</button>
    </div>
    <div class="mb-2 text-center">
        Sudah memiliki akun? <a href="<?= base_url('login') ?>" style="text-decoration: none;">Masuk Disini</a>
    </div>
</form>
    <p class="md-5 mb-0 text-center text-white">Copyright &copy; Muhammad Daffa 2023</p>
</div>
<script type="text/javascript" src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>