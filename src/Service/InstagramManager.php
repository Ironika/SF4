<?php

namespace App\Service;

class InstagramManager
{
	private $session;

	public function __construct($session)
	{
		$this->session = $session;
	}

    public function getAccessToken($url, $code) {
        $datas = array(
            'client_id' => '16bef087e682469b9c722021d002f994' , 
            'client_secret' => '02e42996bef948ae883c09529fbdc6e0', 
            'grant_type' => 'authorization_code', 
            'code' => $code ,
            'redirect_uri' => $url
        );

        $callAccessToken = $this->request_curl('https://api.instagram.com/oauth/access_token', $datas, true, false);
        $token = get_object_vars($callAccessToken)['access_token'];
        $this->session->set('instagram_token', $token);
    }

    public function getMedias() {
        $medias = $this->request_curl('https://api.instagram.com/v1/users/self/media/recent/?access_token=' . $this->session->get('instagram_token'), null, null, null);

        $instagramMedias = [];
        for($i = 0; $i < 12; $i++) {
            $instagramMedias[] = get_object_vars(get_object_vars(get_object_vars(get_object_vars($medias)['data'][$i])['images'])['standard_resolution'])['url'];
        }

        return $instagramMedias;
    }

    public function request_curl($url, $data, $post, $auth) {
        $ch = curl_init($url);
        if ($auth) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $auth));
        } else {
            curl_setopt($ch, CURLOPT_HEADER, false);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, $post);
        if ($post) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        } else {
            curl_setopt($ch, CURLOPT_URL, $url);
        }
        $contents = curl_exec($ch);
        curl_close($ch);

        return json_decode($contents);
    }
}