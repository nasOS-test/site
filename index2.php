<?php
session_start();

if($_POST['submit']){
	if(strtolower(trim($_POST['res'])) == $_SESSION['res']){
		$to = 'mail@mail.ru';
		$subject = '������ � �����';
		$body = $_POST['text'];
		$headers = 'Content-type:text/plain; Charset=windows-1251';
		
		if(mail($to, $subject, $body, $headers)){
			$_SESSION['mes'] = '<p>������ ����������!</p>';
			header("Location: index2.php");
			exit();
		}else{
			$_SESSION['mes'] = '<p>������!</p>';
			header("Location: index2.php");
			exit();
		}
	}else{
		$_SESSION['mes'] = '<p>��� �������� �����!</p>';
		header("Location: index2.php");
		exit();
	}
}

$question = array(array(0 => '�������� ����� �������',
						1 => '�����'),
				  array(0 => '���� ������',
						1 => '���'),
				  array(0 => '���� �...',
						1 => '���'));

$key = rand(0,count($question)-1); // ����
$_SESSION['res'] = $question[$key][1]; // �����
?>

<form method="post" action="">
	<table>
		<tr>
			<td>�����: </td><td><input type="text" name="text" /></td>
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