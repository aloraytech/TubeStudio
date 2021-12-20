<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Mixed_;

class IPResolver
{
    private const DEFAULT_API_URL = 'http://ip-api.com/json/';
    private string $client_ip;
    private array  $result;
    private string $default_ip;
    private string $api_url = '';

    /**
     * @param Request $request
     * @param string $ip
     */
    public function __construct(Request $request,string $ip='')
    {
        $this->default_ip = $request->ip();
        $this->client_ip = $ip;
        $this->api_url = self::DEFAULT_API_URL;
    }

    /**
     * @param string $client_ip
     */
    public function setIP(string $client_ip)
    {
        $this->client_ip = $client_ip;
    }

    public function setApi(string $url = self::DEFAULT_API_URL)
    {
        $this->api_url = $url;
    }


    public function getInfo(bool $array=false)
    {
        if(empty($this->result))
        {
            $this->resolve();
        }
      //  return $this->formatter($this->result);
        return $this->getApiInfo();
    }

    public function getApiInfo(bool $array=false)
    {
        if(empty($this->result))
        {
            $this->resolve();
        }
        return $this->result;
    }

    public function getAuthInfo(bool $array=false)
    {
        $data = [
            'user' => Auth::user(),
            'logged' => Auth::check(),
            'guest' => Auth::guest(),
            'member'=> Auth::guard('member')->user(),

        ];

        dd($data);

    }





    /**
     * @return void|null
     */
    private function resolve()
    {
        // Setup Api Url
        $api= $this->api_url.$this->client_ip ?? $this->default_ip;
        $curl = curl_init($api);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        $this->result = json_decode($result,JSON_PRETTY_PRINT);
    }

    /**
     * @return string
     */
    public function getJson()
    {
        if(empty($this->result))
        {
           $this->resolve();
        }
        return $this->result;
    }

    /**
     * @return false|string
     */
    public function getObject()
    {
        if(empty($this->result))
        {
            $this->resolve();
        }
        return json_encode(json_decode($this->result,JSON_PRETTY_PRINT), JSON_FORCE_OBJECT);

    }

    /**
     * @return mixed
     */
    public function getArray()
    {
        if(empty($this->result))
        {
            $this->resolve();
        }
        return json_decode($this->result,JSON_PRETTY_PRINT);
    }




    private function formatter($result)
    {
        $data = [
              "ip" => $result->query ?? $result['query'],
              "status" => $result->status ?? $result['status'],
              "country" => $result->country ?? $result['country'],
              "countryCode" => $result->countryCode ?? $result['countryCode'],
              "regionName" => $result->regionName ?? $result['regionName'],
              "city" => $result->city ?? $result['city'],
              "zip" => $result->zip ?? $result['zip'],
              "timezone" => $result->timezone ?? $result['timezone'],
              "isp" => $result->isp ?? $result['isp'],
        ];

        return $data;
    }




}
