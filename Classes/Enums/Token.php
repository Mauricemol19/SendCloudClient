<?php
namespace SendCloudClient
{
    class Token
    {
        public string $access_token;
        public string $expires_in;
        public string $id_token;
        public string $refresh_token;
        public string $scope;
        public string $token_type;

        public function Setup($access_token, $expires_in,
                              $id_token, $refresh_token, $scope, $token_type) : Token
        {
            $this->access_token = $access_token;
            $this->expires_in = $expires_in;
            $this->id_token = $id_token;
            $this->refresh_token = $refresh_token;
            $this->scope = $scope;
            $this->token_type = $token_type;

            return $this;
        }
    }
}