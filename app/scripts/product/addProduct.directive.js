angular
    .module('productModule')
	.directive('addProduct',  function(){
		// Runs during compile
		return {
			scope: {
				selected: '&'
			}, // {} = isolate, true = child, false/undefined = no change
			restrict: 'A', // E = Element, A = Attribute, C = Class, M = Comment
			templateUrl: 'app/views/directive-templates/addProduct.html',
			controller: addCategoryController,
            controllerAs: 'addProductCtrl'

		};
	});

function addCategoryController($scope, ProductFactory) {
    // console.log('running add product directive controller')

    var vm = this;
	vm.search = {
        input: {},
        searchBox: {state:'hide'}
    }
    vm.addProduct = {btn:'show', search:'hide', type:'addProduct'}

	ProductFactory.getAll(function (list) {
    	 vm.products = list;
    })

    vm.showSearchResultDiv = ()=> vm.search.searchBox.state = 'show'
    vm.hideSearchResultDiv = ()=> vm.search.searchBox.state = 'hide'

	vm.selectedProduct = (data) => {
    	vm.search.input.result = data.pId
    	vm.search.input.product = data
    	vm.hideSearchResultDiv()
    }

    vm.showSearch = () => {
    	 vm.addProduct.btn = 'hide'
    	 vm.addProduct.search = 'show'
    }

    vm.add = (data) => {

    	let match = vm.products.filter((p)=> {return p.pId == vm.search.input.result})
    	if(match.length == 1){
    		$scope.selected({data:match})
    		showBtn()
            vm.search.input.result = ''
    	}
    	else {
    		swal("Error", "Not a Valid Product ID", 'error')
    	}
    }

    vm.cancel = () => showBtn()

    function showBtn () {
    	vm.addProduct.btn = 'show'
    	vm.addProduct.search = 'hide'
    }
}
