<?php

namespace App\Traits\GetSet;

trait IpAddrTrait
{
    /**
     * @return string
     */
    public function getIp() {

        return $this->ip_addr;
    }

    /**
     * @param string $ipAddr
     */
    public function setIp($ipAddr) {

        $this->ip_addr = $ipAddr;
    }


}
