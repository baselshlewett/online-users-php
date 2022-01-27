<?php
// helper functions to be used throughout the project, you can add yours here

if (!function_exists('dd')) {
    // simple dump and die
    function dd($arguments = []) {
        echo "***********<pre>";
        var_dump($arguments);
        echo "</pre>***********";
        die;
    }
}

if (!function_exists('response')) {
    // function to make returning json easier not to have repeated code in the project
    function json($data, $status = 204) {
        http_response_code($status);
        header('Content-Type: application/json');

        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}

if (!function_exists('error')) {
    // since this project will serve as API, we return json in the error function. can be modified in case we have views in this project in the future
    function error($status = 400, $message = "") {
        $data = [
            'status' => $status
        ];

        if (!empty($message)) {
            $data['message'] = $message;
        }

        http_response_code($status);

        die(json($data, 200));
    }
}