app.directive('uploadImage', function(){
	// Runs during compile
	return {
		restrict: 'E', // E = Element, A = Attribute, C = Class, M = Comment
		scope:{
			label: '@label',
			value: '@value',
			multiple: '@multiple',
			required: '@required',
			property: '='
		},
		templateUrl: 'app/views/directive-templates/uploadImage.html',
		transclude: true
		
	};
});