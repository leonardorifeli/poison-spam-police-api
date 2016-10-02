<?php

namespace CoreBundle\Business\Service;

use CoreBundle\Business\Enum\ClientEnum;

class ClientService {

    private $googleClient;

    public function getGoogleClient()
    {
        if(!is_null($this->googleClient)) return $this->googleClient;

        $this->googleClient = new \Google_Client();
        $this->googleClient->setApplicationName(ClientEnum::APPLICATION_NAME);
        $this->googleClient->setScopes(implode(' ', array(
                \Google_Service_Gmail::GMAIL_READONLY)
        ));
        $this->googleClient->setAuthConfig(ClientEnum::CLIENT_SECRET_PATH);
        $this->googleClient->setAccessType('offline');

        return $this->googleClient;
    }

    public function get(string $accessToken)
    {
        if(!$accessToken) throw new \Exception("Access token invalid.", 401);

        $this->getGoogleClient()->setAccessToken($accessToken);

        return $this->getGoogleClient();
    }

}
