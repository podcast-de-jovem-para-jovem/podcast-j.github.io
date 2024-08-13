<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Verifica se os campos estão preenchidos
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Por favor, preencha todos os campos corretamente.";
        exit;
    }

    // Defina o endereço de e-mail de destino
    $recipient = "gustavomonteiro0610@gmail.com";
    $subject = "Nova mensagem de $name";

    // Construa o conteúdo do e-mail
    $email_content = "Nome: $name\n";
    $email_content = "Email: $email\n\n";
    $email_content .= "Mensagem:\n$message\n";

    // Defina os cabeçalhos do e-mail
    $email_headers = "From: $name <$email>";

    // Envie o e-mail
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Obrigado! Sua mensagem foi enviada.";
    } else {
        http_response_code(500);
        echo "Desculpe, algo deu errado e não conseguimos enviar sua mensagem.";
    }
} else {
    http_response_code(403);
    echo "Desculpe, este formulário não suporta esse método de solicitação.";
}
?>
