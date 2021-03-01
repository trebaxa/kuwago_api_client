<?php

/**
 * @package    Redimero::kuwago
 *
 * @copyright  Copyright (C) 2006 - 2021 Trebaxa GmbH&Co.KG. All rights reserved.
 * @license    Trebaxa GmbH&Co.KG
 */

define('KUWAGO_SERVER', 'https://api.kuwago.de/');

class kuwago_client {

    protected static $config = array();

    /**
     * kuwago_client::set_config()
     * 
     * @param mixed $config
     * @return void
     */
    public static function set_config($config) {
        static::$config = $config;
    }

    /**
     * kuwago_client::valid_connection()
     * 
     * @return
     */
    public static function valid_connection() {
        return static::$config['secret'] != "" && static::$config['hash'] != "" && static::$config['mkid'] != "";
    }

    /**
     * kuwago_client::rest_query()
     * 
     * @param mixed $vars
     * @return
     */
    private static function rest_query($vars) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, KUWAGO_SERVER);
        curl_setopt($ch, CURLOPT_POST, 1);
        #curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($vars));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $headers = array("Authorization: Basic " . base64_encode(static::$config['hash'] . ":" . static::$config['secret']));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if (!$result = curl_exec($ch)) {
            trigger_error(curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }

    /**
     * kuwago_client::send_rest_data()
     * 
     * @param mixed $cmd
     * @param mixed $data
     * @return
     */
    public static function send_rest_data($cmd, $data) {
        return self::call($cmd, $data);
    }

    /**
     * kuwago_client::call()
     * 
     * @param mixed $cmd
     * @param mixed $data
     * @return
     */
    public static function call($cmd, $data) {
        if (self::valid_connection()) {
            $params = array('data' => (array )$data, 'login' => array('mkid' => static::$config['mkid']));
            $res = self::rest_query(array('cmd' => $cmd, 'params' => json_encode($params)));
            return json_decode($res, true);
        }
        else {
            return array();
        }

    }

}
