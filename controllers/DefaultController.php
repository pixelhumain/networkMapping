<?php
/**
 * DefaultController.php
 *
 * OneScreenApp for Communecting people
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class DefaultController extends Controller {

    const moduleTitle = "Network Mapping";
    public static $moduleKey = "networkMapping";
    public $keywords = "connecter, réseau, sociétal, citoyen, société, regrouper, commune, communecter, social";
    public $description = "Etat Généraux des pouvoirs citoyens : Connecter a sa commune, reseau societal, le citoyen au centre de la société.";
    
    
    public $sidebar1 = array(
      array('label' => "Qui", "key"=>"home","href"=>"javascript:;","onclick"=>"hideShow('.home')"),
      array('label' => "Quand", "key"=>"when","href"=>"javascript:;","onclick"=>"hideShow('.when')"),
      array('label' => "Pourquoi", "key"=>"why","href"=>"javascript:;","onclick"=>"hideShow('.why')"),
      array('label' => "Quoi", "key"=>"what","href"=>"javascript:;","onclick"=>"hideShow('.what')"),
      array('label' => "Mixitup", "key"=>"how","href"=>"?tpl=mixitup"),
    );

    protected function beforeAction($action)
  	{
  		Yii::app()->theme  = "oneScreenApp";
		  return parent::beforeAction($action);
  	}

    /**
     * 
     * @return [json Map] list
     */
	public function actionIndex() 
	{
      $searchTags = array();
      if(isset($_GET['tags']))
      {
        foreach (explode(",", $_GET['tags']) as $key)
          array_push($searchTags, array("tags"=>$key));
      }
      
      $params = array("app"=>$this::$moduleKey,
                      "fields"=>array("name","email","tags"));

      if(count($searchTags))
        $params["tags"] = array('$or'=>$searchTags);

      $params["where"] = array('$or' => array( array( "type"=>"association" ),
                                               array( "type"=>"entreprise" ),
                                               array( "type"=>"group" )));

      $groups = Group::getGroupsBy( $params );
      $tagsall = Group::getGroupsBy( array("app"=>$this::$moduleKey , "fields"=>array("tags")));
      $alltags = array();
      foreach ($tagsall as $key => $value) 
      {
        if(isset($value["tags"]))
        {
          foreach ( $value["tags"] as $t ) 
          {
            if(!in_array($t, $alltags) && $t!="")
            {
              array_push($alltags,$t);
            }
          }
        }
      }
      $events = Group::getGroupsBy( array("where"=>array("applications.".$this::$moduleKey.".usertype"=>"event") , "fields"=>array("name","date")));
      $msgs = Message::getMessagesBy( array("where"=>array("applications.".$this::$moduleKey.".usertype"=>"message") , "fields"=>array("msg","created")));
      $tpl = (isset($_GET['tpl'])) ? $_GET['tpl'] : "index";
	    $this->render( $tpl , array( "groups" => $groups ,
                                      "tagsall"=>$alltags,
                                      "msgs"=>$msgs,
                                      "events"=>$events ) );
	}
}