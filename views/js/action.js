$(document).ready(function(){
    var withdrawal=0;
    var deposit=0;
    var userId=1;
    var type;
    
    listAll(userId);
    
    window.setInterval(
        function()
        {
            listAll(userId);
        }, 
        2000
    );
    
    $("#withdrawal").click(
        function()
        {
            withdrawal = $("#count").val();
            deposit = 0;
            type = "提款";
            transaction(withdrawal,deposit,userId,type);
            $("#count").val('');
        }
    );
    $("#deposit").click(
        function()
        {
            withdrawal = 0;
            deposit = $("#count").val();
            type = "存款";
            transaction(withdrawal,deposit,userId,type);
            $("#count").val('');
            
        }
    );
    $("#changeId").click(
        function()
        {
            userId=$("#id").val();
            listAll(userId);
        }
    );
    function listAll(userId)
    {
        var before = '<table class="table table-striped"><tr><td>類型</td><td>金額</td><td>餘額</td><td>時間</td></tr>';
        var after = '</table>';
        $.ajax({
        url : "/SecondStage/payment/Payment/listAllAccountDetail/" + userId,
        type : "post",
        dataType : 'text',
        success : function(list){
                    $("#listContent").html(before+list+after);
                },
        error : function(xhr, ajaxOptions, thrownError){ 
                    setTimeout($("#result").html("更新中..."), 4000); 
                   
                 }
        });
        
    }
    function transaction(withdrawal,deposit,userId,type)
    {
    $.ajax({
        url:"/SecondStage/payment/Payment/transaction/" + withdrawal + "/" + deposit + "/" + userId + "/" + type,
        type:"post",
        dataType:'json',
        success: function(data){
                    $("#result").html(data.result)
                },
        error:function(xhr, ajaxOptions, thrownError){ 
                    setTimeout($("#result").html("伺服器出現異常，請稍後片刻"),10000); 
                   
                 }
    });
    }
});