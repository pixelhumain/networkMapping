<?php
/**
 * DefaultController.php
 *
 * API REST pour géré l'application EGPC
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 01/05/2014
 */
class ApiController extends Controller {

    const moduleTitle = "Network Mapping";
    public static $moduleKey = "networkMapping";
    public $percent = 60; //TODO link it to unit test

    protected function beforeAction($action)
    {
        array_push($this->sidebar1, array('label' => "All Modules", "key"=>"modules","iconClass"=>"fa fa-th",  "menuOnly"=>true,"children"=>PH::buildMenuChildren("applications") ));
        return parent::beforeAction($action);
    }

    public function actions()
    {
        array_push($this->sidebar1,Api::getUserMap());
        $groupMap = Api::getGroupMap();
        array_push($groupMap["children"], Api::$apis["confirmUserRegistration"]);
        array_push($groupMap["children"], Api::$apis["linkUser2Group"]);
        array_push($this->sidebar1, $groupMap);
        array_push($this->sidebar1, Api::getAdminPHMap());

        return Api::buildActionMap($this->sidebar1);
    }
}