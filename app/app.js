var app = angular.module('niktikshaApp', ['ngRoute', 'ngMessages', 'ngMaterial', 'productModule', 'navbarModule']);

app
    .config(function($routeProvider) {
        $routeProvider
              .when('/products',
                {
                    controller: 'ProductController',
                    controllerAs: 'ctrl',
                    templateUrl: 'app/views/product/home.html'
                })
              .when('/addNewProduct',
                {
                    controller: 'ProductController',
                    controllerAs: 'ctrl',
                    templateUrl: 'app/views/product/create.php'
                })
              .when('/editProduct/:pId',
                {
                    controller: 'ProductController',
                   controllerAs: 'ctrl',
                    templateUrl: 'app/views/product/update.php'
                })
              .otherwise({ redirectTo: '/products' });
    });
