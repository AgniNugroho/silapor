<?php
    include "../config.php"
?>

<html>
<head>
    <title>Admin: Petugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <style>
        body {
            display: flex;
        }
        .sidebar {
            min-width: 250px;
            max-width: 250px;
            background-color: #343a40;
            color: white;
            height: 100vh;
            position: fixed;
            transition: all 0.3s;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
        }
        .sidebar .nav-link {
            padding: 15px;
            display: flex;
            align-items: center;
        }
        .sidebar .nav-link .icon {
            width: 30px;
            display: flex;
            justify-content: center;
        }
        .sidebar .nav-link.active {
            background-color: #495057;
            border-left: 4px solid #007bff;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
            transition: all 0.3s;
        }
        .sidebar.collapsed {
            margin-left: -250px;
        }
        .content.expanded {
            margin-left: 0;
        }
        .btn-custom {
            background-color: white;
            color: black;
            border: 2px solid transparent;
            transition: border-color 0.3s;
            margin-left: 15px; /* Adjusted margin to align with the card */
        }
        .btn-custom:hover {
            border-color: black;
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <h3 class="text-center py-3">Admin Dashboard</h3>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <div class="icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="laporan.php">
                    <div class="icon"><i class="fas fa-file-alt"></i></div>
                    Laporan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <div class="icon"><i class="fas fa-user-shield"></i></div>
                    Petugas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">
                    <div class="icon"><i class="fas fa-sign-out-alt"></i></div>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <div class="content" id="content">

        <button class="btn btn-custom mb-3" id="toggleSidebar"><i class="fas fa-bars"></i></button>
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal"">Tambah Petugas</button>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Petugas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="tambah_petugas.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                            <div class="mb-3">
                                <label for="level" class="form-label">Level</label>
                                <select class="form-select" id="level" name="level">
                                    <option value="admin">Admin</option>
                                    <option value="petugas">Petugas</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Id</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Level</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = "SELECT * FROM petugas";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $no++; ?></th>
                            <td><?php echo $row['id_petugas']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['nama_petugas']; ?></td>
                            <td><?php echo $row['level']; ?></td>
                            <TD></TD>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('content').classList.toggle('expanded');
        });
    </script>
</body>
</html>