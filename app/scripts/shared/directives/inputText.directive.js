app.directive('inputText', function(){
	// Runs during compile
	return {
		scope: {
            label: '@label',
            value: '@value',
            required: '@required',
            min: '@min',
            max: '@max',
            type: '@type',
            size: '@size',
            disabled: '@disabled',
            property: '='
        },
        restrict: 'E',
        transclude: true,
        templateUrl: 'app/views/directive-templates/inputText.html'
	};
});