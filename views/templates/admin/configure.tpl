<div class="panel garante" id="garantia">
        <div class="panel-heading">
            {l s='Upload Image Garantia' mod='garante'}
        </div>
        
        <div class="col-md-12">
            <div id="alert-request"></div>
            <h2></h2>
        </div>
        <div class="w-100 container">
            <div class="row">
                <div id="img-gallery">
                    
                </div>
            </div>
        </div>
        <div class="w-100 container">
            <div class="row">
                <div class="col-12 image-box mt-4 mb-4 row">
                    <div id="image-garantia" class="col-md-6">
                        <div id="box-image-garantia">
                            <img id="image-garantia-main" src="" height="200" width="200" alt="Image preview...">
                        </div>
                    </div>
                    <div class="d-flex mod-column">
                        {$band = 0}
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Seleccione la garantia a la que corresponde la imagen</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                               {foreach from=$valuesFeature item=valuesF}
                                    <option value="{$valuesF['id_feature_value']}">{$valuesF['value']}</option>
                                {/foreach}
                            </select>
                          </div>
                       
                    </div>
                    <div class="input-group col-md-6">
                      <div class="custom-file w-100">
                        <input type="file" class="custom-file-input" id="inputFileImggarantia" aria-describedby="inputFileImggarantia" onchange="previewFile()">
                        <label class="custom-file-label" for="inputFileImggarantia">{l s='Choose image' mod='garante'}</label>
                      </div>
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="upload-img-garantia">{l s='Upload' mod='productgarantia'}</button>
                      </div>
                    </div>
                </div>
                
            </div>
        </div>
</div>