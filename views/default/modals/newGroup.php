<div class="modal fade" id="newGroup" tabindex="-1" role="dialog" aria-labelledby="newGroupFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="newGroupFormLabel" >Ajouter une Asso, Group ? </h3>
      </div>
      <div class="modal-body">
        <p> </p>
        <br/>
        <form id="saveEntryForm" action="">
        
          <div class="apiForm saveGroup">
              <label for="">name : </label><input type="text" name="namesaveGroup" id="namesaveGroup" value="Asso1" /><br/>
              <label for="">email* :</label> <input type="text" name="emailsaveGroup" id="emailsaveGroup" value="<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com" /> (personne physique responsable )<br/>
              <label for="">cp* : </label><input type="text" name="postalcodesaveGroup" id="postalcodesaveGroup" value="97421" /><br/>
              <label for="">tags : </label><input type="text" name="tagssaveGroup" id="tagssaveGroup" value="" placeholder="ex:social,solidaire...etc"/><br/>
              <label for="">type : </label><select name="typesaveGroup" id="typesaveGroup" onchange="typeChanged()">
                    <option value="association">Association</option>
                    <option value="entreprise">Entreprise</option>
                    <option value="group">Groupe de personne</option>
                    <option value="event">Evenement</option>
                  </select><br/>
              <br/>
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
initT['newGroupModalsInit'] = function(){

    $("#saveEntryForm").submit( function(event){
      //log($(this).serialize());
      event.preventDefault();
      one = getRandomInt(0,10);
      two = getRandomInt(0,10);
      if( prompt("combien font "+one+"+"+two+" ?") == one+two ){
        $("#newGroupForm").modal('hide');
        //toggleSpinner();
        var hashtagList = getHashTagList( $("#message").val() );
        log(hashtagList.hashtags);
        //log(hashtagList.people);

        params = { "email" : $("#emailsaveGroup").val() , 
                     "name" : $("#namesaveGroup").val() , 
                     "cp" : $("#postalcodesaveGroup").val() , 
                     "pwd" : $("#pwdsaveGroup").val(),
                     "type" : $("#typesaveGroup").val(),
                     "tags" : $("#tagssaveGroup").val(),
                     "app":"<?php echo $this::$moduleKey?>",
                  };
            if( $("#whensaveGroup").val() )
              params["when"] = $("#whensaveGroup").val();
            if( $("#wheresaveGroup").val() )
              params["where"] = $("#wheresaveGroup").val();
            if( $("#whosaveGroup").val() )
              params["group"] = $("#whosaveGroup").val();
            
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