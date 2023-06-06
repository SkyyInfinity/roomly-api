import './bootstrap';

function deleteUser() {
    if(confirm('Etes vous sûr de vouloir supprimer cet utilisateur ?')) {
        return true;
    }
    return false;
}