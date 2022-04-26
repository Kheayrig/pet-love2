<?php
require_once "Database.php";
class Walk
{
    public static function getAd() {
        $db = new Database();
        $prep = $db->prepare("SELECT * FROM `walk`");
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
            $array[ $i ][ 'img' ] = $row[ 'img' ];
            $i++;
        }
        return $array;
    }
    public static function getAddByID($id) {
        $db = new Database();
        $prep = $db->prepare("SELECT * FROM `walk` where id = ?");
        $prep->bind_param('i', $id);
        $prep->execute();
        $res = $prep->get_result();
        $prep->close();
        if($res === false || $res->num_rows < 1) return NULL;
        return $res->fetch_assoc();
    }
    public static function sortBy($type, $city) {
        $db = new Database();
        if($type === "null") {
            $prep = $db->prepare("SELECT * FROM `walk` where city = ?");
            $prep->bind_param('s', $city);
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
                $array[ $i ][ 'img' ] = $row[ 'img' ];
                $i++;
            }
            return $array;
        } else {
            $prep = $db->prepare("SELECT * FROM `walk` where type = ?");
            $prep->bind_param('s', $type);
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
                $array[ $i ][ 'img' ] = $row[ 'img' ];
                $i++;
            }
            return $array;
        }

    }
}