document.addEventListener("DOMContentLoaded", function () {

    var body = document.body;
    setInterval(createStar, 100);

    function createStar() {
        var right = Math.random() * 500;
        var top = Math.random() * screen.height;
        var star = document.createElement("div");
        star.classList.add("star")
        body.appendChild(star);
        setInterval(runStar, 5);
        star.style.top = top + "px";

        function runStar() {
            right += 3;
            star.style.right = right + "px";
            if (right >= screen.width) {
                star.remove();
            }
        }
    }
})
