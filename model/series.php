<?php

class series {
    
    private $id;
    private $nev;
    private $mufaj;
    private $info;

    public function set_series($id, $conn) {
        // adatbázisból lekérdezzük
        $sql = "SELECT id, nev, mufaj, info FROM sorozatok";
        $sql .= " WHERE id = $id ";
        $result = $conn->query($sql);
        if ($conn->query($sql)) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->nev = $row['nev'];
                $this->mufaj = $row['mufaj'];
                $this->info = $row['info'];
                
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

    public function sorozatokListaja($conn) {
        $lista = array();
        $sql = "SELECT id FROM sorozatok";
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
