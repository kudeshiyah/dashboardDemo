<!DOCTYPE html>
<html data-ng-app="niktikshaApp">
<head>
    <title>Customer Manager</title>
    <link href="assets/bower_components/angular-material/angular-material.min.css" rel="stylesheet
    " />
    <link href="assets/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet"/>
    <link href="app/css/style.css" rel="stylesheet"/>

    <!-- Vendor Libs: jQuery only used for Bootstrap functionality -->
    <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>



    <script src="assets/bower_components/angular/angular.js"></script>
    <script src="assets/bower_components/angular-route/angular-route.js"></script>
    <script src="assets/bower_components/angular-messages/angular-messages.js"></script>
    <script src="assets/bower_components/angular-animate/angular-animate.js"></script>
    <script src="assets/bower_components/angular-aria/angular-aria.js"></script>
    <script src="assets/bower_components/angular-material/angular-material.min.js"></script>
    <script src="assets/bower_components/angular-csv-import/dist/angular-csv-import.js"></script>
    <script src="assets/bower_components/angular-sanitize/angular-sanitize.js"></script>
    <script src="assets/bower_components/ng-csv/build/ng-csv.js"></script>

    <!-- UI Libs -->
    <script src="assets/bower_components/sweetalert/dist/sweetalert.min.js"></script>
    <script src="assets/bower_components/ng-file-upload/ng-file-upload.js"></script>
    <!-- // <script src="assets/bower_components/lf-ng-md-file-input/dist/lf-ng-md-file-input.js"></script> -->

    <!-- App libs -->
    <script src="app/app.js"></script>

    <!-- Product -->
    <script src="app/scripts/product/product.module.js"></script>
    <script src="app/scripts/product/product.controller.js"></script>
    <script src="app/scripts/product/product.factory.js"></script>
    <script src="app/scripts/product/addProduct.directive.js"></script>
    <script src="app/scripts/product/selectProduct.directive.js"></script>

    <!-- login -->
    <script src="app/scripts/navbar/navbar.module.js"></script>
    <script src="app/scripts/navbar/navbar.controller.js"></script>

    <!-- Factory -->
    <script src="app/scripts/shared/factorys/user.factory.js"></script>
    <script src="app/scripts/shared/factorys/function.factory.js"></script>

    <!-- service -->
    <script src="app/scripts/shared/services/database/database.service.js"></script>

    <!-- directives -->
    <script src="app/scripts/shared/directives/animatedView.js"></script>
    <script src="app/scripts/shared/directives/uploadMultipleImage.directive.js"></script>
    <script src="app/scripts/shared/directives/inputText.directive.js"></script>



</head>
<body>

    <div class="container-fluid" ng-controller='NavBarController as ctrl' ng-cloak>
        <div class="error" ng-cloak ng-class="ctrl.loginForm.error">
            <p class="error-text" ng-cloak> {{ctrl.loginForm.errorMsg}} </p>
        </div>

        <form novalidate id='login' name='userLogin' ng-cloak>
            <h4 id='login-text'>Login</h4>

            <md-input-container class="md-block">
                <label>Username</label>
                <input required md-no-asterisk="" name="username" data-ng-model="data.username">
                <div ng-messages="userLogin.username.$error">
                    <div ng-message="required">This is required.</div>
                </div>
            </md-input-container>

            <div>
                <md-input-container class="md-block">
                <label for="password">Password</label>
                <input type="password" name="password" data-ng-model="data.password" required />
                <div ng-messages="userLogin.password.$error">
                    <div ng-message="required">This is required.</div>
                </div>
                </md-input-container>
            </div>
            <md-button md-no-ink class="md-raised md-primary" ng-click='ctrl.login(data)'>Login</md-button>
        </form>
    </div>
</body>
</html>
