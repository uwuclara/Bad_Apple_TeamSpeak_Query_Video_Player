<?php

namespace Bad_Apple_TeamSpeak_Query_Video_Player;

class config
{

    private array $ts_config;

    /**
     * Config constructor.
     */
    public function __construct()
    {

        //server configs
        $this->ts_config = array
        (

            "Host"              => "localhost",
            "Server_Query_Port" => "10011",
            "Server_Port"       => "9987",
            "Username"          => "serveradmin",
            "Password"          => "password",
            "Bot_Name"          => "Server_Video_Player"

        );

    }

    /**
     * get ts config
     * @return array
     */
    public function getTS_Config()
    {

        return (array)$this->ts_config;

    }

}
