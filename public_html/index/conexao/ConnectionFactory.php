<?php

class ConnectionFactory {

    //Para uso local
    private $host = "127.0.0.1";
    private $user = "root";
    private $senha = "";
    private $dbase = "w8a80121";

    public function get_Mysqli() {
        // Create connection
        try {
            $mysqli = new mysqli($this->host, $this->user, $this->senha, $this->dbase);

            // Check connection
            if ($mysqli->connect_error) {
                die("Falha na conexção do MYSQLI: " . $mysqli->connect_error);
            }
        } catch (Exception $ex) {
            print $ex;
        }
        return $mysqli;
    }

}
