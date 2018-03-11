	function showComment2CommentInput(i)
           {
             $("#form_comment_2_comment"+i).show();
             $("#showCommentForm"+i).hide();
             
           }
           
      function hideComment2CommentInput(i)
           {
             $("#form_comment_2_comment"+i).hide();
             $("#showCommentForm"+i).show();
             
           }     

	
	
	 function showCommentInput(i)
           {
             $("#form_comment"+i).show();
             $("#showForm"+i).hide();
             
           }
           
      function hideCommentInput(i)
           {
             $("#form_comment"+i).hide();
             $("#showForm"+i).show();
             
           }     
           
           
      function showEditMessage(i)
           { 
             $("#form_edit_message"+i).show();
             $("#showEditForm"+i).hide();
             
           }     
      function hideEditMessage(i)
           {
             $("#form_edit_message"+i).hide();
             $("#showEditForm"+i).show();
             
           }    
     
     
     
     function showEditComment(i)
           { 
             $("#form_edit_comment"+i).show();
             $("#showEditCommentForm"+i).hide();
             
           }     
      function hideEditComment(i)
           {
             $("#form_edit_comment"+i).hide();
             $("#showEditCommentForm"+i).show();
             
           }     
         
      
      function showCommentWrapper(i)
		{
				
             $("#showComments"+i).hide();
             $("#comments_wrapper"+i).show();
             $("#hideComments"+i).show();
             $("#message_img"+i).attr("src","/smp/template/images/arrow_down.png");
              
             
           }
           
       function hideCommentWrapper(i)
		{
             
             $("#showComments"+i).show();
             $("#comments_wrapper"+i).hide();
             $("#hideComments"+i).hide();
             $("#message_img"+i).attr("src","/smp/template/images/arrow_right.png");
             
           }
