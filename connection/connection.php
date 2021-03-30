<?php

namespace Bad_Apple_TeamSpeak_Query_Video_Player;

use TeamSpeak3;
use TeamSpeak3_Adapter_Abstract;
use TeamSpeak3_Exception;
use TeamSpeak3_Node_Server;
use TeamSpeak3_Transport_Exception;

//libs
require_once __DIR__ ."/../vendor/autoload.php";

//config
require_once __DIR__ ."/config.php";

class connection
{

    protected ?TeamSpeak3_Node_Server $ts3 = NULL;

    public function __construct()
    {

        //construct Connection
        $config = new Config;

        $ts_config = $config->getTS_Config();

        $missing = [];

        foreach($ts_config as $key => $config)
        {

            if(empty($config))
            {

                array_push($missing,"TS config missing: ".$key);

            }

        }

        if(!empty($missing))
        {

            $missing_values = implode(", ", $missing);

            echo date("d.m.y H:i:s")." | "." Missing these values: ".$missing_values;

            exit;

        }

        $this->ts3 = $this->TS_Connection($ts_config);

        if(!isset($this->ts3) OR is_null($this->ts3) )
        {

            echo date("d.m.y H:i:s")." | Error: TS connections are at NULL!";

            exit;

        }

    }

    /**
     * TS Connection
     * @param array $ts_config
     * @return TeamSpeak3_Adapter_Abstract|TeamSpeak3_Node_Server
     * @brief a TeamSpeak connection
     */
    private static function TS_Connection(array $ts_config)
    {

        try
        {

            //teamspeak connection
            $cn = TeamSpeak3::factory("serverquery://" . $ts_config['Username'] . ":" . $ts_config['Password'] . "@" . $ts_config['Host'] . ":" . $ts_config['Server_Query_Port'] . "/?server_port=" . $ts_config['Server_Port'] . "&blocking=0&nickname=" . $ts_config['Bot_Name']);

        }
        catch (TeamSpeak3_Transport_Exception $exception)
        {

            echo date("d.m.y H:i:s")." | Error: Couldn't connect to the TeamSpeak server at ".$ts_config["Host"].". ".$exception->getMessage()."\n";

            exit;

        }

        return $cn;

    }

}