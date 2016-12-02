angular
    .module('productModule')
    .controller('ProductController', ProductController);

function ProductController($scope, $http, $routeParams, $rootScope, $timeout, FunctionFactory, ProductFactory){
    let vm = this,
    fn = FunctionFactory;

    // setup home page
    vm.page = {processing:false}


    // setup data variavle for form
    vm.data = {}


    // setup form
    vm.form = {processing:false}
    vm.aVariety = ['gold','silver']

    /**** FETCH PAGE DETAILS ACCORDING TO VIEW ****/
    let page = window.location.href.split('/')[window.location.href.split('/').length-1]
    if (page == "products") {
      // fetch all products
      get_all_products();
    }


    // create product
    vm.save = ()=>{
      create(()=>{
        clear_form();
        ProductFactory.redirectTo_home();
      })
    }
    vm.save_and_new = ()=>{
      create(()=>{
        clear_form();
      })
    }
    function create(callback) {
        // checking form
        if(form_valid()){

          // if form is valid
          // start processing form
          start_form_processing();

          // format variety
          if (vm.data.availaibleVariety != undefined) {
              set_variety_attr()
          };

          // create new product
          ProductFactory.create(vm.data, ()=>{
            stop_form_processing();
            callback();
            vm.products.push(vm.data)
          });

        }
    }


    // delete product
    vm.destroy = (pId) =>{

      // @param = pId
      // @param = callback (execute only when product has been deleted)
      ProductFactory.destroy(pId,()=>
      {
        // find index of deleted product in products array
        let index = fn.findIndex(vm.products, 'pId', pId);

        // remove product from products array
        fn.remove_array_element(vm.products, index);
      })
    }


    // update product
    vm.update = ()=>{
        if(form_valid()){
          start_form_processing()

          if (vm.data.availaibleVariety != undefined) {
            set_variety_attr()
          };

          ProductFactory.update(vm.data, ()=>{
            stop_form_processing();
            clear_form();
            ProductFactory.redirectTo_home();
          });
        }
    }

    if(Object.keys( $routeParams ).length){
        ProductFactory.get_one($routeParams.pId, (data)=>{
            vm.product = data
            vm.data = vm.product
            vm.data.mrp = parseInt(vm.product.mrp)
            vm.data.price = parseInt(vm.product.price)

            if(vm.product.quantityAvailble != null){
              vm.data.quantityAvailble = parseInt(vm.product.quantityAvailble)
            }
            if(vm.product.variety != undefined){
                vm.data.availaibleVariety =  vm.product.variety.join(',')
            }
        })
    }


    function start_form_processing () {
         vm.form.processing = true;
    }
    function stop_form_processing () {
         vm.form.processing = false;
    }
    function get_all_products () {
        vm.page.processing = true;
        ProductFactory.get_all(function (list) {
            vm.page.processing = false;
            vm.products = list
        })
    }
    function form_valid(){
      if($scope.form.$valid){
        return true;
      }
      fn.error("Fill all * marked fields");
      return false;
    }
    function clear_form() {
      vm.data = {};
      $scope.form.$setPristine();
      $scope.form.$setUntouched();
    }
    function set_variety_attr(){
      vm.data.variety = vm.data.availaibleVariety.replace(/\s+/g, '').split(',')
      delete vm.data.availaibleVariety
    }
}
