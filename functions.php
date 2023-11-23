<?php
// Include any necessary functions
function sanitize_folder($folder) {
    // Implement appropriate sanitization for the folder input
    // For example, you might want to ensure that only valid folder names are processed
    return filter_var($folder, FILTER_SANITIZE_STRING);
}

function xor_encrypt($data, $key) {
    $keyLength = strlen($key);
    $encrypted = '';

    for ($i = 0; $i < strlen($data); $i++) {
        $encrypted .= $data[$i] ^ $key[$i % $keyLength];
    }

    return $encrypted;
}

function xor_decrypt($data, $key) {
    return xor_encrypt($data, $key);
}
?>
