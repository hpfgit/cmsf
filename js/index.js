var swiper = new Swiper('.swiper-container', {
    pagination: '.swiper-pagination',
    paginationClickable: true
});
$(".notice").Roll({
    'speed': 1,
});
var ali = $(".productTab ul").find('li');
ali.click(function(){
    var index = $(this).index();
    $(this).addClass('active').siblings().removeClass('active');
    var ul = $(".product-content ul");
    var ali = ul.find("li");
    ali.eq(index).show().siblings().hide();
});
var index = $(".index").find('li').size();
$(".bottom-navigation ul li").eq(index).find("img").attr('src', 'img/nav4_03.jpg');
var nScrollHight = 0; //滚动距离总长(注意不是滚动条的长度)
var nScrollTop = 0;  //滚动到的当前位置
$(".product-content ul li").css('height', $(window).height()-70);
var nDivHight = $(".product-content ul li").eq(0).height();
var start = 5;
var end = 8;
var start2 = 5;
var end2 = 8;
var start3 = 5;
var end3 = 8;
$(".product-content ul li").eq(0).scroll(function(){
nScrollHight = $(this)[0].scrollHeight;
nScrollTop = $(this)[0].scrollTop;
if(nScrollTop + nDivHight >= nScrollHight){
$(".mask").fadeIn();
var html = '';
var count = parseInt($("#count").val());
        if ((count-end) < 3 && (count-end) != 0) {
            end = count;
        }
        $.ajax({
            url:'http://me.baguduobao.com/loading.php',
            data:{
                start:start,
                end:end,
            },
            dataType:'json',
            type:'post',
            success:function(data){
                $(".mask").fadeOut();
                if (data) {
                    $.each(data, function(key, value){
                        var img = '';
                        if (value.img != ''){
                            var arr = value.img.split(',');
                            img += '<img src="baguadmin/'+arr[0]+'" alt="巴咕易购">';
                            }
                        html += '<a href="product.php?id='+value.id+'">'+img+'<span class="product-title">'+value.title+'</span><div class="progress-c"><div class="product-m" style="color: #ef0000; padding-top:.1rem; background-color:#ffffff;">¥'+value.total+'</div><div class="progress-zong">'+value.total+'条评价</div> <div class="progress-num">'+(Math.round((value.total-value.leftpeople)/value.total))*100+'%好评</div></div></a><div class="clearfix"></div>';
                    });
                    $(".product-content ul li").eq(0).append(html);
                    start += 3;
                    end += 3;
                }
            },
            error:function(jqXHR){
                alert('错误:'+jqXHR.status);
            },
        });
        if ((count-end) == 0) {
            $(".product-content ul li").eq(0).unbind ('scroll');
        }
    }
});
$(".product-content ul li").eq(1).scroll(function(){
nScrollHight = $(this)[0].scrollHeight;
nScrollTop = $(this)[0].scrollTop;
if(nScrollTop + nDivHight >= nScrollHight){
$(".mask").fadeIn();
var html = '';
var count2 = parseInt($("#count2").val());
        if ((count2-end2) < 3 && (count2-end2) != 0) {
            end2 = count2;
        }
        $.ajax({
            url:'http://me.baguduobao.com/loading1.php',
            data:{
                start2:start2,
                end2:end2,
                productlabel:'最新',
            },
            dataType:'json',
            type:'post',
            success:function(data){
                    $(".mask").fadeOut();
                if (data) {
                    $.each(data, function(key, value){
                        var img = '';
                        if (value.img != ''){
                            var arr = value.img.split(',');
                            img += '<img src="baguadmin/'+arr[0]+'" alt="巴咕易购">';
                            }
                        html += '<a href="product.php?id='+value.id+'">'+img+'<span class="product-title">'+value.title+'</span><div class="progress-c"><div class="product-m" style="color: #ef0000; padding-top:.1rem; background-color:#ffffff;">¥'+value.total+'</div><div class="progress-zong">'+value.total+'条评价</div> <div class="progress-num">'+(Math.round((value.total-value.leftpeople)/value.total))*100+'%好评</div></div></a><div class="clearfix"></div>';
                    });
                    $(".product-content ul li").eq(1).append(html);
                    start2 += 3;
                    end2 += 3;
                }
            },
            error:function(jqXHR){
                alert('错误:'+jqXHR.status);
            },
        });
        if ((count2-end2) == 0) {
            $(".product-content ul li").eq(1).unbind ('scroll');
        }
    }
});
$(".product-content ul li").eq(2).scroll(function(){
nScrollHight = $(this)[0].scrollHeight;
nScrollTop = $(this)[0].scrollTop;
if(nScrollTop + nDivHight >= nScrollHight){
$(".mask").fadeIn();
var html = '';
var count3 = parseInt($("#count3").val());
        if ((count3-end3) < 3 && (count3-end3) != 0) {
            end3 = count3;
        }
        $.ajax({
            url:'http://me.baguduobao.com/loading2.php',
            data:{
                start3:start3,
                end3:end3,
                productlabel:'最奢侈',
            },
            dataType:'json',
            type:'post',
            success:function(data){
                    $(".mask").fadeOut();
                if (data) {
                    $.each(data, function(key, value){
                        var img = '';
                        if (value.img != ''){
                            var arr = value.img.split(',');
                            img += '<img src="baguadmin/'+arr[0]+'" alt="巴咕易购">';
                            }
                        html += '<a href="product.php?id='+value.id+'">'+img+'<span class="product-title">'+value.title+'</span><div class="progress-c"><div class="product-m" style="color: #ef0000; padding-top:.1rem; background-color:#ffffff;">¥'+value.total+'</div><div class="progress-zong">'+value.total+'条评价</div> <div class="progress-num">'+(Math.round((value.total-value.leftpeople)/value.total))*100+'%好评</div></div></a><div class="clearfix"></div>';
                    });
                    $(".product-content ul li").eq(2).append(html);
                    start3 += 3;
                    end3 += 3;
                }
            },
            error:function(jqXHR){
                alert('错误:'+jqXHR.status);
            },
        });
        if ((count3-end3) == 0) {
            $(".product-content ul li").eq(2).unbind ('scroll');
        }
    }
});
$.ajax({
    url:'user.php',
    data:{
        username:'<?php echo $username; ?>',
    },
    dataType:'json',
    type:'post',
    success:function(data){
        if (data.success == 'true') {
            $("#login").addClass('login').html('');
            $("#login").attr('href', 'mybagu.php');
        } else if (data.success == 'false') {
            $("#login").removeClass('login').html('登录');
            $("#login").attr('href', 'login.php');
        }
    },
    error:function(jqXHR){
        alert('错误'+jqXHR.status);
    },
});