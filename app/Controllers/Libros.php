<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Libro;

class Libros extends Controller{

    public function index(){

        $libro= new Libro();
        $datos['libros']= $libro->orderBy('id','ASC')->findAll();

        $datos['cabecera']= view('template/cabecera');
        $datos['pie']= view('template/piedepagina');

        return view('libros/listar',$datos);
    }

    public function crear(){

        $datos['cabecera']= view('template/cabecera');
        $datos['pie']= view('template/piedepagina');


        return view('libros/crear',$datos);
    }

    public function guardar(){

        $libro= new Libro();

        $validacion = $this->validate([
            'nombre'=>'required|min_length[3]',
            'autor'=>'required|min_length[3]',
            'fechaedit'=>'required|min_length[3]',
            'imagen' => [
                'uploaded[imagen]',
                'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                'max_size[imagen,3000]',
            ]
            
            ]);
        if(!$validacion){
        $session= session();
        $session->setFlashdata('mensaje','Revise la informacion: <br/>
             -Nombre del libro minimo 3 caracteres <br/>
             -Nombre del autor minimo 3 caracteres <br/>
             -Recuerde seleccionar una imagen');
        return redirect()->back()->withInput();
        }
        
        if($imagen=$this->request->getFile('imagen')){
            $nuevoNombre= $imagen->getRandomName();
            $imagen->move('../public/uploads/',$nuevoNombre);
            $datos=[
                'nombre'=>$this->request->getVar('nombre'),
                'imagen'=>$nuevoNombre,
                'autor'=>$this->request->getVar('autor'),
                'fechaedit'=>$this->request->getVar('fechaedit')
            ];
            $libro->insert($datos);
        }
        return $this->response->redirect(site_url('/listar'));

    }

    public function borrar($id=null){

        $libro= new Libro();
        $datosLibro=$libro->where('id',$id)->first();

        $ruta=('../public/uploads/'.$datosLibro['imagen']);
        unlink($ruta);
        

        $libro->where('id',$id)->delete($id);

        return $this->response->redirect(site_url('/listar'));


    }

    public function editar($id=null){

        print_r($id);
        $libro= new Libro();

        $datos['libro']=$libro->where('id',$id)->first();

        $datos['cabecera']= view('template/cabecera');
        $datos['pie']= view('template/piedepagina');

       
        return view('libros/editar', $datos);
    }


    public function actualizar(){

        $libro= new Libro();

        $datos=[
            'nombre'=>$this->request->getVar('nombre'),
            'autor'=>$this->request->getVar('autor'),
            'fechaedit'=>$this->request->getVar('fechaedit')
            ];

            $id= $this->request->getVar('id');


            $validacion = $this->validate([
                'nombre'=>'required|min_length[3]',
                'autor'=>'required|min_length[3]',
                'fechaedit'=>'required|min_length[3]'
                ]);
            if(!$validacion){
            $session= session();
            $session->setFlashdata('mensaje','Revise la informacion: <br/>
             -Nombre del libro minimo 3 caracteres <br/>
             -Nombre del autor minimo 3 caracteres <br/>
             -Recuerde seleccionar una imagen');
            return redirect()->back()->withInput();
            }
            
            $libro->update($id,$datos);

            $validacion = $this->validate([
                'imagen' => [
                    'uploaded[imagen]',
                    'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                    'max_size[imagen,3000]',
                ]
                ]);

                if($validacion){

                    if($imagen=$this->request->getFile('imagen')){

                        $datosLibro=$libro->where('id',$id)->first();

                        $ruta=('../public/uploads/'.$datosLibro['imagen']);
                        unlink($ruta);

                        $nuevoNombre= $imagen->getRandomName();
                        $imagen->move('../public/uploads/',$nuevoNombre);

                        $datos=['imagen'=>$nuevoNombre];
                        $libro->update($id,$datos);

                    }

                }



            return $this->response->redirect(site_url('/listar'));

    }

    /* public function buscar(){

        $data = array();

        /*$query = $this->input->get('query',TRUE);

        if($query){
            $result =$this->Libros->buscar(trim($query));
        }if(!result != FALSE){
            $datos = array('result' => $result);
        }else{
            $datos = array('result' => '');
        }

        
        $datos['cabecera']= view('template/cabecera');
        $datos['pie']= view('template/piedepagina');
        return view('libros/listar', $datos);
    } 
    */


}