angular
	.module('productModule')
	.factory('ProductFactory', ProductFactory);

function ProductFactory($http, FunctionFactory){
	let fn = FunctionFactory;
	// const URL = {
	// 	getAll: 'app/php/product/getAll.php',
	// 	getOne: 'app/php/product/getOne.php',
	// 	create: 'app/php/product/createProduct.php',
	// 	update: 'app/php/product/updateProduct.php',
	// 	destroy: 'app/php/product/deleteProduct.php'
	// }

	const URL = {
		getAll: 'app/json/products.json',
		getOne: 'app/php/product/getOne.php',
		create: 'app/php/product/createProduct.php',
		update: 'app/php/product/updateProduct.php',
		destroy: 'app/php/product/deleteProduct.php'
	}

	function validate(callback, result, flag = true) {
		callback(result)
		// if (result.valid) {
		// 	console.log(result);
		// 	if (result.data.length == 0) {
		// 		callback()
		// 	} else {
		// 		callback(result.data)
		// 	}
		// 	if(flag){
		// 		fn.success(result.msg)
		// 	}
		// } else {
		// 	fn.error(result.error)
		// }
	}

	return{
		get_all:(callback)=>{
			$http.post(URL.getAll).success((result)=>{ validate(callback, result, false)})
		},
		get_one: (pId, callback)=>{
			$http.post(URL.getAll).success((result)=>{callback(result.filter((p)=>{return p.pId==pId})[0])})
			// $http.post(URL.getOne, {pId}).success((result)=>{validate(callback, result, false)})
		},
		create:(data, callback)=>{
			callback();
			// $http.post(URL.create, data).success((result)=>{validate(callback, result)})
		},
		update:(data, callback)=>{
			$http.post(URL.update, data).success((result)=>{validate(callback, result)})
		},
		destroy:(pId, callback)=>{
			fn.confirm("Delete this Product", callback)
			// ()=>{
			// 	// $http.post(URL.destroy, {pId}).success((result)=>{validate(callback, result)})
			// })
		},
		redirectTo_home:()=>{
			fn.redirect_to("products");
		}
	}
}
