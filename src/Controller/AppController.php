<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

       /* if ($this->request->getParam('prefix') != 'services') {
               $this->loadComponent('Auth', [
                    'loginRedirect' => [
                        'controller' => 'Admins',
                        'action' => 'index'
                    ],
                    'loginAction' => [
                        'controller' => 'Admins',
                        'action' => 'login'
                    ],
                    'logoutRedirect' => [
                        'controller' => 'Admins',
                        'action' => 'index',
                        'home'
                    ],
                    'authError' => false,
                    'authenticate' => [
                      'Form' => ['userModel' => 'Admins', 'fields' => ['username' => 'username']],
                    ],
                    'storage' => 'Session'
                    
                ]);
            if ($this->Auth->user()){
                $loggedUser = ucfirst($this->Auth->user('first_name')).' '.(!empty($this->Auth->user('last_name'))?ucfirst($this->Auth->user('last_name')):'');
                $loggedId = $this->Auth->user('id');
                $this->set('loggedUser', $loggedUser);
                $this->set('loggedId', $loggedId);
            }                       
        }        */     
        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        $this->loadComponent('Security');
        $this->loadComponent('Csrf');        
        $this->loadComponent('Cookie', ['expires' => '+10 days']);
        $actions = [
          
        ];

        if (in_array($this->request->params['action'], $actions)) {
          // for csrf
          $this->eventManager()->off($this->Csrf);

          // for security component
          $this->Security->config('unlockedActions', $actions);
        }      
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
