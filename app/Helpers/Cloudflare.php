<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use okw\CF\CF;

class Cloudflare
{
    private $cloudflare;

    public function __construct()
    {
        $this->cloudflare = new CF(env('CLOUDFLARE_EMAIL'), env('CLOUDFLARE_API'));
    }

    public function createARecord($name, $ip)
    {
        $response = $this->cloudflare->rec_new([
            'z'         => env('CLOUDFLARE_DOMAIN'),
            'name'      => $name,
            'ttl'       => 1,
            'type'      => 'A',
            'content'   => $ip
        ]);

        return $response;
    }

    public function createSrvRecord($name, $ip, $port)
    {
        $response = $this->cloudflare->rec_new([
            'z'         => env('CLOUDFLARE_DOMAIN'),
            'name'      => $name,
            'ttl'       => 1,
            'type'      => 'SRV',
            'content'   => $ip,
            'service'   => '_minecraft',
            'srvname'   => $name,
            'protocol'  => '_tcp',
            'weight'    => 1,
            'prio'      => 1,
            'port'      => $port,
            'target'    => $name . '.' . env('CLOUDFLARE_DOMAIN')
        ]);

        return $response;
    }

    public function deleteARecord($id)
    {
        $response = $this->cloudflare->rec_delete([
            'z'         => env('CLOUDFLARE_DOMAIN'),
            'id'        => $id
        ]);

        return $response;
    }

    public function deleteSrvRecord($id)
    {
        $response = $this->cloudflare->rec_delete([
            'z'         => env('CLOUDFLARE_DOMAIN'),
            'id'        => $id
        ]);

        return $response;
    }
}
