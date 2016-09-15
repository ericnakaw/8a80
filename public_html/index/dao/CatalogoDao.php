<?php

class CatalogoDao { 
 
    public function select($id_catalogo, $mysqli) {
        $query = "SELECT * FROM catalogo WHERE id_catalogo = $id_catalogo";
        $result = $mysqli->query($query);
        if (!$result) {
            throw new Exception($query);
        }
        return $result;
    }
    public function selectPagina($id_catalogo, $mysqli) {
        $query = "SELECT * FROM catalogo WHERE id_catalogo = $id_catalogo";
        $result = $mysqli->query($query);
        if (!$result) {
            throw new Exception($query);
        }
        return $result;
    }

    public function selectAll($mysqli) {
        $query = "SELECT * FROM catalogo";
        $result = $mysqli->query($query);
        if (!$result) {
            throw new Exception($query);
        }
        return $result;
    }

    public function insert($id_convite, $pagina, $item, $mysqli) {
        $query = "INSERT into catalogo (pagina,id_convite,item) VALUES ('$pagina',{$id_convite},'{$item}');";
        if (!$mysqli->query($query)) {
            throw new Exception($query);
        }
    }

    public function update($idCatalogo, $id_convite, $pagina, $item, $mysqli) {
        $query = "UPDATE catalogo SET pagina='{$pagina}', id_convite={$id_convite}, item='{$item}' WHERE id_catalogo = {$idCatalogo}";
        if (!$mysqli->query($query)) {
            throw new Exception($query);
        }
    }

    public function delete($id, $mysqli) {
        $query = "DELETE FROM catalogo WHERE id_catalogo = {$id}";
        if (!$mysqli->query($query)) {
            throw new Exception($query);
        }
    }

}
