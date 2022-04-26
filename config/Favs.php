<?php
require_once "Ad.php";
require_once "Walk.php";
class Favs
{
    public static function checkFavs($id_ad, $id_user, $type): bool {
        $db = new Database();
        $prep = $db->prepare("SELECT * FROM favourite WHERE id_ad = ? AND id_user = ? AND type = ?");
        $prep->bind_param('iis', $id_ad,$id_user, $type);
        $prep->execute();
        $res = $prep->get_result();
        $prep->close();
        return $res->num_rows;
    }
    public static function addToFavs($id_ad, $id_user, $type): bool {
        $db = new Database();
        $prep = $db->prepare("INSERT INTO favourite (`id_ad`, `id_user`, `type`) VALUES (?,?,?)");
        $prep->bind_param('ii', $id_ad,$id_user);
        $prep->execute();
        $prep->close();
        return true;
    }
    public static function deleteFromFavs($id_ad, $id_user, $type): bool {
        $db = new Database();
        $prep = $db->prepare("DELETE FROM favourite WHERE id_ad = ? AND id_user = ? AND type = ?");
        $prep->bind_param('ii', $id_ad,$id_user);
        $prep->execute();
        $prep->close();
        return true;
    }
    public static function getFavs($id_user) {
        $db = new Database();
        $prep = $db->prepare("SELECT * FROM `favourite` WHERE id_user = ?");
        $prep->bind_param('i', $id_user);
        $prep->execute();
        $res = $prep->get_result();
        $prep->close();
        if($res === false || $res->num_rows < 1) return NULL;
        $array = [];
        $i = 0;
        while ( $row = $res->fetch_assoc() ) {
            $array[ $i ][ 'id_ad' ] = $row[ 'id_ad' ];
            $array[ $i ][ 'type' ] = $row[ 'type' ];
            $i++;
        }
        $favs = [];
        $i = 0;
        foreach ($array as $id) {
            if($id['type'] === "pethold"){
                $favs[$i] = Ad::getAddByID($id['id_ad']);
            } else {
                $favs[$i] = Walk::getAddByID($id['id_ad']);
            }
            $i++;
        }
        return $favs;
    }
}