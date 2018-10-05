<?php
// $servername = "localhost";
// $username = "username";
// $password = "password";
// $dbname = "myDB";

// Create connection
$conn = new mysqli("localhost", "root", "", "d_modul5");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
<form method="post" action="">
<input type="text" name="nama" placeholder="Nama">
<br>
<input type="text" name="nim" placeholder="NIM">
<br>
<input type="text" name="email" placeholder="email">
<br>
<input type="submit" name="submit" value="Submit">
</form>
<?php
if (isset($_POST['submit'])) {

$nama = $_POST['nama'];
$nim = $_POST['nim'];
$email = $_POST['email'];

if (strlen($nama)>=20) {
	echo "<br>";
	$nama_err = "f";
	echo "Nama Maksimal 20 Karakter";
}else{
	$nama_err = "t";
}
if (is_numeric($nama)) {
	echo "<br>";
	$nama2_err = "f";
	echo "Nama tidak boleh ada ANGKA !";
}else{
	$nama2_err = "t";
}

if (!is_numeric($nim)) {
	echo "<br>";
	$nim_err = "f";
	echo "NIM Harus Angka";
}else{
	$nim_err = "t";
}

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	echo "<br>";
	$email_err = "t";
  echo("$email is a valid email address");
} else {
	$email_err = "f";
	echo "<br>";
  echo("$email is not a valid email address");
}


if ($nama_err == "t" && $nim_err == "t" && $email_err == "t" && $nama2_err == "t") {
	session_start();
	$_SESSION['namanya'] = $nama;
	$_SESSION['nimnya'] = $nim;
	$sql = "INSERT INTO t_jurnal1 (nama, nim, email)
VALUES ('$nama', '$nim', '$email')";



if ($conn->query($sql) === TRUE) {
	echo "<br>";
    echo "New record created successfully";
    header("Location: next.php");
} else {
	echo "<br>";
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}else{
	echo "<br>";
	echo "GAGAL";
}


$conn->close();
}
?>