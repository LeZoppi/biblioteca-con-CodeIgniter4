<?php 
namespace App\Models;

use CodeIgniter\Model;

class Libro extends Model{
    protected $table      = 'libros';
    protected $primaryKey = 'id';
    protected $allowedFields= ['nombre','imagen'];
}

function buscar($query){

    $this->db->like('titulo',$query);
    $query = $this->db->get('libros');

    if($query->num_rows() > 0){

        return $query;
    }else{
        return false;
    }


}