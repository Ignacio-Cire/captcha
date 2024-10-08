<?php
class ABMusuario {
    
   // Función central que maneja todas las acciones (alta, baja, modificación)
public function abm($datos) {
    $resp = false; 
    // Inicializa una variable $resp en false. Se usará para indicar si la operación fue exitosa o no.

    if ($datos['accion'] == 'nuevo') {
        // Verifica si la acción solicitada es 'nuevo' (crear un nuevo registro).
        if ($this->alta($datos)) {
            // Si la función alta(), que crea un nuevo registro, se ejecuta correctamente, devuelve true.
            $resp = true;
            // Cambia el valor de $resp a true si la creación fue exitosa.
        }
    }

    if ($datos['accion'] == 'editar') {
        // Verifica si la acción solicitada es 'editar' (modificar un registro existente).
        if ($this->modificacion($datos)) {
            // Si la función modificacion(), que actualiza un registro, se ejecuta correctamente, devuelve true.
            $resp = true;
            // Cambia el valor de $resp a true si la modificación fue exitosa.
        }
    }

    if ($datos['accion'] == 'borrar') {
        // Verifica si la acción solicitada es 'borrar' (eliminar un registro).
        if ($this->baja($datos)) {
            // Si la función baja(), que elimina un registro, se ejecuta correctamente, devuelve true.
            $resp = true;
            // Cambia el valor de $resp a true si la eliminación fue exitosa.
        }
    }

    return $resp;
    // Devuelve el valor de $resp. Será true si alguna acción fue exitosa, de lo contrario, será false.
}



    
    // Método para dar de alta un usuario
    public function alta($datos) {
        $resp = false;
        // Cifrar la contraseña
        $passwordHash = password_hash($datos['password'], PASSWORD_BCRYPT);
        // Asignar un ID nulo ya que es un nuevo registro
        $datos['id'] = null;
        
        // Crear el objeto Usuario
        $elObjUsuario = $this->cargarObjeto($datos, $passwordHash);
        
        if ($elObjUsuario != null && $elObjUsuario->insertar()) {
            $resp = true;
        }

        return $resp;
    }





    // Método para dar de baja un usuario
    public function baja($datos) {
        $resp = false;
        if ($this->seteadosCamposClaves($datos)) {
            $elObjUsuario = $this->cargarObjetoConClave($datos);
            if ($elObjUsuario != null && $elObjUsuario->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }



    
    // Método para modificar un usuario
    public function modificacion($datos) {
        $resp = false;
        if ($this->seteadosCamposClaves($datos)) {
            // Si se provee una nueva contraseña, la ciframos
            $passwordHash = null;
            if (isset($datos['password'])) {
                $passwordHash = password_hash($datos['password'], PASSWORD_BCRYPT);
            }
            $elObjUsuario = $this->cargarObjeto($datos, $passwordHash);
            if ($elObjUsuario != null && $elObjUsuario->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    // Método para cargar un objeto Usuario desde los datos
    private function cargarObjeto($datos, $passwordHash = null) {
        $obj = null;
        if (array_key_exists('name', $datos) && array_key_exists('email', $datos)) {
            $obj = new Usuario();
            $obj->setear($datos['id'], $datos['name'], $datos['email'], $passwordHash);
        }
        return $obj;
    }

    // Método para cargar un objeto Usuario solo con la clave (id)
    private function cargarObjetoConClave($datos) {
        $obj = null;
        if (isset($datos['id'])) {
            $obj = new Usuario();
            $obj->setear($datos['id'], null, null, null);
        }
        return $obj;
    }

    // Verificar si los campos claves están seteados
    private function seteadosCamposClaves($datos) {
        return isset($datos['id']);
    }

    // Método para buscar usuarios
    public function buscar($datos) {
        $where = " true ";
        if ($datos != null) {
            if (isset($datos['id'])) {
                $where .= " AND id = " . $datos['id'];
            }
            if (isset($datos['email'])) {
                $where .= " AND email = '" . $datos['email'] . "'";
            }
        }
        $obj = new Usuario();
        return $obj->listar($where);
    }
}
?>
