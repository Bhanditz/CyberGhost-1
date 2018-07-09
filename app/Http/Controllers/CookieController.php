<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class CookieController extends Controller {

    public function setCookie() {
        setcookie("cookie[source]", "website", time() + (86400 * 30), '/');
        setcookie("cookie[campaign]", "test", time() + (86400 * 30), '/');
        setcookie("cookie[voucher]", "empty value", time() + (86400 * 30), '/');
    }

    public function getCookie() {
        if (isset($_COOKIE['cookie'])) {
            foreach ($_COOKIE['cookie'] as $name => $value) {
                $name = htmlspecialchars($name);
                $value = htmlspecialchars($value);
                echo "$name : $value <br />\n";
            }
        }
    }

    public function setSpecificCookie($cookieName, $cookieValue) {
        switch ($cookieName) {
            case 'source' :
                echo("Case Source");
                setcookie("cookie[$cookieName]", "$cookieValue");
                break;

            case "campaign" :
                echo("Case campaign");
                setcookie("cookie[$cookieName]", "$cookieValue");
                break;

            case "voucher" :
                echo("Case voucher");
                setcookie("cookie[$cookieName]", "$cookieValue", time() + (86400 * 30), '/');
                break;

            default :
                dd("No cookie named " . $cookieName . " is present!");
                break;
        }
    }

}
