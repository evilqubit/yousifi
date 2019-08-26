<?php
class DynamicPage extends AppModel{
    public $name = 'DynamicPage';
    public $useTable = 'dynamic_pages';

    public $actsAs = array("Containable","Tree" ,"Translate"=>array('title','text','short'));

    public $translateModel = "DynamicPageI18n";
    public $translateTable = "dynamic_pages_i18n";
    public $cacheFolder = "dynamic_pages";
    public $locale = "eng";


    public $hasMany = array(
    //'Media' => array('className' => 'Media','foreignKey' => 'module_id','dependent'=> true, 'conditions'=>array('Media.module'=>'DynamicPage'), 'order' => 'position ASC' ,'recursive'=>3  ),
    //'RelatedContactFormEmail' => array('className' => 'RelatedContactFormEmail','foreignKey' => 'model_id','dependent'=> true  ),
    //'SubPage2' => array('className' => 'DynamicPage','foreignKey' => 'parent_id','dependent'=> true, 'order' => 'position ASC' ,'recursive'=>3)

        //'PagesRelation'=>array('className' => 'PagesRelation' ,"foreignKey"=>"source_id","conditions"=>array("PagesRelation.source_model"=>"DynamicPage"),'dependent'=> true)

    );


    // public $belongsTo = array(
        // 'ParentGroup' =>
            // array('className' => 'DynamicPage',
                  // 'foreignKey' => 'parent_id'
        // ),
     // );

    public $hasOne = array(
                "SeoManagement"=>array('className' => 'SeoManagement','foreignKey' => 'field_id','dependent'=> true,"conditions"=>array("SeoManagement.model_name"=>"DynamicPage"))

    );




    public function getJobDetails($locale)
    {
        return true;
    }

    function get_contact_branches($locale){
        $modelName = $this->name;
        $cacheId = "get_contact_branches_{$locale}";

        if((($data = Cache::read($cacheId,"$modelName")) === false)){

            $contain = array(
            "SeoManagement"=>array("fields"=>array("SeoManagement.id","SeoManagement.slug")));

            $contain = $this->generateContainableTranslations($modelName,$contain,$locale);
            $this->locale = $locale;


            $head_data = $this->find('first' ,array("fields"=>array("$modelName.id","$modelName.title","$modelName.text","$modelName.section","$modelName.sub_section","$modelName.x_coordinate","$modelName.y_coordinate"),
            'contain'=>$contain , 'conditions'=>array("DynamicPage.visible"=>1 , "DynamicPage.section"=>"contact_branches", "DynamicPage.sub_section"=>1),
            'order' => array('DynamicPage.position ASC', 'DynamicPage.id DESC')));


            $show_room_data = $this->find('all' ,array("fields"=>array("$modelName.id","$modelName.title","$modelName.text","$modelName.section","$modelName.sub_section","$modelName.x_coordinate","$modelName.y_coordinate"),
            'contain'=>$contain , 'conditions'=>array("DynamicPage.visible"=>1 , "DynamicPage.section"=>"contact_branches", "DynamicPage.sub_section"=>2),
            'order' => array('DynamicPage.position ASC', 'DynamicPage.id DESC')));

            $data['head']=$head_data;
            $data['show_room']=$show_room_data;




            //Cache::write($cacheId, $data,"$modelName");
        }

        //print_r($data);exit;
        return $data;
    }




    function get_home_our_business($locale){
        $modelName = $this->name;
        $cacheId = "get_home_our_business_{$locale}";

        if((($data = Cache::read($cacheId,"$modelName")) === false)){

            $contain = array("SeoManagement"=>array("fields"=>array("SeoManagement.id","SeoManagement.slug")));

            $contain = $this->generateContainableTranslations($modelName,$contain,$locale);
            $this->locale = $locale;

            $data = $this->find('all' ,array("fields"=>array("$modelName.id","$modelName.title","$modelName.section"),
            'contain'=>$contain ,
            'conditions'=>array("DynamicPage.visible"=>1  , "DynamicPage.show_on_home_page"=>1,"DynamicPage.section IN ('our_business_international','our_business_local')" ),
            'order' => array('DynamicPage.home_page_position ASC', 'DynamicPage.id DESC')));

//
            // $our_business_international = $this->find('all' ,array("fields"=>array("$modelName.id","$modelName.title","$modelName.section"),
            // 'contain'=>$contain ,
            // 'conditions'=>array("DynamicPage.visible"=>1 , "DynamicPage.show_on_home_page"=>1,"DynamicPage.section"=>'our_business_international' ),
            // 'order' => array('DynamicPage.position ASC', 'DynamicPage.id DESC')));
//
            // $data['locale']=$our_business_local;
            // $data['our_business_international']=$our_business_international;
//

            //our_business_local','our_business_international'
            Cache::write($cacheId, $data,"$modelName");
        }

        //print_r($data);exit;
        return $data;
    }



    function get_home_latest_news($locale){
        $modelName = $this->name;
        $cacheId = "get_home_latest_news_{$locale}";

        if((($data = Cache::read($cacheId,"$modelName")) === false)){

            $contain = array(
            "SeoManagement"=>array("fields"=>array("SeoManagement.id","SeoManagement.slug")));

            $contain = $this->generateContainableTranslations($modelName,$contain,$locale);
            $this->locale = $locale;

            $data = $this->find('all' ,array(
            'limit'=>3,
            "fields"=>array("$modelName.id","$modelName.title","$modelName.short","$modelName.date","$modelName.category_id"),
            'contain'=>$contain , 'conditions'=>array("DynamicPage.visible"=>1 ,"DynamicPage.section"=>'news_events' ),'order' => array('DynamicPage.date'=>'DESC','DynamicPage.position ASC', 'DynamicPage.id DESC')));

            Cache::write($cacheId, $data,"$modelName");
        }

        //print_r($data);exit;
        return $data;
    }

    function get_section_details($section  , $locale){
        $modelName = $this->name;
        $cacheId = "get_section_details_{$section}_{$locale}";

        if((($data = Cache::read($cacheId,"$modelName")) === false)){

            $contain = array(
            "SeoManagement"=>array("fields"=>array("SeoManagement.*")));

            $contain = $this->generateContainableTranslations($modelName,$contain,$locale);
            $this->locale = $locale;

            $data = $this->find('first' ,array(
            'limit'=>3,
            "fields"=>array("$modelName.*"),
            'contain'=>$contain , 'conditions'=>array("DynamicPage.section"=>$section ),'order' => array('DynamicPage.date'=>'ASC','DynamicPage.position ASC', 'DynamicPage.id DESC')));

            //Cache::write($cacheId, $data,"$modelName");
        }

        //print_r($data);exit;
        return $data;
    }





    function get_page_details($id  , $locale){
        $modelName = $this->name;
        $cacheId = "get_page_details_{$id}_{$locale}";

        if((($data = Cache::read($cacheId,"$modelName")) === false)){

            $contain = array(
            "SeoManagement"=>array("fields"=>array("SeoManagement.*")));

            $contain = $this->generateContainableTranslations($modelName,$contain,$locale);
            $this->locale = $locale;

            $data = $this->find('first' ,array(

            "fields"=>array("$modelName.*"),
            'contain'=>$contain , 'conditions'=>array("DynamicPage.id"=>$id , "DynamicPage.visible"=>1  ),'order' => array('DynamicPage.date'=>'ASC','DynamicPage.position ASC', 'DynamicPage.id DESC')));

            //Cache::write($cacheId, $data,"$modelName");
        }

        //print_r($data);exit;
        return $data;
    }

    function get_page_details_with_sub($id  , $locale){
        $modelName = $this->name;
        $cacheId = "get_page_details_with_sub_{$id}_{$locale}";

        if((($data = Cache::read($cacheId,"$modelName")) === false)){

            $contain = array(
            "SeoManagement"=>array("fields"=>array("SeoManagement.*")));

            $contain = $this->generateContainableTranslations($modelName,$contain,$locale);
            $this->locale = $locale;

            $data = $this->find('first' ,array(

            "fields"=>array("$modelName.*"),
            'contain'=>$contain , 'conditions'=>array("DynamicPage.id"=>$id , "DynamicPage.visible"=>1  ),'order' => array('DynamicPage.date'=>'ASC','DynamicPage.position ASC', 'DynamicPage.id DESC')));




            $parent_id=$data['DynamicPage']['id'];

            $sub_data = $this->find('all' ,array(

            "fields"=>array("$modelName.*"),
            'contain'=>$contain , 'conditions'=>array("DynamicPage.visible"=>1 ,"DynamicPage.parent_id"=>$parent_id ),'order' => array('DynamicPage.position'=>'ASC', 'DynamicPage.id DESC')));

            $data['children']=$sub_data;




            //Cache::write($cacheId, $data,"$modelName");
        }

        //print_r($data);exit;
        return $data;
    }

    function get_news_category_list( $locale){
        $modelName = $this->name;
        $cacheId = "get_news_category_list_{$locale}";

        if((($newsCategoryModelData = Cache::read($cacheId,"$modelName")) === false)){


            $contain = array(
            "SeoManagement"=>array("fields"=>array("SeoManagement.*")));

            $contain = $this->generateContainableTranslations('Category',$contain,$locale);
            $this->locale = $locale;

            $CategoryModelObj = ClassRegistry::init("Category");
            $newModelObj->locale = $locale;
            $newsCategoryModelData = $CategoryModelObj->find('all',array("contain"=>false,
            'order'=>array("Category.position"=>'ASC' , 'Category.id'=>'DESC'),
            'contain'=>$contain,
            "fields"=>array("Category.id","Category.title"),"conditions"=>array('Category.visible'=>1)));



            $contain = array(
            "SeoManagement"=>array("fields"=>array("SeoManagement.*")));

            $contain = $this->generateContainableTranslations($modelName,$contain,$locale);
            $this->locale = $locale;

            if(!empty($newsCategoryModelData)){
                foreach($newsCategoryModelData as $key=>$d){
                    $category_id=$d['Category']['id'];
                    $data = $this->find('all' ,array(

                    "fields"=>array("$modelName.*"),
                    'limit'=>3,
                    'contain'=>$contain , 'conditions'=>array("DynamicPage.section"=>'news_events' ,'DynamicPage.category_id'=>$category_id , "DynamicPage.visible"=>1  ),
                    'order' => array('DynamicPage.date'=>'ASC','DynamicPage.position ASC', 'DynamicPage.id DESC')));

                    if(!empty($data)){
                        $newsCategoryModelData[$key]['news_events']=$data;
                    }else{
                        unset($newsCategoryModelData[$key]);
                    }
                }

            }

            //print_r($newsCategoryModelData);exit;


            //Cache::write($cacheId, $newsCategoryModelData,"$modelName");
        }

        //print_r($data);exit;
        return $newsCategoryModelData;
    }



    function get_section_left_menu($section , $locale){
        $modelName = $this->name;
        $cacheId = "get_section_left_menu_{$locale}_{$section}";

        if((($data = Cache::read($cacheId,"$modelName")) === false)){

            $contain = array(
            "SeoManagement"=>array("fields"=>array("SeoManagement.id","SeoManagement.slug")));

            $contain = $this->generateContainableTranslations($modelName,$contain,$locale);
            $this->locale = $locale;

            $data = $this->find('all' ,array(

            "fields"=>array("$modelName.id","$modelName.title"),
            'contain'=>$contain , 'conditions'=>array("DynamicPage.visible"=>1 ,"DynamicPage.section"=>$section ,"DynamicPage.parent_id"=>0),'order' => array('DynamicPage.position'=>'ASC', 'DynamicPage.id DESC')));

            //Cache::write($cacheId, $data,"$modelName");
        }

        //print_r($data);exit;
        return $data;
    }


    function get_section_left_menu_multi_level($section , $locale){
        $modelName = $this->name;
        $cacheId = "get_section_left_menu_multi_level_{$locale}_{$section}";

        if((($data = Cache::read($cacheId,"$modelName")) === false)){

            $contain = array(
            "SeoManagement"=>array("fields"=>array("SeoManagement.id","SeoManagement.slug")));

            $contain = $this->generateContainableTranslations($modelName,$contain,$locale);
            $this->locale = $locale;

            $data = $this->find('all' ,array(

            "fields"=>array("$modelName.id","$modelName.title"),
            'contain'=>$contain , 'conditions'=>array("DynamicPage.visible"=>1 , "DynamicPage.parent_id"=>0 ,"DynamicPage.section"=>$section ),'order' => array('DynamicPage.position'=>'ASC', 'DynamicPage.id DESC')));

            foreach($data as $key=>$d){
                    $parent_id=$d['DynamicPage']['id'];

                    $sub_data = $this->find('all' ,array(

                    "fields"=>array("$modelName.id","$modelName.title"),
                    'contain'=>$contain , 'conditions'=>array("DynamicPage.visible"=>1 ,"DynamicPage.parent_id"=>$parent_id ),'order' => array('DynamicPage.position'=>'ASC', 'DynamicPage.id DESC')));

                $data[$key]['children']=$sub_data;

            }

            //Cache::write($cacheId, $data,"$modelName");
        }

        //print_r($data);exit;
        return $data;
    }


    function get_news_details($news_id , $locale){
        $modelName = $this->name;
        $cacheId = "get_news_details_{$locale}_{$news_id}";

        if((($data = Cache::read($cacheId,"$modelName")) === false)){

            $contain = array(
            "SeoManagement"=>array("fields"=>array("SeoManagement.*")));

            $contain = $this->generateContainableTranslations($modelName,$contain,$locale);
            $this->locale = $locale;

            $cond=array("$modelName.visible"=>1  ,"$modelName.id"=>$news_id);

            $data = $this->find('first' ,array(

            "fields"=>array("$modelName.*"),
            'contain'=>$contain , 'conditions'=>$cond));


            //Cache::write($cacheId, $data,"$modelName");
        }

        //print_r($data);exit;
        return $data;
    }




    function getAllSubpageOfIdSet($IdSet ,$locale = 'eng'){

        $modelName = $this->name;
        $cacheId = "{$locale}_getAllSubpageOfSelectedParent_{$IdSet}";

        if((($mainData = Cache::read($cacheId,"$modelName")) === false)){


            $MainArray=array();
            $all_id=array();
            $index=0;

            foreach($IdSet as $cuurent_id){
                $idArray=array();
                if(!(in_array($cuurent_id, $all_id))){
                    array_push($idArray,$cuurent_id);
                    array_push($all_id,$cuurent_id);
                }

                $d=$this->children($cuurent_id,false,array("id"));

                foreach($d as $sub){
                    if(!(in_array($sub['DynamicPage']['id'], $all_id)) ){
                        array_push($idArray,$sub['DynamicPage']['id']);
                        array_push($all_id,$sub['DynamicPage']['id']);
                    }
                }

                if(!empty($idArray)){
                    $MainArray["$index"]=$idArray;
                }
                $index++;
            }



            $data=array();
            foreach($MainArray as $key=>$ids){
                $contain = array(
                "SeoManagement"=>array("fields"=>array("SeoManagement.id","SeoManagement.slug")));

                $contain = $this->generateContainableTranslations($modelName,$contain,$locale);
                $this->locale = $locale;

                $current_data = $this->find('threaded' ,array("fields"=>array("$modelName.*"),
                'contain'=>$contain , 'conditions'=>array("DynamicPage.id"=>$ids ),'order' => array('DynamicPage.position ASC', 'DynamicPage.id DESC')));
                //print_r($current_data);exit;
                $data["$key"]=$current_data[0];
            }


            Cache::write($cacheId, $data,"$modelName");
        }

        return $data;
    }

    function getAllSubpageIdsOfSelectedParents($parent_ids){

        $modelName = $this->name;
        $cacheId = "getAllSubpageIdsOfSelectedParents_{$parent_ids}";

        //print_r($parent_ids);exit;
        if((($data = Cache::read($cacheId,"$modelName")) === false)){

            //$MainArray=array();
            $all_id=array();
            $index=0;
            $idArray=array();
            foreach($parent_ids as $pID){

                if(!(in_array($pID, $all_id))){
                    array_push($idArray,$pID);
                    array_push($all_id,$pID);
                }

                $d=$this->children($pID,false,array("id", 'visible'));


                foreach($d as $sub){
                    if(!(in_array($sub['DynamicPage']['id'], $all_id)) ){
                        if($sub["DynamicPage"]['visible'] == 1){
                            array_push($idArray,$sub['DynamicPage']['id']);
                            array_push($all_id,$sub['DynamicPage']['id']);
                        }

                    }
                }

            }



            if(!empty($idArray)){
                $data=$idArray;
            }else{
                $data='';
            }

        Cache::write($cacheId, $data,"$modelName");
        }

        return $data;
    }

    function getAllSubpageIdsOfSelectedParent($parent_id ,$locale = 'eng'){

        $modelName = $this->name;
        $cacheId = "{$locale}_getAllSubpageIdsOfSelectedParent_{$parent_id}";

        if((($data = Cache::read($cacheId,"$modelName")) === false)){

            $MainArray=array();
            $all_id=array();
            $index=0;


            $idArray=array();
            if(!(in_array($parent_id, $all_id))){
                array_push($idArray,$parent_id);
                array_push($all_id,$parent_id);
            }

            $d=$this->children($parent_id,false,array("id" , "visible"));


            foreach($d as $sub){
                if(!(in_array($sub['DynamicPage']['id'], $all_id)) ){

                    if($sub["DynamicPage"]['visible'] == 1){
                        array_push($idArray,$sub['DynamicPage']['id']);
                        array_push($all_id,$sub['DynamicPage']['id']);
                    }
                }
            }

            if(!empty($idArray)){
                $data=$idArray;
            }else{
                $data='';
            }
        Cache::write($cacheId, $data,"$modelName");
        }

        return $data;
    }


    function getAllSubpageOfSelectedParent($parent_id ,$locale = 'eng'){

        $modelName = $this->name;
        $cacheId = "{$locale}_getAllSubpageOfSelectedParent_{$parent_id}";

        if((($data = Cache::read($cacheId,"$modelName")) === false)){

            $MainArray=array();
            $all_id=array();
            $index=0;


            $idArray=array();
            if(!(in_array($parent_id, $all_id))){
                array_push($idArray,$parent_id);
                array_push($all_id,$parent_id);
            }

            $d=$this->children($parent_id,false,array("id", "visible", "parent_id"));
            //$d=$this->generateTreeList(array("$modelName.id"=>$parent_id));


            //print_R($d);exit;
            $invisible_array=array();
            foreach($d as $sub){
                $id=$sub['DynamicPage']['id'];
                $visible=$sub['DynamicPage']['visible'];
                $parent_id=$sub['DynamicPage']['parent_id'];

                if(($visible != 1)){
                    array_push($invisible_array,$id);
                }

                if(!(in_array($id, $invisible_array)) && !(in_array($parent_id, $invisible_array)) ){
                    if(!(in_array($id, $all_id)) ){
                        array_push($idArray,$id);
                        array_push($all_id,$id);
                    }
                }else{
                    array_push($invisible_array,$id);
                }

            }

            if(!empty($idArray)){
                $MainArray=$idArray;
            }

            $MainArray=implode(',', $MainArray);

            $index++;
            $data=array();
            //foreach($MainArray as $key=>$ids){
                $contain = array(
                "SeoManagement"=>array("fields"=>array("SeoManagement.*")));

                $contain = $this->generateContainableTranslations($modelName,$contain,$locale);
                $this->locale = $locale;

                $current_data = $this->find('threaded' ,array("fields"=>array("$modelName.*"),

                'contain'=>$contain , 'conditions'=>array("DynamicPage.id IN ($MainArray)" , "$modelName.visible"=>1),'order' => array('DynamicPage.position ASC', 'DynamicPage.id DESC')));
                //print_r($current_data);exit;
                $data=$current_data[0];
            //}

            //Cache::write($cacheId, $data,"$modelName");
        }

        //print_r($data);exit;
        return $data;
    }



    function check_number_of_children($parent_id ,$locale = 'eng'){

        $modelName = $this->name;
        $cacheId = "{$locale}_check_number_of_children_{$parent_id}";

        if((($data = Cache::read($cacheId,"$modelName")) === false)){

            $MainArray=array();
            $all_id=array();
            $index=0;


            $idArray=array();


            $d=$this->children($parent_id,false,array("id"));

            if(!empty($d)){
                foreach($d as $sub){
                    if(!(in_array($sub['DynamicPage']['id'], $all_id)) ){
                        array_push($idArray,$sub['DynamicPage']['id']);
                        array_push($all_id,$sub['DynamicPage']['id']);
                    }
                }

                if(!empty($idArray)){
                    $MainArray=$idArray;
                }

                $MainArray=implode(',', $MainArray);

                $index++;
                $data=array();

                    $this->locale = $locale;


                    $joins= array(
                     array('table' => 'landing_boxes',
                        'alias' => 'LandingBox',
                        'type' => 'INNER',
                        'conditions' => array(
                            'LandingBox.page_id= DynamicPage.id',
                            'LandingBox.section'=>'academic_affairs'
                        )
                     ));


                    $current_data = $this->find('count' ,array(
                    'fields'=>array('DynamicPage.id'),
                    'contain'=>false ,'joins'=>$joins,
                    'conditions'=>array("DynamicPage.id IN ($MainArray)" , "DynamicPage.visible"=>1),
                    ));

                    $data=$current_data;
            }else{
                $data=0;
            }
            //}

            //Cache::write($cacheId, $data,"$modelName");
        }

        //print_r($data);exit;
        return $data;
    }
    function getFirstSubpageOfSelectedParent($parent_id ,$locale = 'eng'){

        $modelName = $this->name;
        $cacheId = "{$locale}_getFirstSubpageOfSelectedParent_{$parent_id}";

        if((($data = Cache::read($cacheId,"$modelName")) === false)){

            $MainArray=array();
            $all_id=array();
            $index=0;


            $idArray=array();
            if(!(in_array($parent_id, $all_id))){
                array_push($idArray,$parent_id);
                array_push($all_id,$parent_id);
            }

            $d=$this->children($parent_id,true,array("id"));


            foreach($d as $sub){
                if(!(in_array($sub['DynamicPage']['id'], $all_id)) ){
                    array_push($idArray,$sub['DynamicPage']['id']);
                    array_push($all_id,$sub['DynamicPage']['id']);
                }
            }

            if(!empty($idArray)){
                $MainArray=$idArray;
            }

            $MainArray=implode(',', $MainArray);
            //print_r($MainArray);exit;
            $index++;
            $data=array();
            //foreach($MainArray as $key=>$ids){
                // $contain = array(
                // "SeoManagement"=>array("fields"=>array("SeoManagement.id","SeoManagement.slug")));
//
                // $contain = $this->generateContainableTranslations($modelName,$contain,$locale);
                $this->locale = $locale;


                $joins= array(
                 array('table' => 'landing_boxes',
                    'alias' => 'LandingBox',
                    'type' => 'INNER',
                    'conditions' => array(
                        'LandingBox.page_id= DynamicPage.id',
                        'LandingBox.section'=>'academic_affairs'
                    )
                 ));


                $current_data = $this->find('threaded' ,array(
                'fields'=>array('DynamicPage.id','DynamicPage.parent_id','DynamicPage.title','DynamicPage.text' ,"LandingBox.url_prefix","LandingBox.url"),
                'contain'=>false ,'joins'=>$joins,  'conditions'=>array("DynamicPage.id IN ($MainArray)" , "DynamicPage.visible"=>1),'order' => array('DynamicPage.position ASC', 'DynamicPage.id DESC')));
                //print_r($current_data);exit;
                $data=$current_data[0];
            //}

            //Cache::write($cacheId, $data,"$modelName");
        }

        //print_r($data);exit;
        return $data;
    }

    function getAllSubpageOfSelectedParentLimitedFields($parent_id ,$locale = 'eng'){

        $modelName = $this->name;
        $cacheId = "{$locale}_getAllSubpageOfSelectedParentLimitedFields_{$parent_id}";

        if((($data = Cache::read($cacheId,"$modelName")) === false)){

            $MainArray=array();
            $all_id=array();
            $index=0;


            $idArray=array();
            if(!(in_array($parent_id, $all_id))){
                array_push($idArray,$parent_id);
                array_push($all_id,$parent_id);
            }

            $d=$this->children($parent_id,false,array("id"));


            foreach($d as $sub){
                if(!(in_array($sub['DynamicPage']['id'], $all_id)) ){
                    array_push($idArray,$sub['DynamicPage']['id']);
                    array_push($all_id,$sub['DynamicPage']['id']);
                }
            }

            if(!empty($idArray)){
                $MainArray=$idArray;
            }

            $MainArray=implode(',', $MainArray);
            //print_r($MainArray);exit;
            $index++;
            $data=array();
            //foreach($MainArray as $key=>$ids){
                // $contain = array(
                // "SeoManagement"=>array("fields"=>array("SeoManagement.id","SeoManagement.slug")));
//
                // $contain = $this->generateContainableTranslations($modelName,$contain,$locale);
                $this->locale = $locale;


                $joins= array(
                 array('table' => 'landing_boxes',
                    'alias' => 'LandingBox',
                    'type' => 'INNER',
                    'conditions' => array(
                        'LandingBox.page_id= DynamicPage.id',
                        'LandingBox.section'=>'academic_affairs'
                    )
                 ));


                $current_data = $this->find('threaded' ,array(
                'fields'=>array('DynamicPage.id','DynamicPage.parent_id','DynamicPage.title','DynamicPage.text' ,"LandingBox.url_prefix","LandingBox.url"),
                'contain'=>false ,'joins'=>$joins,  'conditions'=>array("DynamicPage.id IN ($MainArray)" , "DynamicPage.visible"=>1),'order' => array('DynamicPage.position ASC', 'DynamicPage.id DESC')));
                //print_r($current_data);exit;
                $data=$current_data[0];
            //}

            //Cache::write($cacheId, $data,"$modelName");
        }

        //print_r($data);exit;
        return $data;
    }
    function get_page_children_without_parent($parent_id , $locale){

        $modelName = $this->name;
        $cacheId = "get_page_children_without_parent{$parent_id}_{$locale}";

        if((($data = Cache::read($cacheId,"$modelName")) === false)){

            $MainArray=array();
            $all_id=array();
            $index=0;


            $idArray=array();
            if(!(in_array($parent_id, $all_id))){
                //array_push($idArray,$parent_id);
                array_push($all_id,$parent_id);
            }

            $d=$this->children($parent_id,false,array("id"));


            foreach($d as $sub){
                if(!(in_array($sub['DynamicPage']['id'], $all_id)) ){
                    array_push($idArray,$sub['DynamicPage']['id']);
                    array_push($all_id,$sub['DynamicPage']['id']);
                }
            }

            if(!empty($idArray)){
                $MainArray=$idArray;
            }

        //  print_r($MainArray);exit;

            //get the seo for each entry

            $index=0;
            $newModelObj = ClassRegistry::init("SeoManagement");
            $newModelObj->locale = $locale;
            foreach($MainArray as $entry){
                $data["$index"]['id']=$entry;
                $id=$entry;
                $cond=array("SeoManagement.model_name"=>'DynamicPage',"SeoManagement.field_id"=>$id);
                //print_r($cond);exit;
                $slug = $newModelObj->find('first',array("contain"=>false,"fields"=>array("SeoManagement.id","SeoManagement.slug"),"conditions"=>$cond));


                $data["$index"]['slug']=$slug['SeoManagement']['slug'];
                $index++;
            }

            Cache::write($cacheId, $data,"$modelName");
        }


        return $data;
    }
    function get_page_children($parent_id , $locale){

        $modelName = $this->name;
        $cacheId = "get_page_children_{$parent_id}_{$locale}";

        if((($data = Cache::read($cacheId,"$modelName")) === false)){

            $MainArray=array();
            $all_id=array();
            $index=0;


            $idArray=array();
            if(!(in_array($parent_id, $all_id))){
                //array_push($idArray,$parent_id);
                array_push($all_id,$parent_id);
            }

            $d=$this->children($parent_id,false,array("id"));


            foreach($d as $sub){
                if(!(in_array($sub['DynamicPage']['id'], $all_id)) ){
                    array_push($idArray,$sub['DynamicPage']['id']);
                    array_push($all_id,$sub['DynamicPage']['id']);
                }
            }

            if(!empty($idArray)){
                $MainArray=$idArray;
            }

        //  print_r($MainArray);exit;

            //get the seo for each entry

            $index=0;
            $newModelObj = ClassRegistry::init("SeoManagement");
            $newModelObj->locale = $locale;
            foreach($MainArray as $entry){
                $data["$index"]['id']=$entry;
                $id=$entry;
                $cond=array("SeoManagement.model_name"=>'DynamicPage',"SeoManagement.field_id"=>$id);
                //print_r($cond);exit;
                $slug = $newModelObj->find('first',array("contain"=>false,"fields"=>array("SeoManagement.id","SeoManagement.slug"),"conditions"=>$cond));


                $data["$index"]['slug']=$slug['SeoManagement']['slug'];
                $index++;
            }

            Cache::write($cacheId, $data,"$modelName");
        }


        return $data;
    }


    function get_page_children_witout_seo($parent_id ){

        $modelName = $this->name;
        $cacheId = "get_page_children_witout_seo_{$parent_id}";

        if((($data = Cache::read($cacheId,"$modelName")) === false)){

            $MainArray=array();
            $all_id=array();
            $index=0;


            $idArray=array();
            if(!(in_array($parent_id, $all_id))){
                //array_push($idArray,$parent_id);
                array_push($all_id,$parent_id);
            }

            $d=$this->children($parent_id,false,array("id"));


            foreach($d as $sub){
                if(!(in_array($sub['DynamicPage']['id'], $all_id)) ){
                    array_push($idArray,$sub['DynamicPage']['id']);
                    array_push($all_id,$sub['DynamicPage']['id']);
                }
            }

            if(!empty($idArray)){
                $MainArray=$idArray;
            }
            $index=0;
            foreach($MainArray as $entry){
                $data["$index"]['id']=$entry;
                $index++;
            }

            Cache::write($cacheId, $data,"$modelName");
        }


        return $data;
    }



     /* Used in admin interface */
    function getParentsList($currPageId = 0,$otherRelatedModels=array()){
        $locale = $this->locale;
        $modelName = "DynamicPage";
//      $parentsList = $this->find("all",array("conditions"=>array("$modelName.id > 1","$modelName.parent_id"=>0,"$modelName.id != $currPageId"),"contain"=>array("SubPage"=>array("fields"=>array("SubPage.id","SubPage.title"),"conditions"=>array("SubPage.id != $currPageId"))),"fields"=>array("$modelName.id","$modelName.section","$modelName.title"),"order"=>array("$modelName.id"=>"ASC","$modelName.position"=>"ASC")));

        $returnList = array();
//      $returnList[$modelName] = $parentsList;



        if(!empty($otherRelatedModels)){
            foreach ($otherRelatedModels as $model=>$modelData) {
                $aliasModel = $model;

                if($model == 'HeaderCommunicationBanner'){
                    $modelCond = array("HeaderCommunicationBanner.type"=>'internal');
                }else{
                    $modelCond = array("1=1");
                }




                $newModelObj = ClassRegistry::init($model);
                $newModelObj->locale = $locale;
                $newModelData = $newModelObj->find('list',array("contain"=>false,"fields"=>array("$model.id","$model.title"),"conditions"=>array($modelCond)));

                $returnList[$aliasModel] = $newModelData;
            }
        }

        return $returnList;
    }

    function beforeSave(){


    }






    function afterSave(){


        Cache::clearGroup($this->cacheFolder);


    }

    function afterDelete(){

        Cache::clearGroup($this->cacheFolder);

    }

function beforeDelete(){
        // $modelName = $this->name;
        // $id=$this->id;
//
        // App::uses('CakeSession', 'Model/Datasource');
        // $user_id = CakeSession::read('Admin.admin_name');
//
        // $msg = "model_name : $modelName  , model id : $id  , account : $user_id   , status : delete";
//
        // $this->log("events" , $msg);


    }

}