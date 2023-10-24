<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\I18n\FrozenTime;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
        @SWG\Get(
            path="/pruebaTecnica/users/index",
            summary="Servicio para traer la información de todos los usuario",
            tags={"Users"},
            consumes={"application/json"},
            produces={"application/json"},
            @SWG\Parameter(
                name="csrfToken",
                in="header",
                description="CrsfToken",
                required=true,
                type="string"
            ),
            @SWG\Response(
                response="200",
                description="Successful operation",
            ),
        )
     */
    public function index()
    {
        if ($this->getRequest()->getSession()->read('Auth.User.perfil') === 'admin') {
            $users = $this->paginate($this->Users);
        } else {
            $currentUserID = $this->getRequest()->getSession()->read('Auth.User.perfil');
            $users = $this->Users->find()
                ->where(['created_by' => $currentUserID])
                ->toArray();
        }

        $formattedUsers = [];
        foreach ($users as $user) {
            $formattedUser = $user;
            if ($user->has('fecha_creacion') && $user->fecha_creacion instanceof FrozenTime) {
                $formattedUser->fecha_creacion = $user->fecha_creacion->format('Y-m-d');
            }
            $formattedUsers[] = $formattedUser;
        }

        $this->set([
            'users' => $formattedUsers,
            '_serialize' => 'users',
        ]);
    }



    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
        @SWG\Get(
            path="/pruebaTecnica/users/view/{id_usuario}",
            summary="Servicio para traer la información del usuario",
            tags={"Users"},
            consumes={"application/json"},
            produces={"application/json"},
            @SWG\Parameter(
                name="id_usuario",
                in="path",
                description="Es el id del usuario",
                required=true,
                type="string",
            ),
            @SWG\Response(
                response="200",
                description="Successful operation",
            )
        )
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set([
            'user' => $user,
            '_serialize' => 'user',
        ]);

        $this->set(compact('user'));
    }

    /**
     * Add method
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
        @SWG\Post(
            path="/pruebaTecnica/users/add",
            summary="Servicio para agregar un usuario",
            tags={"Users"},
            consumes={"application/json"},
            produces={"application/json"},
            @SWG\Parameter(
                name="_csrfToken",
                in="formData",
                description="CrsfToken",
                required=true,
                type="string"
            ),
            @SWG\Parameter(
                name="nombres",
                in="formData",
                description="Nombre de usuario",
                required=true,
                type="string"
            ),
            @SWG\Parameter(
                name="apellidos",
                in="formData",
                description="Nombre de usuario",
                required=true,
                type="string"
            ),
            @SWG\Parameter(
                name="usuario",
                in="formData",
                description="Nombre de usuario",
                required=true,
                type="string"
            ),
            @SWG\Parameter(
                name="correo",
                in="formData",
                description="Nombre de usuario",
                required=true,
                type="string"
            ),
            @SWG\Parameter(
                name="password",
                in="formData",
                description="Contraseña",
                required=true,
                type="string"
            ),
            @SWG\Response(
                response="200",
                description="Successful operation",
                @SWG\Schema(
                    type="object",
                    ref="#/definitions/add"
                )
            ),
            @SWG\Response(
                response=400,
                description="Bad request",
                @SWG\Schema(
                    type="object",
                    properties={
                        @SWG\Property(
                            property="status",
                            type="integer",
                            format="int32",
                        ),
                        @SWG\Property(
                            property="mensaje",
                            type="string",
                        )
                    }
                ),
            ),
            @SWG\Response(
                response=500,
                description="Internal error server",
                @SWG\Schema(
                    type="object",
                    properties={
                        @SWG\Property(
                            property="status",
                            type="integer",
                            format="int32",
                        ),
                        @SWG\Property(
                            property="mensaje",
                            type="string",
                        )
                    }
                ),
            ),
        )

        @SWG\Definition(
            definition="add",
            required={"nombres","apellidos","usuario","correo","password"},
            @SWG\Property(
                property="nombres",
                type="string",
                description="Nombres completos del usuario."
            ),
            @SWG\Property(
                property="apellidos",
                type="string",
                description="Apellidos completos del usuario."
            ),
            @SWG\Property(
                property="usuario",
                type="string",
                description="Nombre de usuario."
            ),
            @SWG\Property(
                property="correo",
                type="string",
                description="Correo del usuario."
            ),
            @SWG\Property(
                property="password",
                type="string",
                description="Contraseña del usuario"
            )
        )
     */
    
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        $currentUserID = $this->Authentication->getIdentity()->id_usuario;
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->created_by = $currentUserID;
            $existingUser = $this->findExistingUser($user);

            if ($existingUser) {
                $response = [
                    'status' => 400,
                    'message' => 'Ya existe un usuario creado con ese correo'
                ];
            } else if ($existingUserName = $this->findExistingUserName($user)) {
                $response = [
                    'status' => 400,
                    'message' => 'Ya existe un usuario creado como "' . $user->usuario . '"'
                ];
            } else {
                if ($this->Users->save($user)) {
                    $response = [
                        'status' => 200,
                        'message' => 'El usuario se ha agregado con éxito.'
                    ];
                } else {
                    $response = [
                        'status' => 500,
                        'message' => 'No se pudo agregar al usuario, por favor inténtelo más tarde.'
                    ];
                }
            }

            $this->setJsonResponse($response);
        }

        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
        @SWG\Patch(
            path="/pruebaTecnica/users/edit/{id_usuario}",
            summary="Servicio para editar un usuario",
            tags={"Users"},
            consumes={"application/json"},
            produces={"application/json"},
            @SWG\Parameter(
                name="_csrfToken",
                in="formData",
                description="CrsfToken",
                required=true,
                type="string"
            ),
            @SWG\Parameter(
                name="id_usuario",
                in="path",
                description="Es el id del usuario",
                required=true,
                type="string",
            ),
            @SWG\Parameter(
                name="nombres",
                in="formData",
                description="Nombre de usuario",
                required=true,
                type="string"
            ),
            @SWG\Parameter(
                name="apellidos",
                in="formData",
                description="Nombre de usuario",
                required=true,
                type="string"
            ),
            @SWG\Parameter(
                name="usuario",
                in="formData",
                description="Nombre de usuario",
                required=true,
                type="string"
            ),
            @SWG\Parameter(
                name="correo",
                in="formData",
                description="Nombre de usuario",
                required=true,
                type="string"
            ),
            @SWG\Parameter(
                name="password",
                in="formData",
                description="Contraseña",
                required=true,
                type="string"
            ),
            @SWG\Parameter(
                name="estado",
                in="formData",
                description="Estado",
                required=true,
                type="boolean"
            ),
            @SWG\Response(
                response="200",
                description="Successful operation",
                @SWG\Schema(
                    type="object",
                    ref="#/definitions/edit"
                )
            ),
            @SWG\Response(
                response=500,
                description="Internal error server",
                @SWG\Schema(
                    type="object",
                    properties={
                        @SWG\Property(
                            property="status",
                            type="integer",
                            format="int32",
                        ),
                        @SWG\Property(
                            property="mensaje",
                            type="string",
                        )
                    }
                ),
            ),
        )

        @SWG\Definition(
            definition="edit",
            required={"nombres","apellidos","usuario","correo","password"},
            @SWG\Property(
                property="nombres",
                type="string",
                description="Nombres completos del usuario."
            ),
            @SWG\Property(
                property="apellidos",
                type="string",
                description="Apellidos completos del usuario."
            ),
            @SWG\Property(
                property="usuario",
                type="string",
                description="Nombre de usuario."
            ),
            @SWG\Property(
                property="correo",
                type="string",
                description="Correo del usuario."
            ),
            @SWG\Property(
                property="password",
                type="string",
                description="Contraseña del usuario"
            ),
            @SWG\Property(
                property="estado",
                type="boolean",
                description="Estado del usuario"
            )
        )
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $response = [
                    'status' => 200,
                    'message' => 'Usuario editado con éxito.'
                ];
            }

            $response = [
                'status' => 500,
                'message' => 'No se pudo editar el usuario, por favor intentelo más tarde.'
            ];
        }

        if (isset($response)) {
            $this->setJsonResponse($response);
        }

        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
        @SWG\Delete(
            path="/pruebaTecnica/users/delete/{id_usuario}",
            summary="Servicio para eliminar un usuario",
            tags={"Users"},
            consumes={"multipart/form-data"},
            produces={"application/json"},
            @SWG\Parameter(
                name="_csrfToken",
                in="formData",
                description="CrsfToken",
                required=true,
                type="string"
            ),
            @SWG\Parameter(
                name="id_usuario",
                in="path",
                description="Es el id del usuario",
                required=true,
                type="string",
            ),
            @SWG\Response(
                response="200",
                description="Successful operation",
            )
        )
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $response = [
                'status' => 200,
                'message' => 'Usuario eliminado con éxito.'
            ];
        } else {
            $response = [
                'status' => 500,
                'message' => 'No se pudo eliminar al usuario, por favor intentelo más tarde..'
            ];
        }

        if (isset($response)) {
            $this->setJsonResponse($response);
        }
    }
    
    /**
        @SWG\Post(
            path="/pruebaTecnica/users/login",
            summary="Servicio para logear un usuario",
            tags={"Auth"},
            consumes={"multipart/form-data"},
            produces={"application/json"},
            @SWG\Parameter(
                name="_csrfToken",
                in="formData",
                description="CrsfToken",
                required=true,
                type="string"
            ),
            @SWG\Parameter(
                name="usuario",
                in="formData",
                description="Nombre de usuario",
                required=true,
                type="string"
            ),
            @SWG\Parameter(
                name="password",
                in="formData",
                description="Contraseña",
                required=true,
                type="string"
            ),
            @SWG\Response(
                response="200",
                description="Successful operation",
                @SWG\Schema(
                    type="object",
                    ref="#/definitions/login"
                )
            ),
            @SWG\Response(
                response=401,
                description="Unauthorized",
                @SWG\Schema(
                    type="object",
                    properties={
                        @SWG\Property(
                            property="status",
                            type="integer",
                            format="int32",
                        ),
                        @SWG\Property(
                            property="mensaje",
                            type="string",
                        )
                    }
                ),
            ),
            @SWG\Response(
                response=403,
                description="Forbidden",
                @SWG\Schema(
                    type="object",
                    properties={
                        @SWG\Property(
                            property="status",
                            type="integer",
                            format="int32",
                        ),
                        @SWG\Property(
                            property="mensaje",
                            type="string",
                        )
                    }
                ),
            )
        )

        @SWG\Definition(
            definition="login",
            required={"usuario","password"},
            @SWG\Property(
                property="usuario",
                type="string",
                description="Nombre de usuario."
            ),
            @SWG\Property(
                property="password",
                type="string",
                description="Contraseña del usuario"
            )
        )
    
     */
    public function login () {
        $this->request->allowMethod(['get', 'post']);

        $user = $this->Authentication->getResult()->getData('user');
        if ($user && !$user->estado) {
            $response = [
                'status' => 403,
                'message' => 'Tu cuenta está deshabilitada. No puedes iniciar sesión.'
            ];
        } else {
            $result = $this->Authentication->getResult();
            if($result->isValid()){
                $csrfToken = $this->getRequest()->getAttribute('csrfToken');
                $this->request->getSession()->write('Auth.User.perfil', $user->perfil);
                $this->request->getSession()->write('Auth.User.id_usuario', $user->id_usuario);
                $response = [
                    'status' => 200,
                    'csrfToken' => $csrfToken,
                    'message' => 'Usuario logead con éxito'
                ];
            }
    
            if ($this->request->is('post') && !$result->isValid()) {
                $response = [
                    'status' => 401,
                    'message' => 'Usuario ó contraseña incorrectos.'
                ];
            }
        }

        if (isset($response)) {
            $this->setJsonResponse($response);
        }
    }
    

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions([
            'login', 'registrar'
        ]);
    }

    public function logout (){
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Authentication->logout();
            $this->request->getSession()->delete('Auth.User.profile');
            return $this->redirect([
                'controller' => 'Users',
                'action' => 'login'
            ]);
        }
    }
    
    /**
        @SWG\Post(
            path="/pruebaTecnica/users/registrar",
            summary="Servicio para registrar un usuario",
            tags={"Auth"},
            consumes={"application/json"},
            produces={"application/json"},
            @SWG\Parameter(
                name="_csrfToken",
                in="formData",
                description="CrsfToken",
                required=true,
                type="string"
            ),
            @SWG\Parameter(
                name="nombres",
                in="formData",
                description="Nombre de usuario",
                required=true,
                type="string"
            ),
            @SWG\Parameter(
                name="apellidos",
                in="formData",
                description="Nombre de usuario",
                required=true,
                type="string"
            ),
            @SWG\Parameter(
                name="usuario",
                in="formData",
                description="Nombre de usuario",
                required=true,
                type="string"
            ),
            @SWG\Parameter(
                name="correo",
                in="formData",
                description="Nombre de usuario",
                required=true,
                type="string"
            ),
            @SWG\Parameter(
                name="password",
                in="formData",
                description="Contraseña",
                required=true,
                type="string"
            ),
            @SWG\Response(
                response="200",
                description="Successful operation",
                @SWG\Schema(
                    type="object",
                    ref="#/definitions/register"
                )
            ),
            @SWG\Response(
                response=400,
                description="Bad request",
                @SWG\Schema(
                    type="object",
                    properties={
                        @SWG\Property(
                            property="status",
                            type="integer",
                            format="int32",
                        ),
                        @SWG\Property(
                            property="mensaje",
                            type="string",
                        )
                    }
                ),
            ),
            @SWG\Response(
                response=500,
                description="Internal error server",
                @SWG\Schema(
                    type="object",
                    properties={
                        @SWG\Property(
                            property="status",
                            type="integer",
                            format="int32",
                        ),
                        @SWG\Property(
                            property="mensaje",
                            type="string",
                        )
                    }
                ),
            ),
        )

        @SWG\Definition(
            definition="register",
            required={"nombres","apellidos","usuario","correo","password"},
            @SWG\Property(
                property="nombres",
                type="string",
                description="Nombres completos del usuario."
            ),
            @SWG\Property(
                property="apellidos",
                type="string",
                description="Apellidos completos del usuario."
            ),
            @SWG\Property(
                property="usuario",
                type="string",
                description="Nombre de usuario."
            ),
            @SWG\Property(
                property="correo",
                type="string",
                description="Correo del usuario."
            ),
            @SWG\Property(
                property="password",
                type="string",
                description="Contraseña del usuario"
            )
        )
     */
    public function registrar()
    {
        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            $existingUser = $this->findExistingUser($user);

            if ($existingUser) {
                $response = [
                    'status' => 400,
                    'message' => 'Ya existe un usuario creado con ese correo'
                ];
            } else if ($existingUserName = $this->findExistingUserName($user)) {
                $response = [
                    'status' => 400,
                    'message' => 'Ya existe un usuario creado como "' . $user->usuario . '"'
                ];
            } else {
                if ($this->Users->save($user)) {
                    $response = [
                        'status' => 200,
                        'message' => 'El usuario se ha agregado con éxito.'
                    ];
                } else {
                    $response = [
                        'status' => 500,
                        'message' => 'No se pudo agregar al usuario, por favor inténtelo más tarde.'
                    ];
                }
            }

            $this->setJsonResponse($response);
        }

        $this->set(compact('user'));
    }

    /**
     * Undocumented function
     *
     * @param [type] $userId
     * @return \Cake\Http\Response
     */
    public function userIdDelete($userId) {
        $this->autoRender = false;
        $user = $this->Users->get($userId);
    
        $response = [];
    
        if ($this->Users->delete($user)) {
            $response = [
                'status' => 200,
                'message' => 'Usuario eliminado con éxito.'
            ];
        } else {
            $response = [
                'status' => 500,
                'message' => 'No se pudo eliminar al usuario, por favor intentelo más tarde..'
            ];
        }
    
        $this->response = $this->response->withType('application/json')
            ->withStringBody(json_encode($response));
    
        return $this->response;
    }    

    private function findExistingUser($user)
    {
        return $this->Users->find()
            ->where(['correo' => $user->correo])
            ->first();
    }

    private function findExistingUserName($user)
    {
        return $this->Users->find()
            ->where(['usuario' => $user->usuario])
            ->first();
    }

    private function setJsonResponse(array $response)
    {
        $this->set([
            'response' => $response,
            '_serialize' => 'response',
        ]);
    }
    
}
