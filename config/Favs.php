<?php
require_once "Ad.php";
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
        $prep = $db->prepare("INSERT INTO favourite (`id_ad`, `id_user`) VALUES (?,?)");
        $prep->bind_param('ii', $id_ad,$id_user);
        $prep->execute();
        $prep->close();
        return true;
    }
    public static function deleteFromFavs($id_ad, $id_user, $type): bool {
        $db = new Database();
        $prep = $db->prepare("DELETE FROM favourite WHERE id_ad = ? AND id_user = ?");
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
            $i++;
        }
        $favs = [];
        $i = 0;
        foreach ($array as $id) {
            $favs[$i] = Ad::getAddByID($id);
            $i++;
        }
        return $favs;
    }
}