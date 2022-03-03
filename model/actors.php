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
        $sql = "SELECT id FROM szineszek WHERE nev LIKE ('%".$search."%')";
        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    $lista[] = $row['id'];
                }
            }
        }
        return $lista;
    }
}

?>
