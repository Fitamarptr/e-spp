<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'connect.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];


// menyeleksi data petugas dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"select * from user where username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){

	$data = mysqli_fetch_assoc($login);

	// cek jika user login sebagai admin
	if($data['role']=="admin"){

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['role'] = "admin";
		// alihkan ke halaman dashboard admin
		header("location:View/dashboard.php");

	// cek jika user login sebagai petugas
	}else if($data['role']=="staff"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['role'] = "staff";
		// alihkan ke halaman dashboard petugas
		header("location:View/dashboard.php");

		// cek jika user login sebagai siswa
	}else if($data['role']=="siswa"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['role'] = "siswa";
		// alihkan ke halaman dashboard siswa
		header("location:View/pembayaranSiswa.php");

	}else{

		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
	}

	
}else{
	header("location:index.php?pesan=gagal");
}



?>