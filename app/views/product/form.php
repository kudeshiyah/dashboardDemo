<form class="wrapper form form-inline"  name='form' ng-cloak enctype="multipart/form-data">
    <!-- <div class="error" ng-class="ctrl.addProductForm.error">
        <p class="error-text"> {{ctrl.addProductForm.errorMsg}} </p>
    </div> -->
    <div layout='row' layout-xs='column' style="margin-top: 15px;">
        <md-input-container class="md-inline md-custom-input" >
            <label>* Product Id</label>
            <input  required md-no-asterisk="" ng-disabled='{{flag}}' name="pId" data-ng-model="ctrl.data.pId">
            <div ng-messages="form.pId.$error ">
                <div ng-message="required">This is required.</div>
            </div>
        </md-input-container>
        <md-input-container class="md-inline md-custom-input" flex>
            <label>* Product Name</label>
            <input required md-no-asterisk="" name="pName" data-ng-model="ctrl.data.pName">
            <div ng-messages="form.pName.$error">
                <div ng-message="required">This is required.</div>
            </div>
        </md-input-container>
        <md-input-container class="md-inline md-custom-input" flex>
            <label>Text 1</label>
            <input  md-no-asterisk="" name="text1" data-ng-model="ctrl.data.text1">
        </md-input-container>
        <md-input-container class="md-inline md-custom-input" flex>
            <label>Text 2</label>
            <input  md-no-asterisk="" name="text2" data-ng-model="ctrl.data.text2">
        </md-input-container>
    </div>
    <div layout='row' layout-xs='column'>
        <md-input-container class='md-inline md-custom-input' flex>
            <label for="">Description 1</label>
            <textarea  name="descp1" id="" ng-model='ctrl.data.descp1' cols="30" rows="10"></textarea>
        </md-input-container>
        <md-input-container class='md-inline md-custom-input' flex>
            <label for="">Description 2</label>
            <textarea  name="descp2" id="" ng-model='ctrl.data.descp2' cols="30" rows="10"></textarea>
        </md-input-container>
    </div>
    <div layout='row' layout-xs='column'>
        <md-input-container class="md-inline md-custom-input" flex='initial'>
            <label>Available Quantity</label>
            <input  type='number' min='1' name="quantityAvailble" data-ng-model="ctrl.data.quantityAvailble">
            <div ng-messages="form.quantityAvailble.$error">
                <div ng-message="number">Please enter number</div>
            </div>
        </md-input-container>
        <md-input-container class="md-inline md-custom-input" flex>
            <label>Enter all varieety seperated by comma eg.(v1, v2, v3...)</label>
            <input type='text'  md-no-asterisk="" name="availaibleVariety" data-ng-model="ctrl.data.availaibleVariety">
        </md-input-container>
    </div>
    <div layout='row' layout-xs='column'>
        <md-input-container class="md-inline md-custom-input" flex>
            <label>* MRP</label>
            <input type='number' required md-no-asterisk="" name="mrp" data-ng-model="ctrl.data.mrp">
            <div ng-messages="form.mrp.$error">
                <div ng-message="required">This is required.</div>
            </div>
        </md-input-container>
        <md-input-container class="md-inline md-custom-input" flex>
            <label>discount in %</label>
            <input  name="discountPercent" data-ng-model="ctrl.data.discountPercent" type='number'>
        </md-input-container>
        <md-input-container class="md-inline md-custom-input" flex>
            <label>* Price</label>
            <input type='number' required md-no-asterisk="" name="price" data-ng-model="ctrl.data.price">
            <div ng-messages="form.price.$error">
                <div ng-message="required">This is required.</div>
            </div>
        </md-input-container>
        <md-input-container class="md-inline md-custom-input" flex>
            <label>discount</label>
            <input type='number'  md-no-asterisk="" name="discount" data-ng-model="ctrl.data.discount">
        </md-input-container>
        <md-input-container class="md-inline md-custom-input" flex>
            <label>Rating</label>
            <input type='number' name="rating" data-ng-model="ctrl.data.rating">
        </md-input-container>
    </div>
    <div layout='row' layout-align='space-between center'>
        <md-input-container class="md-inline md-custom-input" flex>
            <label>Image Name</label>
            <input name="imageName" data-ng-model="ctrl.data.imageName">
        </md-input-container>
    </div>
</form>
