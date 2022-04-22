<?php
list($Column,$Value) = explode("~",$_POST['id']);
?>

<form class="edit">
   <h4>Editing: {{$Column}}</h4>
   <br>
   <div class="col-md-3"></div>
   <div class="col-md-6 mb-4">
      <div class="form-group row">
        <label for="Input-Value" class="col-sm-6">Value:</label>
        <div class="form-inline">
           <div class="input-group mb-3 youplay-input">
               <input type="text" id="Value" name="Value"placeholder="New Value" value="{{$Value}}">
            </div>
        </div>
      </div>
      <div class="row">
         <div class="col-md-6">
            <button type="button" class="btn btn-primary center-block" id="edit_setting"><i class="fa fa-check-circle"></i> Update Setting</button>
         </div>
      </div>
   </div>
</form>
