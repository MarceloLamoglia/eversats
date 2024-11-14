<?php
// Defina o e-mail para o qual as mensagens serão enviadas
$to = "marcelo.lamoglia@gmail.com"; // Substitua por seu endereço de e-mail

// Verifique se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    $mensagem = htmlspecialchars($_POST['mensagem']);

    // Defina o assunto do e-mail
    $subject = "Nova mensagem de contato de $nome";

    // Estruture o conteúdo do e-mail
    $email_content = "Nome: $nome\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Mensagem:\n$mensagem\n";

    // Defina os cabeçalhos do e-mail
    $headers = "From: $email";

    // Envie o e-mail
    if (mail($to, $subject, $email_content, $headers)) {
        // Redirecione para uma página de confirmação ou exiba uma mensagem
        echo "Mensagem enviada com sucesso! Entraremos em contato em breve.";
    } else {
        echo "Ocorreu um erro ao enviar a mensagem. Tente novamente mais tarde.";
    }
} else {
    echo "Método inválido.";
}
?>
