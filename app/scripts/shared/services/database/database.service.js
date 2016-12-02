angular.module('niktikshaApp')
	.service('DatabaseService', DatabaseService)

function DatabaseService($http){
	let db = this

	function sendToServer (form) {
    	let promise = $http({
        	method:  	'post',
        	url: 		form.url, 
        	data: 		form.data
        }).then(function (response) {
            return response.data;
        });

        return promise
    }

	db.create = (form, callback)=>{
		return sendToServer(form)
	}

}