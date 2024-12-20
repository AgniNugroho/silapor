<?php
    session_start();
    include '../config.php'
?>

<html>
<head>
    <title>Admin Dashboard</title>
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
        <h3 class="text-center py-3">Hai, <?php echo $_SESSION['username']; ?>!</h3>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">
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
                <a class="nav-link" href="petugas.php">
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Total Pengguna</div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php
                                    // Query to get total users
                                    $stmt = $conn->prepare('SELECT COUNT(*) AS total FROM masyarakat');
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['total'];
                                ?>
                            </h5>
                            <p class="card-text">Jumlah pengguna yang terdaftar.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Total Laporan</div>
                        <div class="card-body">
                            <h5 class="card-title">
                            <?php
                                // Query to get total users
                                $stmt = $conn->prepare('SELECT COUNT(*) AS total FROM pengaduan');
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = mysqli_fetch_assoc($result);
                                echo $row['total'];
                            ?>
                            </h5>
                            <p class="card-text">Jumlah laporan yang masuk ke database.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-header">Total Petugas</div>
                        <div class="card-body">
                            <h5 class="card-title">
                            <?php
                                // Query to get total users
                                $stmt = $conn->prepare('SELECT COUNT(*) AS total FROM petugas');
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = mysqli_fetch_assoc($result);
                                echo $row['total'];
                            ?>
                            </h5>
                            <p class="card-text">Jumlah petugas yang terdaftar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('content').classList.toggle('expanded');
        });
    </script>
</body>
</html>