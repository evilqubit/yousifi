<?php
App::uses('Sanitize', 'Utility');
class DynamicPagesController extends AppController{
    public $name = "DynamicPages";
    public $uses = array("DynamicPage");
    public $components = array("FileUpload","StringManipulation");
    public $modelName = "DynamicPage";
    public $controllerName = "DynamicPages";

    var $userFilesFolder = "dynamic_pages";

    var $contact_sub_section=array( '2'=>'Showrooms' ,"1"=>'Head Office' );


    function beforeFilter(){
        parent::beforeFilter();
        if(empty($this->request->params["admin"])){

        }else{


            // if($this->Session->read("Admin.level") != 1){
                // $this->Session->setFlash("You don't have enought permissions to access this page","admin/admin_err");
                // $this->redirect("/admin/Administrators/index");
                // exit;
            // }
        }
    }

    function beforeRender(){
        $controllerName = $this->controllerName;
        $modelName = $this->modelName;
        $this->set('modelName',$modelName);
        $this->set('controllerName',$controllerName);
        $page_number=1;
        if(isset($this->params['paging'][$modelName]['page'])){
            $page_number=$this->params['paging'][$modelName]['page'];
        }
        $this->set("page_number",$page_number);
    }
    function admin_upload_pdf_snapshoot($pdf , $size){

        $modelName = $this->modelName;
        $controllerName = $this->controllerName;
        $userFilesFolder=$this->userFilesFolder;


        $imgMagickPath = Configure::read("IMAGEMAGIC");
        $file_name=$pdf['eng'];

        $file_split=split('.pdf', $file_name);



        if($size == 'pdf_image'){
            $image_name=$file_split[0].'.png';


            $fileSource = WWW_ROOT."files/$userFilesFolder/pdf/$file_name";
            $fileDest = WWW_ROOT."files/$userFilesFolder/original/$image_name";

            $command = $imgMagickPath."/convert -density 300 -colorspace rgb \"$fileSource\"[0] -scale '217x153' \"$fileDest\"";
        }elseif($size == 'large_pdf_image'){
            $image_name=$file_split[0].'_larg.png';


            $fileSource = WWW_ROOT."files/$userFilesFolder/pdf/$file_name";
            $fileDest = WWW_ROOT."files/$userFilesFolder/original/$image_name";

            $command = $imgMagickPath."/convert -density 300 -colorspace rgb \"$fileSource\"[0] -scale '235x316' \"$fileDest\"";
        }



        @passthru($command);


        //resize the image

        $resizeOpStart='';
        $resizeOpEnd='>';
        umask(000);




        //preview resize
        $previewWidth = "217";
        $previewHeight = "153";
        $fileSource = WWW_ROOT."files/$userFilesFolder/original/$image_name";
        $fileDest = WWW_ROOT."files/$userFilesFolder/preview/$image_name";
        //print_r($fileSource);exit;
        $command = $imgMagickPath."/convert -compress jpeg -quality 100 \"$fileSource\" -scale '$resizeOpStart{$previewWidth}x{$previewHeight}$resizeOpEnd' \"$fileDest\"";
        @passthru($command);



        //thumb resize
        $thumbWidth = "100";
        $thumbHeight = "100";
        $fileSource = WWW_ROOT."files/$userFilesFolder/original/$image_name";
        $fileDest = WWW_ROOT."files/$userFilesFolder/thumb/$image_name";

        $command = $imgMagickPath."/convert -compress jpeg -quality 100 \"$fileSource\" -scale '$resizeOpStart{$thumbWidth}x{$thumbHeight}$resizeOpEnd' \"$fileDest\"";
        @passthru($command);


        return $image_name;

    }




    function set_page_title($type='default'){
        $menutypeId='';


        switch ($type){
            case 'about_us':{
                    $page_title="About Us List";
                    $page_sub_title="About Us";
                    $menuSectionId="about_us";
                    $menuFlag=1;

                }
                break;

            case 'our_business_local':{
                    $page_title="Our Business Locale List";
                    $page_sub_title="Our Business Locale";
                    $menuSectionId="our_business";
                    $menuFlag=1;

                }
                break;

            case 'our_business_international':{
                    $page_title="Our Business International List";
                    $page_sub_title="Our Business International";
                    $menuSectionId="our_business";
                    $menuFlag=1;

                }
                break;


            case 'our_brands':{
                    $page_title="Our Brands List";
                    $page_sub_title="Our Brands";
                    $menuSectionId="our_brands";
                    $menuFlag=1;

                }
                break;

            case 'news_events':{
                    $page_title="News & Events List";
                    $page_sub_title="News & Events";
                    $menuSectionId="news_events";
                    $menuFlag=1;

                }
                break;

            case 'default':{
                    $page_title="department";
                    $page_sub_title="department";
                    $menuSectionId="about_aud_menu";
                    $menuFlag=1;

                }
                break;
            case 'careers':{
                    $page_title="Careers Details";
                    $page_sub_title="Careers Details";
                    $menuSectionId="careers";
                    $menuFlag=1;

                }
                break;

            case 'contact':{
                    $page_title="Contact Details";
                    $page_sub_title="Contact Details";
                    $menuSectionId="contact";
                    $menuFlag=1;

                }
                break;

            case 'contact_branches':{
                    $page_title="Contact Branches List";
                    $page_sub_title="Contact Branches";
                    $menuSectionId="contact";
                    $menuFlag=1;

                }
                break;

                // Added default values
            default:{
                    $page_title="";
                    $page_sub_title="";
                    $menuSectionId="";
                    $menuFlag=0;
                }
                break;
                // End of default values
            }



        $this->set("menuFlag",$menuFlag);
        $this->set("page_title",$page_title);
        $this->set("page_sub_title",$page_sub_title);
        $this->set("menuSectionId",$menuSectionId);



    }


    function set_video_cover_preferred_size($module='default'  , $type='default'){
        $video_cover_preferred_size='';
        if($module == 'informative'){
            $video_cover_preferred_size='227 x 129 px';
        }



        $this->set(compact('video_cover_preferred_size'));
    }


    function get_image_resizes($type="informative"){
        $userFilesFolder=$this->userFilesFolder;

        switch ($type){
            case "about_us":


                $thumbWidth = "204";
                $thumbHeight = "130";

                $previewWidth = "470";
                $previewHeight = "300";

                $resizes = array(
                array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),
                array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
                );

                break;

            case "our_business_local":


                $thumbWidth = "204";
                $thumbHeight = "130";

                $previewWidth = "470";
                $previewHeight = "300";

                $resizes = array(
                array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),
                array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
                );

                break;

            case "our_business_international":


                $thumbWidth = "204";
                $thumbHeight = "130";

                $previewWidth = "470";
                $previewHeight = "300";

                $resizes = array(
                array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),
                array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
                );

                break;


            case "our_brands":


                $thumbWidth = "204";
                $thumbHeight = "130";

                $previewWidth = "470";
                $previewHeight = "300";

                $resizes = array(
                array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),
                array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
                );

                break;
            case "news_events":


                $thumbWidth = "204";
                $thumbHeight = "130";

                $previewWidth = "570";
                $previewHeight = "370";

                $resizes = array(
                array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),
                array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
                );

                break;

            // Added default value
            default :
                $resizes = array();
                break;
            // End of default value


        }

        return $resizes;

    }
    function set_preferred_size($type='informative'){
        $preferred_size='';
        if($type == 'about_us'){
            $preferred_size='470 x 300 px';
        }
        if($type == 'our_business_local'){
            $preferred_size='470 x 300 px';
        }

        if($type == 'our_business_international'){
            $preferred_size='470 x 300 px';
        }

        if($type == 'our_brands'){
            $preferred_size='470 x 300 px';
        }

        if($type == 'news_events'){
            $preferred_size='570 x 370 px';
        }




        $this->set(compact('preferred_size'));
    }


    //// size of images for media section
    function set_media_preferred_size($type='informative'){
        $media_preferred_size='';
        if($type == 'informative'){
            $media_preferred_size='227 x 129 px';
        }
        $this->set(compact('media_preferred_size'));
    }


    function fill_empty_fields(){
        $controllerName = $this->controllerName;
        $modelName = $this->modelName;

        $cacheId = "all_languages";
        if (($languages = Cache::read($cacheId)) === false) {
            $this->loadModel("Language");
            $languages=$this->Language->find('all',array('callbacks'=>false));
            Cache::write($cacheId, $languages);
        }

        foreach ($languages as $lang){
            $locale = $lang["Language"]["locale"];

            if(!isset($this->request->data["$modelName"]['title']["$locale"])){
                $this->request->data["$modelName"]['title']["$locale"]='';
            }

            if(!isset($this->request->data["$modelName"]['text']["$locale"])){
                $this->request->data["$modelName"]['text']["$locale"]='';
            }

            if(!isset($this->request->data["$modelName"]['short']["$locale"])){
                $this->request->data["$modelName"]['short']["$locale"]='';
            }
        }
    }

    function admin_index_contact($list_all=0){

        $modelName = $this->modelName;
        $controllerName = $this->controllerName;
        $userFilesFolder=$this->userFilesFolder;
        $this->set("modelName",$modelName);
        $this->set("controllerName",$controllerName);
        $this->set("list_all",$list_all);

        $section='contact_branches';
        $this->set("section",$section);

        $this->set("contact_sub_section",$this->contact_sub_section);
        $this->set_page_title($section);

        $this->loadModel("Category");
        $categories_list=$this->Category->find("list",array('fields'=>array("Category.title") , 'order'=>array('Category.title'=>'ASC')));
        $this->set("categories_list",$categories_list);



        $search_cond="";

        $search_cond="";
        if(isset($_GET['s'])){
            $search_phrase=$_GET['s'];
            //print_r($search_phrase);exit;
            $search_phrase = Sanitize::clean($search_phrase, array('encode' => false));
            $search_cond="($modelName.title like '%$search_phrase%')";

            $this->set('search_phrase',$search_phrase);
        }


        if(!empty($category_id) && ($category_id > 0)){
            $cond = array("$modelName.section"=>$section , "$modelName.parent_id"=>0  , "$modelName.category_id"=>$category_id  , $search_cond);
        }else{
            $cond = array("$modelName.section"=>$section , "$modelName.parent_id"=>0 , $search_cond);
        }


        $fields = array("$modelName.id","$modelName.title" ,"$modelName.modified","$modelName.date" ,"$modelName.sub_section" , "$modelName.category_id" ,"$modelName.visible");



        if ($list_all == 0){
            $this->paginate = array(
                'fields' => $fields,
                'limit' => 40,
                'order' => array("$modelName.position" => 'ASC',"$modelName.id" => 'DESC'),
                'conditions' => $cond,
                'contain'=>false
            );
        }
        else{
            $this->paginate = array(
                'fields' => $fields,
                'order' => array("$modelName.position" => 'ASC',"$modelName.id" => 'DESC'),
                'conditions' => $cond,
                'contain'=>false
            );
        }

        $data = $this->paginate($modelName);

        $this->set('data', $data);


    }


    function admin_index_order($list_all=0){

        $modelName = $this->modelName;
        $controllerName = $this->controllerName;
        $userFilesFolder=$this->userFilesFolder;
        $this->set("modelName",$modelName);
        $this->set("controllerName",$controllerName);
        $this->set("list_all",$list_all);

        $section='our_business_local';
        $this->set("section",$section);

        $this->set_page_title($section);


        $search_cond = "1=1";

        if(isset($_GET['s'])){
            $search_phrase=$_GET['s'];
            $search_phrase = Sanitize::clean($search_phrase, array('encode' => false));
            $search_cond="($modelName.title like '%$search_phrase%')";

            $this->set('search_phrase',$search_phrase);
        }

        $cond = array($search_cond);

        $fields = array("$modelName.id","$modelName.title" ,"$modelName.modified", "$modelName.section", "$modelName.visible" );

        if ($list_all == 0){
            $this->paginate = array(
                'fields' => $fields,
                'limit' => 100,
                'order' => array("$modelName.home_page_position" => 'ASC',"$modelName.id" => 'DESC'),
                'conditions' => $cond,
                'contain'=>false
            );
        }
        else{
            $this->paginate = array(
                'fields' => $fields,
                'order' => array("$modelName.position" => 'ASC',"$modelName.id" => 'DESC'),
                'conditions' => $cond,
                'contain'=>false
            );
        }

        $data = $this->paginate($modelName);

        $this->set('data', $data);


    }
    function admin_index_news($category_id = 0, $list_all=0){

        $modelName = $this->modelName;
        $controllerName = $this->controllerName;
        $userFilesFolder=$this->userFilesFolder;
        $this->set("modelName",$modelName);
        $this->set("controllerName",$controllerName);
        $this->set("list_all",$list_all);
        $this->set("category_id",$category_id);
        $section='news_events';
        $this->set("section",$section);

        $this->set_page_title($section);

        $this->loadModel("Category");
        $categories_list=$this->Category->find("list",array('fields'=>array("Category.title") , 'order'=>array('Category.title'=>'ASC')));
        $this->set("categories_list",$categories_list);



        $search_cond="";

        $search_cond="";
        if(isset($_GET['s'])){
            $search_phrase=$_GET['s'];
            //print_r($search_phrase);exit;
            $search_phrase = Sanitize::clean($search_phrase, array('encode' => false));
            $search_cond="($modelName.title like '%$search_phrase%')";

            $this->set('search_phrase',$search_phrase);
        }


        if(!empty($category_id) && ($category_id > 0)){
            $cond = array("$modelName.section"=>$section , "$modelName.parent_id"=>0  , "$modelName.category_id"=>$category_id  , $search_cond);
        }else{
            $cond = array("$modelName.section"=>$section , "$modelName.parent_id"=>0 , $search_cond);
        }


        $fields = array("$modelName.id","$modelName.title" ,"$modelName.modified","$modelName.date" , "$modelName.category_id" ,"$modelName.visible");



        if ($list_all == 0){
            $this->paginate = array(
                'fields' => $fields,
                'limit' => 40,
                'order' => array("$modelName.position" => 'ASC',"$modelName.id" => 'DESC'),
                'conditions' => $cond,
                'contain'=>false
            );
        }
        else{
            $this->paginate = array(
                'fields' => $fields,
                'order' => array("$modelName.position" => 'ASC',"$modelName.id" => 'DESC'),
                'conditions' => $cond,
                'contain'=>false
            );
        }

        $data = $this->paginate($modelName);

        $this->set('data', $data);


    }
    function admin_index($section = null, $list_all=0){

        $modelName = $this->modelName;
        $controllerName = $this->controllerName;
        $userFilesFolder=$this->userFilesFolder;
        $this->set("modelName",$modelName);
        $this->set("controllerName",$controllerName);
        $this->set("list_all",$list_all);

        $this->set("section",$section);

        $this->set_page_title($section);



        $search_cond="";

        $search_cond="";
        if(isset($_GET['s'])){
            $search_phrase=$_GET['s'];
            //print_r($search_phrase);exit;
            $search_phrase = Sanitize::clean($search_phrase, array('encode' => false));
            $search_cond="($modelName.title like '%$search_phrase%')";

            $this->set('search_phrase',$search_phrase);
        }

        if(!empty($search_cond)){
            $cond = array("$modelName.section"=>$section  , $search_cond);
        }else{
            $cond = array("$modelName.section"=>$section , "$modelName.parent_id"=>0 , $search_cond);
        }


        $fields = array("$modelName.id","$modelName.title" ,"$modelName.modified" ,"$modelName.visible");



        if ($list_all == 0){
            $this->paginate = array(
                'fields' => $fields,
                'limit' => 40,
                'order' => array("$modelName.position" => 'ASC',"$modelName.id" => 'DESC'),
                'conditions' => $cond,
                'contain'=>false
            );
        }
        else{
            $this->paginate = array(
                'fields' => $fields,
                'order' => array("$modelName.position" => 'ASC',"$modelName.id" => 'DESC'),
                'conditions' => $cond,
                'contain'=>false
            );
        }

        $data = $this->paginate($modelName);
        $this->set('data', $data);

        //print_r($data);exit;

        /////////////////           get path after edit
        // $parentIdArray=array();
//
        // if($child_id != null){
            // $current_data = $this->$modelName->getPath($child_id, array("id"));
            // foreach($current_data as $sub){
                // $parent_id=$sub['DynamicPage']['id'];
                // if($parent_id != $child_id){
                    // array_push($parentIdArray,$parent_id);
                // }
            // }
        // }
        // $this->set('parentIdArray',$parentIdArray);


    }


    function admin_index_2($section = null, $list_all=0){

        $modelName = $this->modelName;
        $controllerName = $this->controllerName;
        $userFilesFolder=$this->userFilesFolder;
        $this->set("modelName",$modelName);
        $this->set("controllerName",$controllerName);
        $this->set("list_all",$list_all);

        $this->set("section",$section);

        $this->set_page_title($section);



        $search_cond="";

        $search_cond="";
        if(isset($_GET['s'])){
            $search_phrase=$_GET['s'];
            //print_r($search_phrase);exit;
            $search_phrase = Sanitize::clean($search_phrase, array('encode' => false));
            $search_cond="($modelName.title like '%$search_phrase%')";

            $this->set('search_phrase',$search_phrase);
        }

        if(!empty($search_cond)){
            $cond = array("$modelName.section"=>$section  , $search_cond);
        }else{
            $cond = array("$modelName.section"=>$section , "$modelName.parent_id"=>0 , $search_cond);
        }


        $fields = array("$modelName.id","$modelName.title" ,"$modelName.modified" ,"$modelName.visible");



        if ($list_all == 0){
            $this->paginate = array(
                'fields' => $fields,
                'limit' => 40,
                'order' => array("$modelName.position" => 'ASC',"$modelName.id" => 'DESC'),
                'conditions' => $cond,
                'contain'=>false
            );
        }
        else{
            $this->paginate = array(
                'fields' => $fields,
                'order' => array("$modelName.position" => 'ASC',"$modelName.id" => 'DESC'),
                'conditions' => $cond,
                'contain'=>false
            );
        }

        $data = $this->paginate($modelName);
        $this->set('data', $data);

        //print_r($data);exit;

        /////////////////           get path after edit
        // $parentIdArray=array();
//
        // if($child_id != null){
            // $current_data = $this->$modelName->getPath($child_id, array("id"));
            // foreach($current_data as $sub){
                // $parent_id=$sub['DynamicPage']['id'];
                // if($parent_id != $child_id){
                    // array_push($parentIdArray,$parent_id);
                // }
            // }
        // }
        // $this->set('parentIdArray',$parentIdArray);


    }

    function admin_add_2($section =null ){
        $modelName = $this->modelName;
        $controllerName = $this->controllerName;
        $userFilesFolder=$this->userFilesFolder;
        $this->set("section",$section);

        $this->set_preferred_size($section);
        $this->set_page_title($section);

        if(empty($this->request->data)){

            $hashed_id = md5('unique_salt' . time());
            $this->set("hashed_id",$hashed_id);

        }else{

            $error = 0;

            /*////////////////      Image           ///////////////////////////////////////*/
            if (isset($this->request->data[$modelName]["image"]) && !empty($this->request->data[$modelName]["image"]["name"])){
                $resizes = $this->get_image_resizes("$section");
                $this->request->data[$modelName]['image']['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['image']['name']);
                $retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['image'],WWW_ROOT."/files/$userFilesFolder/original",'image',array('resize'=>true,'resizeOptions'=>$resizes,'randomName'=>false));
                $retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['image'],WWW_ROOT."/files/$userFilesFolder/thumb",'image',array('resize'=>true,'resizeOptions'=>$resizes,'randomName'=>false));
                if(!$retArray['error']){
                    $this->request->data["$modelName"]['image']=$retArray['fileName'];
                }else{

                    $fileError=$retArray['errorMsg'];
                    $this->request->data["$modelName"]['image']='';
                    $this->Session->setFlash($fileError);
                    $error=1;
                }
            }else{
                $this->request->data["$modelName"]['image']='';
            }


            /*//////////////////                end of Upload images        /////////////////////////////   **/


            if ($error == 0){

                $this->$modelName->create();
                $this->fill_empty_fields();
                $this->fillEmptyMetaFields($modelName);

                //print_r($this->request->data);exit;

                if((isset($this->request->data["$modelName"]['parent_id'])) && empty($this->request->data["$modelName"]['parent_id'])){
                    $this->request->data["$modelName"]['parent_id']=0;
                }
                $this->request->data[$modelName]["section"]=$section;

            // debug($this->request->data());exit;

                //print_R($this->request->data);exit;
                if ($this->$modelName->saveAll($this->request->data)){
                    $modelId = $this->$modelName->id;
                    //$current_parent_id=$this->request->data[$modelName]["parent_id"];


                    //////////////////////       media section  ///////////////////////////////////////
                    // $hashed_id= $this->request->data["$modelName"]['hashed_id'];
                    // $this->loadModel("Media");
                    // // updating the media items with the hashed id
                    // $this->Media->updateAll(
                        // array( 'Media.module_id' => $modelId ,'Media.module'=>'"DynamicPage"'),   //fields to update
                        // array( 'Media.hashed_id' => $hashed_id )  //condition
                    // );

                    //////////////////////       end of media section   ///////////////////////////////////////


                    /** save relations **/


                    $this->redirect("/admin/$controllerName/index_2/$section");
                    exit;
                }else{
                    $this->Session->setFlash("Page could not be saved. Please try again later.","admin/admin_err");
                    exit;
                }
            }
        }



        $this->set(compact('modelName','controllerName','type','parent_id'));
    }

    function admin_edit_2($id){
        $modelName = $this->modelName;
        $controllerName = $this->controllerName;
        $userFilesFolder=$this->userFilesFolder;

        $this->set('userFilesFolder',$userFilesFolder);
        $this->set("id",$id);
        $this->loadModel("SeoManagement");



        $id = (int)$id;
        $get_data = $this->get_all_locales(array("$modelName.id"=>$id),"$modelName",Configure::read('LOCALES'),array("title","text",'short'),array("SeoManagement"));



        $section=$get_data["$modelName"]['section'];
        $parent_id=$get_data["$modelName"]['parent_id'];
        $hashed_id=$get_data["$modelName"]['hashed_id'];


        $this->set("section",$section);
        $this->set("hashed_id",$hashed_id);
        $this->set("parent_id",$parent_id);


        $pointer=$this->$modelName->find("first",array("conditions"=>array("$modelName.id"=>$parent_id)));



        $this->set("pointer",$pointer);
        $this->set_preferred_size($section);
        $this->set_page_title($section);



        if($id==null || !is_numeric($id) || empty($get_data)){
            $this->Session->setFlash("Invalid Request");
            $this->redirect("/admin/$controllerName/index/");
            exit;
        }



        $error = 0;





        if(empty($this->request->data)){


            $this->request->data = $get_data;


            // print_r($this->request->data);exit;
            $seoData = $this->get_all_locales(array("SeoManagement.model_name"=>"$modelName","SeoManagement.field_id"=>$id),"SeoManagement",Configure::read('LOCALES'),array("slug","prepend_title","append_title","title","keywords","description"));
            if(!empty($seoData))
            $this->request->data["SeoManagement"] = $seoData["SeoManagement"];




            // $this->loadModel("Media");
//
            // $MediaData = $this->get_all_locales_multiple(array("Media.module"=>"$modelName","Media.module_id"=>$id),"Media",Configure::read('LOCALES'),array("title","caption"));
//
            // $this->request->data["Media"]=$MediaData;



        }
        else{
            $is_changed=0;
            $this->fill_empty_fields();

            //print_r($this->request->data);exit;


            /*////////////////      Image           ///////////////////////////////////////*/
            if (isset($this->request->data[$modelName]["image"]) && !empty($this->request->data[$modelName]["image"]["name"])){
                $resizes = $this->get_image_resizes("$section");
                $this->request->data[$modelName]['image']['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['image']['name']);
                $retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['image'],WWW_ROOT."/files/$userFilesFolder/original",'image',array('resize'=>true,'resizeOptions'=>$resizes,'randomName'=>false));
                $retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['image'],WWW_ROOT."/files/$userFilesFolder/thumb",'image',array('resize'=>true,'resizeOptions'=>$resizes,'randomName'=>false));
                if(!$retArray['error']){
                    $this->request->data["$modelName"]['image']=$retArray['fileName'];
                }else{

                    $fileError=$retArray['errorMsg'];
                    $this->request->data["$modelName"]['image']='';
                    $this->Session->setFlash($fileError);
                    $error=1;
                }
            }else{
                unset($this->request->data["$modelName"]['image']);
            }



            $this->fill_empty_fields();
            $this->fillEmptyMetaFields($modelName);

            //print_r($this->request->data);exit;

            if((isset($this->request->data["$modelName"]['parent_id'])) && empty($this->request->data["$modelName"]['parent_id'])){
                $this->request->data["$modelName"]['parent_id']=0;
            }
            $this->request->data["$modelName"]['id']=$id;

            if ($this->$modelName->saveAll($this->request->data)){


                // $modelId = $this->$modelName->id;
                // /////////////////////    media section       ////////////////////////////
                // $hashed_id= $get_data["$modelName"]['hashed_id'];
                // $this->loadModel("Media");
                // // updating the media items with the hashed id
                // $this->Media->updateAll(
                    // array( 'Media.module_id' => $modelId ,'Media.module'=>'"DynamicPage"'),   //fields to update
                    // array( 'Media.hashed_id' => $hashed_id )  //condition
                // );


                /*//////////         end of saving media    ///////////////////*/

                $this->Session->setFlash("Page Saved Successfully","admin/admin_succ");
                $this->redirect("/admin/$controllerName/index_2/$section");
                exit;

            }
        }
    }

    function admin_get_parent_tree($section){
        $modelName = $this->modelName;
        $controllerName = $this->controllerName;



        $main_parent_id=0;
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $pass=$_GET['id'];

            $pass=explode("_", $pass);

            $parent_id=$pass[1];
            $data=$this->$modelName->find("all",array('contain'=>false, 'fields'=>array("$modelName.id","$modelName.title"),  "conditions"=>array("$modelName.section"=>$section , "$modelName.parent_id"=>$parent_id) , 'order'=>array("$modelName.title"=>'ASC')));;

        }else{
            $data=$this->$modelName->find("all",array('contain'=>false, 'fields'=>array("$modelName.id","$modelName.title"),  "conditions"=>array("$modelName.section"=>$section , "$modelName.parent_id"=>0) , 'order'=>array("$modelName.title"=>'ASC')));;

        }




        foreach($data as $key=>$d){
            $id=$d["$modelName"]['id'];

            $counter=$this->$modelName->find("count",array('conditions'=>array("$modelName.parent_id"=>$id)));
            if($counter > 0){
                $data[$key]['DynamicPage']['has_children']=1;
            }else{
                $data[$key]['DynamicPage']['has_children']=0;
            }


        }


        $this->set("data",$data);
    }


    function admin_get_subpage_tree($type){
        //get the parents list of type section
        $main_parent_id=0;
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $main_parent_id=$_GET['id'];
        }


        if($main_parent_id == 0){
            $parentsList=$this->get_dynamic_pages_section_list_without_restriction('section');
            $roles_parentsList=$this->get_dynamic_pages_section_list_without_restriction('roles' );

        }else{
            $res=explode('_', $main_parent_id);
            $main_parent_id=$res['0'];
            $parent_id=$res['1'];
            $parentsList=$this->get_sub_dynamic_pages_section_list('section' ,$main_parent_id , $parent_id);
            $roles_parentsList=$this->get_sub_dynamic_pages_section_list('roles',$main_parent_id , $parent_id);
        }

        //print_R($parentsList);exit;
        $this->set('main_parent_id',$main_parent_id);
        $this->set("parentsList",$parentsList);
        $this->set("roles_parentsList",$roles_parentsList);

        $this->set('type',$type);

    }


    function admin_edit_section($section=null){
        $controllerName = $this->controllerName;
        $modelName = $this->modelName;
        $this->set('modelName',$modelName);
        $this->set('controllerName',$controllerName);
        $this->loadModel("SeoManagement");


        $this->set("section",$section);


        $userFilesFolder=$this->userFilesFolder;
        $this->set("userFilesFolder",$userFilesFolder);
        $locales = Configure::read("LOCALES");



        if(($section != 'careers') && ($section != 'contact')   ){
            $this->redirect("/admin/");
            exit;
        }


        $get_data =  $this->get_all_locales(array("$modelName.section"=>$section,"$modelName.parent_id"=>0),"$modelName",Configure::read('LOCALES'),array("title","text" , 'short'),array("SeoManagement"));

        if(empty($get_data)){
            $data["$modelName"]['id']=0;
            $data["$modelName"]['section']=$section;






            $this->fill_empty_fields();

            $this->$modelName->create();
            $this->$modelName->saveAll($data);

            $get_data =  $this->get_all_locales(array("$modelName.id"=>$section_id,"$modelName.parent_id"=>0),"$modelName",Configure::read('LOCALES'),array("title","text" ,'short'),array("SeoManagement"));

        }



        $id=$get_data["$modelName"]['id'];
        $this->set_page_title($section);


        $this->set('id',$id);

        if (empty($this->request->data)){
            $this->request->data = $get_data;
            //print_R($this->request->data);exit;

            $seoData = $this->get_all_locales(array("SeoManagement.model_name"=>"$modelName","SeoManagement.field_id"=>$id),"SeoManagement",Configure::read('LOCALES'),array("slug","prepend_title","append_title","title","keywords","description"));
            //print_r($seoData);exit;
            if(!empty($seoData))
            $this->request->data["SeoManagement"] = $seoData["SeoManagement"];

        }
        else{

                $this->request->data["$modelName"]['id']=$id;
                $this->fillEmptyMetaFields($modelName);

                if ($this->$modelName->saveAll($this->request->data)){

                    $this->Session->setFlash("Item Edited Successfully","admin/admin_succ");
                    $this->redirect("/admin/$controllerName/edit_section/$section");
                    exit;
                }
                else {
                    $this->Session->setFlash("Item could not be saved. Please try again later.","admin/admin_err");
                    exit;
                }
        }
    }



    function admin_add($section =null ){
        $modelName = $this->modelName;
        $controllerName = $this->controllerName;
        $userFilesFolder=$this->userFilesFolder;
        $this->set("section",$section);

        $this->set_preferred_size($section);
        $this->set_page_title($section);

        $this->loadModel("Category");
        $categories_list=$this->Category->find("list",array('fields'=>array("Category.title") , 'order'=>array('Category.title'=>'ASC')));
        $this->set("categories_list",$categories_list);

        $this->set("contact_sub_section",$this->contact_sub_section);

        // debug($this->request->data);exit;

        if(empty($this->request->data)){
            //$parentsList=$this->get_dynamic_pages_dropdown_list($parent_id);


            //$this->set("parentsList",$parentsList);


            $hashed_id = md5('unique_salt' . time());
            $this->set("hashed_id",$hashed_id);

        }else{

            $error = 0;

            /*////////////////      Image           ///////////////////////////////////////*/
            if (isset($this->request->data[$modelName]["image"]) && !empty($this->request->data[$modelName]["image"]["name"])){
                $resizes = $this->get_image_resizes("$section");
                $this->request->data[$modelName]['image']['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['image']['name']);
                $retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['image'],WWW_ROOT."/files/$userFilesFolder/original",'image',array('resize'=>true,'resizeOptions'=>$resizes,'randomName'=>false));
                $retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['image'],WWW_ROOT."/files/$userFilesFolder/thumb",'image',array('resize'=>true,'resizeOptions'=>$resizes,'randomName'=>false));
                $retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['image'],WWW_ROOT."/files/$userFilesFolder/preview",'image',array('resize'=>true,'resizeOptions'=>$resizes,'randomName'=>false));
                if(!$retArray['error']){
                    $this->request->data["$modelName"]['image']=$retArray['fileName'];
                }else{

                    $fileError=$retArray['errorMsg'];
                    $this->request->data["$modelName"]['image']='';
                    $this->Session->setFlash($fileError);
                    $error=1;
                }
            }else{
                $this->request->data["$modelName"]['image']='';
            }



            /*//////////////////                end of Upload images        /////////////////////////////   **/


            if ($error == 0){

                $this->$modelName->create();
                $this->fill_empty_fields();
                $this->fillEmptyMetaFields($modelName);

                //print_r($this->request->data);exit;

                if((isset($this->request->data["$modelName"]['parent_id'])) && empty($this->request->data["$modelName"]['parent_id'])){
                    $this->request->data["$modelName"]['parent_id']=0;
                }
                $this->request->data[$modelName]["section"]=$section;

                if(isset($this->request->data[$modelName]["date"]) && empty($this->request->data[$modelName]["date"])){
                    $this->request->data['DynamicPage']['date']=gmdate("Y-m-d");
                }

                //print_R($this->request->data);exit;
                if ($this->$modelName->saveAll($this->request->data)){
                    $modelId = $this->$modelName->id;
                    //$current_parent_id=$this->request->data[$modelName]["parent_id"];


                    //////////////////////       media section  ///////////////////////////////////////
                    // $hashed_id= $this->request->data["$modelName"]['hashed_id'];
                    // $this->loadModel("Media");
                    // // updating the media items with the hashed id
                    // $this->Media->updateAll(
                        // array( 'Media.module_id' => $modelId ,'Media.module'=>'"DynamicPage"'),   //fields to update
                        // array( 'Media.hashed_id' => $hashed_id )  //condition
                    // );

                    //////////////////////       end of media section   ///////////////////////////////////////


                    /** save relations **/


                    if($section == 'contact_branches'){
                        $this->redirect("/admin/$controllerName/index_contact");
                    }elseif($section == 'news_events'){
                        $this->redirect("/admin/$controllerName/index_news");
                    }else{
                        $this->redirect("/admin/$controllerName/index/$section");
                    }

                    exit;
                }else{
                    $this->Session->setFlash("Page could not be saved. Please try again later.","admin/admin_err");
                    exit;
                }
            }
        }



        $this->set(compact('modelName','controllerName','type','parent_id'));
    }

    function admin_edit($id){
        $modelName = $this->modelName;
        $controllerName = $this->controllerName;
        $userFilesFolder=$this->userFilesFolder;


        $this->loadModel("Category");
        $categories_list=$this->Category->find("list",array('fields'=>array("Category.title") , 'order'=>array('Category.title'=>'ASC')));
        $this->set("categories_list",$categories_list);


        $this->set("contact_sub_section",$this->contact_sub_section);

        $this->set('userFilesFolder',$userFilesFolder);
        $this->set("id",$id);
        $this->loadModel("SeoManagement");



        $id = (int)$id;
        $get_data = $this->get_all_locales(array("$modelName.id"=>$id),"$modelName",Configure::read('LOCALES'),array("title","text",'short'),array("SeoManagement"));

        $section=$get_data["$modelName"]['section'];
        $parent_id=$get_data["$modelName"]['parent_id'];
        $hashed_id=$get_data["$modelName"]['hashed_id'];

        $pointer='';
        if($parent_id > 0){
            $pointer=$this->$modelName->find("first",array("conditions"=>array("$modelName.id"=>$parent_id), 'contain'=>false));
        }
        $this->set("pointer",$pointer);
        $this->set("section",$section);
        $this->set("hashed_id",$hashed_id);
        $this->set_preferred_size($section);
        $this->set_page_title($section);



        if($id==null || !is_numeric($id) || empty($get_data)){
            $this->Session->setFlash("Invalid Request");
            $this->redirect("/admin/$controllerName/index/");
            exit;
        }



        $error = 0;





        if(empty($this->request->data)){


            $this->request->data = $get_data;


            // print_r($this->request->data);exit;
            $seoData = $this->get_all_locales(array("SeoManagement.model_name"=>"$modelName","SeoManagement.field_id"=>$id),"SeoManagement",Configure::read('LOCALES'),array("slug","prepend_title","append_title","title","keywords","description"));
            if(!empty($seoData))
            $this->request->data["SeoManagement"] = $seoData["SeoManagement"];




            // $this->loadModel("Media");
//
            // $MediaData = $this->get_all_locales_multiple(array("Media.module"=>"$modelName","Media.module_id"=>$id),"Media",Configure::read('LOCALES'),array("title","caption"));
//
            // $this->request->data["Media"]=$MediaData;



        }
        else{
            $is_changed=0;
            $this->fill_empty_fields();

            //print_r($this->request->data);exit;


            /*////////////////      Image           ///////////////////////////////////////*/
            if (isset($this->request->data[$modelName]["image"]) && !empty($this->request->data[$modelName]["image"]["name"])){
                $resizes = $this->get_image_resizes("$section");
                $this->request->data[$modelName]['image']['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['image']['name']);
                $retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['image'],WWW_ROOT."/files/$userFilesFolder/original",'image',array('resize'=>true,'resizeOptions'=>$resizes,'randomName'=>false));
                $retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['image'],WWW_ROOT."/files/$userFilesFolder/thumb",'image',array('resize'=>true,'resizeOptions'=>$resizes,'randomName'=>false));
                $retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['image'],WWW_ROOT."/files/$userFilesFolder/preview",'image',array('resize'=>true,'resizeOptions'=>$resizes,'randomName'=>false));
                if(!$retArray['error']){
                    $this->request->data["$modelName"]['image']=$retArray['fileName'];
                }else{

                    $fileError=$retArray['errorMsg'];
                    $this->request->data["$modelName"]['image']='';
                    $this->Session->setFlash($fileError);
                    $error=1;
                }
            }else{
                unset($this->request->data["$modelName"]['image']);
            }

            // debug($this->request->data);die;

            $this->fill_empty_fields();
            $this->fillEmptyMetaFields($modelName);

            //print_r($this->request->data);exit;

            if((isset($this->request->data["$modelName"]['parent_id'])) && empty($this->request->data["$modelName"]['parent_id'])){
                $this->request->data["$modelName"]['parent_id']=0;
            }
            $this->request->data["$modelName"]['id']=$id;

            if ($this->$modelName->saveAll($this->request->data)){


                // $modelId = $this->$modelName->id;
                // /////////////////////    media section       ////////////////////////////
                // $hashed_id= $get_data["$modelName"]['hashed_id'];
                // $this->loadModel("Media");
                // // updating the media items with the hashed id
                // $this->Media->updateAll(
                    // array( 'Media.module_id' => $modelId ,'Media.module'=>'"DynamicPage"'),   //fields to update
                    // array( 'Media.hashed_id' => $hashed_id )  //condition
                // );


                /*//////////         end of saving media    ///////////////////*/

                $this->Session->setFlash("Page Saved Successfully","admin/admin_succ");

                    if($section == 'contact_branches'){
                        $this->redirect("/admin/$controllerName/index_contact");
                    }elseif($section == 'news_events'){
                        $this->redirect("/admin/$controllerName/index_news");
                    }else{
                        $this->redirect("/admin/$controllerName/index/$section");
                    }
                exit;

            }
        }
    }







    function admin_index_sub($section , $parent_id=null){
        $modelName = $this->modelName;
        $controllerName = $this->controllerName;
        $userFilesFolder=$this->userFilesFolder;
        $this->set("modelName",$modelName);
        $this->set("controllerName",$controllerName);
        $this->set("section",$section);


        $idArray=array();
        $all_id=array();
        $index=0;


        $cond=array("DynamicPage.parent_id"=>$parent_id);



        $data = $this->DynamicPage->find('all' ,array("fields"=>array("id","title","visible",'parent_id' ,'modified'),
        'conditions'=>$cond , 'contain'=>false,'order' => array('DynamicPage.position ASC', 'DynamicPage.id DESC')));


        $this->set('data',$data);
        $this->set("parent_id",$parent_id);
    }








    function admin_delete($id){
        $modelName = $this->modelName;
        $controllerName = $this->controllerName;
        $userFilesFolder=$this->userFilesFolder;
        $this->loadModel("PagesRelation");
        $this->loadModel("MenuBuilderRelation");
        //$this->loadModel("LandingBo");

        $cacheId = "all_languages";
        if (($languages = Cache::read($cacheId)) === false) {
            $this->loadModel("Language");
            $languages=$this->Language->find('all',array('callbacks'=>false));
            Cache::write($cacheId, $languages);
        }




        //////////////////////      admin upload data into workflow     //////////////////////////



        $MainArray=array();
        $all_id=array();
        $index=0;

        $idArray=array();
        if(!(in_array($id, $all_id))){
            array_push($idArray,$id);
            array_push($all_id,$id);
        }

        $children=$this->$modelName->children($id,false,array("id"));

        foreach($children as $sub){
            if(!(in_array($sub['DynamicPage']['id'], $all_id)) ){
                array_push($idArray,$sub['DynamicPage']['id']);
                array_push($all_id,$sub['DynamicPage']['id']);
            }
        }


        // foreach($idArray as $child){
            // $child_id=$child;
            // $this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$child_id) , true , true);
            // $this->MenuBuilderRelation->deleteAll(array("MenuBuilderRelation.module_name"=>"$modelName","MenuBuilderRelation.page_id"=>$child_id) ,true , true);
        // }

        $error=0;

        //print_r($idArray);exit;
        foreach($idArray as $child){
            $child_id=$child;
            //print_r($child_id);exit;
            $get_data = $this->get_all_locales(array("$modelName.id"=>$child_id),"$modelName",Configure::read('LOCALES'),array('title'));
            //print_r($get_data);exit;
          if($this->$modelName->delete($child_id,true)){
            // foreach ($languages as $lang){
                // $locale = $lang["Language"]["locale"];
//
                // //document
                // $pdf_name=$get_data["$modelName"]["pdf"]["$locale"];
                // if(!empty($pdf_name)){
                    // $pdf_location=WWW_ROOT."files/$userFilesFolder/pdf/$pdf_name";
//
                    // if(file_exists($pdf_location))
                    // unlink($pdf_location);
                // }
//
//
            // }



            $image=$get_data["$modelName"]['image'];



            if(!empty($image)){
                //$title_logo
                $thumb_location=WWW_ROOT."files/$userFilesFolder/thumb/$image";
                $preview_location=WWW_ROOT."files/$userFilesFolder/preview/$image";
                $original_location=WWW_ROOT."files/$userFilesFolder/original/$image";
                if(file_exists($thumb_location))
                unlink($thumb_location);
                if(file_exists($preview_location))
                unlink($preview_location);
                if(file_exists($original_location))
                unlink($original_location);
            }




            }else{
                $error=1;
            }

            if($error == 0){
                if(!isset($this->request->params["isAjax"])){
                    $this->Session->setFlash("Item Deleted Successfully","admin/admin_succ");
                    $this->redirect("/admin/$controllerName/index");
                    exit;
                }else{
                    echo 1;
                    exit;
                }
            }else{
                if(!isset($this->request->params["isAjax"])){
                    $this->Session->setFlash("Item could not be deleted. Please try again later.","admin/admin_err");
                    $this->redirect("/admin/$controllerName/index");
                    exit;
                }else{
                    echo "Item could not be deleted. Please try again later.";
                    exit;
                }
            }
        }
    }

    function admin_ajax_order2(){
        $modelName=$this->modelName;

        $error_flag=0;
        $paginator_limit=$this->paginator_limit;

        $current_page_number=$this->params['named']['page'];

        $counter=($paginator_limit*$current_page_number) - $paginator_limit;

        foreach ($_GET['row'] as $position => $item) {

            $this->$modelName->id=$item;
            $position=$counter+$position;
            if($this->$modelName->saveField('home_page_position',$position))
            $error_flag=1;
            else $error_flag=0;
        }

        if($error_flag==1)
        echo "<div class='highlight_msg'>The order has been changed successfully</div>";
        exit;
    }

    function admin_ajax_order(){
        $modelName=$this->modelName;

        $error_flag=0;
        $paginator_limit=$this->paginator_limit;

        $current_page_number=$this->params['named']['page'];

        $counter=($paginator_limit*$current_page_number) - $paginator_limit;

        foreach ($_GET['row'] as $position => $item) {

            $this->$modelName->id=$item;
            $position=$counter+$position;
            if($this->$modelName->saveField('position',$position))
            $error_flag=1;
            else $error_flag=0;
        }

        if($error_flag==1)
        echo "<div class='highlight_msg'>The order has been changed successfully</div>";
        exit;
    }

    function admin_show($id=null){
        if($this->RequestHandler->isAjax()){
            $this->layout='';
        }
        $modelName=$this->modelName;
        $controllerName=$this->controllerName;
        ////////Validating Id////////////
        if($id==null || !is_numeric($id)){
            if(!$this->RequestHandler->isAjax()){
                $this->Session->setFlash("Invalid Request");
                $this->redirect("/admin/$controllerName/index");
            }
            exit;
        }
        $this->$modelName->id=$id;
        $this->$modelName->saveField("visible",1);



        if(!($this->RequestHandler->isAjax())){
            $this->Session->setFlash("Status Changed successfully");
            $this->redirect("/admin/$controllerName/index");
            exit;
        }
        echo 1;exit;
    }

    function admin_hide($id=null){
        if($this->RequestHandler->isAjax()){
            $this->layout='';
        }
        $modelName=$this->modelName;
        $controllerName=$this->controllerName;
        ////////Validating Id////////////
        if($id==null || !is_numeric($id)){
            print "<pre>";
            print_r($id);
            print"</pre>";
            exit;
            if($this->RequestHandler->isAjax()){
                $this->Session->setFlash("Invalid Request");
                $this->redirect("/admin/$controllerName/index");
            }
            exit;
        }
        $this->$modelName->id=$id;
        $this->$modelName->saveField("visible",0);



        if(!($this->RequestHandler->isAjax())){
            $this->Session->setFlash("Status Changed successfully");
            $this->redirect("/admin/$controllerName/index");
            exit;
        }
        echo 1;
        exit;
    }











////////////////////////////////            end of admin interface      /////////////////////////////////////////////////


    function about_us($category_id = 0){
        $controllerName = $this->controllerName;
        $modelName = $this->modelName;

        $locale=$this->params['locale'];
        $lang=$this->params['lang'];
        $isAjax=false;

        if($this->RequestHandler->isAjax()){
            $isAjax=true;
        }

        $this->$modelName->locale = $locale;

        $section = 'about_us';
        $this->set("section",$section);
        //get section left menu
        $section_left_menu=$this->DynamicPage->get_section_left_menu($section , $locale);



        if($category_id == 0){
            if(!empty($section_left_menu)){
                $first_entry=$section_left_menu[0];
                $category_id=$first_entry["$modelName"]['id'];
            }
        }


        $page_details=$this->$modelName->get_page_details($category_id , $locale);
        // $seoData['SeoManagement']=$page_details['SeoManagement'];
        // $this->set("$seoData",$seoData);
        $this->loadModel('SeoManagement');
        $this->SeoManagement->locale = $this->locale;
        $seo = $this->SeoManagement->find('first', array('conditions' => array("SeoManagement.field_id" => $category_id)));
        foreach($seo['SeoManagement'] as $field => $value){
            if($value == ""){
                $seo['SeoManagement'][$field] = $this->backup_seo['SeoManagement'][$field][$this->params['locale']];
            }
        }
        $this->set('seoData',$seo);


        //get section banner
        $this->loadModel("Banner");
        $section_banner=$this->Banner->get_first_banners_of_selected_section($section  ,$locale);

        $section_name="about us";

        // debug($page_details['DynamicPage']['image']);die;

        $this->set(compact('isAjax', "section_left_menu",'page_details' ,'section_banner','section_name' , 'category_id'));

    }




    function business($sub_section ,  $category_id = 0){
        $controllerName = $this->controllerName;
        $modelName = $this->modelName;

        $locale=$this->params['locale'];
        $lang=$this->params['lang'];
        $isAjax=false;
        $this->set("sub_section",$sub_section);
        if($this->RequestHandler->isAjax()){
            $isAjax=true;
        }

        $this->$modelName->locale = $locale;

        $section = $sub_section;

        //get section left menu
        $section_left_menu=$this->DynamicPage->get_section_left_menu_multi_level($section , $locale);


        if($category_id == 0){
            if(!empty($section_left_menu)){


                if(isset($section_left_menu[0]['DynamicPage'])){
                    if(isset($section_left_menu[0]['DynamicPage']['id'])){
//                      $first_entry=$section_left_menu[0]['children'][0];
                        $category_id=$section_left_menu[0]['DynamicPage']['id'];
                    }

                }
            }
        }

        $active_main_menu=0;
        foreach($section_left_menu as $m){
//          if(isset($m['DynamicPage'])){
//                  foreach($m['DynamicPage'] as $s){
                        $sub_id=$m['DynamicPage']['id'];
                        if($category_id == $sub_id){
                            $active_main_menu=$m['DynamicPage']['id'];
                        }
//                  }
//              }
        }


        $page_details=$this->$modelName->get_page_details_with_sub($category_id , $locale);

        $this->loadModel('SeoManagement');
        $this->SeoManagement->locale = $this->locale;
        $seo = $this->SeoManagement->find('first', array('conditions' => array("SeoManagement.field_id" => $category_id)));
        foreach($seo['SeoManagement'] as $field => $value){
            if($value == ""){
                $seo['SeoManagement'][$field] = $this->backup_seo['SeoManagement'][$field][$this->params['locale']];
            }
        }
        $this->set('seoData',$seo);
        // var_dump($seo);exit;

// debug($page_details);exit;
        // if(isset($page_details['SeoManagement'])){

        //     $seoData['SeoManagement']=$page_details['SeoManagement'];
        //     $this->set("$seoData",$seoData);

        // }


        //get section banner
        $this->loadModel("Banner");
        $section_banner=$this->Banner->get_first_banners_of_selected_section('our_business'  ,$locale);

        $section_name="our business";


        $this->set(compact('active_main_menu', 'isAjax', "section_left_menu",'page_details' ,'section_banner','section_name' , 'category_id' , 'section'));


    }


    function our_brands($category_id = 0  , $sub_category=0){
        $controllerName = $this->controllerName;
        $modelName = $this->modelName;

        $locale=$this->params['locale'];
        $lang=$this->params['lang'];
        $isAjax=false;

        if($this->RequestHandler->isAjax()){
            $isAjax=true;
        }

        $this->$modelName->locale = $locale;

        $section = 'our_brands';
        $this->set("section",$section);
        //get section left menu
        $section_left_menu=$this->DynamicPage->get_section_left_menu($section , $locale);


        if($category_id == 0){
            if(!empty($section_left_menu)){
                $first_entry=$section_left_menu[0];
                $category_id=$first_entry["$modelName"]['id'];
            }
        }

        $back_url='';
        $show_brand_details=0;
        if($sub_category > 0){
            $page_details=$this->$modelName->get_page_details_with_sub($sub_category , $locale);
            $back_url="/$lang/DynamicPages/our_brands/$category_id";
            $show_brand_details=1;
        }else{
            $page_details=$this->$modelName->get_page_details_with_sub($category_id , $locale);
        }


        // $seoData['SeoManagement']=$page_details['SeoManagement'];
        // $this->set("$seoData",$seoData);
        $this->loadModel('SeoManagement');
        $this->SeoManagement->locale = $this->locale;
        $seo = $this->SeoManagement->find('first', array('conditions' => array("SeoManagement.field_id" => $category_id)));
        foreach($seo['SeoManagement'] as $field => $value){
            if($value == ""){
                $seo['SeoManagement'][$field] = $this->backup_seo['SeoManagement'][$field][$this->params['locale']];
            }
        }
        $this->set('seoData',$seo);


        //get section banner
        $this->loadModel("Banner");
        $section_banner=$this->Banner->get_first_banners_of_selected_section("$section"  ,$locale);

        $section_name="our brands";


        $this->set(compact('show_brand_details', 'back_url', 'active_main_menu', 'isAjax', "section_left_menu",'page_details' ,'section_banner','section_name' , 'category_id' , 'section'));

    }





    function news_events_landing(){
        $controllerName = $this->controllerName;
        $modelName = $this->modelName;

        $locale=$this->params['locale'];
        $lang=$this->params['lang'];
        $isAjax=false;

        if($this->RequestHandler->isAjax()){
            $isAjax=true;
        }

        $this->$modelName->locale = $locale;

        $section = 'news_events';
        $this->set("section",$section);


        //get news
        $news_list=$this->DynamicPage->get_news_category_list($locale);

        // $this->loadModel('SeoManagement');
        // $this->SeoManagement->locale = $this->locale;
        // $seo = $this->SeoManagement->find('first', array('conditions' => array(
        //     "SeoManagement.slug" => 'news-category-1')));
        // $this->set('seoData',$seo);


        //get section banner
        $this->loadModel("Banner");
        $section_banner=$this->Banner->get_first_banners_of_selected_section($section  ,$locale);

        $section_name="news & events";
        $this->set(compact('isAjax', "news_list" ,'section_banner','section_name' ));

    }

    function news_events_listing($category_id=0){
        $controllerName = $this->controllerName;
        $modelName = $this->modelName;

        $locale=$this->params['locale'];
        $lang=$this->params['lang'];
        $isAjax=false;

        if($this->RequestHandler->isAjax()){
            $isAjax=true;
        }

        $this->$modelName->locale = $locale;

        $section = 'news_events';
        $this->set("section",$section);

        if(isset($this->params['named']["page"])){
            $page = $this->params['named']["page"];
        }
        else{
            $page = 1;
        }



        //get category details
        $this->loadModel("Category");
        $category_details=$this->Category->find("first",array("conditions"=>array("Category.id"=>$category_id)));



        $cond=array("$modelName.visible"=>1 , "$modelName.category_id"=>"$category_id" ,"$modelName.section"=>$section );

        $contain = array("SeoManagement"=>array("fields"=>array("id","slug")));
        $contain = $this->$modelName->generateContainableTranslations($modelName,$contain,$locale);

        $this->$modelName->locale = $locale;
        $this->paginate = array(
            'fields' => array("$modelName.id","$modelName.title","$modelName.date","$modelName.short","$modelName.category_id"),
            'limit' => 10,
            'page'=>$page,
            'order' => array("$modelName.date" => 'ASC' , "$modelName.position"=>'ASC', "$modelName.id"=>'DESC'),
            'conditions' => $cond,
            'contain'=>$contain
        );
        $data = $this->paginate($modelName);


        $back_url="/$lang/DynamicPages/news_events_landing";


        //get section banner
        $this->loadModel("Banner");
        $section_banner=$this->Banner->get_first_banners_of_selected_section($section  ,$locale);

        $section_name="news & events";
        $this->set(compact('data', 'back_url', 'category_details', 'isAjax', "news_list" ,'section_banner','section_name' ,'category_id' ));

    }



    function news_events_view($category_id=0 , $news_id=0){
        $controllerName = $this->controllerName;
        $modelName = $this->modelName;

        $locale=$this->params['locale'];
        $lang=$this->params['lang'];
        $isAjax=false;

        if($this->RequestHandler->isAjax()){
            $isAjax=true;
        }

        $this->$modelName->locale = $locale;

        $section = 'news_events';
        $this->set("section",$section);

        if(isset($this->params['named']["page"])){
            $page = $this->params['named']["page"];
        }
        else{
            $page = 1;
        }


        $news_details=$this->DynamicPage->get_news_details($news_id , $locale);
        // $seoData['SeoManagement']=$news_details['SeoManagement'];
        // $this->set("$seoData",$seoData);

        $this->loadModel('SeoManagement');
        $this->SeoManagement->locale = $this->locale;
        $seo = $this->SeoManagement->find('first', array('conditions' => array("SeoManagement.field_id" => $category_id)));
        foreach($seo['SeoManagement'] as $field => $value){
            if($value == ""){
                $seo['SeoManagement'][$field] = $this->backup_seo['SeoManagement'][$field][$this->params['locale']];
            }
        }
        $this->set('seoData',$seo);

        //get section banner
        $this->loadModel("Banner");
        $section_banner=$this->Banner->get_first_banners_of_selected_section($section  ,$locale);


        $page = $this->getPageNumber($news_id,10 , $category_id , $section );
        $back_url="/$lang/DynamicPages/news_events_listing/$category_id/page:$page";

        $section_name="news & events";
        $this->set(compact('news_details', 'back_url', 'category_details', 'isAjax', "news_list" ,'section_banner','section_name' ,'category_id' ));

    }


    function getPageNumber($id, $rowsPerPage, $category_id ,$section ) {


        $controllerName = $this->controllerName;
        $modelName = $this->modelName;
        $this->loadModel($modelName);




        $order =array("$modelName.date" => 'ASC' , "$modelName.position"=>'ASC', "$modelName.id"=>'DESC');
        $cond=array("$modelName.visible"=>1 , "$modelName.category_id"=>"$category_id" ,"$modelName.section"=>$section );

        $result = $this->$modelName->find('list',array('order'=>$order,'conditions'=>$cond)); // id => name


        $resultIDs = array_keys($result); // position - 1 => id

        $resultPositions = array_flip($resultIDs); // id => position - 1

        $position = $resultPositions[$id] + 1; // Find the row number of the record

        $page = ceil($position / $rowsPerPage); // Find the page of that row number

        return $page;
      }





    function careers(){
        $controllerName = $this->controllerName;
        $modelName = $this->modelName;

        $locale=$this->params['locale'];
        $lang=$this->params['lang'];
        $isAjax=false;

        if($this->RequestHandler->isAjax()){
            $isAjax=true;
        }

        $this->$modelName->locale = $locale;

        $section = 'careers';
        $this->set("section",$section);

        $page_details=$this->$modelName->get_section_details($section , $locale);
        $seoData['SeoManagement']=$page_details['SeoManagement'];
        $this->set("$seoData",$seoData);


        //get jobs
        $this->loadModel("Job");
        $job_list=$this->Job->getAllJobsList($locale);


        //get section banner
        $this->loadModel("Banner");
        $section_banner=$this->Banner->get_first_banners_of_selected_section($section  ,$locale);

        $section_name="careers";
        $this->set(compact('isAjax' , "job_list" ,'section_banner','section_name' ,'page_details' ));

    }



    function contact_us(){
        $controllerName = $this->controllerName;
        $modelName = $this->modelName;

        $locale=$this->params['locale'];
        $lang=$this->params['lang'];
        $isAjax=false;

        if($this->RequestHandler->isAjax()){
            $isAjax=true;
        }

        $this->$modelName->locale = $locale;

        $section = 'contact';
        $this->set("section",$section);

        $this->loadModel('SeoManagement');
        $this->SeoManagement->locale = $this->locale;
        $seo = $this->SeoManagement->find('first', array('conditions' => array(
            "SeoManagement.slug" => 'contact-us')));
        $this->set('seoData',$seo);
        // var_dump($seo);exit;

        //get contact branches
        $contact_branches=$this->DynamicPage->get_contact_branches($locale);
        //print_r($contact_branches);exit;

        //get section banner
        $this->loadModel("Banner");
        $section_banner=$this->Banner->get_first_banners_of_selected_section($section  ,$locale);

        $section_name="contact us";
        $this->set(compact('isAjax','section_banner','section_name','contact_branches'));
    }


    function branch_details($contact_id){
        $branch_details=$this->DynamicPage->find("first",array("conditions"=>array("DynamicPage.id"=>$contact_id)));

        $this->set("branch_details",$branch_details);
    }
    function job_details($id){
        $controllerName = $this->controllerName;
        $modelName = $this->modelName;

        $locale=$this->params['locale'];
        $lang=$this->params['lang'];
        $isAjax=false;

        if($this->RequestHandler->isAjax()){
            $isAjax=true;
        }

        $this->$modelName->locale = $locale;

        $this->loadModel("Job");
        $job_details=$this->Job->find("first",array("conditions"=>array("Job.id"=>$id)));




        $section_name="careers";
        $this->set(compact('isAjax' , "job_details" ,'section_banner','section_name' ,'id' ));

    }


    function get_footer_captcha(){

    }
    function download_file($id , $location=0){


        if($id!=null && is_numeric($id)){
            $controllerName = $this->controllerName;
            $modelName = $this->modelName;

            $locale=$this->params['locale'];
            $lang=$this->params['lang'];

            $this->$modelName->locale = $locale;
            $get_data=$this->$modelName->find('first',array("contain"=>false,"fields"=>array("$modelName.id","$modelName.pdf"),"conditions"=>array("$modelName.id"=>$id)));
            //print_r($get_data);exit;
            if(!empty($get_data)){
                $name=$get_data["$modelName"]['pdf'];
                $target_path = WWW_ROOT."files/dynamic_pages/pdf/";
                $full_path = $target_path.$name;

                $type=filetype($full_path);

                if($location  == 0){
                    header('Content-Type: '.$type);
                    header('Content-Disposition: attachment; filename="'.$name.'"' , false);
                }else{
                    header('Content-type: application/pdf');
                    header('Content-Disposition: inline; filename="' . $name . '"');
                    header('Content-Transfer-Encoding: binary');
                    header('Content-Length: ' . filesize($full_path));
                    header('Accept-Ranges: bytes');

                    @readfile($full_path);

                    exit();
                }





                print file_get_contents($full_path);
                exit;
            }
        }
        exit;
    }


}

?>
