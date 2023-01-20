<html>

<head>
<title>Projeto Docker</title>
<style>
    table { width: 100%; }
    th { text-align: center; }
    td { text-align: center; }
	h1 { text-align: center; }
</style>

</head>
<body>

<?php
ini_set("display_errors", 1);
header('Content-Type: text/html; charset=utf-8');

echo 'Versão Atual do PHP: '. phpversion() .'<br>';

$servername = "mysql";
$username = "usr_docker";
$password = "Teste123";
$database = "bd_docker";

// Criar conexão
$link = new mysqli($servername, $username, $password, $database);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$host_name = gethostname();

$query = "INSERT INTO dados (id, nome, endereco, email, telefone, host)
 VALUES (null , 'Nome Completo', 'Endereço detalhado', 'pessoa@email.com', '(71) 12345-6789','$host_name')";

if ($link->query($query) === TRUE) {
  //echo "Novo registro criado com sucesso.<br>";
}
else if ($link->errno == "1146") {
	$query = "CREATE TABLE dados (
		id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
		nome VARCHAR(50) NOT NULL,
		endereco VARCHAR(100) NOT NULL,
		email VARCHAR(60) NOT NULL,
		telefone VARCHAR(15) NOT NULL,
		host VARCHAR(50)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	echo "Erro: " . $link->error . "<br>";
	if ($link->query($query) === TRUE) {
		echo "A tabela dados não existia, mas foi criada com sucesso.";
	}
}
else {
  echo "Erro: " . $link->error;
}
?>

<hr>
<table>
<thead>
<tr><th colspan="5" style="font-size: 28px;">Primeiro Projeto Docker</th></tr>
<tr>
	<th>Nome</th>
	<th>Endereço</th>
	<th>E-mail</th>
	<th>Telefone</th>
    <th>Host</th>
</tr>
</thead>
<tbody>
<?php
	$query = "SELECT * from dados ORDER BY id";
    $matrizDados = $link->query($query);
	while ($dados = $matrizDados->fetch_array()) {
		if ($dados['id'] == '50') {
			$query = 'TRUNCATE TABLE dados;';
			if ($link->query($query) === TRUE) {
				echo "<tr><td colspan='5'><b>Dados zerados na tabela dados</b></td></tr>";
			}
		} else {
echo "<tr>"
	."<td>".$dados['nome']."</td>"
	."<td>".$dados['endereco']."</td>"
	."<td>".$dados['email']."</td>"
	."<td>".$dados['telefone']."</td>"
    ."<td>".$dados['host']."</td>"
	."</tr>";
		}
	}
?>
</tbody>
</table>
</hr>

</body>
</html>