$(document).ready(function () {
    //$(".ce").html('<h2>Comments</h2><div id="ce_list"></div><form name="ce_form" id="ce_form" method="post" action="">Name:<input type="text" name="ce_name" id="ce_name" /><br />Comment:<textarea name="ce_comment" id="ce_comment"></textarea><br /><input type="submit" value="Add Comment"><br></form>');
//    $(".ce").each(function () {
//       //$(this).html('<h2>Comments</h2><div class="ce_list"></div><form name="ce_form" class="ce_form" method="post"><label>Name:</label><input type="text" name="ce_name" class="ce_name" /><br /><label>Comment:</label><textarea name="ce_comment" class="ce_comment"></textarea><br /><input type="submit" value="Add Comment"><br></form>'); 
//       
//       ceLoadComment(this);
//    });
    $(".ce_list").append('<div class="large-4 columns left"><h4 class="subheader left">New Comment</h4></div><div class="large-8 columns coments1"><form class="ce_form" action="" method="post"><input type="text" name="ce_name" class="ce_name" placeholder="Name"><textarea name="ce_comment" class="ce_comment" placeholder="Comments"></textarea><button type="submit">Submit</button></form></div>');
    $('.ce_form').submit(function(){
        ceAddComment();
        return false;
    });
    ceLoadComment();
});
                
                function ceLoadComment()
                {
                    $.ajax({
                        url: 'ce/loadComment.php',
                        dataType: "json",
                        success: function (data) {
                            console.log('load');
                            $(".ce_list").html('<div class="large-4 columns left"><h4 class="subheader left">New Comment</h4></div><div class="large-8 columns coments1"><form class="ce_form" action="" method="post"><input type="text" name="ce_name" class="ce_name" placeholder="Name"><textarea name="ce_comment" class="ce_comment" placeholder="Comments"></textarea><button type="submit">Submit</button></form></div>');
                            $.each(data, function()
                            {
                               $(".ce_list").prepend('<div class="large-4 columns left"><h4 class="subheader left">' + this.name + '</h4><img src="img/callout.png" alt="Commenter" width="40" class="right"></div><div class="large-8 columns coments1"><p>' + this.comment + '</p></div>');
                            });
                            $('.ce_form').submit(function(){
                                ceAddComment();
                                return false;
                            });
                        }
                    });
                }
                
                function ceAddComment()
                {
                    if ($('.ce_form').find('.ce_name').val() == '')
                    {
                        alert ('Please enter your name.');
                        return false;
                    }
                    if ($('.ce_form').find('.ce_name').val().length > 15)
                    {
                        alert ('The name is limited to 15 characters.');
                        return false;
                    }
                    if ($('.ce_form').find('.ce_comment').val() == '')
                    {
                        alert ('Please enter your comment.');
                        return false;
                    }
                    if ($('.ce_form').find('.ce_comment').val().length > 200)
                    {
                        alert ('The comment is limited to 200 characters.');
                        return false;
                    }
                    $.ajax({
                        data: {
                            name: $('.ce_form').find('.ce_name').val(), 
                            comment: $('.ce_form').find('.ce_comment').val()
                        },
                        url: 'ce/addComment.php',
                        dataType: "json",
                        success: function(data) {
                            
                            console.log(data.result);
                            if (data.result)
                            {
                                ceLoadComment();
                            }
                        }});
                }


