    <div class="container">
        <div layout="row" layout-align='start'>
            <div>
                <md-button class='md-fab md-primary' href="#/products">
                    <md-icon><i class="material-icons">arrow_back</i></md-icon>
                    <md-tooltip md-visible="show" md-direction="bottom">
                        go back
                    </md-tooltip>
                </md-button>
            </div>
            <div  md-whiteframe="3" flex='70' style="margin: 0px auto; margin-top: 10px;" ng-init="flag=false" >
                <p style="margin:10px 0 0 0; color:#666; text-align:center; font-weight:bold; font-size: 24px;">Add Product <span style='font-size:16px; color:brown; margin-left:20px; font-weight:normal;'>All * fields are manadatory</span></p>
                <?php include 'form.php'; ?>
                <div layout='row' layout-align='end end'>
                  <md-button type='submit' class="md-raised md-primary" ng-click='ctrl.save()'> <md-icon><i class="material-icons">launch</i></md-icon> Save </md-button>
                  <md-button type='submit' class="md-raised md-primary" ng-click='ctrl.save_and_new()'> <md-icon><i class="material-icons">launch</i></md-icon> Save and New</md-button>
                </div>
                <div layout='column' >
                  <md-progress-linear ng-if='ctrl.form.processing' md-mode="indeterminate"></md-progress-linear>
                </div>
            </div>
        </div>
    </div>
