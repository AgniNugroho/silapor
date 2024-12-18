<?php

include 'config.php';
include 'redirect.php';

if (!isset($_SESSION['id'])) {
 header('Location: login.php');
}
?>

<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />
		<title>SILAPOR</title>
		<link
			href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
			rel="stylesheet"
		/>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link href="assets/css/all.min.css" rel="stylesheet" />
		<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<style>
			body {
				font-family: "Poppins", sans-serif;
				background-color: #ffffff;
				color: #000000;
			}
			.navbar {
				padding: 1rem 2rem;
				background-color: #ffffff;
			}
			.navbar-brand {
				font-weight: bold;
				font-size: 2rem; /* Adjust the font size as needed */
			}
			.navbar-nav .nav-link {
				margin-right: 1rem;
			}
			.hero-section {
				text-align: left;
				padding: 2rem 1rem;
			}
			.hero-section img {
				max-width: 100%;
				height: auto;
			}
			.btn-primary {
				background-color: #000000;
				border: none;
				padding: 0.75rem 1.5rem;
				font-size: 1rem;
			}
			.card {
				border-radius: 15px;
				margin-bottom: 1rem;
			}
			.faq-section .card {
				border: none;
				margin-bottom: 1rem;
			}
			.faq-section .card-header {
				background-color: #f8f9fa;
			}
			.faq-section .card-body {
				background-color: #d4ff7f;
			}
			.footer {
				background-color: #000000;
				color: #ffffff;
				padding: 1rem 1rem;
				text-align: center;
			}
			.footer a {
				color: #ffffff;
			}
			.footer .form-control {
				border-radius: 15px;
			}
			.footer .btn {
				background-color: #d4ff7f;
				border: none;
				border-radius: 15px;
			}
			.footer p {
				margin-bottom: 0.5rem;
			}
			.btn-outline-dark {
				border: 1px solid #000000;
			}
			.review-card {
				display: flex;
				align-items: flex-start;
				padding: 1rem;
			}
			.review-card img {
				margin-right: 1rem;
				width: 60px;
				height: 60px;
			}
			.review-card .card-body {
				display: flex;
				align-items: flex-start;
				justify-content: flex-start;
			}
			.review-card .card-title {
				margin-bottom: 0.5rem;
			}
			.review-card .review-text {
				margin-top: 1rem;
			}
			.accordion {
				margin-bottom: 1rem;
			}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light">
			<a class="navbar-brand" href="#"> SILAPOR </a>
			<div class="collapse navbar-collapse">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item">
						<a class="nav-link" href="#"> Cek Status </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#review"> Testimonial </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#faqAccordion1"> FAQ </a>
					</li>
					<li class="nav-item dropdown">
						<div class="dropdown">
 							<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
    							<?php echo $_SESSION['username']; ?>
    						</button>
    						<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
    							<li><a class="nav-link logout" href="logout.php">Logout</a></li>
    						</ul>
						</div>
					</li>
				</ul>
			</div>
		</nav>
		<section class="hero-section container d-flex align-items-center">
			<div class="col-md-6">
				<h1>Pengaduan Masyarakat</h1>
				<p>
					Laporkan segala bentuk masalah yang mengganggu kegiatan
					dijalankan seluruh Indonesia
				</p>
				<button class="btn btn-primary">Laporkan Sekarang!</button>
			</div>
			<div class="col-md-6 text-end">
				<img
					alt="Illustration of a megaphone with social media icons"
					height="400"
					src="https://storage.googleapis.com/a1aa/image/aOUU7fJi60zKOqiF2muvHDHJT4vrGkNAkhSUz61gPxsocf7TA.jpg"
					width="600"
				/>
			</div>
		</section>
		<section class="container my-5" id="review">
			<div class="row">
				<div class="col-md-4">
					<div class="card review-card">
						<div class="card-body">
							<img
								alt="Profile picture of Athaya"
								class="rounded-circle"
								src="https://storage.googleapis.com/a1aa/image/yxQL2t2iYQIiEtPf9Rj6REOfUneI1i44NUyTo1p4Ettgy93nA.jpg"
							/>
							<div>
								<h5 class="card-title">Athaya</h5>
								<p class="card-text">Pengguna SILAPOR</p>
							</div>
						</div>
						<div class="card-body">
							<div class="review-text">
								<p class="card-text">
									Terimakasih SILAPOR telah membantu saya
									melaporkan masalah di lingkungan saya.
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card review-card">
						<div class="card-body">
							<img
								alt="Profile picture of Athaya"
								class="rounded-circle"
								src="https://storage.googleapis.com/a1aa/image/yxQL2t2iYQIiEtPf9Rj6REOfUneI1i44NUyTo1p4Ettgy93nA.jpg"
							/>
							<div>
								<h5 class="card-title">Athaya</h5>
								<p class="card-text">Pengguna SILAPOR</p>
							</div>
						</div>
						<div class="card-body">
							<div class="review-text">
								<p class="card-text">
									Terimakasih SILAPOR telah membantu saya
									melaporkan masalah di lingkungan saya.
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card review-card">
						<div class="card-body">
							<img
								alt="Profile picture of Athaya"
								class="rounded-circle"
								src="https://storage.googleapis.com/a1aa/image/yxQL2t2iYQIiEtPf9Rj6REOfUneI1i44NUyTo1p4Ettgy93nA.jpg"
							/>
							<div>
								<h5 class="card-title">Athaya</h5>
								<p class="card-text">Pengguna SILAPOR</p>
							</div>
						</div>
						<div class="card-body">
							<div class="review-text">
								<p class="card-text">
									Terimakasih SILAPOR telah membantu saya
									melaporkan masalah di lingkungan saya.
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card review-card">
						<div class="card-body">
							<img
								alt="Profile picture of Athaya"
								class="rounded-circle"
								src="https://storage.googleapis.com/a1aa/image/yxQL2t2iYQIiEtPf9Rj6REOfUneI1i44NUyTo1p4Ettgy93nA.jpg"
							/>
							<div>
								<h5 class="card-title">Athaya</h5>
								<p class="card-text">Pengguna SILAPOR</p>
							</div>
						</div>
						<div class="card-body">
							<div class="review-text">
								<p class="card-text">
									Terimakasih SILAPOR telah membantu saya
									melaporkan masalah di lingkungan saya.
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card review-card">
						<div class="card-body">
							<img
								alt="Profile picture of Athaya"
								class="rounded-circle"
								src="https://storage.googleapis.com/a1aa/image/yxQL2t2iYQIiEtPf9Rj6REOfUneI1i44NUyTo1p4Ettgy93nA.jpg"
							/>
							<div>
								<h5 class="card-title">Athaya</h5>
								<p class="card-text">Pengguna SILAPOR</p>
							</div>
						</div>
						<div class="card-body">
							<div class="review-text">
								<p class="card-text">
									Terimakasih SILAPOR telah membantu saya
									melaporkan masalah di lingkungan saya.
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card review-card">
						<div class="card-body">
							<img
								alt="Profile picture of Athaya"
								class="rounded-circle"
								src="https://storage.googleapis.com/a1aa/image/yxQL2t2iYQIiEtPf9Rj6REOfUneI1i44NUyTo1p4Ettgy93nA.jpg"
							/>
							<div>
								<h5 class="card-title">Athaya</h5>
								<p class="card-text">Pengguna SILAPOR</p>
							</div>
						</div>
						<div class="card-body">
							<div class="review-text">
								<p class="card-text">
									Terimakasih SILAPOR telah membantu saya
									melaporkan masalah di lingkungan saya.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="faq-section container my-5">
			<div class="accordion mb-3" id="faqAccordion1">
				<div class="accordion-item">
					<h2 class="accordion-header" id="headingOne">
						<button
							aria-controls="collapseOne"
							aria-expanded="false"
							class="accordion-button collapsed"
							data-bs-target="#collapseOne"
							data-bs-toggle="collapse"
							type="button"
						>
							Apakah SILAPOR berbayar?
						</button>
					</h2>
					<div
						aria-labelledby="headingOne"
						class="accordion-collapse collapse"
						data-bs-parent="#faqAccordion1"
						id="collapseOne"
					>
						<div class="accordion-body">
							Tidak, SILAPOR bisa digunakan oleh siapapun secara
							gratis.
						</div>
					</div>
				</div>
			</div>
			<div class="accordion mb-3" id="faqAccordion2">
				<div class="accordion-item">
					<h2 class="accordion-header" id="headingTwo">
						<button
							aria-controls="collapseTwo"
							aria-expanded="false"
							class="accordion-button collapsed"
							data-bs-target="#collapseTwo"
							data-bs-toggle="collapse"
							type="button"
						>
							Semua orang boleh akses?
						</button>
					</h2>
					<div
						aria-labelledby="headingTwo"
						class="accordion-collapse collapse"
						data-bs-parent="#faqAccordion2"
						id="collapseTwo"
					>
						<div class="accordion-body">
							Ya, semua orang bisa mengakses SILAPOR.
						</div>
					</div>
				</div>
			</div>
			<div class="accordion mb-3" id="faqAccordion3">
				<div class="accordion-item">
					<h2 class="accordion-header" id="headingThree">
						<button
							aria-controls="collapseThree"
							aria-expanded="false"
							class="accordion-button collapsed"
							data-bs-target="#collapseThree"
							data-bs-toggle="collapse"
							type="button"
						>
							Contohnya apa sih?
						</button>
					</h2>
					<div
						aria-labelledby="headingThree"
						class="accordion-collapse collapse"
						data-bs-parent="#faqAccordion3"
						id="collapseThree"
					>
						<div class="accordion-body">
							Contohnya seperti pelanggaran lalu lintas,
							pencemaran lingkungan, dan lain-lain.
						</div>
					</div>
				</div>
			</div>
			<div class="accordion mb-3" id="faqAccordion4">
				<div class="accordion-item">
					<h2 class="accordion-header" id="headingFour">
						<button
							aria-controls="collapseFour"
							aria-expanded="false"
							class="accordion-button collapsed"
							data-bs-target="#collapseFour"
							data-bs-toggle="collapse"
							type="button"
						>
							Kalau sound horog boleh dilaporin ga?
						</button>
					</h2>
					<div
						aria-labelledby="headingFour"
						class="accordion-collapse collapse"
						data-bs-parent="#faqAccordion4"
						id="collapseFour"
					>
						<div class="accordion-body">
							Ya, suara bising yang mengganggu bisa dilaporkan.
						</div>
					</div>
				</div>
			</div>
			<div class="accordion mb-3" id="faqAccordion5">
				<div class="accordion-item">
					<h2 class="accordion-header" id="headingFive">
						<button
							aria-controls="collapseFive"
							aria-expanded="false"
							class="accordion-button collapsed"
							data-bs-target="#collapseFive"
							data-bs-toggle="collapse"
							type="button"
						>
							Siapa yang akan menangani?
						</button>
					</h2>
					<div
						aria-labelledby="headingFive"
						class="accordion-collapse collapse"
						data-bs-parent="#faqAccordion5"
						id="collapseFive"
					>
						<div class="accordion-body">
							Laporan akan ditangani oleh pihak berwenang terkait.
						</div>
					</div>
				</div>
			</div>
			<div class="accordion mb-3" id="faqAccordion6">
				<div class="accordion-item">
					<h2 class="accordion-header" id="headingSix">
						<button
							aria-controls="collapseSix"
							aria-expanded="false"
							class="accordion-button collapsed"
							data-bs-target="#collapseSix"
							data-bs-toggle="collapse"
							type="button"
						>
							Apakah ada info Polisi Zebra?
						</button>
					</h2>
					<div
						aria-labelledby="headingSix"
						class="accordion-collapse collapse"
						data-bs-parent="#faqAccordion6"
						id="collapseSix"
					>
						<div class="accordion-body">
							Ya, informasi mengenai operasi Polisi Zebra bisa
							ditemukan di SILAPOR.
						</div>
					</div>
				</div>
			</div>
		</section>
		<footer class="footer">
			<div class="container">
				<h5>SILAPOR</h5>
				<p>Contact Us</p>
				<p>Email: support@silapor.com</p>
				<p>Phone: +62 123 4567 890</p>
				<p>Address: Jl. Merdeka No. 123, Jakarta, Indonesia</p>
				<p class="mt-3">© 2023 SILAPOR. All rights reserved.</p>
			</div>
		</footer>
		

		<script></script>

	</body>
</html>
