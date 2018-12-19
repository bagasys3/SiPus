<?php
use Phalcon\Mvc\Controller;
class ReservasiController extends BaseController
{

	public function manageAction()
    {
        if($this->session->get('auth')['status'] != '1'){
            $this->response->redirect();
        }

        $searchBy = $this->request->getPost('searchBy');
        $searchKey = $this->request->getPost('searchKey');
        if($searchBy == 'id_reservasi'){            
            $query = $this->modelsManager->createQuery('SELECT r.id as idr, r.id_user, u.nama, b.ISBN_ISSN, r.id_buku, b.judul FROM Users u, Reservasi r, Buku b
            WHERE u.id = r.id_user AND r.id_buku = b.id AND r.id = :searchKey:');
            $peminjamans  = $query->execute([
                'searchKey' => $searchKey,
            ]);
        }else if($searchBy == 'judul') {
            $searchKey = '%'.$searchKey.'%';
            $query = $this->modelsManager->createQuery('SELECT r.id as idr, r.id_user, u.nama, b.ISBN_ISSN, r.id_buku, b.judul FROM Users u, Reservasi r, Buku b
            WHERE u.id = r.id_user AND r.id_buku = b.id AND b.judul LIKE :searchKey:');
            $peminjamans  = $query->execute([
                'searchKey' => $searchKey,
            ]);
        }else if($searchBy == 'ISBN_ISSN'){
            $query = $this->modelsManager->createQuery('SELECT r.id as idr, r.id_user, u.nama, b.ISBN_ISSN, r.id_buku, b.judul FROM Users u, Reservasi r, Buku b
            WHERE u.id = r.id_user AND r.id_buku = b.id AND b.ISBN_ISSN = :searchKey:');
            $peminjamans  = $query->execute([
                'searchKey' => $searchKey,
            ]);
        }else if($searchBy == 'no_id'){
            $query = $this->modelsManager->createQuery('SELECT r.id as idr, r.id_user, u.nama, b.ISBN_ISSN, r.id_buku, b.judul FROM Users u, Reservasi r, Buku b
            WHERE u.id = r.id_user AND r.id_buku = b.id AND u.no_id = :searchKey:');
            $peminjamans  = $query->execute([
                'searchKey' => $searchKey,
            ]);
        }else{
            $searchKey= '%'.$searchKey.'%';
            $query = $this->modelsManager->createQuery('SELECT r.id as idr, r.id_user, u.nama, u.no_id, b.ISBN_ISSN, r.id_buku, b.judul FROM Users u, Reservasi r, Buku b
            WHERE u.id = r.id_user AND r.id_buku = b.id AND u.nama LIKE :searchKey:');
            $peminjamans  = $query->execute([
                'searchKey' => $searchKey,
            ]);  
        }

        $this->view->peminjamans = $peminjamans;
        
        
    }

    public function createAction()
    {
        $reservasi = new Reservasi();

        $id_buku = $this->request->getPost('id_buku');
        $id_user = $this->session->get('auth')['id'];
        $date = date('Y-m-d');

        $reservasi->id_buku = $id_buku;
        $reservasi->id_user = $id_user;
        $reservasi->tgl_reservasi = $date;

        if ($reservasi->save() === false) {
            foreach ($reservasi->getMessages() as $message) {
                echo $message, "\n";
            }
        } else {
            $this->response->redirect('reservasi');
        }
    }

    public function destroyAction()
    {
        $id = $this->request->getPost('id');
        
        $reservasi = Reservasi::findFirst("id = '$id'");

        if ($reservasi !== false) {
            if ($reservasi->delete() === false) {
                echo "Sorry, we can't delete the reservation right now: \n";
        
                $messages = $reservasi->getMessages();
        
                foreach ($messages as $message) {
                    echo $message, "\n";
                }
            } else {
                $this->response->redirect('daftar-reservasi');
            }
        }
    }

    public function showAction()
    {
        if($this->session->get('auth')['status'] != '0'){
              $this->response->redirect();
        }

        $id = $this->session->get('auth')['id'];
    
        $results = Reservasi::find("id_user = '$id' ");
        $this->view->results = $results;
        

    }

}
