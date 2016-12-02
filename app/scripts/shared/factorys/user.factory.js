app.factory('UserFactory', UserFactory);

function UserFactory($http){
	var
	result = '',
	valid = true,
	form;

	let findUndefinedProp = (obj) =>{
		for(let prop in obj){
			// console.log(prop, obj[prop])
			if(obj[prop] === undefined){
				return true
			}
		}
		return false
	}

	let objUndefined = (obj) => {
		if(obj === undefined){
			return true;
		}
		return false
	}

	function validateReturn(form) {
		var result = { error_msg: '', valid: true }

		if(!objUndefined(form.data) && !findUndefinedProp(form.data)){
			removeError(form, result.error_msg)
        }
    	else{
    		result.error_msg = "Fill all the fields"
    		result.valid = false
        	showError(form, result.error_msg);
    	}

        return result;

	}

	function showError (form, msg) {
        form.errorMsg = msg;
        form.error = 'show';
        // console.log(form, msg)
    }

    function removeError (form, msg) {
        form.errorMsg = msg;
        form.error = 'hide';
    }

	function propIndexInObjectArray(arr, prop, value){
        if(arr.length == 0)
	        return {index:-1, valid:false}
		else if(arr[arr.length-1][prop] == value)
	        return {index:arr.length-1, valid:true}
		else
	        return propIndexInObjectArray(arr.slice(0, arr.length-1), prop, value)
	}

	function indexInNumericArray(arr, value){
        // console.log(arr, value)
        if(!Array.isArray(arr)){
            return {index:0, valid:true}
        }

		if(arr.length == 0)
	        return {index:-1, valid:false}
		else if(arr[arr.length-1] == value)
	        return {index:arr.length-1, valid:true}
		else
	        return indexInNumericArray(arr.slice(0, arr.length-1), value)
	}

    function remove(alertMsg, data, url, arr, index, deleteFunc) {
        swal({
            title: "Are you sure?",
            text: alertMsg,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: true,
            closeOnCancel: true
        },deleteFunc);
    }

    function sendFormDtatToServer(url, data, form, callback) {
		var returnData = {error: false, result: ''};

		$http.post(url, data).then(function (response) {
			var result = response.data;
			if(result['error']){
				showError(form, result['error']);
				returnData.error = true;
			}
			else
				returnData.error = false;

			returnData.result = result;
		});

		callback(returnData);
	}
	function remove_array_element(arr, index) {
		arr.splice(index,1)
		return arr;
	}

	function get_array_item(prop) {
		return (item)=>{
			return item[prop];
		}
	}

	function pluck(arr, prop) {
		return arr.map(get_array_item(prop));
	}

	function combine_array(arr1, arr2, finalArray) {
		finalArray = finalArray || [];
		finalArray.push([arr1[0], arr2[0]]);

		arr1 = remove_array_element(arr1, 0)
		arr2 = remove_array_element(arr2, 0)

		if(arr1.length === 0 && arr2.length === 0){
			return finalArray;
		}
		else {
			return combine_array(arr1, arr2, finalArray);
		}
	}
	function multiply(a,b) {
		return  parseFloat(a)*parseFloat(b);
	}
	function add(a,b) {
		// console.log(a,b);
		return  parseFloat(a)+parseFloat(b);
	}
	function substract(a,b) {
		return parseFloat(a) - parseFloat(b);
	}

	function find_all_items_info (itemList, itemIds, infoArr) {
	  if (itemIds.length == 0 ) {
	      return infoArr
	      ;
	  }
	  else{
	      itemList.forEach((p,i)=>{
	        if(p.pId == itemIds[itemIds.length-1])
	          infoArr
	      .push(p)
	      })
	      return find_all_items_info(itemList, itemIds.slice(0, itemIds.length-1), infoArr
	          )
	  }
	}
	function to_json(data) {
		return JSON.parse(angular.toJson(data));
	}
	function clone_object(obj) {
		return Object.assign({}, obj)
	}
	return{
		validate: function (obj, form, callback) {
			// console.log(obj)
			var result = {
				error_msg: '',
				valid: true
			}
			if(!objUndefined(obj) && !findUndefinedProp(obj)){
				removeError(form, result.error_msg)
	        }
	    	else{
	    		result.error_msg = "Fill all the fields"
	    		result.valid = false
	        	showError(form, result.error_msg);
	    	}
	        callback(result);

		},
    find_all_items_info: find_all_items_info,
		postFormData: sendFormDtatToServer,
		showErr: showError,
    removeErr: removeError,
    propIndexInObjectArray: propIndexInObjectArray,
    indexInNumericArray: indexInNumericArray,
    remove : (arr, data, url, index, alertMsg)=>{
    	remove(alertMsg, data, url, arr, index, ()=>{
    		$http.post(url, data).success((result)=>{
    			if(result.valid){
            if(!Array.isArray(arr)){
                // console.log('not an array', arr)
            }
						arr = remove_array_element(arr, index);
    				swal("Success", "Deleted successfully", "success")
    			}
    			else{
    				swal("Error", result.error, "error")
    			}

    		});
    	});
    },
    getItem: (data, url, callback)=>{
    	$http.post(url, data)
    		.success(item=>{callback(item)})

    },
    saveEdit: (form)=>{
    	let result = validateReturn(form)

  		if(result.valid){
    		if(form.data.files.length){
            var images = form.data.files.map(function(obj){ return obj.lfFile })
            delete form.data.files
            form.data.images = images
        }

      	if(form.type != undefined)
      		if (form.data.images || form.data.Limages.length) sendToServer(form)
              else showError(form, form.noImgselected)

          else if(form.data.images || form.data.Img.length) sendToServer(form)
          else showError(form, form.noImgselected)
      }

        function sendToServer (form) {
        	$http({
            	method:  	'post',
            	url: 		form.url,
            	data: 		form.data,
            	headers: 	{'Content-Type': 'multipart/form-data'}
            }).success((result)=>{
                swal("Success", form.successMsg, 'success')
            })
        }
    },
    ImagesUpload: data => data.files.length,
    copyObject: data => Object.assign({}, data),
		delete_item:(alertMsg,deleteFunc)=>{
        swal({
            title: "Are you sure?",
            text: alertMsg,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: true,
            closeOnCancel: true
        },deleteFunc);
    },
		remove_array_element: remove_array_element,
		get_array_item:get_array_item,
		pluck:pluck,
		combine_array:combine_array,
		multiply:multiply,
		to_json:to_json,
		clone_object:clone_object,
		substract:substract,
		add:add
	};
}
