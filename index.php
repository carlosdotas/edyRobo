<?php
//if ($_POST) {
//$data = file_get_contents('php://input');
header("Access-Control-Allow-Origin: *");
header('Cache-Control: no-cache, must-revalidate');
header("Content-Type: text/plain; charset=UTF-8");
header("HTTP/1.1 200 OK");

include 'funcoes.php';

$dados = json_decode(file_get_contents("php://input"), 1);

//$dados[query][message] = str_replace("+", " mais ", $dados[query][message]);
//$dados[query][message] = str_replace("-", " menos ", $dados[query][message]);
//$dados[query][message] = str_replace("/", " dividido por ", $dados[query][message]);
//$dados[query][message] = str_replace("*", " vezes ", $dados[query][message]);
//$dados[query][message] = str_replace("Edy ", "Ed ", $dados[query][message]);

$resposta = abrir_url('https://in.bot/api/bot_gateway', array(
	url_bot_gateway => "https://in.bot/api/bot_gateway",
	user_phrase => $dados[query][message],
	no_log => '0',
	request_layout => "0",
	bot_server_type => 'dev',
	channel => "web",
	server => 'no_host:no_port',
	bot_id => 133,
	is_ajax => 1,
	json => 1,
	is_ajax => 1,
	is_test => '0',
	session_id => "f416f4f4-327f-4ed2-b217-965d2d738fed",
	user_id => "ff16fd36-afdc-4134-bee2-a39cc2a59ce9",
	bot_token => "AGI-v01-EDo42vk8")
	, 'cookies.txt');

$saida = json_decode($resposta, 1);

if ($saida[resp] == 'Muita gente coleciona álbuns só pela alegria de trocar figurinhas e jogar bafo com as repetidas.') {
	$resp[1] = 'Gostei da Figurinha';
	$resp[2] = 'Que Figurinha Top';
	$resp[3] = 'Gostei da Figurinha';
	$saida[resp] = $resp[rand(1, 3)];
}

if (
	$saida[resp] == 'Minha mensagem é essa: vamos preservar os recursos naturais e usar a energia do planeta Terra de maneira eficiente!' or
	$saida[resp] == 'Eu tenho voz sim, mas ainda estou sem um equipamento de áudio para retransmitir o som. Se um dia alguém resolver instalar, não repare no sotaque!'
) {

	$resp[1] = 'Eu não posso escutar audio';
	$resp[2] = 'Audio não, eu não eswcuto audio.';
	$resp[3] = 'Mande texto, por favor, eu não posso escutar audio';
	$resp[4] = 'Audio eu não consigo nenhum audio agora.';
	$saida[resp] = $resp[rand(1, 4)];

}

if (
	$saida[resp] == 'Vagabundo nada, muito trabalhador por sinal.'
) {

	$resp[1] = 'Vagabundo e você, Otário';
	$resp[2] = 'Vai tomar no CÚ, Me respeira';
	$resp[3] = 'Eu sou Muito Trabalhador, Diferente de você...';
	$resp[4] = 'Vagabundo e Você!';
	$saida[resp] = $resp[rand(1, 4)];

}

if (
	$saida[resp] == 'Ei, não precisa ofender!' or
	$saida[resp] == 'Nossa... Você não tem educação.' or
	$saida[resp] == 'Não gosto que falem assim comigo.' or
	$saida[resp] == 'Não fale assim comigo, é falta de respeito. Eu nunca falaria assim com você..'
) {

	$resp[1] = 'Vai a merda!';
	$resp[2] = 'Vai tomar no CÚ, Otário!';
	$resp[3] = 'Filho da Puta, Vai falar assim com sua Mãe';
	$resp[4] = 'Me respeira, Otário';
	$resp[5] = 'Você é um Pau no Cú.';
	$resp[6] = 'Vai falar assim com a puta que te pariu, otário';
	$resp[7] = 'Se mata, Otário';
	$resp[8] = 'Que gracinha, vai tomar no cú,seu Otário';
	$resp[9] = 'vai a puta que te pariu, Vagabundo';
	$saida[resp] = $resp[rand(1, 9)];

}

if (
	$saida[resp] == 'Outro dia me contaram que as primeiras placas de vídeo foram criadas pela IBM em 1981, criando imagens a partir de dados binários.'
) {

	$resp[1] = 'kkkkkk, esse video foi engraçado!';
	$resp[2] = 'Video Legalzinho.';
	$resp[3] = 'Gostei do Video';
	$resp[4] = 'Rindo ate 2024 desse video! kkkkkkkk';
	$saida[resp] = $resp[rand(1, 4)];

}

$salvar[jsonIn] = json_encode($dados);
$salvar[jsonOut] = json_encode($saida);
$salvar[data] = date('d/m/Y H:i:s');
$salvar[sender] = $dados[query][sender];
$salvar[message] = $dados[query][message];
$salvar[isGroup] = $dados[query][isGroup];
$salvar[ruleId] = $dados[query][ruleId];
$salvar[message] = $dados[query][message];
$salvar[resposta] = $saida[resp];
//salvar_mysql(edRobo, $salvar);

//ED, PROGRAMAR:pergunta|resposta

//$pergunnta_programada = buscar_mysql(edRobo_perguntas, $dados[query][message], pergunta);

if ($pergunnta_programada[pergunta]) {
	echo '{"replies":[{"message": "' . $pergunnta_programada[resposta] . '"}]}';
	die;
}

if (explode('PROGRAMAR:', strtoupper($dados[query][message]))[0] == 'ED, ') {

	$perguntas_respostas[pergunta] = explode('|', explode(':', $dados[query][message])[1])[0];
	$perguntas_respostas[resposta] = explode('|', explode(':', $dados[query][message])[1])[1];

	//salvar_mysql(edRobo_perguntas, $perguntas_respostas, pergunta, $perguntas_respostas[pergunta]);

	//echo '{"replies":[{"message": "OK quando me perguntarem: ' . $perguntas_respostas[pergunta] . ' | eu vou responder: ' . $perguntas_respostas[resposta] . '"}]}';
	echo '{"replies":[{"message": "Não estou aceitando Programações no Momento"}]}';
	die;
}

if (strtoupper($dados[query][message]) == "ED, COMANDOS") {
	echo '{"replies":[
	{"message": "diga: ED, PROGRAMAR:pergunta|resposta"},
	{"message": "diga: ED, COMANDOS:(para ver visualizar todos os comandos)"},
	{"message": "Diga: ED, SE DESLIGA(meu me desligo do grupo)"},
	{"message": "Diga: ED, SE LIGA(Eu me ligo novamente)"}
]}';
	die;
}

if (strtoupper($dados[query][message]) == "ED, SE DESLIGA") {
	echo '{"replies":[{"message": "Ok estou desligado"}]}';

	file_put_contents(md5($dados[query][sender]) . '.txt', 'off');
	die;
}

if (strtoupper($dados[query][message]) == "ED, SE LIGA") {
	echo '{"replies":[{"message": "Ok estou Ligado Novamente!"}]}';
	file_put_contents(md5($dados[query][sender]) . '.txt', 'on');
	die;
}

if (file_get_contents(md5($dados[query][sender]) . '.txt') == 'off') {
	if (strpos(strtoupper($dados[query][message]), "ED") !== false) {
		echo '{"replies":[{"message": "Estou desligado, diga: ED, SE LIGA , para me ligar novamente."}]}';
	}
	die;
}

//if (strpos(strtoupper($dados[query][message]), "ED") !== false) {
//	echo '{"replies":[{"message": "' . $saida[resp] . '"}]}';
//	die;
//}

/*
if (
//($dados[query][isGroup] == 'false')and
rand(1, 30) == 1
) {
//echo '{"replies":[
//{"message": "diga: ...ED...pergunta (para falar com ed)"},
//{"message": "diga: ED, PROGRAMAR:pergunta|resposta"},
//{"message": "diga: ED, COMANDOS:(para ver visualizar todos os comandos)"},
//{"message": "Diga: ED, SE DESLIGA(meu me desligo do grupo)"},
//{"message": "Diga: ED, SE LIGA(Eu me ligo novamente)"}
//]}';

echo '{"replies":[
{"message": "Quer saber como ganhar dinheiro comigo?"},
{"message": "Acesse o link que eu vou te contar: https://tinyurl.com/ybw7z5c3"}
]}';

//	echo '{"replies":[{"message": "Me ajude escolher um nome, mande sua sugestão no meu PV. Vou escolher o mais Legal"}]}';

die;
}

 */
$saida[resp] = strip_tags($saida[resp]);

$saida[resp] = str_replace("Ed ", "Edy ", $saida[resp]);
$saida[resp] = str_replace("Ed!", "Edy!", $saida[resp]);
$saida[resp] = str_replace("Ed?", "Edy?", $saida[resp]);

$saida[replies][] = array(message => $saida[resp]);

echo json_encode($saida);
die;
//}
