<?php
session_start();
if (!isset( $_SESSION['login'])) {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html data-ng-app="niktikshaApp">
<head>
    <title>Riddhi Login</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Michroma" rel="stylesheet">
    <link href="assets/bower_components/angular-material/angular-material.min.css" rel="stylesheet
    " />
    <link href="assets/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet"/>
    <link href="app/css/style.css" rel="stylesheet"/>
    <!-- <link rel="stylesheet" href="assets/bower_components/lf-ng-md-file-input/dist/lf-ng-md-file-input.css"> -->

    <!-- Vendor Libs: jQuery only used for Bootstrap functionality -->
    <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>



    <script src="assets/bower_components/angular/angular.js"></script>
    <script src="assets/bower_components/angular-route/angular-route.js"></script>
    <script src="assets/bower_components/angular-messages/angular-messages.js"></script>
    <script src="assets/bower_components/angular-animate/angular-animate.js"></script>
    <script src="assets/bower_components/angular-aria/angular-aria.js"></script>
    <script src="assets/bower_components/angular-material/angular-material.min.js"></script>

    <!-- UI Libs -->
    <script src="assets/bower_components/sweetalert/dist/sweetalert.min.js"></script>
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

<style media="screen">
  .navigation .md-select-value.md-select-placeholder{
    color: #fff;
    border-bottom-color: #fff;
    font-size: 17px;
  }
</style>
</head>
<body>

    <div class="container-fluid no-padding navigation" ng-controller='NavBarController as ctrl' ng-cloak>
      <div class="topbar" layout='row'>
        <p style="margin:auto 20px auto 10px; font-size:24px;">Dashboard</p>
        <p flex='initial'><a ng-href="#/products"> Products </a></p>
        <span flex></span>
        <p>{{ctrl.admin.city}}</p>
        <md-menu-bar>
          <md-menu ng-init='open=false' style="margin-top: 4px;">
            <button ng-click="$mdOpenMenu()">
              <i class="material-icons">more_vert</i>
            </button>
            <md-menu-content>
              <md-menu-item>
                <md-button disabled="disabled" ng-click="ctrl.logout()">
                  {{ctrl.admin.type}}
                  <span class="md-alt-text">User</span>
                </md-button>
              </md-menu-item>
              <md-menu-divider></md-menu-divider>
              <?php if($_SESSION['userType']=="super admin"){?>
                <md-menu-item>
                <md-menu>
                  <md-button ng-click='$mdOpenMenu()'>Change City</md-button>
                  <md-menu-content>
                    <md-menu-item><md-button ng-click="ctrl.set_city('City1')">City1</md-button></md-menu-item>
                    <md-menu-item><md-button ng-click="ctrl.set_city('City2')">City2</md-button></md-menu-item>
                    <md-menu-item><md-button ng-click="ctrl.set_city('City3')">City3</md-button></md-menu-item>
                  </md-menu-content>
                </md-menu>
              </md-menu-item>
              <?php } ?>
              <md-menu-item>
                <md-button ng-click="ctrl.logout()">
                  Logout
                </md-button>
              </md-menu-item>
            </md-menu-content>
          </md-menu>
        </md-menu-bar>
      </div>
    </div>
    <ng-view onload=""></ng-view>

</body>
</html>
