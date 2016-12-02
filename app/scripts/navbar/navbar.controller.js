angular
    .module('navbarModule')
    .controller('NavBarController', NavBarController);

function NavBarController($scope, $http, $route, $mdSidenav, UserFactory){

    let vm = this
    fn = UserFactory
    vm.loginForm = {error: 'hide', errorMsg:''};
    vm.cityOptions = ["Sheoganj", "Falna", "Abu Road"]
    vm.sideNavItems = [
      {link:"slider",name:"Sliders"},
      {link:'categorys', name: "Category"},
      {link:'specialCategories', name: "Special Categories"},
      {link:'products', name: "Product"},
      {link:'orders', name: "Orders"},
      {link:'reports', name: "Reports"},
      {link:'querys', name: "Querys"},
      {link:'bulk_upload', name: "Bulk Upload"}
    ]
    vm.admin = {}

    let arr = window.location.href.split('/'),
    page = arr[arr.length-1]

    if (page != "login.php" && page != "login_details") {
      get_user_details((result)=>{
        vm.admin = result
      })
    }
    else if(page == "login_details"){
      $http.post('app/php/navbar/getLoginDetails.php').success((result)=>{
        vm.loginDetails = result;
      })
    }


    $scope.toggleLeft = buildToggler('left');
    function buildToggler(componentId) {
      return function() {
        $mdSidenav(componentId).toggle();
      }
    }

    vm.login = function (loginData){
      if($scope.userLogin.$valid){
        $http.post('app/php/navbar/adminLogin.php', loginData).success(result=>{
            if(result.valid)
            {
              // console.log(result);
                fn.removeErr(vm.loginForm)
                let arr = window.location.pathname.split('/')
                arr.splice(arr.length-1, 1)
                window.location.assign(window.location.origin + arr.join('/'))
            }
            else
            {
                fn.showErr(vm.loginForm, result.error)
            }
        })
      }
      else {
          fn.showErr(vm.loginForm, "Fill all the fields");
      }
    }
    vm.logout = ()=>{
      $http.post("app/php/navbar/logout.php").success((result)=>{
        if (result.valid) {
          window.location.assign(window.location.origin + window.location.pathname)
        }
      })
    }
    vm.set_city = (city)=>{
      change_city(city)
    };

    function change_city(city) {
      // console.log("changing city");
        vm.admin.city = city
        $http.post('app/php/setCity.php', {city}).success(()=>{
          $route.reload();
        })
    }
    function get_user_details(callback){
      $http.post("app/php/navbar/getUserDetails.php").success((result)=>{
        callback(result)
      })
    }
}
