<div class="modal fade" id="newDate" tabindex="-1" role="dialog" aria-labelledby="newDateFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="newDateFormLabel" >Ajouter une Date à l'agenda ? </h3>
      </div>
      <div class="modal-body">
        <p> </p>
        <br/>
        <form id="saveEntryForm" action="">
        
          <div class="apiForm addEvent">
            <label for="nameaddEvent">name : </label><input type="text" name="nameaddEvent" id="nameaddEvent" value="Asso1" /><br/>
            <label for="">email* : </label><input type="text" name="emailaddEvent" id="emailaddEvent" value="<?php echo strtolower($this::$moduleKey)?>@<?php echo strtolower($this::$moduleKey)?>.com" /> (personne physique responsable )<br/>
            <label for="">when : </label><input type="text" name="whenaddEvent" id="whenaddEvent" value="" /><br/>
            <label for="">where : </label><input  type="text" name="whereaddEvent" id="whereaddEvent" value="" /><br/>
            <label for="">cp* : </label><input type="text" name="postalcodeaddEvent" id="postalcodeaddEvent" value="97421" /><br/>
            <label for="">phoneNumber : </label><input type="text" name="phoneNumberaddEvent" id="phoneNumberaddEvent" value="1234" />(for SMS)<br/>
            <label for="">tags : </label><input type="text" name="tagsaddEvent" id="tagsaddEvent" value="" placeholder="ex:social,solidaire...etc"/><br/>
            <label for="">participant : </label><input  type="text" name="whoaddEvent" id="whoaddEvent" value="5370b477f6b95c280a00390c" /><br/>
    </div>
          
        </form>
        <div style="clear:both"></div>
      </div>
       <div class="modal-footer">
          <a class="btn btn-warning " href="javascript:;" onclick="$('#saveEntryForm').submit();return false;"  >ENREGISTRER</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
initT['newDateModalsInit'] = function(){

    $("#saveEntryForm").submit( function(event){
      //log($(this).serialize());
      event.preventDefault();
      one = getRandomInt(0,10);
      two = getRandomInt(0,10);
      if( prompt("combien font "+one+"+"+two+" ?") == one+two ){
        $("#newDateForm").modal('hide');

        params = { "email" : $("#emailaddEvent").val() , 
                   "name" : $("#nameaddEvent").val() , 
                   "cp" : $("#postalcodeaddEvent").val() , 
                   "pwd" : $("#pwdaddEvent").val(),
                   "type" : "event",
                   "phoneNumber" : $("#phoneNumberaddEvent").val(),
                   "tags" : $("#tagsaddEvent").val(),
                   "app":"<?php echo $this::$moduleKey?>",
                   "when":$("#whenaddEvent").val(),
                   "where":$("#whereaddEvent").val(),
                   "group":$("#whoaddEvent").val()
                };
            
       console.dir(params);
       $.ajax({
          type: "POST",
          url: '<?php echo Yii::app()->createUrl($this->module->id."/api/saveGroup")?>',
          data: params,
          success: function(data){
            if(data.result){
                window.location.reload();
            }
            else {
                  $("#flashInfo .modal-body").html(data.msg);
                  $("#flashInfo").modal('show');
            }
          },
          dataType: "json"
        });
    } else {
              $("#flashInfo .modal-body").html("mauvaise réponse, etes vous humain ?");
              $("#flashInfo").modal('show');
            }
      alert();
    });
  
  
};

function getRandomInt (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

</script>