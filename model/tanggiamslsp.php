<?php
class tanggiamsl{
    private $con;
    public function __construct() {
        $this->con = ketnoi();
    }
    public function giam($don,$user_id){
        $sql1 = "select ct.id_giay, ct.size, ct.so_luong
                                from don_hang as don 
                                join chi_tiet_don_hang as ct
                                on don.ma_don_hang = ct.ma_don_hang
                                where don.ma_don_hang=$don and don.user_id=$user_id";
        $result = mysqli_query($this->con, $sql1);
        $arridgiay = array();
        $arrsize = array();
        $arrsoluong = array();
        $dem = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $arridgiay[$dem] = (int)$row['id_giay'];
            $arrsize[$dem] = (int)$row['size'];
            $arrsoluong[$dem] = (int)$row['so_luong'];
            $dem += 1;
        }
        $i = 0;
        while ($i < count($arridgiay)) {
            $sql2 = "select so_luong_ton_kho_ban from kich_co where id_giay=$arridgiay[$i]"
                    . " and size=$arrsize[$i]";
            $result2 = mysqli_query($this->con, $sql2);
            $row = mysqli_fetch_assoc($result2);
            $slkhoban = (int)$row['so_luong_ton_kho_ban'];
            $slkhobanmoi = $slkhoban - $arrsoluong[$i];
            $sql3 = "update kich_co set so_luong_ton_kho_ban=$slkhobanmoi where id_giay=$arridgiay[$i]"
                    . " and size=$arrsize[$i]";
            $result2 = mysqli_query($this->con, $sql3);
            $sql4 = "select so_luong_ton_kho_ban from giay where id_giay=$arridgiay[$i]";
            $result3 = mysqli_query($this->con, $sql4);
            $row1 = mysqli_fetch_assoc($result3);
            $slkhobancugiay = (int)$row1['so_luong_ton_kho_ban'];
            $slkhobanmoigiay = $slkhobancugiay - $arrsoluong[$i];
            $sql4 = "update giay set so_luong_ton_kho_ban=$slkhobanmoigiay where id_giay=$arridgiay[$i]";
            $result4 = mysqli_query($this->con, $sql4);
            $i+=1;
        }
        if(mysqli_affected_rows($this->con) != 0){
            return 1;
        }
        return 0;
    }
    public function tang($don,$user_id){
        $sql1 = "select ct.id_giay, ct.size, ct.so_luong
                                from don_hang as don 
                                join chi_tiet_don_hang as ct
                                on don.ma_don_hang = ct.ma_don_hang
                                where don.ma_don_hang=$don and don.user_id=$user_id";
        $result = mysqli_query($this->con, $sql1);
        $arridgiay = array();
        $arrsize = array();
        $arrsoluong = array();
        $dem = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $arridgiay[$dem] = (int)$row['id_giay'];
            $arrsize[$dem] = (int)$row['size'];
            $arrsoluong[$dem] = (int)$row['so_luong'];
            $dem += 1;
        }
        $i = 0;
        while ($i < count($arridgiay)) {
            $sql2 = "select so_luong_ton_kho_ban from kich_co where id_giay=$arridgiay[$i]"
                    . " and size=$arrsize[$i]";
            $result2 = mysqli_query($this->con, $sql2);
            $row = mysqli_fetch_assoc($result2);
            $slkhoban = (int)$row['so_luong_ton_kho_ban'];
            $slkhobanmoi = $slkhoban + $arrsoluong[$i];
            $sql3 = "update kich_co set so_luong_ton_kho_ban=$slkhobanmoi where id_giay=$arridgiay[$i]"
                    . " and size=$arrsize[$i]";
            $result2 = mysqli_query($this->con, $sql3);
            $sql4 = "select so_luong_ton_kho_ban from giay where id_giay=$arridgiay[$i]";
            $result3 = mysqli_query($this->con, $sql4);
            $row1 = mysqli_fetch_assoc($result3);
            $slkhobancugiay = (int)$row1['so_luong_ton_kho_ban'];
            $slkhobanmoigiay = $slkhobancugiay + $arrsoluong[$i];
            $sql4 = "update giay set so_luong_ton_kho_ban=$slkhobanmoigiay where id_giay=$arridgiay[$i]";
            $result4 = mysqli_query($this->con, $sql4);
            $i += 1;
        }
        if(mysqli_affected_rows($this->con) != 0){
            return 1;
        }
        return 0;
    }
}
?>
