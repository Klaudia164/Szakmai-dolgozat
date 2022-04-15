<?php

class series {
    
    private $id;
    private $nev;
    private $mufaj;
    private $info;
    private $hatter;
    
    public function set_series($id, $conn) {
        // adatbázisból lekérdezzük
        $sql = "SELECT id, nev, mufaj, info, hatter FROM sorozatok";
        $sql .= " WHERE id = $id ";
        $result = $conn->query($sql);
        if ($conn->query($sql)) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->nev = $row['nev'];
                $this->mufaj = $row['mufaj'];
                $this->info = $row['info'];
                $this->hatter = $row['hatter'];
            }
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    public function get_nev() {
        return $this->nev;
    }

    public function get_mufaj() {
        return $this->mufaj;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_hatter() {
        return $this->hatter;
    }

    public function get_info() {
        return $this->info;
    }
//Sorozatok listájának lekérése az adatbázisból
    public function sorozatokListaja($conn) {
        $lista = array();
        $search = '';
        if(!empty ($_POST['search'])){
            $search = $_POST['search'];
        }
        $sql = "SELECT id FROM sorozatok WHERE nev LIKE ('%".$search."%') AND elfogadva = 1";
        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    $lista[] = $row['id'];
                }
            }
        }
        return $lista;
    }

    //Requestsbel való sorozatok lekérése az adatbázisból
    public function request_seriesLista($conn) {
        $lista = array();
        $sql = "SELECT id FROM sorozatok WHERE elfogadva = 0";
        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    $lista[] = $row['id'];
                }
            }
        }
        return $lista;
    }
    //kommentek feltöltése az adatbázisba
    public function komment($kom, $sId, $conn) {
        $sql = "INSERT INTO s_comment (sorozat_Id, felhasznalo_id, komment) VALUES (".$sId.",".$_SESSION['id'].", '".$kom."')";
        $conn->query($sql);
       
    }
//komment törlés funkciójának beállítása
    public function delcomment($com_Id, $conn) {
        $felhasznalo = new felhasznalok();
        $felhasznalo->set_user($_SESSION['id'], $conn);
        if($felhasznalo->get_permission()>0){
            $sql = "DELETE FROM s_comment WHERE id = ".$com_Id."";
        }else{
            $sql = "DELETE FROM s_comment WHERE id = ".$com_Id." AND felhasznalo_id = ".$_SESSION['id']."";
        }
        $conn->query($sql);
    }
//komment szerkeztési funkciójának beállítása
    public function editcomment($kom, $com_Id, $conn) {
        $sql = "UPDATE s_comment SET komment = '".$kom."' WHERE felhasznalo_id = ".$_SESSION['id']." AND id = ".$com_Id."";
        $conn->query($sql);
        
    }
//Az új értékelések rögzítése és a régiek átírása
    public function set_rating($rating, $sId, $conn){
        $sql = "SELECT ertek2 FROM sorozatokErtekelese WHERE felhasznalo1_Id = ".$_SESSION['id']." AND sorozat_Id = ".$sId."";
        if($result = $conn->query($sql)){
            if($result->num_rows > 0){
                $sql = "UPDATE `sorozatokErtekelese` SET `ertek2`=".$rating." WHERE felhasznalo1_Id = ".$_SESSION['id']." AND sorozat_Id = ".$sId."";
            }else{
                $sql = "INSERT INTO sorozatokErtekelese (felhasznalo1_Id, sorozat_Id, ertek2) VALUES (".$_SESSION['id'].",".$sId.",".$rating.")";
            }
        }
        $conn->query($sql);
    }
//Értékelések lekérése az adatbázisból
    public function get_rating($sId, $conn){
        $sql = "SELECT ertek2 FROM sorozatokErtekelese WHERE felhasznalo1_Id = ".$_SESSION['id']." AND sorozat_Id = ".$sId."";

        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    return $row['ertek2'];
                }
            }else{
                return 0;
            }
        }
    }

//Átlagértékelés lekérése az adatbázisból
    public function get_avgrating($sId, $conn){
        $sql = "SELECT CAST(AVG(ertek2)  AS DECIMAL (10,2)) AS atlag2 FROM sorozatokErtekelese WHERE sorozat_Id = ".$sId."";

        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    return $row['atlag2'];
                }
            }else{
                return 0;
            }
        }
    }
}

?>
