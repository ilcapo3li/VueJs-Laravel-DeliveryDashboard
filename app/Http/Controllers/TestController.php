<?php

namespace App\Http\Controllers;

use App\ServerType;
use Illuminate\Http\Request;
use App\WowzaSecureToken;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function wowza()
    {
        $wowza_serverip = "load.live-plus.tv"; // your ip/host
        $wowzatoken = '&liveplus';
        $validity1 = 0; // validity in secondsc

        $wowzastart =  strtotime(date('d-m-Y H:i')) + $validity1;
        $validity2 = 1800; // validity in seconds
        $wowzaend = strtotime(date('d-m-Y H:i')) + $validity2;
        $secret = "9969077a27ee2951"; // your secret
        $stream_name = "redirect/Beinx1/bx1_160p/";// your stream myStream is default steaming

        $extintion = "?scheme=m3u8";

        $hashstr = hash('sha256', $stream_name.'?'.$secret.$wowzatoken.'endtime='.$wowzaend.$wowzatoken.'starttime='.$wowzastart.'', true);
        $usableHash = strtr(base64_encode($hashstr), '+/', '-_');

        $url = "rtmp://".$wowza_serverip.":1935/".$stream_name.$wowzatoken."endtime=".$wowzaend.$wowzatoken
        ."starttime=".$wowzastart.$wowzatoken."hash=".$usableHash."";
        //RTMP protocol usable for flash player and android

        $iurl = "rtmp://".$wowza_serverip.":1935/".$stream_name.$extintion.$wowzatoken."endtime=".$wowzaend.$wowzatoken
        ."starttime=".$wowzastart.$wowzatoken."hash=".$usableHash."";
        //HLS protocol for Iphone

        return response()->json(['wowza_android'=>$url,'wowza_iphone'=>$iurl,'status'=>'true']);
    }
    public function getSecureUrlAttribute(Request $request)
    {
        $server_type = ServerType::find($request->id);
        $url = $server_type->name;
        $url .= ':';
        $url .= $server_type->port;
        $url .= '/';
        $url .= $request->channel;
        $url .= '/';
        $url .= $server_type->extintion;
        return  $this->makeSecureUrl(
            '213.165.45.100',
                    // $server_type->ip,
                    $server_type->wow_prefix,
            $server_type->password,
            $url,
            $server_type->hash
        ) ;
    }
    
    
    /**
     * @param $ip
     * @param $wowzaprefix
     * @param $mySharedSecret
     * @param $url
     * @param $method
     * @return string
     * @throws \remiheensWowzaSecureTokenWowzaException
     */
    private function makeSecureUrl($ip, $wowzaprefix, $mySharedSecret, $url, $method)
    {
        // dd($ip);
        $wowzaToken = new WowzaSecureToken($wowzaprefix, $mySharedSecret);
        $wowzaToken->setClientIP($ip);
        $wowzaToken->setURL($url);
        if ($method=='sha384') {
            $wowzaToken->setHashMethod(WowzaSecureToken::SHA384);
        } elseif ($method=='sha512') {
            $wowzaToken->setHashMethod(WowzaSecureToken::SHA512);
        } else {
            $wowzaToken->setHashMethod(WowzaSecureToken::SHA256);
        }
        $starttime = time();
        $endtime = strtotime('+24 HOUR');
        $params = array(
                'endtime' => $endtime,
                'starttime' => $starttime
            );
        $wowzaToken->setExtraParams($params);
        return $wowzaToken->getFullURL();
    }
}
