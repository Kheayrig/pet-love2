<?php
require_once "Database.php";
class Ad
{
    public static function getAd() {
        $db = new Database();
        $prep = $db->prepare("SELECT * FROM `ad`");
        //$prep->bind_param('s', $email);
        $prep->execute();
        $res = $prep->get_result();
        $prep->close();
        if($res === false || $res->num_rows < 1) return NULL;
        $array = [];
        $i = 0;
        while ( $row = $res->fetch_assoc() ) {
        $array[ $i ][ 'id' ] = $row[ 'id' ];
        $array[ $i ][ 'title' ] = $row[ 'title' ];
        $array[ $i ][ 'about' ] = $row[ 'about' ];
        $array[ $i ][ 'city' ] = $row[ 'city' ];
        $array[ $i ][ 'distance' ] = $row[ 'distance' ];
        $array[ $i ][ 'price' ] = $row[ 'price' ];
        $array[ $i ][ 'type' ] = $row[ 'type' ];
        $array[ $i ][ 'subtype' ] = $row[ 'subtype' ];
        $array[ $i ][ 'img' ] = $row[ 'img' ];
        $i++;
        }
        return $array;
    }
    public static function getAddByID($id) {
        $db = new Database();
        $prep = $db->prepare("SELECT * FROM `ad` where id = ?");
        $prep->bind_param('i', $id);
        $prep->execute();
        $res = $prep->get_result();
        $prep->close();
        if($res === false || $res->num_rows < 1) return NULL;
        return $res->fetch_assoc();
    }
}