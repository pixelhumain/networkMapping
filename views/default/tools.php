<?php if(isset(Yii::app()->session["userId"])){
//echo Yii::app()->session["userId"];?>
<a href="javascript:hideShow('.home')"><i class="fa fa-home"></i></a>
<a href="#newGroup" role="button" data-toggle="modal" title="add a group"><i class="fa fa-plus"></i></a> 
<a href="javascript:hideShow('.newMessage')"><i class="fa fa-comment"></i></a> 
<a href="#newDate" role="button" data-toggle="modal" title="add a group"><i class="fa fa-calendar"></i></a> 
<a href="javascript:hideShow('.linkPeople')"><i class="fa fa-group"></i></a> 
<?php }?>