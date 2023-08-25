function closeOnLoad(myLink) {
    var newWindow = window.open(myLink, "connectWindow", "width=1,height=1,scrollbars=yes");

    setTimeout(
        function() {
            newWindow.close();
        },
        300
    );


    setTimeout(() => {
        window.open("logout.php", "_self")
    }, 400)
    return false;
}