<?php
session_start();

if($_POST['submit']){
	if(strtolower(trim($_POST['res'])) == $_SESSION['res']){
		$to = 'mail@mail.ru';
		$subject = 'Письмо с сайта';
		$body = $_POST['text'];
		$headers = 'Content-type:text/plain; Charset=windows-1251';
		
		if(mail($to, $subject, $body, $headers)){
			$_SESSION['mes'] = '<p>Письмо отправлено!</p>';
			header("Location: index2.php");
			exit();
		}else{
			$_SESSION['mes'] = '<p>Ошибка!</p>';
			header("Location: index2.php");
			exit();
		}
	}else{
		$_SESSION['mes'] = '<p>Дан неверный ответ!</p>';
		header("Location: index2.php");
		exit();
	}
}

$question = array(array(0 => 'Название нашей планеты',
						1 => 'земля'),
				  array(0 => 'Царь зверей',
						1 => 'лев'),
				  array(0 => 'Адам и...',
						1 => 'ева'));

$key = rand(0,count($question)-1); // ключ
$_SESSION['res'] = $question[$key][1]; // ответ
?>

<form method="post" action="">
	<table>
		<tr>
			<td>Текст: </td><td><input type="text" name="text" /></td>
		</tr>
		<tr>
			<td><?php echo $question[$key][0];?></td><td><input type="text" name="res" /></td>
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