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

    public function sorozatokListaja($conn) {
        $lista = array();
        $search = '';
        if(!empty ($_POST['search'])){
            $search = $_POST['search'];
        }
        $sql = "SELECT id FROM sorozatok WHERE nev LIKE ('%".$search."%')";
        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    $lista[] = $row['id'];
                }
            }
        }
        return $lista;
    }

    public function komment($kom, $sId, $conn) {
        $sql = "INSERT INTO s_comment (sorozat_Id, felhasznalo_id, komment) VALUES (".$sId.",".$_SESSION['id'].", '".$kom."')";
        $conn->query($sql);
       
    }

    public function set_rating($rating, $sId, $conn){
        $sql = "INSERT INTO sorozatokErtekelese (felhasznalo1_Id, sorozat_Id, ertek2) VALUES (".$_SESSION['id'].",".$sId.",".$rating.")";
        $conn->query($sql);
    }

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

}

?>
