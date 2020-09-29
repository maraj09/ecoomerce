function openNav() {
    document.getElementById("mySidepanel").style.width = "65%";
    document.querySelector("body").style.position="fixed";
    document.querySelector(".content").style.opacity=".5";
    }
function closeNav() {
    document.getElementById("mySidepanel").style.width = "0";
    document.querySelector("body").style.position="relative";
    document.querySelector(".content").style.opacity="1";
    }
    
    var dropdown = document.getElementsByClassName("fa-angle-down");
    var i;
    
    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
        });
    }   