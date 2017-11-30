<script type="text/javascript">

function submitPoll(id){
      $('#refresh').show();
      $('#refresh').fadeIn(400).html('Please Wait <img src="images/loading.gif" />');
      var optionId=$('input[name=pollOption]:radio:checked').val();
      if(optionId=='' || optionId==null){
            alert('Please select Option');
      }else{
            var type="addPoll";
            var dataString = 'id='+ optionId + '&type=' + type + '&qid=' + id;
            $.ajax({
            type: "POST",
            url: "api/prosess.php",
            data: dataString,
            cache: false,
            success: function(result){
                   loadPoll('viewPoll',id);
            }
            });
      }
}

function loadPoll(type,id){
      $('#refresh').show();
      $('#refresh').fadeIn(400).html('Please Wait <img src="image/loading.gif" />');
      var dataString = 'id='+ id + '&type=' + type;
      $.ajax({
      type: "POST",
      url: "api/prosess.php",
      data: dataString,
      cache: false,
      success: function(result){
             $('#refresh').hide();
             $("#poll_wrap").html(result);
          }
      });
}
loadPoll('','');
</script>

        <div class="col-lg-6">
            <div class="news_pool">

                <div class="news_pool_option">

                     <div id="poll_wrap"></div> 

                </div>  
                
            </div>
        </div>