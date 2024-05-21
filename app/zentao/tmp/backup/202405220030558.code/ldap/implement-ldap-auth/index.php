<?php

require_once __DIR__ . '/config/ldap_config.php';
require_once __DIR__ . '/module/ldap.class.php';
require_once __DIR__ . '/api/controller/get_token.php';
require_once __DIR__ . '/api/controller/get_user.php';

function login_zentao($username, $password) {
    $response = new stdClass();

    $ldapServer = ldapServer;
    $ldapAuthenticator = new LDAP();

    if ($ldapAuthenticator->ldapConnect($ldapServer)) {
        $response->status = true;
        $response->message = "LDAP connection established.";

        if ($ldapAuthenticator->ldapAuthenticate($username, $password)) {
            $response->status = true;
            $response->message = "LDAP authentication successful.";
        } else {
            $response->status = false;
            $response->message = "LDAP authentication failed.";
        }
    } else {
        $response->status = false;
        $response->message = "Failed to connect to LDAP server.";
    }

    return $response;
}

?>
