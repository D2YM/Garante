<?php

if (!defined('_PS_VERSION_')) {
    exit;
}
class Garante extends Module
{
    public function __construct()
    {
        $this->name = 'garante';
        $this->author = 'Arigato';
        $this->version = '1.0.0';
        $this->bootstrap = true;
        parent:: __construct();
        $this->displayName = $this->l('Garante');
        $this->description = $this->l('This is Module for prestashop, for garante in products');
        $this->ps_versions_compliancy = array('min'=> '1.7.0.0', 'max'=>'1.7.9.9');
    }
    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        };
        return  parent::install() &&
                $this->registerHook('displayHeader') &&
                $this->registerHook('displayGaranteProduct') &&
                Configuration::updateValue('maplocalice', 'Map Localice');
    }
    public function uninstall()
    {
        return parent::uninstall();
    }
    
    public function hookDisplayHeader($params)
    {
        /*    $this->context->controller->addCSS(array(
               $this->_path.'views/css/style.css',
                $this->_path.'views/css/select2.min.css'
            ));*/
    }
    public function getContent()
    {
            $this->context->controller->addJS(array(
                $this->_path.'views/js/admin.js?v='.rand()
            ));
             $this->context->controller->addCSS(array(
               $this->_path.'views/css/admin.css'
            ));             
            Media::addJsDef(array(
                'mp_ajax_upload_image_garante' => $this->_path.'helps/ajax_upload_image_garantia.php'
            ));
            $features = Feature::getFeature(1, 25);
            $valuesFeature = FeatureValue::getFeatureValuesWithLang(1, 25);
             $this->context->smarty->assign(array(
                'featuresgarante' => $features,
                'valuesFeature'=>$valuesFeature
            ));
        
        return $this->display(__FILE__, 'views/templates/admin/configure.tpl');
    }
    public function hookDisplayGaranteProduct($params){
        //getFeaturesStatic($params['product']['id_product']);
        //print_r(Product::getFrontFeaturesStatic(1,$params['product']['id_product']));echo'<hr>';
        $featuresProdut = Product::getFeaturesStatic($params['product']['id_product']);
        foreach($featuresProdut as $featureProdut):
            if($featureProdut['id_feature']==25):
                echo '<div class="col box-image-garante-gallery"><img class="img-gg" src="/modules/garante/views/img/garantias/feature-'.$featureProdut['id_feature_value'].'.png"></div>';
            endif;
        endforeach;
    }
}