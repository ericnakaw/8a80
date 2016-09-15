<?php

class Conexao {
    
//    //Para uso local
    protected $host = "127.0.0.1";
    protected $user = "root"; 
    protected $senha = "";
    protected $dbase = "w8a80121";
    // Cria as variáveis que Utilizaremos
    var $query;
    var $link;
    var $resultado;

    // Instancia o Objeto para usarmos    
    function __construct() {
        
    }

    // Cria a função para Conectar ao Banco MySQL
    protected function conecta() {
        $this->link = @mysql_connect($this->host, $this->user, $this->senha);
        // Conecta ao Banco de Dados
        if (!$this->link) {
            // Caso ocorra um erro, exibe uma mensagem com o erro
            print "Ocorreu um Erro na conexão MySQL:";
            print "<b>" . mysql_error() . "</b>";
            die();
        } elseif (!mysql_select_db($this->dbase, $this->link)) {
            // Seleciona o banco após a conexão
            // Caso ocorra um erro, exibe uma mensagem com o erro
            print "Ocorreu um Erro em selecionar o Banco:";
            print "<b>" . mysql_error() . "</b>";
            die();
        }
    }

    // Cria a função para query no Banco de Dados
    public function sql_query($query) {
        $this->conecta();
        $this->query = $query;
        // Conecta e faz a query no MySQL
        if ($this->resultado = mysql_query($this->query)) {
            $this->desconnecta();
            return $this->resultado;
        } else {
            // Caso ocorra um erro, exibe uma mensagem com o Erro
            print "Ocorreu um erro ao executar a Query MySQL: <b>$query</b>";
            print "<br /><br />";
            print "Erro no MySQL: <b>" . mysql_error() . "</b>";
            die();
            $this->desconnecta();
        }
    }

    // Cria a função para Desconectar ao Banco MySQL
    protected function desconnecta() {
        return mysql_close($this->link);
    }

    public function get_sql_query_inserted_id($query) {
        $this->conecta();
        $this->query = $query;
        // Conecta e faz a query no MySQL
        if (mysql_query($this->query)) {
            $last_id = mysql_insert_id();
            $this->desconnecta();
            return $last_id;
        } else {
            // Caso ocorra um erro, exibe uma mensagem com o Erro
            print "Ocorreu um erro ao executar a Query MySQL: <b>$query</b>";
            print "<br /><br />";
            print "Erro no MySQL: <b>" . mysql_error() . "</b>";
            die();
            $this->desconnecta();
        }
    }
}

?>