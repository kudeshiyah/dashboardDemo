    <div class="container">
        <div layout="column" layout-align='start'>
            <div layout='row' layout-align='start center'>
                <md-button class='md-fab md-primary' href="#/products">
                    <md-icon><i class="material-icons">arrow_back</i></md-icon>
	                <md-tooltip md-visible="show" md-direction="bottom">
	                    go back
	                </md-tooltip>
                </md-button>
                <p style="margin: 0; color:#666; text-align:center; font-weight:bold; font-size: 24px;">Edit Product <span style='font-size:16px; color:brown; margin-left:20px; font-weight:normal;'>All * fields are manadatory</span></p>
            </div>
            <div  md-whiteframe="3" flex style="margin-top: 10px;" ng-init="flag=true" >
              <?php include 'form.php'; ?>
              <div layout='row' layout-align='space-between center'>
                  <md-button class="md-raised md-primary" ng-click='ctrl.update()'> <md-icon><i class="material-icons">launch</i></md-icon> Save </md-button>
              </div>
              <div layout='column' >
	                 <md-progress-linear ng-if='ctrl.form.processing' md-mode="indeterminate"></md-progress-linear>
	            </div>
            </div>
        </div>
    </div>
