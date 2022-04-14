<?php

// Here we register our "find_user_by_cpf" function to handle our AJAX request, do you remember the "superhypermega" hidden field? Yes, this is what it refers, the "send_form" action.
add_action('wp_ajax_find_user_by_cpf', 'find_user_by_cpf'); // This is for authenticated users
add_action('wp_ajax_nopriv_find_user_by_cpf', 'login'); // This is for unauthenticated users.
 
/**
 * In this function we will handle the form inputs and send our email.
 *
 * @return void
 */
function find_user_by_cpf() {
 
    // This is a secure process to validate if this request comes from a valid source.
    check_ajax_referer( 'secure-nonce-name', 'security' );

    header('Content-Type: application/json');
    
    $cpf = $_POST["cpf"];

    if ( empty( $cpf ) ) {
        $response = [
            "success" => false,
            "message" => "Informe o CPF seu canalha"
        ];

        echo json_encode($response);

        wp_die();
    }

    // busca usuário por cpf no banco
    // $response = buscarNoBanco($cpf);
    $bancoDeDados = [
        '1' => [
            'nome' => 'Fernando',
            'cpf' => '123.456.789-01',
            'cupons' => 9,
        ],
        '2' => [
            'nome' => 'Dahan',
            'cpf' => '123.456.789-02',
            'cupons' => 9,
        ],
    ];

    $foundUser = array_filter($bancoDeDados, function ($user) use ($cpf) {
        return $user['cpf'] == $cpf;
    });

    if (sizeof($foundUser) == 1)
        $response = [
            "success" => true,
            "user" => $foundUser
        ];
    else
        $response = [
            "success" => false,
            "message" => "CPF errado seu trouxa"
        ];

    echo $response;
    wp_die();
}

function login() {
    header('Location: ' . admin_url())
    wp_die();
}