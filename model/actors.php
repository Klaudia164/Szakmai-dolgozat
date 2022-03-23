<?php

class actors {
    
    private $id;
    private $nev;
    private $nem;
    private $info;
    private $hatter;

    public function set_actors($id, $conn) {
        // adatbázisból lekérdezzük
        $sql = "SELECT id, nev, nem, info, hatter FROM szineszek";
        $sql .= " WHERE id = $id ";
        $result = $conn->query($sql);
        if ($conn->query($sql)) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->nev = $row['nev'];
                $this->mufaj = $row['nem'];
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

    public function get_nem() {
        return $this->mufaj;
    }

    public function get_hatter() {
        return $this->hatter;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_info() {
        return $this->info;
    }

    public function szineszekListaja($conn) {
        $lista = array();
        $search = '';
        if(!empty ($_POST['search'])){
            $search = $_POST['search'];
        }
        $sql = "SELECT id FROM szineszek WHERE nev LIKE ('%".$search."%') AND elfogadva = 1";
        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    $lista[] = $row['id'];
                }
            }
        }
        return $lista;
    }

    public function request_actorsLista($conn) {
        $lista = array();
        $sql = "SELECT id FROM szineszek WHERE elfogadva = 0";
        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    $lista[] = $row['id'];
                }
            }
        }
        return $lista;
    }

    public function komment($kom, $aId, $conn) {
        $sql = "INSERT INTO sz_comment (szinesz_Id, felhasznalo_id, komment) VALUES (".$aId.",".$_SESSION['id'].", '".$kom."')";
        $conn->query($sql);
       
    }

    public function delcomment($com_Id, $conn) {
        $felhasznalo = new felhasznalok();
        $felhasznalo->set_user($_SESSION['id'], $conn);
        if($felhasznalo->get_permission()>0){
            $sql = "DELETE FROM sz_comment WHERE id = ".$com_Id."";
        }else{
            $sql = "DELETE FROM sz_comment WHERE id = ".$com_Id." AND felhasznalo_id = ".$_SESSION['id']."";
        }
        $conn->query($sql);
    }

    public function editcomment($kom, $com_Id, $conn) {
        $sql = "UPDATE sz_comment SET komment = '".$kom."' WHERE felhasznalo_id = ".$_SESSION['id']." AND id = ".$com_Id."";
        $conn->query($sql);
        
    }

    public function set_rating($rating, $aId, $conn){
        $sql = "SELECT ertek3 FROM szineszekErtekelese WHERE felhasznalo_Id = ".$_SESSION['id']." AND szinesz_Id = ".$aId."";
        if($result = $conn->query($sql)){
            if($result->num_rows > 0){
                $sql = "UPDATE `szineszekErtekelese` SET `ertek3`=".$rating." WHERE felhasznalo_Id = ".$_SESSION['id']." AND szinesz_Id = ".$aId."";
            }else{
                $sql = "INSERT INTO szineszekErtekelese (felhasznalo_Id, szinesz_Id, ertek3) VALUES (".$_SESSION['id'].",".$aId.",".$rating.")";
            }
        }
        $conn->query($sql);
    }

    public function get_rating($aId, $conn){
        $sql = "SELECT ertek3 FROM szineszekErtekelese WHERE felhasznalo_Id = ".$_SESSION['id']." AND szinesz_Id = ".$aId."";

        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    return $row['ertek3'];
                }
            }else{
                return 0;
            }
        }
    }

    public function get_avgrating($aId, $conn){
        $sql = "SELECT CAST(AVG(ertek3) AS DECIMAL (10,2)) AS atlag3 FROM szineszekErtekelese WHERE szinesz_Id = ".$aId."";

        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    return $row['atlag3'];
                }
            }else{
                return 0;
            }
        }
    }

}

?>
