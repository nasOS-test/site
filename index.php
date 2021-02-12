<?php
session_start();

if($_POST['submit']){
	if($_POST['res'] == $_SESSION['res']){
		$to = 'mail@mail.ru';
		$subject = 'Письмо с сайта';
		$body = $_POST['text'];
		$headers = 'Content-type:text/plain; Charset=windows-1251';
		
		if(mail($to, $subject, $body, $headers)){
			$_SESSION['mes'] = '<p>Письмо отправлено!</p>';
			header("Location: index.php");
			exit();
		}else{
			$_SESSION['mes'] = '<p>Ошибка!</p>';
			header("Location: index.php");
			exit();
		}
	}else{
		$_SESSION['mes'] = '<p>Дан неверный ответ!</p>';
		header("Location: index.php");
		exit();
	}
}

$a = rand(1,10);
$b = rand(1,10);
$_SESSION['res'] = $a + $b;
?>

<form method="post" action="">
	<table>
		<tr>
			<td>Текст: </td><td><input type="text" name="text" /></td>
		</tr>
		<tr>
			<td><?php echo $a. ' + ' .$b. ' = ';?></td><td><input type="text" name="res" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="submit" value="Send" /></td>
		</tr>
	</table>
</form>

<?php
echo $_SESSION['mes'];
unset($_SESSION['mes']);
?>