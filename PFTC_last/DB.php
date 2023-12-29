
<?php
$connection_string = "host=localhost port=5432 dbname=Base user=postgres password=1";
$db_connection = pg_connect($connection_string);

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$reppassword = $_POST['reppassword'];

$povtor = pg_query($db_connection,"SELECT count(*) AS rows FROM users WHERE email = '$email'");

if($password != $reppassword)
{
  echo '<script>alert("пароли не совпадают.")</script>';
  echo '<script>window.location.href = "registration.html"</script>';
}
else
{

if (strpos($email, '@') === false) 

{
  echo '<script>alert("Введите корректную почту.")</script>';
  echo '<script>window.location.href = "registration.html"</script>';
}
 else 
{

if  (!$povtor) 
{
  echo "query did not execute";
}
$result = pg_fetch_assoc($povtor);

if ($result['rows']==0)
{ 
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  $query = pg_query($db_connection,"INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')");

  //$povtor = pg_query($db_connection,"SELECT count(*) AS rows FROM users WHERE email = '$email'");
  header("Location: /PFTC_LAST/personal area.html");
  // header("Location: https://example.com");
}

else 
{
  echo '<script>alert("ошибка регистрации.")</script>';
  echo '<script>window.location.href = "registration.html"</script>';
  // header("Location: /PFTC_/registration.html");
}
}
}
//$povtor = "SELECT * FROM users WHERE email = '$email' "
//if ($povtor -> num_rows > 0)
//{ echo "Пользователь с данной почтой уже существует";}
//else 
//{ $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')"; }
//$stmt = pg_query($db_connection,$query);
// $stmt = pg_query($db_connection,$query);
// $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
// if ("SELECT COUNT(*) FROM users WHERE $name='name' ") 
// {
//   print("error");
// }
// $query3 = "UPDATE users SET $password = 'password' WHERE $name = 'name'";
// $stmt = pg_query($db_connection,$query);
// $query = "INSERT INTO users VALUES (?, ?, ?)";
// $stmt = $db_connection->prepare($query);
// $stmt = pg_prepare( $db_connection,"$query");
// $stmt->bind_param("sss", $name, $email, $password);
// $stmt->execute();
// $stmt->close();
//$stmt = pg_query($db_connection,$query);