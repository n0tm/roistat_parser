<?php


namespace RoistatParser\Model;


class AccessLogRow
{
    /**
     * @type string
     */
    private $_ip;
    /**
     * @type string
     */
    private $_identity;
    /**
     * @type string
     */
    private $_user;
    /**
     * @type string
     */
    private $_date;
    /**
     * @type string
     */
    private $_time;
    /**
     * @type string
     */
    private $_timezone;
    /**
     * @type string
     */
    private $_method;
    /**
     * @type string
     */
    private $_path;
    /**
     * @type string
     */
    private $_protocol;
    /**
     * @type string
     */
    private $_status;
    /**
     * @type string
     */
    private $_bytes;
    /**
     * @type string
     */
    private $_referer;
    /**
     * @type string
     */
    private $_agent;

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->_ip;
    }

    /**
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->_ip = $ip;
    }

    /**
     * @return string
     */
    public function getIdentity()
    {
        return $this->_identity;
    }

    /**
     * @param string $identity
     */
    public function setIdentity($identity)
    {
        $this->_identity = $identity;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->_user;
    }

    /**
     * @param string $user
     */
    public function setUser($user)
    {
        $this->_user = $user;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->_date = $date;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->_time;
    }

    /**
     * @param string $time
     */
    public function setTime($time)
    {
        $this->_time = $time;
    }

    /**
     * @return string
     */
    public function getTimezone()
    {
        return $this->_timezone;
    }

    /**
     * @param string $timezone
     */
    public function setTimezone($timezone)
    {
        $this->_timezone = $timezone;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->_method;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->_method = $method;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->_path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->_path = $path;
    }

    /**
     * @return string
     */
    public function getProtocol()
    {
        return $this->_protocol;
    }

    /**
     * @param string $protocol
     */
    public function setProtocol($protocol)
    {
        $this->_protocol = $protocol;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->_status = $status;
    }

    /**
     * @return string
     */
    public function getBytes()
    {
        return $this->_bytes;
    }

    /**
     * @param string $bytes
     */
    public function setBytes($bytes)
    {
        $this->_bytes = $bytes;
    }

    /**
     * @return string
     */
    public function getReferer()
    {
        return $this->_referer;
    }

    /**
     * @param string $referer
     */
    public function setReferer($referer)
    {
        $this->_referer = $referer;
    }

    /**
     * @return string
     */
    public function getAgent()
    {
        return $this->_agent;
    }

    /**
     * @param string $agent
     */
    public function setAgent($agent)
    {
        $this->_agent = $agent;
    }


}