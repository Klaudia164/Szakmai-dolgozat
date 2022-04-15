<?php

class movies {
    
    private $id;
    private $nev;
    private $mufaj;
    private $info;
    private $hatter;

    public function set_movie($id, $conn) {
        // adatbázisból lekérdezzük
        $sql = "SELECT id, nev, mufaj, info, hatter FROM filmek";
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

    public function get_info() {
        return $this->info;
    }

    public function get_hatter() {
        return $this->hatter;
    }
//Filmek listájának lekérése az adatbázisból
    public function filmekListaja($conn) {
        $lista = array();
        $search = '';
        if(!empty ($_POST['search'])){
            $search = $_POST['search'];
        }
        $sql = "SELECT id FROM filmek WHERE nev LIKE ('%".$search."%') AND elfogadva = 1";
        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    $lista[] = $row['id'];
                }
            }
        }
        return $lista;
    }
    //Requestsbel való filmek lekérése az adatbázisból
    public function request_moviesLista($conn) {
        $lista = array();
        $sql = "SELECT id FROM filmek WHERE elfogadva = 0";
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
    public function komment($kom, $mId, $conn) {
        $sql = "INSERT INTO f_comment (film_id, felhasznalo_id, komment) VALUES (".$mId.",".$_SESSION['id'].", '".$kom."')";
        $conn->query($sql);
       
    }
//komment törlés funkciójának beállítása
    public function delcomment($com_Id, $conn) {
        $felhasznalo = new felhasznalok();
        $felhasznalo->set_user($_SESSION['id'], $conn);
        if($felhasznalo->get_permission()>0){
            $sql = "DELETE FROM f_comment WHERE id = ".$com_Id."";
        }else{
            $sql = "DELETE FROM f_comment WHERE id = ".$com_Id." AND felhasznalo_id = ".$_SESSION['id']."";
        }
        $conn->query($sql);
    }
//komment szerkeztési funkciójának beállítása
    public function editcomment($kom, $com_Id, $conn) {
        $sql = "UPDATE f_comment SET komment = '".$kom."' WHERE felhasznalo_id = ".$_SESSION['id']." AND id = ".$com_Id."";
        $conn->query($sql);
        
    }
//Az új értékelések rögzítése és a régiek átírása
    public function set_rating($rating, $mId, $conn){
        $sql = "SELECT ertek1 FROM filmekErtekelese WHERE felhasznalo2_Id = ".$_SESSION['id']." AND film_id = ".$mId."";
        if($result = $conn->query($sql)){
            if($result->num_rows > 0){
                $sql = "UPDATE `filmekErtekelese` SET `ertek1`=".$rating." WHERE felhasznalo2_Id = ".$_SESSION['id']." AND film_id = ".$mId."";
            }else{
                $sql = "INSERT INTO filmekErtekelese (felhasznalo2_Id, film_id, ertek1) VALUES (".$_SESSION['id'].",".$mId.",".$rating.")";
            }
        }
        $conn->query($sql);
    }
//Értékelések lekérése az adatbázisból
    public function get_rating($mId, $conn){
        $sql = "SELECT ertek1 FROM filmekErtekelese WHERE felhasznalo2_Id = ".$_SESSION['id']." AND film_id = ".$mId."";

        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    return $row['ertek1'];
                }
            }else{
                return 0;
            }
        }
    }
//Átlagértékelés lekérése az adatbázisból
    public function get_avgrating($mId, $conn){
        $sql = "SELECT CAST(AVG(ertek1) AS DECIMAL (10,2)) AS atlag1 FROM filmekErtekelese WHERE film_id = ".$mId."";

        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    return $row['atlag1'];
                }
            }else{
                return 0;
            }
        }
    }
}

?>
