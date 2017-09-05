$(function () {
    var $menu1 = $(".menu1"), $menu1Li = $menu1.find("li"), $current = $menu1.find('.current'), $li_3 = $menu1.find('li.li_3'), $li_3_content = $li_3.find('.li_3_content');
    $menu1Li.hover(function () {
        var $this = $(this), num = $menu1Li.index($this), current = $menu1Li.index($(".first")), len = current - num;
        $menu1.css("background-position", (101 * current) + "px" + " bottom");
        $current.removeClass("lihover");
        $menu1Li.removeClass("first");
        $this.addClass("first");
        if (len <= 0) { len = -len; };
        if (num != 4) {
            $menu1.stop().animate({ backgroundPosition: (101 * num) + "px" + " bottom" }, 100 * len);
        }
        else {
            $menu1.stop().animate({ backgroundPosition: (101 * num + 30) + "px" + " bottom" }, 100 * len);
        }
    });
    $li_3.hover(function () {
        $li_3_content.stop(true, true).fadeIn(0);
    }, function () {
        $li_3_content.fadeOut(500, function () {
            $li_3_content.css("display", "none");
        });
    });
    $menu1.mouseleave(function () {
        var $this = $(this), num = $menu1Li.index($this), current = $menu1Li.index($current), len = current - num;
        $menu1Li.removeClass("first");
        $current.addClass("first");
        if (len <= 0) { len = -len; };
        $menu1.stop().animate({ backgroundPosition: (100 * current + 1) + "px" + " bottom" }, 100 * len);
    });
    $("a.noclick").click(function (event) {
        event.preventDefault();
    });
});