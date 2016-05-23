<?php
namespace AppBundle\EventListener;

// ...

use AppBundle\Model\MenuItemModel;
use CorentinRegnier\AdminTemplateBundle\Event\SidebarMenuEvent;
use Symfony\Component\HttpFoundation\Request;

class MyMenuItemListListener {

    // ...

    public function onSetupMenu(SidebarMenuEvent $event) {

        $request = $event->getRequest();

        foreach ($this->getMenu($request) as $item) {
            $event->addItem($item);
        }

    }

    protected function getMenu(Request $request) {

        // Build your menu here by constructing a MenuItemModel array
        $student = new MenuItemModel('liststudent', 'Liste des étudiants', 'student_index', array(/* options */), 'fa fa-list');

        // Build your menu here by constructing a MenuItemModel array
        $calendar = new MenuItemModel('calendar', 'Calendrier', 'event_index', array(/* options */), 'fa fa-calendar');

        // Build your menu here by constructing a MenuItemModel array
        $classe = new MenuItemModel('listclasse', 'Liste des classes', 'classe_index', array(/* options */), 'iconclasses fa fa-users');
        // Build your menu here by constructing a MenuItemModel array

        $admin = new MenuItemModel('administration', 'Profil', 'fos_user_profile_show', array(/* options */), 'iconclasses fa fa-user');

        
        // Add some children
        
        // A child with an icon
        //$admin->addChild(new MenuItemModel('editpwd', 'Éditer mot de passe', 'fos_user_change_password', array(), 'fa fa-unlock-alt'));

        // A child with default circle icon
        //$admin->addChild(new MenuItemModel('editprofile', 'Éditer profil', 'fos_user_profile_show', array(), 'fa fa-user-plus'));

        $menu=array($calendar,$student,$admin,$classe);

        return $this->activateByRoute($request->get('_route'), $menu);
    }

    protected function activateByRoute($route, $items) {

        foreach($items as $item) {
            if($item->hasChildren()) {
                $this->activateByRoute($route, $item->getChildren());
            }
            else {
                if($item->getRoute() == $route) {
                    $item->setIsActive(true);
                }
            }
        }

        return $items;
    }

}