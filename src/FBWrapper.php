<?php

class FBWrapper {
	
	public static function parseSignedRequest($signedRequest, $secret) {
		list($encodedSig, $payload) = explode('.', $signedRequest, 2); 

 		 // decode the data
  		$sig = self::base64UrlDecode($encodedSig);
  		$data = json_decode(self::base64UrlDecode($payload), true);

  		// confirm the signature
  		$expectedSig = hash_hmac('sha256', $payload, $secret, $raw = true);
  		if ($sig !== $expectedSig) {
    		error_log('Bad Signed JSON signature!');
    		return null;
  		}

  		return $data;
	}

	public static function base64UrlDecode($input) {
  		return base64_decode(strtr($input, '-_', '+/'));
	}
}
