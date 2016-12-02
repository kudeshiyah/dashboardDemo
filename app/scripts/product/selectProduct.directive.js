angular
    .module('productModule')
	.directive('selectProduct',  function(){
		// Runs during compile
		return {
			scope: {
				property: '=',
                value: '@value',
                size:  '@size',
                label: '@label'
			},
			restrict: 'E',
			templateUrl: 'app/views/directive-templates/selectProduct.html',
			controller: select_product_directive_cotroller,
            controllerAs: 'selectProductCtrl'

		};
	});

function select_product_directive_cotroller($scope, ProductFactory) {
    // console.log('running add product directive controller')
    let vm = this;
    
	ProductFactory.getAll(function (list) {
    	 vm.products = list; 
    })

}