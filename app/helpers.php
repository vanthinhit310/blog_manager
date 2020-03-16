<?php
if (!function_exists('activeMenu')) {

    function activeMenu($route, $class = 'active')
    {
        if ($route == url()->current()) {
            return $class;
        } else {
            return '';
        }
    }

}

if (!function_exists('getLongLivedAccessTokenCURL')) {

    function getLongLivedAccessTokenCURL($accessToken)
    {
        $clientId = '735782230232735';
        $clientSecret = '4f67a85b4629ffdc8ec2905db5cee316';
        $result = (function ($method, $url, $datas) {
            $curl = curl_init();
            switch ($method) :
                case 'POST':
                    curl_setopt($curl, CURLOPT_POST, 1);
                    if ($datas) :
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $datas);
                    endif;

                    break;
                case 'PUT':
                    curl_setopt($curl, CURLOPT_PUT, 1);
                    break;
                default:
                    if ($datas) :
                        $url = sprintf('%s?%s', $url, http_build_query($datas));
                    endif;

            endswitch;
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($curl);
            curl_close($curl);

            return $result;
        })('GET', 'https://graph.facebook.com/oauth/access_token?client_id=' . $clientId . '&client_secret=' . $clientSecret . '&grant_type=fb_exchange_token&fb_exchange_token=' . $accessToken, []);

        return $resultDecode = json_decode($result, true);
    }
}

if (!function_exists('exists_and_blank')) {

    function exists_and_blank($data)
    {
        if (isset($data) && !blank($data)) {
            return true;
        }
        return false;
    }

}
