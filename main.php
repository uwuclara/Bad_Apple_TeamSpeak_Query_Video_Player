<?php

namespace Bad_Apple_TeamSpeak_Query_Video_Player;

use TeamSpeak3_Exception;

//connection
require_once __DIR__ ."/connection/connection.php";

class main extends connection
{
    /**
     * Bot constructor.
     * @brief a constructor
     */
    public function __construct()
    {

        ignore_user_abort(true);
        set_time_limit(0);

        //construct Connection
        Connection::__construct();

        $song = file_get_contents(__DIR__ ."/play/bad_apple.txt");

        $frames = preg_split("#\n\s*\n#Uis", $song);

        foreach ($frames as $key => $frame)
        {

            $frame_time_start = microtime(true);

            try
            {

                $this->ts3->message("\n".$frame);

            }
            catch (TeamSpeak3_Exception $error)
            {

                $error = $error->getMessage();

                if(preg_match("/flooding/", $error))
                {

                    echo "Bot is flooding, exiting." ;

                    exit;

                }
                else
                {

                    echo "Failed to send frame (".$key.") ".$error;

                }

            }

            $frame_time_diff = microtime(true) - $frame_time_start;

            usleep(40000 - $frame_time_diff);

        }

        exit;

    }

}

new main();