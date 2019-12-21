<?php    
    require_once('../../../config/config.inc.php');
    require_once('../../../init.php');
    $moduleName = 'garante';
    $module= Module::getInstanceByName($moduleName);
    header('Content-Type: application/json');
    //$idfeature = isset($_POST['idfeature']) ? $_POST['idfeature'] : '';
    $initGet = isset($_POST['init']) ? $_POST['init'] : 0;
    $errors = array();
    if($initGet):
        $resp =getImagePiece($module);
        echo json_encode($resp, JSON_FORCE_OBJECT);
        die();
    else:
        $imgPiece = $_FILES['imagePiece'];
        $featureType = $_POST['featureType'];
        $resp =uploadImage($module, $featureType, $imgPiece);
        echo json_encode($resp, JSON_FORCE_OBJECT);
        die();
    endif;
    
    function uploadImage($module,$featureType,$imgPiece)
    {
        $target_dir = "../views/img/garantias/";
        /*if(!file_exists($target_dir.'f-'.$featureType)):
            if(!mkdir($target_dir.'f-'.$featureType, 0755, true)):
                $resp = alertErrorImg($module);
            endif;
        endif;*/
        if(isset($imgPiece)):
          $errors= array();
          $file_name = $imgPiece['name'];
          $file_size =$imgPiece['size'];
          $file_tmp =$imgPiece['tmp_name'];
          $file_type=$imgPiece['type'];
          $temp = explode('.',$imgPiece['name']);
          
          $file_ext=strtolower(end($temp));
          //print_r(end($temp));die();
          $extensions= array("png");
          
          if(in_array($file_ext,$extensions)=== false):
             $errors[]="extension not allowed, please choose a JPEG or PNG file.";
          endif;
          
          if($file_size > 2097152):
             $errors[]='File size must be excately 2 MB';
          endif;
          if(empty($errors)==true):
             move_uploaded_file($file_tmp,$target_dir.'feature-'.$featureType.'.'.$file_ext);
             clearstatcache();
             $resp = getImagePiece($module);
             alertSucces($module);
          else:
             $resp = alertError($module);
          endif;
       endif;
       return $resp;
    }
    
    function getImagePiece($module){
        $target_dir = "../views/img/garantias/";
        $target_dir_module = "/modules/garante/views/img/garantias/";
        $ruta = "../views/img/garantias/"; // Indicar ruta
        $listImg = array();
        $filehandle = opendir($ruta); // Abrir archivos
            while ($file = readdir($filehandle)):
                if ($file != "." && $file != ".."):
                    $tamanyo = GetImageSize($ruta . $file);
                    $listImg[]= $target_dir_module.$file;
                endif;
             clearstatcache();
            endwhile;
        closedir($filehandle); // Fin lectura archivos
        return $listImg;
    }
    
    /**
     * alertError
     *
     * @param  mixed $module
     *
     * @return string
     */
    function alertErrorImg($module)
    {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.
                    '<strong>'.$module->l('Error', 'CustomModuleClass').'</strong> '.$module->l('Ups! Something has failed to create file image, please retry.', 'CustomModuleClass').
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
                        '<span class="pl-1" aria-hidden="true">&times;</span>'.
                    '</button>'.
                  '</div>';
        return $alert;
    }
    
    /**
     * alertError
     *
     * @param  mixed $module
     *
     * @return string
     */
    function alertError($module)
    {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.
                    '<strong>'.$module->l('Error', 'CustomModuleClass').'</strong> '.$module->l('Ups! Something has failed, please retry.', 'CustomModuleClass').
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
                        '<span class="pl-1" aria-hidden="true">&times;</span>'.
                    '</button>'.
                  '</div>';
        return $alert;
    }
    
    /**
     * alertWarning
     *
     * @param  mixed $module
     *
     * @return string
     */    
    function alertWarning($module)
    {
        $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">'.
                    '<strong>'.$module->l('Warning', 'CustomModuleClass').'</strong> '.$module->l('Select one features for register!', 'CustomModuleClass').
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
                        '<span class="pl-1" aria-hidden="true">&times;</span>'.
                    '</button>'.
                  '</div>';
        return $alert;
    }
    /**
     * alertWarning
     *
     * @param  mixed $module
     *
     * @return string
     */    
    function alertWarning2($module)
    {
        $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">'.
                    '<strong>'.$module->l('Warning', 'CustomModuleClass').'</strong> '.$module->l('First Register feature!', 'CustomModuleClass').
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
                        '<span class="pl-1" aria-hidden="true">&times;</span>'.
                    '</button>'.
                  '</div>';
        return $alert;
    }
    /**
     * alertSucces
     *
     * @param  mixed $module
     *
     * @return string
     */    
    function alertSucces($module)
    {
        $alert ='<div class="alert alert-success alert-dismissible fade show" role="alert">'.
                    '<strong>'.$module->l('Success', 'CustomModuleClass').'</strong> '.$module->l('Your upload image, success!.', 'CustomModuleClass').
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
                        '<span class="pl-1" aria-hidden="true">&times;</span>'.
                    '</button>'.
                '</div>';
        return $alert;
    }
?>