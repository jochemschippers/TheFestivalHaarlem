<?php

class EncryptionService
{
    private $cipher = "aes-128-gcm";
    private $key = "ePpBTdk4WrPjH/lgtTmv/WVajeLY6OFPebvAQ2Gcjjs=";
    public function encryptId($id)
    {
        $ivlen = openssl_cipher_iv_length($this->cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);

        $tag = '';
        $tagLength = 16;
        $encryptedId = openssl_encrypt($id, $this->cipher, $this->key, $options = 0, $iv, $tag, "", $tagLength);

        // Encode the IV (initialization vector), tag and encrypted data,
        // this is necessary for decrypting.
        $combined = $encryptedId . '::' . $iv . '::' . $tag;

        // URL-safe base64 encode, so the encrypted ID can be used in URLs.
        return strtr(base64_encode($combined), '+/', '-_');
    }

    public function decryptId($encryptedId)
    {
        $data = base64_decode(strtr($encryptedId, '-_', '+/'));

        $parts = explode('::', $data, 3);

        list($encryptedData, $iv, $tag) = $parts;

        $decryptedId = openssl_decrypt($encryptedData, $this->cipher, $this->key, $options = 0, $iv, $tag);

        $ids = explode('|', $decryptedId);

        list($userId, $personalProgramId) = $ids;

        return [
            'userId' => $userId,
            'personalProgramId' => $personalProgramId,
        ];
    }
}
