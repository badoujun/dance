<?php
namespace App\Common;

use \Lcobucci\JWT\Builder as Builder;
use \Lcobucci\JWT\Signer\Hmac\Sha256 as Sha256;
use \Lcobucci\JWT\Signer\Key as Key;
use \Lcobucci\JWT\Parser as Parser;
use \Lcobucci\JWT\ValidationData as ValidationData;

class Token{

    public static function getToken($userId) {
        $builder = new Builder();
        $signer = new Sha256();
        $time = time();
        $token = $builder->issuedBy('http://dance.com') // Configures the issuer (iss claim)
        ->permittedFor('http://dance.org') // Configures the audience (aud claim)
        ->identifiedBy('001126', true) // Configures the id (jti claim), replicating as a header item
        ->issuedAt($time) // Configures the time that the token was issue (iat claim)
        ->withClaim('userId', $userId) // Configures a new claim, called "uid"
        ->getToken($signer, new Key('testing')); // Retrieves the generated token

        return (string)$token;
    }

    public static function checkToken($token) {
        $signer = new Sha256();
        $Parser = new Parser();
        $token = $Parser->parse((string) $token);

        $data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)
        $data->setIssuer('http://dance.com');
        $data->setAudience('http://dance.org');
        $data->setId('001126');

        if($token->validate($data) && $token->verify($signer, 'testing')){
            return $token->getClaim('userId');
        }else{
            throw new ResultException('签名已过期', 3);
        }
    }
}
